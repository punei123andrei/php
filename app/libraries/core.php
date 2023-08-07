<?php 
/*
* App Core Class
* Creates URL & loads core controller
* URLL FORMAT - /controller/method/params
*/
declare(strict_types=1);
namespace App\Libraries;

class Core {
  protected $currentController = '\\App\\Controllers\\Pages';
  protected $currentMethod = 'index';
  protected $params = [];

  public function __construct(){
    $url = $this->getUrl();
    // Look in controllers for first
    if(is_array($url)){
      $controllerClassName = '\\App\\Controllers\\' . ucwords($url[0]);
      if(class_exists($controllerClassName)){
          // if class exists, set as controller
          $this->currentController = $controllerClassName;
          // unset 0 index
          unset($url[0]);
      }
    }
    $this->currentController = new $this->currentController;
    // Check for second part of url
    if(isset($url[1])){
      // Check to see if method exists in controller
      if(method_exists($this->currentController, $url[1])){
        $this->currentMethod = $url[1];
        // Unset 1 index
        unset($url[1]);
      }
    }
    $this->params = is_array($url) ? array_values($url) : [];
    call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
  }

  public function getUrl(){
    if(isset($_GET['url'])){
      $url = rtrim($_GET['url'], '/');
      $url = filter_var($url, FILTER_SANITIZE_URL);
      $url = explode('/', $url);
      return $url;
    }
  }
}
