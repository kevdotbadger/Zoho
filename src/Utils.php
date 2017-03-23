<?php

namespace Kevdotbadger\Zoho;

class Utils {

    public static function normaliseArray($default = [], $payload = [])
    {
        $normalised = [];

        foreach ($default as $key => $value) {
            $normalised[$key] = isset($payload[$key]) ? $payload[$key] : $value;
        }

        return $normalised;
    }

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