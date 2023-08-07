<?php 

require_once __DIR__ . '/vendor/autoload.php';

use App\User;
use App\Customer;

if(Customer::validatePass('wro')){
  echo 'The password is perfect';
}