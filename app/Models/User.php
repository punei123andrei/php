<?php
/*
* Define Users create and login logic
* URLL FORMAT - /controller/method/params
*/
declare(strict_types=1);
namespace App\Models;
use App\Libraries\Database;

class User {
  private $db;
  public function __construct(){
    $this->db = new Database;
  }

  public function find_email(string $email): bool{
    $this->db->query("SELECT * FROM users WHERE email = :email");
    $this->db->bind(':email', $email);
    $row = $this->db->single();
    $email_exists = $this->db->rowCount > 0 ? true : false;
    return $email_exists;
  }

  public function insert(array $data): void{
    
  } 
}