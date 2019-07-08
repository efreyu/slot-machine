<?php


namespace App\Services\GiftService;


use App\Exceptions\ClassNotFoundException;

class GiftFactory
{
    /**
     * @param $type
     * @param array $options
     * @return mixed
     * @throws ClassNotFoundException
     */
    public static function factory($type, array $options = array()) {
        $classname = 'App\\Services\\GiftService\\GiftState\\Gift'.$type;
        if (!class_exists($classname)) {
            throw new ClassNotFoundException($classname);
        }
        return new $classname($options);
    }
}