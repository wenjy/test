<?php
/**
 * @author: jiangyi
 * @date: 下午1:53 2018/11/12
 */
/*** a simple xml tree ***/
$xmlstring = <<<XML
<?xml version = "1.0" encoding="UTF-8" standalone="yes"?>
<document>
  <animal>
    <category id="48">
      <species>monotremes</species>
      <type>platypus</type>
      <name>Bruce</name>
    </category>
  </animal>
  <animal>
    <category id="4">
      <species>arachnid</species>
      <type>funnel web</type>
      <name>Bruce</name>
      <legs>8</legs>
    </category>
  </animal>
</document>
XML;

/*** a new simpleXML iterator object ***/
try {
    /*** a new simple xml iterator ***/
    $it = new SimpleXMLIterator($xmlstring);
    /*** a new limitIterator object ***/
    foreach (new RecursiveIteratorIterator($it, 1) as $name => $data) {
        //echo $name . '=>' . $data . PHP_EOL;
        if ($name == 'animal') {
            //var_dump($data);
        }
    }
} catch (Exception $e) {
    echo $e->getMessage();
}

try {
    /*** a new simpleXML iterator object ***/
    $sxi =  new SimpleXMLIterator($xmlstring);

    /*** set the xpath ***/
    $foo = $sxi->xpath('animal/category/species');

    /*** iterate over the xpath ***/
    foreach ($foo as $k=>$v)
    {
        echo $v.PHP_EOL;
    }
}
catch(Exception $e)
{
    echo $e->getMessage();
}
