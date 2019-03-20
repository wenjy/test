#!/bin/bash
network='192.168.1'
for sitenu in $(seq 1 10)
do
	ping -c 1 ${network}.${sitenu} &> /dev/null && result=0 || result=1
	if [ "$result" == 0 ]; then
		echo "Server ${network}.${sitenu} is up."
	else
		echo "Server ${network}.${sitenu} is down."
	fi
done
