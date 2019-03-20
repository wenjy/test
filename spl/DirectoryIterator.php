<?php
/**
 * @author: jiangyi
 * @date: 上午10:51 2018/11/12
 */

try {
    foreach (new DirectoryIterator('./') as $item) {
        if ($item->getFilename() == 'ArrayObject.php') {
            echo 'getFilename()->' . $item->getFilename() . PHP_EOL;
            echo 'isDot()->' . $item->isDot() . PHP_EOL;
            echo '__toString()->' . $item->__toString() . PHP_EOL;
            echo 'getPath()->' . $item->getPath() . PHP_EOL;
            echo 'getPathname()->' . $item->getPathname() . PHP_EOL;
            echo 'getPerms()->' . $item->getPerms() . PHP_EOL;
            echo 'getInode()->' . $item->getInode() . PHP_EOL;
            echo 'getSize()->' . $item->getSize() . PHP_EOL;
            echo 'getOwner()->' . $item->getOwner() . PHP_EOL;
            echo 'getGroup()->' . $item->getGroup() . PHP_EOL;
            echo 'getATime()->' . $item->getATime() . PHP_EOL;
            echo 'getMTime()->' . $item->getMTime() . PHP_EOL;
            echo 'getCTime()->' . $item->getCTime() . PHP_EOL;
            echo 'getType()->' . $item->getType() . PHP_EOL;
            echo 'isWritable()->' . $item->isWritable() . PHP_EOL;
            echo 'isReadable()->' . $item->isReadable() . PHP_EOL;
            echo 'isExecutable()->' . $item->isExecutable() . PHP_EOL;
            echo 'isFile()->' . $item->isFile() . PHP_EOL;
            echo 'isDir()->' . $item->isDir() . PHP_EOL;
            echo 'isLink()->' . $item->isLink() . PHP_EOL;
            echo 'getFileInfo()->' . $item->getFileInfo() . PHP_EOL;
            echo 'getPathInfo()->' . $item->getPathInfo() . PHP_EOL;
            echo 'setFileClass()->' . $item->setFileClass() . PHP_EOL;
            echo 'setInfoClass()->' . $item->setInfoClass() . PHP_EOL;
            echo 'openFile()->' . $item->openFile() . PHP_EOL;
        }
    }
} catch (Exception $e) {
    echo 'No files Found!' . PHP_EOL;
}
