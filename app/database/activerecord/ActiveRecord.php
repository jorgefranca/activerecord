<?php

namespace app\database\activerecord;

use app\database\interfaces\ActiveRecordExecuteInterface;
use app\database\interfaces\ActiveRecordInterface;
use app\database\interfaces\UpdateInterface;
use ReflectionClass;

abstract class ActiveRecord implements ActiveRecordInterface{
  //se a classe que extende ActiveRecord não definir uma table, 
  //o valor default será nulo, isso é imṕrtante para fazer o construct
  protected $table = null;
  protected $attributes = [];

  public function __construct(){
    if(!$this->table){
      $this->table = strtolower((new ReflectionClass($this))->getShortName());
      // var_dump($this->table);
    }
  }
  
  public function getAttributes(){
    return $this->attributes;
  }

  public function getTable(){
    return $this->table;
  }

  public function execute(ActiveRecordExecuteInterface $activeRecordExecuteInterface){
    //o $this vai passar os parametros que eu quero atualizar
    return $activeRecordExecuteInterface->execute($this);
  }

  public function __set($attribute, $value){
    $this->attributes[$attribute] = $value;
  }

  public function __get($attribute){
    return $this->attributes[$attribute];
  }
}