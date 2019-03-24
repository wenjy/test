#!/bin/bash

# -n 安静模式 被 sed 处理过的行（或操作）才列出来
# -e 直接在命令行模式上进行 sed 的动作编辑
# -f 将 sed 命令的动作写到一个文件中，-f filename 则可执行文件内的 sed 动作
# -r 扩展正则表达式语法，默认是基础
# -i 直接修改读取文件的内容，而不是屏幕输出
# 动作说明 [n1[n2]]function a 新增 c 替换 d 删除 i 插入 p 打印 s替换

# 不显示2-5行
cat ips | sed '2,5d'

# 不显示第2行
cat ips | sed '2d'

# 不显示2-最后行
cat ips | sed '2,$d'

# 正则替换
cat ips | sed 's/192.168.0.3/127.0.0.1/g'
