#!/bin/bash
echo "The script name is => $0"
echo "Total parameter number is => $#"
[ "$#" -lt 2 ] && echo 'The number of parameter is less than 2. stop' && exit 0
echo "Your whole param is => '$@'"
echo "The 1st param is => $1"
echo "The 2st param is => $2"

shift # 进行第一次‘一个变量的shift
echo "Total parameter number is => $#"
echo "Your whole param is => '$@'"

shift 2
echo "Total parameter number is => $#"
echo "Your whole param is => '$@'"
