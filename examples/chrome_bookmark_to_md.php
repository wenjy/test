<?php
// 把谷歌浏览器导出的书签生成 md文档

$bookmarks_file = __DIR__ . DIRECTORY_SEPARATOR . 'bookmarks_2020_3_25.html';

preg_match_all('/<DT><A HREF="(?<href>.*)" ADD_DATE.*">(?<title>.*)<\/A>/', file_get_contents($bookmarks_file), $matches);

//var_dump($matches);

if (!empty($matches['href'])) {
    $md = '';
    foreach ($matches['href'] as $k => $url) {
        $title = $matches['title'][$k] ?? '';
        $md .= "[{$title}]($url)\n\n";
    }
    file_put_contents(__DIR__ . DIRECTORY_SEPARATOR . date('Y-m-d').'-chrome-bookmarks.md', $md);
}
