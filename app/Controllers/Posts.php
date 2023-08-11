<?php 
/*
* App Core Class
* Creates URL & loads core controller
* URLL FORMAT - /controller/method/params
*/
declare(strict_types=1);
namespace App\Controllers;
use App\Libraries\Controller;

class Posts extends Controller{

    public function __construct(){
      if(!isLoggedIn()){
        redirect('/users/login');
      }
      $this->postModel = $this->model('Post');
    }

    public function index() {
      // Get Posts
      $posts = $this->postModel->getPosts();

      $data = [
        'posts' => $posts
      ];
      $this->view('posts/index', $data);
    }

    public function add(){
      $data = [
        'title' => '',
        'body'  => ''
      ];
      $this->view('posts/add', $data);
    }

}