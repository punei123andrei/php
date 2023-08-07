<?php
declare(strict_types=1);
namespace App;
//Define a class
class User {
  //Proprieties
  public $name;
  public $age;

  public function __construct(string $name = "", string $age = ""){
    $this->name = $name;
    $this->age = $age;
  }

  // Methods
  public function sayHello(): string {
    return $this->name . ' says Hello';
  }

  // public function __destruct() {
  //   echo 'destructer ran';
  // }
  
  public function __get($property){
    if(property_exists($this, $property)){
      return $this->property;
    }
  }

  // public function __set($property, $value){
  //   if(property_exists($this, $property)){
  //     return $this->property = $value;
  //   }
  // }

}

