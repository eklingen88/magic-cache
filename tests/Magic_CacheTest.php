<?php

/**
 * Created by PhpStorm.
 * User: eric
 * Date: 6/2/2016
 * Time: 10:56 AM
 */
class Magic_CacheTest extends PHPUnit_Framework_TestCase
{
    public static function setUpBeforeClass() {
        // Load the Magic_Cache class
        require_once( '../src/magic_cache.php' );
    } // setUpBeforeClass

    public function testSetGet() {
        Magic_Cache::set( 'testSetGet', 'test value' );
        $value = Magic_Cache::get( 'testSetGet' );
        $this->assertEquals( 'test value', $value );
    } // testSetGet

    public function testSetGetTimeout() {
        // Set a value with a timeout of 1 second
        $key = 'testSetGetTimeout';
        $expected = 'test value';
        Magic_Cache::set( $key, $expected, 1 );

        // Get the value back and check it right away
        $value = Magic_Cache::get( $key, false );
        $this->assertEquals( $expected, $value );

        // Wait a second, then check again
        sleep( 1 );
        $value = Magic_Cache::get( $key, false );
        $this->assertFalse( $value );
    } // testSetGetTimeout

    public function testFlush() {
        // Set a value
        $expected = 'test value';
        Magic_Cache::set( __FUNCTION__, $expected, 3600 );

        // Make sure the value was set
        $this->assertEquals( $expected, Magic_Cache::get( __FUNCTION__, false ) );

        // Flush it and check the value
        Magic_Cache::flush();
        $this->assertFalse( Magic_Cache::get( __FUNCTION__, false ) );
    } // testFlush

    public function testCache() {
        // Set our value
        $value = 'test value';

        // Flush the cache
        Magic_Cache::flush();
        
        // Check the magical cache() function, should be null
        $this->assertNull( Magic_Cache::cache() );

        // Use the magical cache() function to set a variable and make sure that it stuck
        $this->assertEquals( $value, Magic_Cache::cache( $value ) );
        $this->assertEquals( $value, Magic_Cache::cache() );
    } // testCache
} // Magic_CacheTest
