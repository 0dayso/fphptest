<?php
/**
* 类工厂
*/
class Factory {
	
	public static function instance($class_name){
		try {
	    	$class = new ReflectionClass($class_name);
	    	return $class->newInstance();
	    } catch (LogicException $Exception) {
	        die('Not gonna make it in here...');
	    } catch (ReflectionException $Exception) {
	        die('Your class does not exist!');
	    }
	}
}

?>