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
    $this->userModel = $this->model('User');
  }

  public function register(){
    // check for POST
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
      // Process the form
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      $data = [
        'name'                  => trim($_POST['name']),
        'email'                 => trim($_POST['email']),
        'password'              => trim($_POST['password']),
        'confirm_password'      => trim($_POST['confirm_password']),
        'name_err'              => '',
        'email_err'             => '',
        'password_err'          => '',
        'confirm_password_err'  => ''
      ];

      // validation
      $data['name_err'] = empty($data['name']) ? 'Please enter name' : '';
      $data['email_err'] = empty($data['email']) ? 'Please enter email' : '';
      $data['password_err'] = empty($data['password']) ? 'Please enter password' : '';
      $data['password_err'] = strlen($data['password']) < 6 ? 'The password is too short' : '';
      $data['confirm_password_err'] = ($data['confirm_password'] != $data['password']) ? 'The passwords do not match' : '';
      if(empty($data['email'])){
        $data['email_err'] = 'Please enter email';
      } elseif($this->userModel->find_email($data['email'])) {
        $data['email_err'] = 'Email is already taken';
      }


      if(empty($data['name_err']) && empty($data['email_err']) && empty($data['password_err']) && empty($data['confirm_password_err'])){
        // Hash the password

        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        
        if($this->userModel->insert_user($data)){
          flash('register_success', 'You are registered and can log in!');
          redirect('users/login');
        } else {
          die('Something went wrong');
        }
      } else {
        //Load view 
        $this->view('users/register', $data);
      }

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

  public function login(){
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
      // Process the form

      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      $data = [
        'email'                 => trim($_POST['email']),
        'password'              => trim($_POST['password']),
        'email_err'             => '',
        'password_err'          => '',
      ];

      $data['email_err'] = empty($data['email']) ? 'Please enter email' : '';
      $data['password_err'] = empty($data['password']) ? 'Please enter password' : '';
      $data['password_err'] = strlen($data['password']) < 6 ? 'The password is too short' : '';

      if($this->userModel->find_email($data['email'])){
        
      } else {
        $data['email_err'] = 'No user found';
      }

      if(empty($data['email_err']) && empty($data['password_err'])){
        // Validated
        // Check and set logged user
        $loggedInUser = $this->userModel->login($data['email'], $data['password']);
        if($loggedInUser){
          // Create Session
          $this->createUserSession($loggedInUser);
        } else {
          $data['password_err'] = 'Password incorrect';
          $this->view('users/login', $data);
        }
      } else {
        //Load view 
        $this->view('users/login', $data);
      }

    } else {
      // Init Data
      $data = [
        'email'                 => '',
        'password'              => '',
        'email_err'             => '',
        'password_err'          => ''
      ];

      // LOad view
      $this->view('users/login', $data);
  }
}

public function createUserSession($user){
  $_SESSION['user_id'] = $user->id;
  $_SESSION['user_email'] = $user->email;
  $_SESSION['user_name'] = $user->name;
  redirect('posts');

}

public function logout(){
  unset($_SESSION['user_id']);
  unset($_SESSION['user_email']);
  unset($_SESSION['user_name']);
  redirect('users/login');
}

public function isLoggedIn(): bool{
  $isLoggedIn = isset($_SESSION['user_id']) ? true : false;
  return $isLoggedIn;
}

}