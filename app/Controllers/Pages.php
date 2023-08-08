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
      $this->postModel = $this->model('Post');
    }

    public function index(){
      $posts = $this->postModel->getPosts();
      $data = [
        'title' => 'Welcome',
        'posts' => $posts
      ];
      $this->view('pages/index', $data);

    }

    public function about() {
      $data = [
        'title' => 'About us'
      ];
      $this->view('pages/about', $data);
    }
}