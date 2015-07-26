<?php
Class Log{

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
    $statement = 'INSERT INTO log
    (brand, typeMessage)
    VALUES (:brand, :typeMessage)';
    $data = array();
    $data['brand'] = $this->brand;
    $data['typeMessage'] = $msg;
    $preparedStatement = $pdo->prepare($statement);
    return $preparedStatement->execute($data);
  }

  public function delete(){
    $pdo = DataSource::load();
    if($this->hasId()){
      $statement = 'DELETE FROM log WHERE brand = :id';
      $preparedStatement = $pdo->prepare($statement);
      $data['id'] = $this->id;
      if($preparedStatement->execute($data)){
        $this->id = 0;
        return true;
      }
    }
    return false;
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
    $statement = 'SELECT log.*, brand.name AS brandName, brand.brandColor AS brandColor, brand.slug AS brandSlug FROM log
    LEFT JOIN brand ON log.brand = brand.id
    ORDER BY log.date DESC
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
