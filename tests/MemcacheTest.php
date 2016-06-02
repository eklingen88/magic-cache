<?php

/**
 * Created by PhpStorm.
 * User: eric
 * Date: 6/2/2016
 * Time: 11:36 AM
 */
class MemcacheTest extends PHPUnit_Framework_TestCase
{
    public static function setUpBeforeClass() {
        // Include the config file
        require_once( '../src/config.php' );
    } // setUpBeforeClass

    public function testConnect() {
        $memcache = new Memcache();
        $connected = $memcache->connect( MAGIC_CACHE_HOST, MAGIC_CACHE_PORT, MAGIC_CACHE_TIMEOUT );
        $this->assertTrue( $connected );
    } // testConnect
} // MemcacheTest
