<?php

namespace Kevdotbadger\Zoho;

class Utils
{
    /**
     * Ensures the required fields are added to the array.
     *
     * @param array $default
     * @param array $payload
     *
     * @return array
     */
    public static function normaliseArray($default = [], $payload = [])
    {
        $normalised = [];

        foreach ($default as $key => $value) {
            $normalised[$key] = isset($payload[$key]) ? $payload[$key] : $value;
        }

        return $normalised;
    }

    /**
     * Builds an xml entity.
     *
     * @param string $entity
     * @param array $payload
     *
     * @return string
     */
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
