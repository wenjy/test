#!/usr/bin/env lua

sum = 0
for i = 1, 100 do
    sum = sum + i
end

print(sum)

sum = 0
for i = 1, 100, 2 do
    sum = sum + i
end

print(sum)

sum = 0
for i = 100, 1, -2 do
    sum = sum + i
end

print(sum)

sum = 2
repeat
    sum = sum ^ 2 --幂操作
    print(sum)
until sum >1000

print(sum)
