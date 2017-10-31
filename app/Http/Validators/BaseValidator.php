<?php namespace App\Http\Validators;

abstract class BaseValidator
{
    /** Specifies if this field in form is required
     * bool @var
     */
    protected static $required;

    /** RegEx pattern
     * string @var
     */
    protected static $pattern;

    /** Error message
     * string @var
     */
    protected static $message;

    /** Checks if the value is set and match RegEx pattern
     * @param $value
     * @return string
     */
    public static function validate(&$value)
    {
        $result = '';

        if ((!isset($value) || ((isset($value) && ($value == ''))))
            && (self::$required))
        {
            $result = 'This field is required';
        }
        else if (isset($value) && (!self::matchPattern($value)))
        {
            $result = self::$message;
        }

        return $result;
    }

    /** Compares value with RegEx pattern
     * @param $value
     * @return bool
     */
    protected static function matchPattern($value)
    {
        if (preg_match(self::$pattern, $value))
            return true;
        else
            return false;
    }
}