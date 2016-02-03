<?php

class Contenu implements Iterator {

    private $_read = 0;


    private $_write = 0;


    private $_content = [];

    public function __construct() {
        $this->reset();
    }

  
    public function get() {
        return $this->_content;
    }

    public function reset() {
        $this->_content = [];
        $this->_write = 0;
        $this->resetLine();
    }

    public function resetLine() {
        $this->_content[$this->_write] = '';
        return $this;
    }


    public function add($message) {
        $this->_content[$this->_write] .= $message;
        return $this;
    }

    public function insert($position, Contenu $content) {
        $max = ($this->_write + 1);
        if ($position < 0 || $position > $max) {
            throw new MethodParametersException('Nouvelle position invalide');
        }

        for ($i = $position; $i < $max; $i += 1) {
            $content->add($this->_content[$i]);
            if ($i < ($max - 1)) {
                $content->add_sauts();
            }
        }

        $this->_write = $position;
        $content->rewind();
        while ($content->valid()) {
            if ($content->key() > 0) {
                $this->add_sauts ();
            }
            $this->resetLine()->add($content->current());
            $content->next();
        }
    }


    public function add_sauts($number = 1) {
        if ($number < 1) {
            throw new MethodParametersException('Le nombre de saut de ligne n\'est pas bon');
        }

        for($i = 0; $i < $number; $i += 1) {
            $this->_write += 1;
            $this->resetLine();
        }
        return $this;
    }

    public function addTab($number = 1) {
        if ($number < 1) {
            throw new MethodParametersException('Le nombre de tabulation n\'est pas bon');
        }

        for($i = 0; $i < $number; $i += 1) {
            $this->_content[$this->_write] .= "\t";
        }
        return $this;
    }

    public function rewind() {
        $this->_read = 0;
    }

 
    public function current() {
        return $this->_content[$this->_read];
    }

    public function key() {
        return $this->_read;
    }


    public function next() {
        $this->_read += 1;
    }


    public function valid() {
        return isset($this->_content[$this->_read]);
    }

    public function writeFile($file) {
        $this->rewind();
        while ($this->valid()) {
            if ($this->key() > 0) {
                fputs($file, "\n");
            }
            fputs($file, $this->current());
            $this->next();
        }
    }

}