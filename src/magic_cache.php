<?php

/**
 * magic_cache.php
 *
 * Memcache wrapper for quick function result caching.
 *
 * @category   cache
 * @package    MagicCache
 * @author     Eric M. Klingensmith <eric.m.klingensmith@gmail.com>
 * @copyright  2016 Eric M. Klingensmith
 * @license    GNU General Public License V3
 * @version    1.0.0
 * @link       https://github.com/eklingen88/magic-cache
 */

require( 'config.php' );
  
class Magic_Cache {
    /* @var Memcache $memcache */
    private static $memcache = null;

    /**
     * Connect the a memcache server if not already connected.
     */
    private static function _connect() {
        if( is_null( self::$memcache ) ) {
            self::$memcache = new Memcache();
            self::$memcache->connect( MAGIC_CACHE_HOST, MAGIC_CACHE_PORT, MAGIC_CACHE_TIMEOUT );
        }
    } // _connect

    /**
     * @param string $key
     * @param bool $default
     * @return mixed
     */
    public static function get( $key, $default = null ) {
        self::_connect();
        $hash_key = md5( $key );    
        
        $value = self::$memcache->get( $hash_key );
        
        if( $value ) {
            return $value;
        } else {
            return $default;
        }
    } // get
    
    /**
     * Store a value in memcache.  The key will be passed through MD5 hashing
     * before use to obscure the data and shorten any lengthy keys.
     * @param string $key
     * @param mixed $value
     * @param int $lifespan Lifespan of cache in seconds.
     * @return mixed Returns $value.
     */
    public static function set( $key, $value, $lifespan = null ) {
        self::_connect();
        $hash_key = md5( $key );
        
        if( is_null( $lifespan ) ) {
            $lifespan = MAGIC_CACHE_LIFESPAN;
        }
        
        self::$memcache->set( $hash_key, $value, false, $lifespan );
        
        return $value;
    } // set

    /**
     * Flush Memcache cache.
     * @return bool Returns true on success or false on failure.
     */
    public static function flush() {
        self::_connect();
        return self::$memcache->flush();
    } // flush
    
    /**
     * Get or set a cache value based on the calling function.  The key is set
     * using debug_backtrace.
     * @param mixed $value If omitted, this lookup the value.
     * @return mixed Returns the value if one is found.
     */
    public static function cache( $value = null ) {
        // Get the calling function
        $debug_backtrace = debug_backtrace();
        $caller = $debug_backtrace[1];

        // Remove line number if it's set
        if( array_key_exists( 'line', $caller ) ) {
            unset( $caller['line'] );
        }

        // Set the key
        $key = json_encode( $caller );

        if( empty( $key ) ) {
            // Failed to get a key, take off
            return null;
        } elseif( is_null( $value ) ) {
            // Got a key, let's try this
            return self::get( $key );
        } else {
            return self::set( $key, $value );
        }
    } // cache
} // Magic_Cache