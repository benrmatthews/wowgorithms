<?php
Class BrandClick{

  protected $id;
  public $brand;

  public function hasId(){
    return !empty($this->id);
  }

  public function getId(){
    return $this->id;
  }

  public function create(){
    $pdo = DataSource::load();
    $statement = 'INSERT INTO click
    (brand, creation_time)
    VALUES (:brand, :creation_time)';
    $data = array();
    $data['brand'] = $this->brand;
    $data['creation_time'] = date('Y-m-d H:i:s');
    $preparedStatement = $pdo->prepare($statement);
    return $preparedStatement->execute($data);
  }

}
