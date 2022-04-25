#!/bin/bash

IMAGE_NAME=php7.4
CONTAINER_NAME=isat-open-cart-handler

P_PATH=$(pwd)
REMOTE_PATH=/var/www/html

USER_ID=$(id -u)

docker run --rm \
 -u "$USER_ID":"$USER_ID" \
 -v "$P_PATH":$REMOTE_PATH \
 --name $CONTAINER_NAME -it $IMAGE_NAME /bin/bash
