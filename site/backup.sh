#!/bin/bash
echo "Start deploy"
ARCH=amd64
HOST=site
RHOME=/home/zf413514
WDIR=site.ai-r.info/www
SDIR=site.ai-r.info
#DB=/opt/ptks/oapi/db
MDIR=$PWD/deploy
TARGET=$MDIR/$WDIR
BDIR=$PWD/backup

mkdir -p "$BDIR"

### Mount deploy
docker-machine mount $HOST:$RHOME "$MDIR"

# ### backup 
cp -v -u -r "$MDIR"/$SDIR "$BDIR"

### Unmount
sleep 10s
docker-machine mount -u $HOST:$RHOME "$MDIR"

