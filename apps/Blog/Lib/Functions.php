<?php
namespace Blog\Lib;

class Functions {

    public static function slugify($string) {
        $result = strtolower($string);
        // replace all non alpha-numeric symbols to dashes
        $result = preg_replace('#[^a-zA-Z0-9]+#', '-', $result);
        // replace multiple dashes to one dash
        $result = str_replace('--', '-', $result);
        // trim dashes on the ends of string
        $result = trim($result, '-');

        return $result;
    }

    public static function toCamelCase($string) {
        $parts = explode('_', $string);
        $result = array_shift($parts);
        foreach ($parts as $part) {
            $result .= ucfirst($part);
        }
        return $result;
    }

    public static function fromCamelCase($string) {
        $words = preg_split('/([[:upper:]][[:lower:]]+)/', $string, null,
            PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);
        $words = array_map('strtolower', $words);
        $result = implode('_', $words);
        return $result;
    }

}