#!/bin/bash

mkdir -p ../temp ../log ../reporter
chmod -R a+rw ../temp ../log ../reporter

pushd ..

docker run --rm -it -w /opt -v $PWD:/opt dockette/php:8.1 composer update

# https://contributte.org/packages/contributte/apitte/
docker run --rm -it -w /opt -v $PWD:/opt dockette/php:8.1 composer require contributte/apitte

popd
