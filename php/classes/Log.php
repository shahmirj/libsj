<?php

namespace shahmirj\core;

class Log
{
    public static $level = 0;
    public static $strict = false;
    public static $dateType = DATE_ATOM;

    public static function info($string, $level = 0)
    {
        if ($level <= self::$level) { self::message($string, "Info"); }
    }

    public static function error($string, $ec = -1)
    {
        self::message($string, "Error");
        exit($ec);
    }

    public static function warning($string)
    {
        //If not failing on strict, then just print the Warning message
        if (!self::$strict) 
        { 
            self::message($string, "Warning"); 
            return;
        }
        
        //Otherwise print the Warning message, and commit error
        self::message($string, "Warning");
        self::error("Exiting on strict, see above warning.", -1);
    }
    
    /**
     * The handler to call the message
     */
    private static function message($string, $type)
    {
        echo self::premessage($type) . "" .  $string . "\n";
    }

    private static function premessage($type)
    {
        return date(self::$dateType) . " " . str_pad("$type: ", 10, " ", STR_PAD_LEFT);
    }
}

?>
