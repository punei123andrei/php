<?php 
/*
* Define Users create and login logic
* URLL FORMAT - /controller/method/params
*/
declare(strict_types=1);
namespace App\Models;
use App\Libraries\Database;

class Post {
  private $db;

  public function __construct(){
    $this->db = new Database;
  }

  public function getPosts(){
    $this->db->query("SELECT *,
    posts.id as postId,
    users.id as userId,
    posts.created_at as postsCreated,
    users.created_at as userCreated
    FROM posts
    INNER JOIN users
    ON posts.user_id = users.id
    ORDER BY POSTS.CREATED_AT DESC
    ");
    $results = $this->db->resultSet();
    return $results;
  }
}