<?php 
/*
* App Core Class
* Creates URL & loads core controller
* URLL FORMAT - /controller/method/params
*/
declare(strict_types=1);
namespace App\Controllers;

class Posts {
    public function __construct() {
      echo 'posts loaded';
    }
}