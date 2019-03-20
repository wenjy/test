#!/bin/bash
read -p 'Please input a number: ' nu
s=0
for ((i=1; i<=$nu; i++)) #两括号间不能有空格
do
	s=$(($s+$i))
done
echo "The result is ==> $s";
