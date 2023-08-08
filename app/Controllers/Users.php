<?php 
/*
* Define Users action
* Creates a login form
* URLL FORMAT - /controller/method/params
*/
declare(strict_types=1);
namespace App\Controllers;
use App\Libraries\Controller;


class Users extends Controller {
  public function __construct() {

  }

  public function register(){
    // check for POST
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
      // Process the form
    } else {
      // Init Data
      $data = [
        'name'                  => '',
        'email'                 => '',
        'password'              => '',
        'confirm_password'      => '',
        'name_err'              => '',
        'email_err'             => '',
        'password_err'          => '',
        'confirm_password_err'  => ''
      ];

      // LOad view
      $this->view('users/register', $data);
      
    }
  }
}