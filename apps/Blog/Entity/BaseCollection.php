<?php
namespace Blog\Entity;

class BaseCollection extends \ArrayIterator {

    protected $foundRows;

    public function getFoundRows() {
        return $this->foundRows;
    }

    public function setFoundRows($foundRows) {
        $this->foundRows = intval($foundRows);
        return $this;
    }
}