<?php defined('COREPATH') or exit('No direct script access allowed'); ?>

ERROR - 2016-10-21 17:31:54 --> shutdown - mysqli::mysqli(): (HY000/1045): Access denied for user 'wechart_copy'@'localhost' (using password in D:\WWW\wechat\fuel\core\classes\session\db.php on 235
ERROR - 2016-10-21 17:31:54 --> Fatal Error - Uncaught exception 'Fuel\Core\PhpErrorException' with message 'chmod() has been disabled for security reasons' in D:\WWW\wechat\fuel\core\classes\log.php:95
Stack trace:
#0 D:\WWW\wechat\fuel\core\bootstrap.php(109): Fuel\Core\Error::error_handler(2, 'chmod() has bee...', 'D:\\WWW\\wechat\\f...', 95)
#1 [internal function]: {closure}(2, 'chmod() has bee...', 'D:\\WWW\\wechat\\f...', 95, Array)
#2 D:\WWW\wechat\fuel\core\classes\log.php(95): chmod('D:\\WWW\\wechat\\a...', 438)
#3 [internal function]: Fuel\Core\Log::_init()
#4 D:\WWW\wechat\fuel\core\classes\autoloader.php(375): call_user_func('Log::_init')
#5 D:\WWW\wechat\fuel\core\classes\autoloader.php(249): Fuel\Core\Autoloader::init_class('Log')
#6 [internal function]: Fuel\Core\Autoloader::load('Log')
#7 D:\WWW\wechat\fuel\core\base.php(102): spl_autoload_call('Log')
#8 D:\WWW\wechat\fuel\core\classes\error.php(120): logger(400, 'Error - Listing...')
#9 D:\WWW\wechat\fuel\core\bootstrap.php(93): Fuel\Core\Error::exception_handler(Object(Fuel\Core\FuelExc in D:\WWW\wechat\fuel\core\classes\log.php on line 95
ERROR - 2016-10-21 17:34:23 --> Error - Listing columns failed, you have to set the model properties with a static $_properties setting in the model. Original exception: mysqli::mysqli(): (HY000/1045): Access denied for user 'wechart_copy'@'localhost' (using password: YES) in D:\WWW\wechat\fuel\packages\orm\classes\model.php on line 305
ERROR - 2016-10-21 17:34:23 --> shutdown - mysqli::mysqli(): (HY000/1045): Access denied for user 'wechart_copy'@'localhost' (using password in D:\WWW\wechat\fuel\core\classes\session\db.php on 235
ERROR - 2016-10-21 17:34:54 --> Error - Listing columns failed, you have to set the model properties with a static $_properties setting in the model. Original exception: mysqli::mysqli(): (HY000/1045): Access denied for user 'wechart_copy'@'localhost' (using password: YES) in D:\WWW\wechat\fuel\packages\orm\classes\model.php on line 305
ERROR - 2016-10-21 17:34:54 --> shutdown - mysqli::mysqli(): (HY000/1045): Access denied for user 'wechart_copy'@'localhost' (using password in D:\WWW\wechat\fuel\core\classes\session\db.php on 235
ERROR - 2016-10-21 23:40:59 --> Error - Listing columns failed, you have to set the model properties with a static $_properties setting in the model. Original exception: mysqli::mysqli(): (HY000/1045): Access denied for user 'wechart_copy'@'localhost' (using password: YES) in D:\WWW\wechat\fuel\packages\orm\classes\model.php on line 305
ERROR - 2016-10-21 23:40:59 --> shutdown - mysqli::mysqli(): (HY000/1045): Access denied for user 'wechart_copy'@'localhost' (using password in D:\WWW\wechat\fuel\core\classes\session\db.php on 235
ERROR - 2016-10-21 23:43:38 --> Error - Listing columns failed, you have to set the model properties with a static $_properties setting in the model. Original exception: mysqli::mysqli(): (HY000/1045): Access denied for user 'wechart_copy'@'localhost' (using password: YES) in D:\WWW\wechat\fuel\packages\orm\classes\model.php on line 305
ERROR - 2016-10-21 23:43:38 --> shutdown - mysqli::mysqli(): (HY000/1045): Access denied for user 'wechart_copy'@'localhost' (using password in D:\WWW\wechat\fuel\core\classes\session\db.php on 235
ERROR - 2016-10-21 23:43:41 --> Error - Listing columns failed, you have to set the model properties with a static $_properties setting in the model. Original exception: mysqli::mysqli(): (HY000/1045): Access denied for user 'wechart_copy'@'localhost' (using password: YES) in D:\WWW\wechat\fuel\packages\orm\classes\model.php on line 305
ERROR - 2016-10-21 23:43:41 --> shutdown - mysqli::mysqli(): (HY000/1045): Access denied for user 'wechart_copy'@'localhost' (using password in D:\WWW\wechat\fuel\core\classes\session\db.php on 235
ERROR - 2016-10-21 23:59:14 --> Error - Listing columns failed, you have to set the model properties with a static $_properties setting in the model. Original exception: mysqli::mysqli(): (HY000/1049): Unknown database 'wechat_wxj' in D:\WWW\wechat\fuel\packages\orm\classes\model.php on line 305
ERROR - 2016-10-21 23:59:14 --> shutdown - mysqli::mysqli(): (HY000/1049) in D:\WWW\wechat\fuel\core\classes\session\db.php on 235
