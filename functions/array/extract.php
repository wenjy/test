<?php
/**
int extract ( array var_array [, int extract_type [, string prefix]] )
本函数用来将变量从数组中导入到当前的符号表中。接受结合数组 var_array 作为参数并将键名当作变量名，值作为变量的值。
对每个键／值对都会在当前的符号表中建立变量，并受到 extract_type 和 prefix 参数的影响。 

注意: 自版本 4.0.5 起本函数返回被提取的变量数目。 

注意: EXTR_IF_EXISTS 和 EXTR_PREFIX_IF_EXISTS 是版本 4.2.0 中引进的。 

注意: EXTR_REFS 是版本 4.3.0 中引进的。 

extract() 检查每个键名看是否可以作为一个合法的变量名，同时也检查和符号表中已有的变量名的冲突。
对待非法／数字和冲突的键名的方法将根据 extract_type 参数决定。可以是以下值之一： 

EXTR_OVERWRITE
如果有冲突，覆盖已有的变量。 

EXTR_SKIP
如果有冲突，不覆盖已有的变量。 

EXTR_PREFIX_SAME
如果有冲突，在变量名前加上前缀 prefix。 

EXTR_PREFIX_ALL
给所有变量名加上前缀 prefix。自 PHP 4.0.5 起这也包括了对数字索引的处理。 

EXTR_PREFIX_INVALID
仅在非法／数字的变量名前加上前缀 prefix。本标记是 PHP 4.0.5 新加的。 

EXTR_IF_EXISTS
仅在当前符号表中已有同名变量时，覆盖它们的值。其它的都不处理。可以用在已经定义了一组合法的变量，然后要从一个数组例如 $_REQUEST 中提取值覆盖这些变量的场合。本标记是 PHP 4.2.0 新加的。 

EXTR_PREFIX_IF_EXISTS
仅在当前符号表中已有同名变量时，建立附加了前缀的变量名，其它的都不处理。本标记是 PHP 4.2.0 新加的。 

EXTR_REFS
将变量作为引用提取。这有力地表明了导入的变量仍然引用了 var_array 参数的值。可以单独使用这个标志或者在 extract_type 中用 OR 与其它任何标志结合使用。
本标记是 PHP 4.3.0 新加的。 
如果没有指定 extract_type，则被假定为 EXTR_OVERWRITE。 
注意 prefix 仅在 extract_type 的值是 EXTR_PREFIX_SAME，EXTR_PREFIX_ALL，EXTR_PREFIX_INVALID 或 EXTR_PREFIX_IF_EXISTS 时需要。
如果附加了前缀后的结果不是合法的变量名，将不会导入到符号表中。前缀和数组键名之间会自动加上一个下划线。 
extract() 返回成功导入到符号表中的变量数目。 
*/

