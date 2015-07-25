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

  public function save($msg){
    $pdo = DataSource::load();
    $statement = 'INSERT INTO logs
    (brand, typeMessage)
    VALUES (:brand, :typeMessage)';
    $data = array();
    $data['brand'] = $this->brand;
    $data['typeMessage'] = $msg;
    $preparedStatement = $pdo->prepare($statement);
    return $preparedStatement->execute($data);
  }

  public function setProperties($properties){
    foreach($properties as $key => $value){
      $this->setProperty($key, $value);
    }
  }

  public function setProperty($key, $value){
    if($key == 'id' && empty($this->id)){
      $this->id = (int)$value;
    }else{
      $this->$key = $value;
    }
  }

  static public function getAll(){
    $logs = array();
    $pdo = DataSource::load();
    $statement = 'SELECT logs.*, brand.name AS brandName FROM logs
    LEFT JOIN brand ON logs.brand = brand.id
    ORDER BY logs.date ASC
    LIMIT 1000';
    $preparedStatement = $pdo->prepare($statement);
    $preparedStatement->execute();
    $logsData = $preparedStatement->fetchAll();
    foreach($logsData as $logData){
      $log = new self();
      $log->setProperties($logData);
      $logs[] = $log;
    }
    return $logs;
  }

}
