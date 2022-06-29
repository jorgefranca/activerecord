<?php

namespace app\database\models;

use app\database\activerecord\ActiveRecord;

//extender a classe activeRecord para ter acesso aos metodos
//mágicos (__set() e __get())
class User extends ActiveRecord{
    //a tabela fica definida, caso não seja definida, o activeRecord criara o nome
    protected $table = 'users';
}