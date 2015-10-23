<?php

/**
 * @file
 * Contains \Drupal\la2015\Plugin\migrate\source\FileBase.
 */

namespace Drupal\la2015\Plugin\migrate\source;


use Drupal\migrate\Entity\MigrationInterface;
use Drupal\migrate\Plugin\migrate\id_map\Sql;
use Drupal\migrate\Plugin\MigrateIdMapInterface;
use Drupal\migrate\Plugin\migrate\source\SourcePluginBase;
use Drupal\la2015\Plugin\migrate\source\CsvFileIterator;

/**
 * Sources whose data is in a csv. Later I will refactor the shit out of it.
 */
 
 /**
 * Nodes from a csv file.
 *
 * @MigrateSource(
 *   id = "migrate_csv"
 * )
 */
class FileBase extends SourcePluginBase {
  
   //the file to read
  private $file;
  //the delimiter between columns
  private $delimiter;
  //does the file contain header?
  private $headers;
  
  private $lines;
  //the columns required to uniquely identify each row in the file
  private $ids;

  /**
   * @var \Drupal\migrate\Entity\MigrationInterface
   */
  protected $migration;
  
  /**
   * {@inheritdoc}
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition, MigrationInterface $migration) {
    parent::__construct($configuration, $plugin_id, $plugin_definition, $migration);
    $this->file = "/Users/pieter-jandrouillon/Documents/drupalsites/d8/modules/dev/la2015/src/test/test.csv";
    $this->delimiter = ';';
    $this->ids=array('idnr');
    $this->readHeaders();
  }
  
  /**
  * Print the query string when the object is used a string.
  *
  * @return string
  *   The query string.
  */
  public function __toString() {
    return (string) $this->file;
  }
  public function fields(){
    return $this->headers;
  }
  public function getIds(){
    return array();
  }
  public function count(){
    return count($this->lines);
  }
  public function getIterator(){
    if(!isset($this->iterator)){
      //read file
      $iterator = new CsvFileIterator($this->file);
      $this->iterator = $iterator;
    }
    return $this->iterator;
  }
  
  public function readHeaders(){
    $this->getIterator();
    $this->iterator->rewind();
    $this->headers = $this->iterator->current();
  }
  public function readLines(){
    //skip line with headers
    $this->iterator->current();
    //loop over lines
    
  }
  
}