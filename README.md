##Introduction

Magic Cache is a class that I have taken from a framework that I am currently working on.  There are some significant differences between the way that this class behaves versus the way that Magic Cache works.  However, they do achieve the same end goal with simplicity.

Its functionality is based on the Memcache module.  Details on the entire module can be found here http://php.net/manual/en/book.memcache.php, along with installation instructions here http://php.net/manual/en/memcache.setup.php.

There are certainly much better ways to go about the config portion of things.  I am not implementing the config this way, however in an effort to leave it as open as possible for others to integrate, I have gone with this method.

##Vagrant, PHPUnit, and PhpStorm

A Vagrantfile is provided and bootstrapped to launch ubuntu/trusty64 and install Apache2, PHP 5.6, Memcache, PHPUnit, and Xdebug on a private network with an IP address of 10.0.0.10.  The bootstrap will also handle necessary configuration for Xdebug.
 
The PhpStorm .idea directory has also been included for those of you using this as your IDE.  It should allow you to easily get things up and running.

A copy of the phpunit-5.3.4.phar has also been included both for reference in your IDE and the set up for the vagrant box.

##Known Issues

* Setting the value to 0 with the cache function does not work.  This is due to PHP resolving 0 as false.