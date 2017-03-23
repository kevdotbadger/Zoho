<?php

namespace KevinRuscoe\Zoho;

class Utils {
    public static function toXmlEntity($entity, $payload = [])
    {
        $xml = "<$entity><row no='1'>";
        foreach ($payload as $key => $value) {
            $xml .= "<FL val='$key'>$value</FL>";
        }
        $xml .= "</row></$entity>";

        return $xml;
    }
}