<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ObjectComparator
 *
 * @author Teta
 */

namespace Walva\SupportkotBundle\Plugin;

class ObjectComparator {

    //put your code here

    public static $ASC = 'ASC';
    public static $DESC = 'DESC';
    private $property;
    private $order = 1;

    public function sort($objects, $property, $order = null) {
        $this->setProperty($property);
        usort($objects, array($this, "compare"));
        if ($order == self::$DESC) {
            $objects = array_reverse($objects);
        }
        return $objects;
    }

    public function compare($a, $b) {
        $method = "get" . ucfirst($this->getProperty());
        $a = $a->$method();
        $b = $b->$method();
        if (is_object($a) AND (get_class($a) != 'DateTime')) {
            $a = '' . $a;
            $b = '' . $b;
            
        }
        if (!isset($a))
            return -1;
        if (!isset($b))
            return 1;
        if ($a == $b)
            return 0;
        $result = ($a < $b) ? -1 : 1;
        return $result;
    }

    public function getProperty() {
        return $this->property;
    }

    public function setProperty($property) {
        $this->property = $property;
    }

}

?>
