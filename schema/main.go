package main

import (
	"crypto/rand"
	"crypto/rsa"
	"crypto/x509"
	"encoding/base64"
	"encoding/json"
	"encoding/pem"
	"errors"
	"fmt"
	"io/ioutil"
	"log"

	"github.com/parnurzeal/gorequest"
)

func main() {
	pubKey, err := getPubKey("site_public_key.pem")
	if err != nil {
		log.Println("Get pubKey error:", err)
		return
	}

	buf, err := ioutil.ReadFile("schema.sql")
	if err != nil {
		log.Println(err)
		return
	}

	err = run(pubKey, "mysql-ddl", buf)

	if err != nil {
		log.Println(err)
		return
	}
	log.Println("ok")
}

func run(pub *rsa.PublicKey, cmd string, sql []byte) error {

	buf := sql

	data := []string{}
	st := 128
	for i := 0; i < len(buf); i += st {
		h := i + st
		if h > len(buf) {
			h = len(buf)
		}
		b := buf[i:h]
		s, err := encode(string(b), pub)
		if err != nil {
			return err
		}
		data = append(data, s)
	}

	req := map[string]interface{}{"data": data}
	rbuf, err := json.Marshal(req)
	if err != nil {
		return err
	}

	r := gorequest.New()
	r.SetDebug(false)

	//fmt.Println(string(rbuf))

	rsp, resp, respErrs := r.Post("http://site.ai-r.info/run.cgi?command=" + cmd).SendString(string(rbuf)).End()
	if respErrs != nil {
		return fmt.Errorf("************ Post errors: %v", respErrs)
	}

	if rsp.StatusCode >= 400 {
		return fmt.Errorf("rsp.StatusCode %v", rsp.StatusCode)
	}

	fmt.Println(resp)

	return nil

}

func encode(src string, pubKey *rsa.PublicKey) (cr string, err error) {

	mess := []byte(src)

	enc, err := rsa.EncryptPKCS1v15(rand.Reader, pubKey, mess)
	if err == nil {
		cr = base64.StdEncoding.EncodeToString(enc)
	}
	return
}

func getPubKey(file string) (key *rsa.PublicKey, err error) {
	var rsaKey []byte
	if rsaKey, err = ioutil.ReadFile(file); err != nil {
		return
	}

	var block *pem.Block
	if block, _ = pem.Decode(rsaKey); block == nil {
		return nil, errors.New("PEM-block not found")
	}

	var res interface{}
	res, err = x509.ParsePKIXPublicKey(block.Bytes)
	key = res.(*rsa.PublicKey)

	return
}
