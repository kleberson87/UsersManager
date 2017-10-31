<?php namespace App\Http\Validators;

class Sanitizer
{
    /** Cleaning data from illegal characters
     * @param $data
     * @return string
     */
    public static function sanitizeData ($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);

        return $data;
    }
}