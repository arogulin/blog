<?php
namespace Blog\Entity;

use Blog\Lib\Functions;

class BaseEntity implements \ArrayAccess {

    public function __construct($data = array()) {
        foreach ($data as $name => $value) {
            $setter = Functions::toCamelCase('set_' . $name);
            $this->$setter($value);
        }
    }

    public function __call($methodName, $arguments) {
        $name = Functions::fromCamelCase($methodName);

        // if string begins with "get_"
        if (strpos($name, 'get_') === 0) {
            $name = str_replace('get_', '', $name);
            return $this->_get($name);
        } elseif (strpos($name, 'set_') === 0) {
            $name = str_replace('set_', '', $name);
            if (empty($arguments)) {
                throw new \Exception("Nothing to set for '" . $name . "' in '" . __CLASS__ . "'");
            }
            return $this->_set($name, $arguments[0]);
        }
        throw new \Exception("Method '" . $methodName . "' does not exists in '" . __CLASS__ . "'");
    }

    protected function _get($name) {
        if (property_exists($this, $name)) {
            return $this->$name;
        }
        throw new \Exception("Property '" . $name . "' does not exists in '" . __CLASS__ . "'");
    }

    protected function _set($name, $value) {
        if (property_exists($this, $name)) {
            $this->$name = $value;
            return $this;
        }
        throw new \Exception("Property '" . $name . "' does not exists in '" . __CLASS__ . "'");
    }

    public function offsetSet($offset, $value) {
        if (is_null($offset)) {
            throw new \Exception("Add element to array does not allowed for '" . __CLASS__ . "'");
        } else {
            $this->_set($offset, $value);
        }
    }

    public function offsetExists($offset) {
        return property_exists($this, $offset);
    }

    public function offsetUnset($offset) {
        throw new \Exception("Unset does not allowed for '" . __CLASS__ . "'");
    }

    public function offsetGet($offset) {
        return $this->_get($offset);
    }
}