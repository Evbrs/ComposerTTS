<?php

function connectDB(){
  $pdo = new PDO('mysql:host=localhost;port=3306;dbname=tts;charset=utf8','root', '');
}

function CheckIfLogin($input){
  if(empty($_SESSION['pseudo'])){
    header('Location: login.php');
  };
}

function LoginButtonStatu($input){
  if(!empty($_SESSION['pseudo'])){
    $href="/profil.php";
  }else{
    $href ="/login.php";
  }
}


function clearInput($input){
  $input = htmlspecialchars($input);
  $input = strip_tags($input);
  $input = str_replace('-', ' ', $input);
  $input = str_replace('_', ' ', $input);
  return $input;
  // $input = ucwords($input);
}