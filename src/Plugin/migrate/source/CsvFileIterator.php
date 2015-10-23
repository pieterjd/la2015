<?php
namespace Drupal\la2015\Plugin\migrate\source;
use \Iterator;
use \InvalidArgumentException;
/**
 * CSV File Iterator
 *
 * @author Jon LaBelle
 */
class CsvFileIterator implements Iterator
{
    /**
     * Must be greater than the longest line (in characters) to be found in
     * the CSV file (allowing for trailing line-end characters).
     *
     * @var int
     */
    const ROW_LENGTH = 2048;

    /**
     * Resource file pointer
     */
    private $_filePointer;

    /**
     * Represents current element in iteration
     *
     * @var int
     */
    private $_currentElement;

    /**
     * Cumalitve row count of CSV data
     *
     * @var int
     */
    private $_rowCounter;

    /**
     * CSV column delimeter
     *
     * @var string
     */
    private $_delimiter;
    
    /**
    * Headers of the csv file
    */
    private $_headers;
    

    /**
     * Create an instance of the CsvFileIterator class.
     *
     * Throws InvalidArgumentException if CSV file (string $file)
     * does not exist.
     *
     * @param string $file The CSV file path.
     * @param string $delimiter The default delimeter is a single comma (,)
     */
    public function __construct($file, $delimiter = ';')
    {
        if (! file_exists($file))
            throw new InvalidArgumentException("{$file}");

        $this->_filePointer = fopen($file, 'rt');
        $this->_delimiter = ';';
        $this->rewind();
    }

    /*
     * @see Iterator::rewind()
     */
    public function rewind()
    {
        $this->_rowCounter = 0;
        print_r("rewinding\n");
        print_r(rewind($this->_filePointer));
    }

    /*
     * @see Iterator::current()
     */
    public function current()
    {
        $this->_currentElement =
            fgetcsv($this->_filePointer, self::ROW_LENGTH, $this->_delimiter);
        $this->_rowCounter ++;

        return $this->_currentElement;
    }

    /*
     * @see Iterator::key()
     */
    public function key()
    {
        return $this->_rowCounter;
    }

    /*
     * @see Iterator::next()
     */
    public function next()
    {
        return ! feof($this->_filePointer);
    }

    /*
     * @see Iterator::valid()
     */
    public function valid()
    {
        if (! $this->next())
            fclose($this->_filePointer);
            return FALSE;

        return TRUE;
    }
    public function __toString(){
      return "delim: ".($this->_delimiter)."\n";
    }
}