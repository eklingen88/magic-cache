<?php

/**
 * config.php
 *
 * Config file for Magic_Cache.
 *
 * @category   cache
 * @package    MagicCache
 * @author     Eric M. Klingensmith <eric.m.klingensmith@gmail.com>
 * @copyright  2016 Eric M. Klingensmith
 * @license    GNU General Public License V3
 * @version    1.0.0
 * @link       https://github.com/eklingen88/magic-cache
 */
  
define( 'MAGIC_CACHE_HOST', 'localhost' );
define( 'MAGIC_CACHE_PORT', 11211 );
define( 'MAGIC_CACHE_TIMEOUT', 1 ); // Higher timeouts can reduce the effectiveness of caching
define( 'MAGIC_CACHE_LIFESPAN', 60 * 5 ); // In seconds