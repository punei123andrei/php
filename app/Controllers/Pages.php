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
      $data = [
        'title' => 'Welcome'
      ];
      $this->view('pages/index', $data);
    }

    public function about() {
      $this->view('pages/about');
    }
}