<?php 

declare(strict_types=1);
namespace App;

class Customer extends User {

  private $balance;
  
  public static $minPassLength = 6;

  public function __construct($name, $age, $balance = ''){
    parent::__construct($name, $age);
    $this->balance = $balance;
  }
  
  public function pay($amount){
    return $this->name . ' paid $' . $amount;
  }
  
  public static function validatePass(?string $pass): bool{
    if(strlen($pass) >= self::$minPassLength){
      return true;
    } else {
      return false;
    }
  }
}