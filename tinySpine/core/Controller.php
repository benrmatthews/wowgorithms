<?php
Class Controller{
	
	const CONTROLLERS_DIRECTORY = 'controllers';
	protected $view;
	
	
	static public function exec($controllerName, $actionName, $argument = array()){
		$controllerClass = $controllerName.'Controller';
		if(class_exists($controllerClass)){
			$controller = new $controllerClass();
			$controller->$actionName($argument);
		}
	}

	public function __construct(){
		$this->view = new View();
	}
	
	public function render($view){
		ob_start();
		$this->view->render($view);
		ob_end_flush();
	}
	
	public function set($key, $value){
		$this->view->set($key, $value);
	}
	
	public function redirect($url){
		header('Location: '.$url);
		exit();
	}
	
	public function secure(){
		if($user = user::load()){
			return true;
		}
		return false;
	}
	
	
}