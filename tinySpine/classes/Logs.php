<?php
Class Logs{

  protected $id;
  public $brand;

  public function hasId(){
    return !empty($this->id);
  }

  public function getId(){
    return $this->id;
  }

  public function hasBeenCreated(){
    $pdo = DataSource::load();
    $statement = 'INSERT INTO logs
    (brand, typeMessage)
    VALUES (:brand, :typeMessage)';
    $data = array();
    $data['brand'] = $this->brand;
    $data['typeMessage'] = 1;
    $preparedStatement = $pdo->prepare($statement);
    return $preparedStatement->execute($data);
  }

}
