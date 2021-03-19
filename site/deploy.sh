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

mkdir -p "$MDIR"

### Mount deploy
docker-machine mount $HOST:$RHOME "$MDIR"

### Make target dir
mkdir -p "$TARGET"

# ### Deploy php

cp -v -u -r basic/assets/  "$MDIR"/$SDIR
cp -v -u -r basic/commands/  "$MDIR"/$SDIR
cp -v -u -r basic/config/  "$MDIR"/$SDIR
cp -v -u -r basic/controllers/  "$MDIR"/$SDIR
cp -v -u -r basic/mail/  "$MDIR"/$SDIR
cp -v -u -r basic/models/  "$MDIR"/$SDIR
cp -v -u -r basic/runtime/  "$MDIR"/$SDIR
cp -v -u -r basic/vendor/  "$MDIR"/$SDIR
cp -v -u -r basic/views/  "$MDIR"/$SDIR
cp -v -u -r basic/widgets/  "$MDIR"/$SDIR

cp -v -u -r basic/web/* "$TARGET"
chmod 750 "$TARGET"/index.php

### Unmount
sleep 10s
docker-machine mount -u $HOST:$RHOME "$MDIR"

