<!DOCTYPE html>
<?php

// Include Magic_Cache
require_once( 'magic_cache.php' );

// Flush the cache
Magic_Cache::flush();

// Record the start time and set an end time array
$start_time = microtime( true );
$end_time = array();

// Demonstrate the magical cache() function
for( $i = 1; $i <= 2; $i ++ ) {
    // Run the function twice with the same params
    test( $i );
    $end_time[] = microtime( true );

    test( $i );
    $end_time[] = microtime( true );
}

// Function that will pause if cached value isn't found
function test( $value ) {
    if( !is_null( $result = Magic_Cache::cache() ) ) {
        return $result;
    };

    for( $i = 1; $i <= $value; $i++ ) {
        sleep( 1 );
    }

    return Magic_Cache::cache( $value );
} // test

?>
<html>
    <head>
        <meta http-equiv="Expires" content="Fri, Jan 01 1900 00:00:00 GMT">
        <meta http-equiv="Pragma" content="no-cache">
        <meta http-equiv="Cache-Control" content="no-cache">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta http-equiv="Lang" content="en">
        <meta name="author" content="Eric M. Klingensmith <eric.m.klingensmith@gmail.com>">
        <meta http-equiv="Reply-to" content="eric.m.klingensmith@gmail.com">
        <meta name="creation-date" content="05/31/2016">
        <meta name="revisit-after" content="15 days">
        <title>Magic Cache - Basic Usage</title>

        <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-xs-12 text-center">
                    <h1>Magic Cache - Basic Usage</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <table class="table table-stripe">
                        <caption><h2>Configuration</h2></caption>
                        <tr>
                            <th>Host</th>
                            <td><?= MAGIC_CACHE_HOST ?></td>
                        </tr>
                        <tr>
                            <th>Port</th>
                            <td><?= MAGIC_CACHE_PORT ?></td>
                        </tr>
                        <tr>
                            <th>Timeout</th>
                            <td><?= MAGIC_CACHE_TIMEOUT ?></td>
                        </tr>
                        <tr>
                            <th>Lifespan</th>
                            <td><?= MAGIC_CACHE_LIFESPAN ?></td>
                        </tr>
                    </table>
                </div>
                <div class="col-sm-6">
                    <table class="table table-stripe">
                        <caption><h2>Configuration</h2></caption>
                        <tr>
                            <th>First run, $value = 0</th>
                            <td><?= number_format( $end_time[0] - $start_time, 6 ) ?></td>
                        </tr>
                        <tr>
                            <th>Second run, $value = 0</th>
                            <td><?= number_format( $end_time[1] - $end_time[0], 6 ) ?></td>
                        </tr>
                        <tr>
                            <th>First run, $value = 1</th>
                            <td><?= number_format( $end_time[2] - $end_time[1], 6 ) ?></td>
                        </tr>
                        <tr>
                            <th>Second run, $value = 1</th>
                            <td><?= number_format( $end_time[3] - $end_time[2], 6 ) ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </body>
</html>
