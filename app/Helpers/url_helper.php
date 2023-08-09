<?php 
//Simple redirect function
function redirect($page){
  header("Location: " . URLROOT . "/" . $page);
  exit;
}