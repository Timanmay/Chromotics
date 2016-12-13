<?php

namespace CustomFramework;


class JsonRestManager {

    public static function createObject($content, $class) {
        if (! self::isJsonValid($content)) {
          echo "Invalid JSON";
            return false;
        }

        /*var_dump($request->getContent());
        var_dump(json_decode($request->getContent()));*/



        $object = new $class();

        self::fillObject($content, $object);

        return $object;
    }

    public static function updateObject($content, $em, $class) {
        if (! self::isJsonValid($content)) return false;

        $objectId = self::getObjectId($content);
        if ($objectId == 0) return false;

        $object = $em->getRepository($class)->find($objectId);

        self::fillObject($content, $object);

        return $object;
    }

    /*
     *
     */

    public static function isJsonValid($content) {

        //echo $request->getContent();

        if ($content === null) return false;
        if ($content == "") return false;


        return true;
    }

    public static function getObjectId($content) {
        $json = json_decode($content);

        foreach ($json as $key => $value) {
            if ($key == "id") return $value;
        }

        return 0;
    }


    public static function fillObject($content, $object) {
        //$json = json_decode($content);
        $json = $content;


        foreach ($json as $key => $value) {
            $method = 'set'.ucfirst($key);
            if (method_exists($object, $method)) {
                $object->$method($value);
            }
        }

        return $object;
    }








}
