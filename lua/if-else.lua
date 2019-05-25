#!/usr/bin/env lua

-- `~=` 不等于
-- `..` 字符串拼接
-- io库的分别从stdin和stdout读写的read和write函数

age = 40
sex = "Male"

if age == 40 and sex =="Male" then
    print("男人四十一枝花")
elseif age > 60 and sex ~="Female" then
    print("old man without country!")
elseif age < 20 then
    io.write("too young, too naive!\n")
else
    local age = io.read()
    print("Your age is "..age)
end
