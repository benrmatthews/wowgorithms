<?php
session_start();
include('tinySpine/include.php');
try{
	$queryString = '';
	if(!empty($_GET['q'])){
		$queryString = $_GET['q'];
	}

	if(substr($queryString, -1) == '/') {
	    $queryString = substr($queryString, 0, -1);
	}


	if(empty($queryString)){
		Controller::exec('FindGuidelines', 'index');
	}else if($queryString == 'download'){
		Controller::exec('FindGuidelines', 'download');
	}else if($queryString == 'about'){
		Controller::exec('FindGuidelines', 'about');
	}else if(class_exists('AdministrationController') && $queryString == AdministrationController::DIRECTORY_ADMINISTRATION){
		Controller::exec('administration', 'display');
	}else{
		$brand = new Brand();
		$brand->withSlug($queryString);
		if($brand->hasId()){
			Controller::exec('FindGuidelines', 'brandRedirect');
		}else{
			Controller::exec('FindGuidelines', 'error404');
		}
	}
}catch(Exception $e){
	echo 'Oups! Something do not work... :(';
}
