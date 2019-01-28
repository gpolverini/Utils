<?php

namespace Utils\Converters;

use stdClass;

/**
 * @author Gabriel Polverini <polverini.gabriel@gmail.com>
 */
trait ArrayAwareTrait
{
    /**
     * Converts an array to an object
     *
     * @param array $array the array to be converted to an object
     * @param bool $recursive Whether or not to convert child arrays to child objects
     * @return Object $object
     */
    public static function arrayToObject(array $array, $recursive = true) {
        $object = new stdClass;
        foreach($array as $k => $v) {
            $object->{$k} = ($recursive && is_array($v)) ? self::arrayToObject($v, $recursive) : $v;
        }
        return $object;
    }
}
