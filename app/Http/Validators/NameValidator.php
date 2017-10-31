<?php namespace App\Http\Validators;

class NameValidator extends BaseValidator
{
    /** Cleaning and validating data
     * @param $value
     * @return string
     */
    public static function validate(&$value)
    {
        self::$required = true;
        self::$pattern = '/^[a-zA-Z]{1}[a-zA-Z]{2,9}$/';
        self::$message = 'This field can contain only latin letters. Possible lenght is 3-10 characters.';

        $value = Sanitizer::sanitizeData($value);

        $result = parent::validate($value);

        return $result;
    }
}