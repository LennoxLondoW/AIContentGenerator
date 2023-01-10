<?php
if (!defined('__path__')) {
    define('__path__', isset($__path__) ? $__path__ : "../");
}
require_once __path__ . 'app/app.php';
class Validation extends App
{
    // lets validate username 
    public function is_correct_name($input)
    {
        $input = strip_tags($input);
        return preg_match("/^[a-zA-Z ]*$/", $input) && !empty(str_replace(" ","",  $input));
    }

    public function is_alphanumeral($input)
    {
        $input = strip_tags($input);
        return preg_match('/[^A-Za-z0-9 ]*$/', $input) && !empty(str_replace(" ","",  $input));
    }

    // lets validate email 
    public function is_correct_email($input)
    {
        $input = strip_tags($input);
        return filter_var($input, FILTER_VALIDATE_EMAIL) && !empty(str_replace(" ","",  $input));
    }

    // lets validate password 
    public function is_correct_password($input)
    {
        $input = strip_tags($input);
        return  preg_match('@[A-Z]@', $input) && //uppercase
            preg_match('@[a-z]@', $input) && //lowercase
            preg_match('@[0-9]@', $input) && //number
            preg_match('@[^\w]@', $input)// special character
            && strlen($input) > 7; //atleast 7 characters
    }

     // lets validate phone number 
     public function is_correct_phoneNumber($input)
     {
         $input = strip_tags($input);
         return filter_var($input, FILTER_SANITIZE_NUMBER_INT) && strlen($input)>=6 && strlen($input)<15 && $input >= 0;
         
     }

}