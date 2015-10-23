<?php
namespace Drupal\la2015\test;
use Drupal\la2015\Plugin\migrate\source\CsvFileIterator;
use Drupal\la2015\Plugin\migrate\source\FileBase;

$file ="/Users/pieter-jandrouillon/Documents/drupalsites/d8/modules/dev/la2015/src/test/test.csv";
 $it =new CsvFileIterator($file);
 $fb = new FileBase(null,null,null,null);
// echo $fb->__toString();
// print_r($fb->fields());
    //print_r("key: ".$it->key()); 
  //print_r($it->current());
   // print_r("key: ".$it->key()); 
  /*while($it->next()){
    print_r($it->current()); 
    print_r("key: ".$it->key()); 
  }
  $it->rewind();
  $it->next();
  print_r($it->current());*/
  print_r("rewindend");
  while($it->next()){
    
    print_r("key: ".$it->key()."\n"); 
    $it->current();
  }
  /*
  foreach($it as $key => $value){
     print_r("key: $key"); 
    print_r("value ".print_r($value,TRUE)); 
  }
  */

?>