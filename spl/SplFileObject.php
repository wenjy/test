<?php
/**
 * @author: jiangyi
 * @date: 下午2:19 2018/11/12
 */

try{
    // iterate directly over the object
    foreach( new SplFileObject(__DIR__.'/spl_file.log') as $line)
    // and echo each line of the file
    echo $line;
}
catch (Exception $e)
{
    echo $e->getMessage();
}

try{
    $file = new SplFileObject(__DIR__.'/spl_file.log');

    $file->seek(3);

    echo $file->current();
}
catch (Exception $e)
{
    echo $e->getMessage();
}
