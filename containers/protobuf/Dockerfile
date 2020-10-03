FROM jaegertracing/protobuf

RUN wget https://github.com/spiral/php-grpc/releases/download/v1.4.0/protoc-gen-php-grpc-1.4.0-linux-amd64.tar.gz \
  && tar zxf protoc-gen-php-grpc-1.4.0-linux-amd64.tar.gz \
  && rm protoc-gen-php-grpc-1.4.0-linux-amd64.tar.gz \
  && mv protoc-gen-php-grpc-1.4.0-linux-amd64/protoc-gen-php-grpc /usr/bin/protoc-gen-php-grpc \
  && rm -Rf protoc-gen-php-grpc-1.4.0-linux-amd64

ENTRYPOINT ["protoc-wrapper", "-I/usr/include"]
