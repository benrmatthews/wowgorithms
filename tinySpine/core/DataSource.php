<?php
class DataSource{

	static protected $pdo = null;

	/**
	 *
	 * @return PDO
	 */
	static public function load(){
		if(self::$pdo === null){
			$configuration = Configuration::load();
			$user = $configuration->database['user'];
			$password = $configuration->database['password'];
			$dsn = 'mysql:host='.$configuration->database['host'].';dbname='.$configuration->database['database'];
			try{
				$pdo = new PDO($dsn, $user, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
				$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

				self::$pdo = $pdo;
			}catch (PDOException $e){
				echo $e->getMessage();
				exit();
			}


		}
		return self::$pdo;
	}
}
