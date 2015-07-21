<?php
Class View{
	const VIEWS_DIRECTORY = 'views';
	protected $var = array();
	protected $viewPath = '';
	
	public function set($key, $value){
		$this->var[$key] = $value;
	}
	
	public function setControllerDirectory($controllerDirectory){
		$this->controllerDirectory = $controllerDirectory;
	}
	
	public function setView($viewName){
		$viewPath = ROOT.'/'.self::VIEWS_DIRECTORY.'/'.$viewName.'.php';
		if(is_file($viewPath)){
			$this->viewPath = $viewPath;
		}
	}
	
	public function render($viewName = null){
		if(!empty($viewName)){
			$this->setView($viewName);
		}
		
		if(empty($this->viewPath)){
			return;
		}
		
		extract($this->var);
		include($this->viewPath);
		
	}
	
	public function translate($key){
	
	}

}