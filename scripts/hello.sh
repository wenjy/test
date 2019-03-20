#!/bin/bash
if [ "$1" == 'hello' ]; then
	echo 'Hello, how are you'
elif [ "$1" == '' ]; then
	echo "You must input param, ex> {$0 someword}"
else
	echo "The only param is 'hello', ex> {$0 hello}"
fi
