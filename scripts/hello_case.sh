#!/bin/bash
case $1 in
	'hello')
	echo 'Hello, how are you'
	;;
	'')
	echo "You must input param, ex> {$0 someword}"
	;;
	*)
	echo "Usage $0 {hello}"
	;;
esac
