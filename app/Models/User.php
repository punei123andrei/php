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

  public function insert_user(array $data): bool{
    $this->db->query("INSERT INTO users(name, email, password) VALUES (:name, :email, :password)");
    // Bind values
    $this->db->bind(':name', $data['name']);
    $this->db->bind(':email', $data['email']);
    $this->db->bind(':password', $data['password']);
    if($this->db->execute()){
     return true;
    } else {
      return false;
    }
  } 

  public function login(string $email,string $password){
    $this->db->query("SELECT * FROM users WHERE email = :email");
    $this->db->bind(':email', $email);
    $row = $this->db->single();
    $hash_password = $row->password;

    if(password_verify($password, $hash_password)){
      return $row;
    } else {
      return false;
    }

  }

  public function find_email(string $email): bool{
    $this->db->query("SELECT * FROM users WHERE email = :email");
    $this->db->bind(':email', $email);
    $row = $this->db->single();
    $email_exists = $this->db->rowCount() > 0 ? true : false;
    return $email_exists;
  }

  public function getUserById($id){
    $this->db->query("SELECT * FROM users WHERE id = :id");
    $this->db->bind(':id', $id);
    $row = $this->db->single();
    return $row;
  }
 
}