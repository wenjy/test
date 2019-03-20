#!/bin/bash
read -p 'Please input (Y/N) :' yn
#[ "$yn" == 'Y' -o "$yn" == 'y' ] && echo 'OK, continue' && exit 0
#[ "$yn" == 'N' -o "$yn" == 'n' ] && echo 'Oh, interrupt' && exit 0
if [ "$yn" == 'Y' ] || [ "$yn" == 'y' ]; then
	echo 'Ok, continue'
	exit 0
fi
if [ "$yn" == 'N' ] || [ "$yn" == 'n' ]; then
        echo 'Oh, interrput'
        exit 0
fi
echo 'I don not konw what your choisce is' && exit 0
