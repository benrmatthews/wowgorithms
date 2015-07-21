<?php
Class Configuration{
	static protected $instance = null;
	public $database;
	
	static public function load(){
		if(self::$instance === null){
			self::$instance = new self();
		}
		return self::$instance;
	}
	
	protected function __construct(){
		include(ROOT.'/configuration.php');
		$this->database = $databaseConfiguration;
	}
}