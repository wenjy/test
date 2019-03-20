#!/bin/bash

# 让用户输入文件名，并取得 fileuser 这个变量
echo -e 'I will use touch command create 3 files';
read -p 'Place input your filename:' fileuser;

# 为了避免用户随意按 enter，利用变量分析文件名是否有设置
# 如果 fileuser 没有设置则把'filename'赋值给filename
filename=${fileuser:-'filename'}; # 判断是否有配置文件名

# 使用 date 命令来取得所需要的文件名
# linux
#date1=$(date --date="+2 day" +%Y%m%d);
#date2=$(date --date="+1 day" +%Y%m%d);

# mac
date1=$(date -v-2d +%Y%m%d);
date2=$(date -v-1d +%Y%m%d);
date3=$(date +%Y%m%d);

file1=${filename}_${date1};
file2=${filename}_${date2};
file3=${filename}_${date3};

# 创建文件
touch "$file1";
touch "$file2";
touch "$file3";
