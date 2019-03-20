#!/bin/bash
function printit () {
	echo -n "Your choice is $1"
}

case $1 in
	'one')
	printit 1
	;;
	'two')
	printit 2
	;;
	*)
	echo "Usage $0 {one|two}"
	;;
esac
