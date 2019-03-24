#!/bin/bash

# sort
# -f 忽略字母大小写
# -b 忽略最前面空格
# -M 以月份名字排序，JAN、DEC
# -n 使用数字排序，默认以文字类型排序
# -r 倒序
# -t 分隔符，默认 Tab 键分隔
# -k 区间

# uniq
# -i 忽略大小写
# -c 统计计数

# wc
# -l 仅列出行
# -w 仅列出多少字（单词）
# -m 多少字符

# cut 将一段信息的某一段切出来，以行为单位
# -d '分隔字符' -f 取出第几段
# -c 以字符的单位取出固定字符区间

cat ips | sort | uniq -c | sort -r

cat ips | wc -l

cat ips | wc -m

cat ips | cut -d '.' -f 4

# 查看php-fpm的进程个数
ps aux |grep php-fpm | wc -l

# linux 查看PHP-FPM在你的机器上的平均内存占用
# ps --no-headers -o "rss,cmd" -C php-fpm | awk '{ sum+=$1 } END { printf ("%d%s\n", sum/NR/1024,"M") }'

# split 切割文件
# -b 以文件大小切割 b、k、m
# -l 以文件行数切割

# `split -l 5 ips ip` 将会生成 ipa ipb 文件

# `-` 将前一个命令的 stdout 作为这次的 stdin
# tar -zcvf - test | tar -zxvf -
# 将test文件压缩打包，但是压缩打包的文件不是记录到文件，而是传送到 stdout ；经过管道后传送给 tar -zxvf
# - 就是代表前面的 stdout

# grep 分析一行的信息
# -a 将 binary 文件以 text 文件的方式查找数据
# -c 计算找到 查找字符串 的次数
# -i 忽略大小写
# -n 输出行号
# -v 反向选择，显示没有 查找关键词 的内容
