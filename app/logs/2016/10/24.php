<?php defined('COREPATH') or exit('No direct script access allowed'); ?>

ERROR - 2016-10-24 00:00:16 --> Fatal Error - Uncaught exception 'Fuel\Core\PhpErrorException' with message 'chmod() has been disabled for security reasons' in D:\WWW\wechat\fuel\core\classes\log.php:95
Stack trace:
#0 D:\WWW\wechat\fuel\core\bootstrap.php(109): Fuel\Core\Error::error_handler(2, 'chmod() has bee...', 'D:\\WWW\\wechat\\f...', 95)
#1 [internal function]: {closure}(2, 'chmod() has bee...', 'D:\\WWW\\wechat\\f...', 95, Array)
#2 D:\WWW\wechat\fuel\core\classes\log.php(95): chmod('D:\\WWW\\wechat\\a...', 438)
#3 [internal function]: Fuel\Core\Log::_init()
#4 D:\WWW\wechat\fuel\core\classes\autoloader.php(375): call_user_func('Log::_init')
#5 D:\WWW\wechat\fuel\core\classes\autoloader.php(249): Fuel\Core\Autoloader::init_class('Log')
#6 [internal function]: Fuel\Core\Autoloader::load('Log')
#7 D:\WWW\wechat\fuel\core\base.php(102): spl_autoload_call('Log')
#8 D:\WWW\wechat\fuel\core\classes\error.php(120): logger(400, 'Warning - chmod...')
#9 D:\WWW\wechat\fuel\core\bootstrap.php(93): Fuel\Core\Error::exception_handler(Object(Fuel\Core\PhpErro in D:\WWW\wechat\fuel\core\classes\log.php on line 95
ERROR - 2016-10-24 00:01:42 --> Warning - chmod() has been disabled for security reasons in D:\WWW\wechat\fuel\core\classes\cache\storage\file.php on line 308
