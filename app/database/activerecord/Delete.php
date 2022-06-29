<?php

namespace app\database\activerecord;

use app\database\connection\Connection;
use app\database\interfaces\ActiveRecordInterface;
use app\database\interfaces\ActiveRecordExecuteInterface;

class Delete implements ActiveRecordExecuteInterface{
  
  public function __construct(private string $field, private string|int $value){}

  public function execute(ActiveRecordInterface $activeRecordInterface){
    try {
      $query = $this->createQuery($activeRecordInterface);
      $connection = Connection::connect();
      $prepare = $connection->prepare($query);
      $prepare->execute([
        $this->field => $this->value
      ]);
      return $prepare->rowCount();

    } catch (\Throwable $th) {
      var_dump($th->getMessage());
    }  
  }

   //delete from nomedatabela where id=:id
  private function createQuery(ActiveRecordInterface $activeRecordInterface){
    $sql = "delete from {$activeRecordInterface->getTable()}";
    $sql.= " where {$this->field} = :{$this->field}";
    return $sql;
  }
}