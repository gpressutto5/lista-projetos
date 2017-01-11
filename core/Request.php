<?php
class Request
{
    public static function uri()
    {
        $uri = strstr($_SERVER['REQUEST_URI'], '?', true);
        if (empty($uri)) {
            $uri = $_SERVER['REQUEST_URI'];
        }
        return trim($uri,'/');
    }
}
