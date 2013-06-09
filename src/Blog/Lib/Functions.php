<?php
namespace Blog\Lib;

class Functions {

    public static function translit($string) {
        $from = array('а', 'б', 'в', 'г', 'д', 'е', 'ё', 'ж', 'з', 'и', 'й', 'к', 'л', 'м', 'н', 'о', 'п', 'р', 'с', 'т', 'у', 'ф', 'х', 'ц', 'ч', 'ш', 'щ', 'ы', 'ъ', 'э', 'ь', 'ю', 'я');
        $to = array(
            'a', 'b', 'v', 'g', 'd', 'e', 'yo', 'g', 'z', 'i', 'y', 'k', 'l', 'm', 'n', 'o', 'p', 'r', 's', 't', 'u', 'f', 'h',
            'ts', 'ch', 'sh', 'sch', 'y', '', 'e', '', 'yu', 'ya'
        );
        return str_ireplace($from, $to, $string);
    }

    public static function slugify($string) {
        $result = mb_strtolower($string, 'utf-8');
        $result = self::translit($result);
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

    /**
     * Wrap $string to last "space" or "dot" before position $length.
     *
     * @param string $string String for wrapping
     * @param int    $length Max length of wrapped string
     * @return string Wrapped string
     */
    public static function wrapContentToWord($string, $length = 100) {
        // If string length lower than $length, just return it
        if (mb_strlen($string, 'utf-8') <= $length) {
            return $string;
        }
        // From position at $length start
        $subString = mb_substr($string, 0, $length, 'utf-8');
        $endPositionDot = mb_strrpos($subString, '.', null, 'utf-8');
        $endPositionSpace = mb_strrpos($subString, ' ', null, 'utf-8');
        $endPosition = max($endPositionDot + 1, $endPositionSpace); // +1 because we need to leave a dot in string 
        return mb_substr($subString, 0, $endPosition, 'utf-8');
    }

}