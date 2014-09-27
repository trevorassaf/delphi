<?php

// -- Dependencies
require_once(dirname(__FILE__)."/../User.php");

// -- MAIN
$user = User::create(
  111113,
  "PrinceOfDenmarkBitch",
  "Hamlet",
  "Son of Hamlet",
  date("Y-m-d"), 
  "male",
  1000,    
  1
);

var_dump($user);

$user->delete();
