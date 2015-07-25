<?php
Class Brand{

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
		$userData = $preparedStatement->fetch();
		if(!empty($userData)){
				$this->setProperties($userData);
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
		if(!empty($this->password)){
			$this->hash = $this->cryptPassword($this->password, $this->getSalt());
		}

		$pdo = DataSource::load();
		if(!$this->hasId()){
			$statement = 'INSERT INTO brand
			(name, brandColor, borderColor, category, tags, slug, url, date, isPDF, clickedBlock, deleted)
			VALUES (:name, :brandColor, :borderColor, :category, :tags, :slug, :url, :date, :isPDF, :clickedBlock, :deleted)';


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
			$data['deleted'] = (int)$this->deleted;
			$preparedStatement = $pdo->prepare($statement);
			
			$this->registerLog();
			
			return $preparedStatement->execute($data);



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
			$data['id'] = $this->id;
			$preparedStatement = $pdo->prepare($statement);
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

	public function registerLog(){
		if($this->hasId()){
			$log = new Logs();
			$log->brand = $this->getId();
			$log->hasBeenCreated();
		}
		return false;
	}

	static public function getAll(){
		$brands = array();
		$pdo = DataSource::load();
		$statement = 'SELECT brand.*, category.name AS categoryName FROM brand
		LEFT JOIN category ON brand.category = category.id
		WHERE deleted = 0
		ORDER BY brand.id ASC
		LIMIT 1000';
		$preparedStatement = $pdo->prepare($statement);
		$preparedStatement->execute();
		$brandsData = $preparedStatement->fetchAll();
		foreach($brandsData as $brandData){
			$brand = new self();
			$brand->setProperties($brandData);
			$brands[] = $brand;
		}
		return $brands;
	}
	
	


}
