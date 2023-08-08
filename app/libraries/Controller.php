<?php 
/*
* Base Controller
* Loads the model view
* URLL FORMAT - /controller/method/params
*/
declare(strict_types=1);
namespace App\Libraries;

class Controller {
  //Load model
  public function model($model) {
    //Require model file
    $modelClass =  '\\App\\Models\\' . $model;
    // Instantiate model
    return new $modelClass();
  }

  // Load view
  public function view(string $view, array $data = []){
    $viewName = '../app/Views/' . $view . '.php';
    if(file_exists($viewName)){
      require_once $viewName;
    }
  }
}