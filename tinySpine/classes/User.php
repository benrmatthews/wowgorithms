<?php
Class User{

	protected $id;
	public $firstName;
	public $lastName;
	public $login;
	public $password;
	public $salt;
	public $hash;
	public $secret;

	const SESSION_KEY = 'user_token';
	const BLOWFISH_MODE = '$2a$07$';
	/*
	static $properties = array(
		'firstName' => array(self::FIELD_TYPE => self::TYPE_STRING),
		'lastName' => array(self::FIELD_TYPE => self::TYPE_STRING),
		'login' => array(self::FIELD_TYPE => self::TYPE_STRING),
		'hash' => array(self::FIELD_TYPE => self::TYPE_STRING),
		'salt' => array(self::FIELD_TYPE => self::TYPE_STRING),
		'token' => array(self::FIELD_TYPE => self::TYPE_STRING),
	);
	*/

	static protected $user = null;

	static function connect($login, $password){
		$pdo = DataSource::load();
		$statement = 'SELECT * FROM user WHERE login = :login LIMIT 1';
		$preparedStatement = $pdo->prepare($statement);
		$preparedStatement->execute(array('login' => $login));
		$userData = $preparedStatement->fetch();

		if(!empty($userData)){
			if(self::cryptPassword($password, $userData['salt']) == $userData['hash']){
				$user = new User();
				$user->setProperties($userData);
				self::$user = $user;
				$_SESSION[self::SESSION_KEY] = $user->getSecret();
				return self::$user;
			}
		}
		return false;
	}

	static function disconnect(){
		if(isset($_SESSION[self::SESSION_KEY])){
			unset($_SESSION[self::SESSION_KEY]);
		}
	}

	static function load(){
		if(!empty(self::$user)){
			return self::$user;
		}elseif(!empty($_SESSION[self::SESSION_KEY])){
			$pdo = DataSource::load();
			$statement = 'SELECT * FROM user WHERE secret = :secret LIMIT 1';
			$preparedStatement = $pdo->prepare($statement);
			$preparedStatement->execute(array('secret' => $_SESSION[self::SESSION_KEY]));
			$userData = $preparedStatement->fetch();
			if(!empty($userData)){
				$user = new User();
				$user->setProperties($userData);
				self::$user = $user;
				return self::$user;
			}

		}

		return false;
	}

	public function hasId(){
		return !empty($this->id);
	}

	public function withId($id){
		$pdo = DataSource::load();
		$statement = 'SELECT * FROM user WHERE id = :id LIMIT 1';
		$preparedStatement = $pdo->prepare($statement);
		$preparedStatement->execute(array('id' => $id));
		$userData = $preparedStatement->fetch();
		if(!empty($userData)){
				$this->setProperties($userData);
		}
	}

	public function withToken($token){

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
			$statement = 'INSERT INTO user
			(firstName, lastName, login, salt, hash, secret)
			VALUES (:firstName, :lastName, :login, :salt, :hash, :secret)';

			$data = array();
			$data['firstName'] = $this->firstName;
			$data['lastName'] = $this->lastName;
			$data['login'] = $this->login;
			$data['salt'] = $this->salt;
			$data['hash'] = $this->hash;
			$data['secret'] = $this->getSecret();
			$preparedStatement = $pdo->prepare($statement);
			return $preparedStatement->execute($data);
		}else{
			$statement = 'UPDATE user SET
			firstName = :firstName,
			lastName = :lastName,
			login = :login,
			salt = :salt,
			secret = :secret,
			hash = :hash
			WHERE id = :id';
			$data = array();
			$data['firstName'] = $this->firstName;
			$data['lastName'] = $this->lastName;
			$data['login'] = $this->login;
			$data['salt'] = $this->salt;
			$data['hash'] = $this->hash;
			$data['secret'] = $this->getSecret();
			$data['id'] = $this->id;
			$preparedStatement = $pdo->prepare($statement);
			return $preparedStatement->execute($data);
		}
		return false;
	}


	public function delete(){
		$pdo = DataSource::load();
		if($this->hasId()){
			$statement = 'DELETE FROM user WHERE id = :id';
			$preparedStatement = $pdo->prepare($statement);
			$data['id'] = $this->id;
			if($preparedStatement->execute($data)){
				$this->id = 0;
				return true;
			}
		}
		return false;
	}

	/**
	 * Generate a 22 length salt
	 * @return string
	 */
	public function getSalt(){
		if(empty($this->salt)){
			$this->salt = substr(md5(uniqid()), 0, 22);
		}
		return $this->salt;
	}

	/**
	 *
	 *Encrypt a password with blowfish
	 */
	public static function cryptPassword($password, $salt){
		return crypt($password, self::BLOWFISH_MODE.$salt.'$');
	}


	public function getSecret(){
		if(empty($this->secret)){
			$this->secret = md5(uniqid());
		}
		return $this->secret;
	}

	public function getCompleteName(){
		if(!empty($this->firstName) && !empty($this->lastName)){
			return $this->firstName.' '.$this->lastName;
		}elseif(!empty($this->firstName)){
			return $this->firstName;
		}elseif(!empty($this->lastName)){
			return $this->lastName;
		}else{
			return false;
		}
	}

}
