#!/bin/bash
read -p 'Input a filename:' filename
# 输入为空时，提示并退出
test -z $filename &&  echo 'You must input a filename.' && exit 0
# 判断文件是否存在
test ! -e $filename && echo "The filename '$filename' do not exist" && exit 0
# 判断文件类型与属性
test -f $filename && filetype='regulare file'
test -d $filename && filetype='directory'
test -r $filrname && perm='readable'
test -w $filename && perm="$perm writable"
test -x $fielname && perm="$perm executable"

echo "The filename: $filename is a $filetype"
echo " and the permissions are: $perm"
