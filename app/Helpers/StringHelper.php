<?php

namespace App\Helpers;

class StringHelper
{
    /**
     * Formats a person's name: proper casing and limited character count.
     *
     * @param string $name
     * @param int $maxCharacters
     * @return string
     */
    public static function prepareName(string $name, int $maxCharacters = 26): string
    {
        $exceptions = ['da', 'das', 'de', 'des', 'do', 'dos'];

        $formatted = array_map(function ($word) use ($exceptions) {
            return (strlen($word) > 2 && !in_array($word, $exceptions))
                ? ucfirst(strtolower($word))
                : strtolower($word);
        }, explode(' ', strtolower($name)));

        $name = implode(' ', $formatted);

        // Trim words from the end until length is within limit
        while (strlen($name) > $maxCharacters && count($formatted) > 1) {
            array_pop($formatted);
            $name = implode(' ', $formatted);
        }

        return $name;
    }
}
