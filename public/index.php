<?php

require "../vendor/autoload.php";

use app\database\activerecord\Delete;
use app\database\activerecord\FindBy;
use app\database\activerecord\Insert;
use app\database\activerecord\Update;
use app\database\models\User;


$user = new User;
// $user->firstName = 'jorge';
// $user->lastName = 'F';
// $user->id = 3;

var_dump($user->execute(new FindBy(field:'id',value: 1, fields:'lastName')));