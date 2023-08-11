<?php 
/*
* App Core Class
* Creates URL & loads core controller
* URLL FORMAT - /controller/method/params
*/
declare(strict_types=1);
namespace App\Controllers;
use App\Libraries\Controller;

class Pages extends Controller {
    public function __construct() {
      
    }

    public function index(){
      if(isLoggedIn()){
        redirect('posts');
      }
      $data = [
        'title'       => 'SharePosts',
        'description' => 'Simple social network built with MVC'
      ];
      $this->view('pages/index', $data);

    }

    public function about() {
      $data = [
        'title' => 'About us',
        'description' => 'App to share posts with other users'
      ];
      $this->view('pages/about', $data);
    }
}