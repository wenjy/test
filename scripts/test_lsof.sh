#!/bin/bash
test=$(lsof -i | grep ':80')
if [ "$test" != '' ]; then
	echo 'WWW is running in your system.'
fi
