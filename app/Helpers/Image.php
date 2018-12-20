<?php
namespace App\Helpers;
/**
 * Created by PhpStorm.
 * User: Администратор
 * Date: 23.04.16
 * Time: 14:14
 */
class Image{
    public static function sanitize($string, $force_lowercase = true, $anal = false){
        $strip = array("~", "`", "!", "@", "#", "$", "%", "^", "&", "*", "(", ")", "_", "=", "+", "[", "{", "]",
            "}", "\\", "|", ";", ":", "\"", "'", "&#8216;", "&#8217;", "&#8220;", "&#8221;", "&#8211;", "&#8212;",
            "â€”", "â€“", ",", "<", ".", ">", "/", "?");
        $clean = trim(str_replace($strip, "", strip_tags($string)));
        $clean = preg_replace('/\s+/', "-", $clean);
        $clean = ($anal) ? preg_replace("/[^a-zA-Z0-9]/", "", $clean) : $clean ;

        return ($force_lowercase) ?
            (function_exists('mb_strtolower')) ?
                mb_strtolower($clean, 'UTF-8') :
                strtolower($clean) :
            $clean;
    }
    public static function createUniqueFilename( $filename )
    {
        $imageToken = substr(sha1(mt_rand()), 0, 5);
        return time().$imageToken;
    }
}