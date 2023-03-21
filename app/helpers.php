<?php

if (!function_exists('split_name')) {
    function split_name(string $fullName)
    {
        $words = str_word_count($fullName, 1); // Split the full name into an array of words
        $lastName = array_slice($words, -1)[0]; // Get the last word as the last name
        $firstName = implode(" ", array_slice($words, 0, -1));
        return [$firstName, $lastName];
    }
}
