<?php
Class BrandCategory{

  protected $id;
  public $name;
  public $acoUrl;

  public function hasId(){
    return !empty($this->id);
  }

  public function getId(){
    return $this->id;
  }

  public function withId($id){
    $pdo = DataSource::load();
    $statement = 'SELECT * FROM category WHERE id = :id LIMIT 1';
    $preparedStatement = $pdo->prepare($statement);
    $preparedStatement->execute(array('id' => $id));
    $userData = $preparedStatement->fetch();
    if(!empty($userData)){
        $this->setProperties($userData);
    }
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

  public function save(){

    $pdo = DataSource::load();
    if(!$this->hasId()){
      $statement = 'INSERT INTO category
      (name, acoUrl)
      VALUES (:name, :acoUrl)';

      $data = array();
      $data['name'] = $this->name;
      $data['acoUrl'] = $this->acoUrl;
      $preparedStatement = $pdo->prepare($statement);
      return $preparedStatement->execute($data);
    }else{
      $statement = 'UPDATE user SET
      name = :name,
      acoUrl = :acoUrl
      WHERE id = :id';
      $data = array();
      $data['name'] = $this->name;
      $data['acoUrl'] = $this->acoUrl;
      $data['id'] = $this->id;
      $preparedStatement = $pdo->prepare($statement);
      return $preparedStatement->execute($data);
    }
    return false;
  }


  public function delete(){
    $pdo = DataSource::load();
    if($this->hasId()){
      $statement = 'DELETE FROM category WHERE id = :id';
      $preparedStatement = $pdo->prepare($statement);
      $data['id'] = $this->id;
      if($preparedStatement->execute($data)){
        $this->id = 0;
        return true;
      }
    }
    return false;
  }
  
  public function getAllBrand(){
  	$brands = array();
  	$pdo = DataSource::load();
  	$statement = 'SELECT brand.*, category.name AS categoryName FROM brand
		LEFT JOIN category ON brand.category = category.id
		WHERE deleted = 0 AND category = :category
		ORDER BY brand.id ASC
		LIMIT 1000';
  	$preparedStatement = $pdo->prepare($statement);
  	$data = array();
  	$data['category'] = $this->id;
  	$preparedStatement->execute($data);
  	$brandsData = $preparedStatement->fetchAll();
  	foreach($brandsData as $brandData){
  		$brand = new self();
  		$brand->setProperties($brandData);
  		$brands[] = $brand;
  	}
  	return $brands;
  }
  
  public function getAllBrandOrderByClicks(){
  	$brands = array();
  	$pdo = DataSource::load();
  	$statement = 'SELECT brand.*, category.name AS categoryName FROM brand
		LEFT JOIN category ON brand.category = category.id
		WHERE deleted = 0 AND category = :category
		ORDER BY brand.clicksCount DESC
		LIMIT 1000';
  	$preparedStatement = $pdo->prepare($statement);
  	$data = array();
  	$data['category'] = $this->id;
  	$preparedStatement->execute($data);
  	$brandsData = $preparedStatement->fetchAll();
  	foreach($brandsData as $brandData){
  		$brand = new self();
  		$brand->setProperties($brandData);
  		$brands[] = $brand;
  	}
  	return $brands;
  }

  static public function getAll(){
    $categories = array();
    $pdo = DataSource::load();
    $statement = 'SELECT * FROM category';
    $preparedStatement = $pdo->prepare($statement);
    $preparedStatement->execute();
    $categoriesData = $preparedStatement->fetchAll();
    foreach($categoriesData as $categoryData){
      $category = new self();
      $category->setProperties($categoryData);
      $categories[] = $category;
    }
    return $categories;
  }


}
