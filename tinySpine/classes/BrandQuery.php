<?php 
Class BrandQuery{
	
	const ORDER_BY_ID_DESC = 'brand.id DESC';
	const ORDER_BY_ID_ASC = 'brand.id ASC';
	const ORDER_BY_CLICKS_DESC = 'brand.clicksCount DESC';
	const ORDER_BY_CLICKS_ASC = 'brand.clicksCount ASC';
	
	protected $limit;
	protected $offset;
	protected $orderBy;
	protected $categoryId;
	protected $status;
	
	public function setLimit($limit){
		$this->limit = (int)$limit;
	}
	
	public function getLimit(){
		return $this->limit;
	}
	
	public function setOffset($offset){
		$this->offset = (int)$offset;
	}
	
	public function getOffset(){
		return $this->offset;
	}
	
	public function setOrderBy($orderBy){
		switch($orderBy){
			case self::ORDER_BY_ID_DESC:
			case self::ORDER_BY_ID_ASC:
			case self::ORDER_BY_CLICKS_DESC:
			case self::ORDER_BY_CLICKS_ASC:
				$this->orderBy = (int)$orderBy;
				break;
		}
	}
	
	public function getOrderBy(){
		return $this->orderBy;
	}
	
	public function setCategoryId($categoryId){
		$this->categoryId = (int)$categoryId;
	}
	
	public function getCategoryId(){
		return $this->categoryId;
	}
	
	public function setStatus($status){
		if($status !== null){
			$this->status = (int)$status;
		}
	}
	
	public function getStatus(){
		return $this->status;
	}
	
	public function getBrands(){
		$brands = array();
		$pdo = DataSource::load();
		$data = array();
		$statement = 'SELECT brand.*, category.name AS categoryName FROM brand
		LEFT JOIN category ON brand.category = category.id
		WHERE deleted = 0';
		 
		if(!empty($this->categoryId)){
			$statement .= ' AND category = :category';
			$data['category'] = $this->categoryId;
		}
		
		if($this->status !== null){
			$statement .= ' AND status = :status';
			$data['status'] = $this->status;
		}
		 
		if(!empty($this->orderBy)){
			$statement .= ' ORDER BY '.$this->orderBy;
		}
		 
		if(!empty($this->limit)){
			$statement .= ' LIMIT '.(int)$this->limit;
		}
		
		if(!empty($this->offset)){
			$statement .= ' OFFSET '.(int)$this->offset;
		}
		
		$preparedStatement = $pdo->prepare($statement);
		$preparedStatement->execute($data);
		$brandsData = $preparedStatement->fetchAll();
		foreach($brandsData as $brandData){
			$brand = new Brand();
			$brand->setProperties($brandData);
			$brands[] = $brand;
		}
		return $brands;
	}
	
	
}
?>