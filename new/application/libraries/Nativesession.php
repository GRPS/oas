<?php
    
if ( ! defined('BASEPATH') )
    exit( 'No direct script access allowed' );

class Nativesession
{
    public function __construct()
    {
        session_start();
    }

    public function set( $key, $value )
    {
        $_SESSION[$key] = $value;
    }

    public function setset( $key1, $key2, $value )
    {
        $_SESSION[$key1][$key2] = $value;
    }
    
    public function setsetset( $key1, $key2, $key3, $value )
    {
        $_SESSION[$key1][$key2][$key3] = $value;
    }
    
    public function get( $key )
    {
        return isset( $_SESSION[$key] ) ? $_SESSION[$key] : null;
    }
    
    public function getget( $key1, $key2 )
    {
        return isset( $_SESSION[$key1][$key2] ) ? $_SESSION[$key1][$key2] : null;
    }

    public function getgetget( $key1, $key2, $key3 )
    {
        return isset( $_SESSION[$key1][$key2][$key3] ) ? $_SESSION[$key1][$key2][$key3] : null;
    }
    
    public function regenerateId( $delOld = false )
    {
        session_regenerate_id( $delOld );
    }

    public function delete( $key )
    {
        unset( $_SESSION[$key] );
    }
}