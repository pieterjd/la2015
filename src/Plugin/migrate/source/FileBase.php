<?php

/**
 * @file
 * Contains \Drupal\la2015\Plugin\migrate\source\FileBase.
 */

namespace Drupal\la2015\Plugin\migrate\source;


use Drupal\migrate\Entity\MigrationInterface;
use Drupal\migrate\Plugin\migrate\id_map\Sql;
use Drupal\migrate\Plugin\MigrateIdMapInterface;
use Drupal\la2015\Plugin\migrate\source\CsvFileIterator;

/**
 * Sources whose data is in a file, eg csv, xml, ...
 */
abstract class FileBase extends SourcePluginBase {
  
   //the file to read
  protected $file;
  //the delimiter between columns
  protected $delimiter;
  //does the file contain header?
  protected $headers;
  
  protected $lines;

  /**
   * @var \Drupal\migrate\Entity\MigrationInterface
   */
  protected $migration;
  
  /**
   * {@inheritdoc}
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition, MigrationInterface $migration) {
    parent::__construct($configuration, $plugin_id, $plugin_definition, $migration);
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
  
  public function iterator(){
    if(!isset($this->iterator){
      //read file
      $iterator = new CsvFileIterator($this->file,$this->delimiter);
      $this->iterator = $iterator;
    }
    return $this->iterator;
  }
  
  public function readHeaders(){
    $handle = fopen($this->file, "r");
    if ($handle) {
      if (($line = fgets($handle)) !== false) {
          $this->headers = explode($this->delimiter,$line);
      }

      fclose($handle);
    }
  }
  
}