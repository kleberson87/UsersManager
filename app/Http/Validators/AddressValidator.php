<?php namespace App\Http\Validators;

class AddressValidator extends BaseValidator
{
    /** Cleaning and validating data
     * @param $value
     * @return string
     */
    public static function validate(&$value)
    {
        self::$required = true;
        self::$pattern = '/^[a-zA-Z]{1}[a-zA-Z\'-\s]{2,44}$/';
        self::$message = 'This field can contain only latin letters,
        dash and apostrophe characters. Possible lenght is 3-45 characters.';

        $value = Sanitizer::sanitizeData($value);

        $result = parent::validate($value);

        return $result;
    }
}