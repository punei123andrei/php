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
  public function model($model): object {
    //Require model file
    require_once '../app/models/' . $model . '.php';
    // Instantiate model
    return new $model();
  }

  // Load view
  public function view(string $view, array $data = []){
    $viewName = '../app/Views/' . $view . '.php';
    if(file_exists($viewName)){
      require_once $viewName;
    }
  }
}