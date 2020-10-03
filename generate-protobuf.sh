#!/usr/bin/env sh

CONTAINER_NAME="protobuf"
CURRENT="/tmp/protobuf"

docker build -t $CONTAINER_NAME ./containers/protobuf/

docker run --rm -it -v ${PWD}:$CURRENT $CONTAINER_NAME \
  --proto_path=$CURRENT/protos/ \
  --php_out=$CURRENT/generated \
  --php-grpc_out=$CURRENT/generated \
  --grpc_out=$CURRENT/generated \
  --plugin=protoc-gen-php-grpc=/usr/bin/protoc-gen-php-grpc \
  --plugin=protoc-gen-grpc=/usr/bin/grpc_php_plugin \
  $CURRENT/protos/service.proto
