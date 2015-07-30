<?php
Class Brand{
	
	const STATUS_INVALID = 0;
	const STATUS_PUBLISHED = 1;
	const STATUS_REJECTED = 2;
	
	protected $id;
	public $name;
	public $brandColor;
	public $borderColor;
	public $category;
	public $categoryName;
	public $tags;
	public $slug;
	public $url;
 	public $date;
	public $isPDF;
	public $deleted;
	public $clicksCount;
	public $status;

	public function hasId(){
		return !empty($this->id);
	}

	public function getId(){
		return $this->id;
	}

	public function withId($id){
		$pdo = DataSource::load();
		$statement = 'SELECT brand.*, category.name AS categoryName FROM Brand
		LEFT JOIN category ON brand.category = category.id
		WHERE deleted = 0 AND brand.id = :id
		LIMIT 1';

		$preparedStatement = $pdo->prepare($statement);
		$preparedStatement->execute(array('id' => $id));
		$brandData = $preparedStatement->fetch();
		if(!empty($brandData)){
			$this->setProperties($brandData);
		}
	}
	
	public function withSlug($slug){
		$pdo = DataSource::load();
		$statement = 'SELECT brand.*, category.name AS categoryName FROM Brand
		LEFT JOIN category ON brand.category = category.id
		WHERE deleted = 0 AND brand.slug = :slug
		LIMIT 1';
	
		$preparedStatement = $pdo->prepare($statement);
		$preparedStatement->execute(array('slug' => $slug));
		$brandData = $preparedStatement->fetch();
		if(!empty($brandData)){
			$this->setProperties($brandData);
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
		if(!empty($this->password)){
			$this->hash = $this->cryptPassword($this->password, $this->getSalt());
		}

		$pdo = DataSource::load();
		if(!$this->hasId()){

			$statement = 'INSERT INTO brand
			(name, brandColor, borderColor, category, tags, slug, url, date, isPDF, clickedBlock, status, deleted)
			VALUES (:name, :brandColor, :borderColor, :category, :tags, :slug, :url, :date, :isPDF, :clickedBlock, :status, :deleted)';


			$data = array();
			$data['name'] = $this->name;
			$data['brandColor'] = $this->brandColor;
			$data['borderColor'] = $this->borderColor;
			$data['category'] = (int)$this->category;
			$data['tags'] = $this->tags;
			$data['slug'] = $this->slug;
			$data['url'] = $this->url;
			$data['date'] = $this->date;
			$data['isPDF'] = $this->isPDF;
			$data['clickedBlock'] = (int)$this->clickedBlock;
			$data['status'] = (int)$this->status;
			$data['deleted'] = (int)$this->deleted;
			$preparedStatement = $pdo->prepare($statement);
			if($preparedStatement->execute($data)){
				$this->id = $pdo->lastInsertId();
				$this->registerLog(1);
				return true;
			}

		}else{
			$statement = 'UPDATE brand SET
			name  = :name,
			brandColor = :brandColor,
			borderColor = :borderColor,
			category = :category,
			tags = :tags,
			slug = :slug,
			url = :url,
			date = :date,
			isPDF = :isPDF,
			clickedBlock = :clickedBlock,
			status = :status,
			deleted = :deleted
			WHERE id = :id';
			$data = array();
			$data['name'] = $this->name;
			$data['brandColor'] = $this->brandColor;
			$data['borderColor'] = $this->borderColor;
			$data['category'] = $this->category;
			$data['tags'] = $this->tags;
			$data['slug'] = $this->slug;
			$data['url'] = $this->url;
			$data['date'] = $this->date;
			$data['isPDF'] = $this->isPDF;
			$data['clickedBlock'] = $this->clickedBlock;
			$data['deleted'] = $this->deleted;
			$data['status'] = (int)$this->status;
			$data['id'] = $this->id;
			$preparedStatement = $pdo->prepare($statement);

			$this->registerLog(2);

			return $preparedStatement->execute($data);
		}
		return false;
	}


	public function delete(){
		$pdo = DataSource::load();
		if($this->hasId()){

			$statement = 'DELETE FROM brand WHERE id = :id';
			$preparedStatement = $pdo->prepare($statement);
			$data['id'] = $this->id;
			if($preparedStatement->execute($data)){
				$this->id = 0;
				return true;
			}
		}
		return false;
	}
	
	public function registerClick(){
		if($this->hasId()){
			$click = new BrandClick();
			$click->brand = $this->getId();
			if($click->create()){
				return $this->updateClicksCount();
			}
		}
		return false;
	}
	
	public function updateClicksCount(){
		if($this->hasId()){
			$pdo = DataSource::load();
			$statement = 'UPDATE brand
			SET clicksCount = (SELECT COUNT(*) FROM click WHERE click.brand = brand.id)
			WHERE id = :brandId;';
			$data = array();
			$data['brandId'] = (int)$this->getId();
			$preparedStatement = $pdo->prepare($statement);
			return $preparedStatement->execute($data);
		}
		return false;
	}

	public function registerLog($msg){
		if($this->hasId()){
			$log = new Log();
			$log->brand = $this->getId();
			return $log->save($msg);
		}
		return false;
	}

	static public function getAll(){
		$query = new BrandQuery();
  		$query->setOrderBy(BrandQuery::ORDER_BY_NAME_ASC);
	  	return $query->getBrands();
	}
	
	


}
