<?php
class Helper{
    public static function sectionYield($selectionName){
        include_once(LAYOUT."{$selectionName}.php");
    }
    
    public static function redirect($url){
        header("Location: {$url}");
    }
}
?>