<?php
namespace Abdur\RStream;

class Loader{

    public function __construct()
    {
        
    }

    public static function view($page){
        require __DIR__ . "/views/".$page.".php";
    }
}