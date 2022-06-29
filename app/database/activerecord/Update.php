<?php

namespace app\database\activerecord;

use app\database\connection\Connection;
use app\database\interfaces\ActiveRecordExecuteInterface;
use app\database\interfaces\ActiveRecordInterface;
use Throwable;

class Update implements ActiveRecordExecuteInterface{

  public function __construct(private string $field, private string|int $value){}

  public function execute(ActiveRecordInterface $activeRecordInterface){
    try {
      //faz conexao com o bd e atualiza os dados
      $query = $this->createQuery($activeRecordInterface);
      $connection = Connection::connect();
      
      //juntar dois arrays
      $attributes = array_merge($activeRecordInterface->getAttributes(),[
        $this->field => $this->value
      ]);
      
      $prepare = $connection->prepare($query);
      $prepare->execute($attributes);
      return $prepare->rowCount();

    }catch (Throwable $th) {
      var_dump($th->getMessage());
    }
  }

  private function createQuery(ActiveRecordInterface $activeRecordInterface){      
    //criando a query para fazer o update
    $sql = "update {$activeRecordInterface->getTable()} set ";
    
    //percorre todos os atributos passados pelo objeto
    foreach ($activeRecordInterface->getAttributes() as $key => $value){
      $sql.= "{$key}=:{$key},";
    }
    //remove a ultima virgula da string
    $sql = Rtrim($sql,',');
    $sql.= " where {$this->field}=:{$this->field}";
    return $sql;
  }
}