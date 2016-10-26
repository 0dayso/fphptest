<?php

/**
* 分类协助操作
*/

namespace utils;

class CategoryHandler {
    
    function __construct()  {
        
    }

    /**
    * 递归某分类的子类目
    *
    */
    public static function get_children($cats){
        $items = array();
        foreach ($cats as $key => $value) {
            $item = $value->to_array();
            $sub = $value->children()->get();
            if($sub){
                $item['children'] = static::get_children($sub);
            }
            array_push($items, $item);
        }
        return $items;
    }

    /**
    * 递归某分类的子类目(array)
    *
    */
    public static function get_childrenII($cats){
        $items = array();
        foreach ($cats as $key => $value) {
            $item = $value->to_array();
            $sub = $value->children()->get();
            if($sub){
                $item['children'] = static::get_children($sub);
            }
            array_push($items, $item);
        }
        return $items;
    }
}