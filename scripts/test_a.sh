#!/bin/bash
read -p 'Please input (Y/N) :' yn
[ "$yn" == 'Y' -o "$yn" == 'y' ] && echo 'OK, continue' && exit 0
[ "$yn" == 'N' -o "$yn" == 'n' ] && echo 'Oh, interrupt' && exit 0
echo 'I don not konw what your choisce is' && exit 0
