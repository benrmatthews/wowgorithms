<?php
Class AdministrationController extends Controller{
	const DIRECTORY_ADMINISTRATION = 'fgl_headquarter';

	public function display(){
		if($user = User::load()){
			if(!empty($_GET['action'])){
				$action = $_GET['action'];
			}else{
				$action = 'index';
			}
			$this->set('module', 'Administration');
			$this->set('action', $action);
			$this->render('administration/display');
		}else if(!empty($_GET['action']) && $_GET['action'] == 'login'){
			$this->login();
		}else{
			$this->redirect($this->getLoginUrl());
		}
	}

	public function header(){
		$user = User::load();
		$this->set('user', $user);
		$this->set('userLink', $this->getUrl('user'));
		$this->set('usersLink', $this->getUrl('users'));
		$this->set('brandLink', $this->getUrl('brand'));
		$this->set('brandsLink', $this->getUrl('brands'));
		$this->set('categoriesLink', $this->getUrl('categories'));
		$this->set('categoryLink', $this->getUrl('category'));
		$this->set('exportLink', $this->getUrl('export'));
		$this->set('disconnectLink', $this->getUrl('disconnect'));
		$this->render('administration/header');
	}

	public function footer(){
		$this->render('administration/footer');
	}

	public function login(){
		if(!empty($_POST['login']) && !empty($_POST['password'])){
			if($user = User::connect($_POST['login'], $_POST['password'])){
				$this->redirect($this->getUrl('index'));
			}
		}
		$this->render('administration/login');
	}

	public function disconnect(){
		User::disconnect();
		$this->redirect($this->getLoginUrl());
	}

	public function index(){
		$this->redirect($this->getUrl('brands'));
	}

	public function categories(){
		$this->set('categories', BrandCategory::getAll());
		$this->render('administration/categories');
	}

	public function category(){

		$id = null;
		if(!empty($_GET['id'])){
				$id = (int)$_GET['id'];
		}
		$category = new BrandCategory();
		$category->withId($id);

		if(!empty($_POST)){
			if(isset($_POST['name'])) $category->name = $_POST['name'];
			if($category->save()){
				header('Location: '.$this->getUrl('categories'));
				exit();
			}
		}

		$this->set('category', $category);
		$this->render('administration/category');
	}

	public function deleteCategory(){
		$id = null;
		if(!empty($_GET['id'])){
				$id = (int)$_GET['id'];
		}
		$category = new BrandCategory();
		$category->withId($id);
		if($category->hasId()){
				$category->delete();
		}
		header('Location: '.$this->getUrl('categories'));
		exit();
	}

	public function users(){
		$pdo = DataSource::load();
		$statement = 'SELECT id, firstName, lastName, login  FROM User';
		$preparedStatement = $pdo->prepare($statement);
		$preparedStatement->execute();
		$usersData = $preparedStatement->fetchAll();
		$this->set('usersData', $usersData);
		$this->render('administration/users');
	}

	public function user(){
		$user = new User();
		if(!empty($_GET['id'])){
			$user->withId($_GET['id']);
			if(!$user->hasId()){
				return;
			}
		}

	    if(!empty($_POST)){
			if(isset($_POST['firstName'])) $user->firstName = $_POST['firstName'];
			if(isset($_POST['lastName'])) $user->lastName = $_POST['lastName'];
			if(isset($_POST['login'])) $user->login = $_POST['login'];
			if(isset($_POST['password'])) $user->password = $_POST['password'];

			if(empty($user->login)){
			    $this->set('error', 'Un identifiant est nécessaire.');
			}else if(!$user->hasId() && empty($_POST['password'])){
			    $this->set('error', 'Un mot de passe est nécessaire pour créer un utilisateur.');
			}else if($user->save()){
				header('Location: '.$this->getUrl('users'));
				exit();
			}
		}
		$this->set('user', $user);
		$this->render('administration/user');
	}

	public function deleteUser(){
	    $id = null;
	    if(!empty($_GET['id'])){
	        $id = $_GET['id'];
	    }
	    $user = new User();
			$user->withId($id);
	    if($user->hasId()){
	        $user->delete();
	    }
	    header('Location: '.$this->getUrl('users'));
	    exit();
	}

	public function brands(){
		if (!empty($_GET['s'])) {
			switch ($_GET['s']) {
				case 'submission':
					$this->set('brands', Brand::getBrandByStatus(Brand::STATUS_SUBMITTED));
					break;
				case 'published':
					$this->set('brands', Brand::getBrandByStatus(Brand::STATUS_PUBLISHED));
					break;
				case 'rejected':
					$this->set('brands', Brand::getBrandByStatus(Brand::STATUS_REJECTED));
					break;
				default:
					break;
			}
		} else {
			$this->set('brands', Brand::getAll());		
		}
		$this->render('administration/brands');
	}

	public function brand(){
	    ini_set('post_max_size', '32M');
	    ini_set('upload_max_filesize', '32M');
	    ini_set('memory_limit','64M');

		$id = null;
		if(!empty($_GET['id'])){
				$id = (int)$_GET['id'];
		}
		$brand = new Brand();
		$brand->withId($id);

		if(!empty($_POST)){
			if(isset($_POST['name'])) $brand->name = $_POST['name'];
			if(isset($_POST['brandColor'])) $brand->brandColor = $_POST['brandColor'];
			if(isset($_POST['borderColor'])) $brand->borderColor = $_POST['borderColor'];
			if(isset($_POST['category'])) $brand->category = $_POST['category'];
			if(isset($_POST['tags'])) $brand->tags = $_POST['tags'];
			if(isset($_POST['slug'])) $brand->slug = $_POST['slug'];
			if(isset($_POST['url'])) $brand->url = $_POST['url'];
			if(isset($_POST['date'])) $brand->date = $_POST['date'];
			if(isset($_POST['isPDF'])) $brand->isPDF = $_POST['isPDF'];
			if(isset($_POST['status'])) $brand->status = $_POST['status'];
			if($brand->save()){
				if(!empty($_FILES)){
					if(!empty($_FILES['logoPNG']['size'])) $this->uploadFileToBrand($brand, 'logoPNG', 'png');
					if(!empty($_FILES['logoSVG']['size'])) $this->uploadFileToBrand($brand, 'logoSVG', 'svg');
				}
				header('Location: '.$this->getUrl('brands'));
				exit();
			}
		}

		$this->set('categories', BrandCategory::getAll());
		$this->set('brand', $brand);
		$this->render('administration/brand');
	}


	public function deleteBrand(){
		$id = null;
		if(!empty($_GET['id'])){
				$id = (int)$_GET['id'];
		}
		$brand = new Brand();
		$brand->withId($id);
		if($brand->hasId()){
				$brand->delete();
		}
		header('Location: '.$this->getUrl('brands'));
		exit();
	}


	protected function uploadFileToBrand($brand, $key, $format){
		if(empty($brand)
		|| empty($brand->slug)){
			return false;
		}

		if(isset($_FILES[$key])){
			// Images dir
			$imagesDir = dirname(ROOT).'/img/icons/';
			if(!is_dir($imagesDir)){
				mkdir($imagesDir);
			}

			if('png' == strtolower($format)
			&& $_FILES[$key]['type'] == 'image/png'){
				$imagePath = $imagesDir.$brand->slug.'.png';
			}else if('svg' == strtolower($format)
			&& $_FILES[$key]['type'] = 'image/svg+xml'){
				$imagePath = $imagesDir.$brand->slug.'.svg';
			}else{
				return false;
			}

			if(is_file($imagePath)){
				unlink($imagePath);
			}
			move_uploaded_file($_FILES[$key]["tmp_name"], $imagePath);
	    }
	}



	protected function getLoginUrl(){
		return $this->getUrl('login');
	}

	protected function getUrl($action, $id = 0){

		$url = BASEURL.self::DIRECTORY_ADMINISTRATION.'?action='.$action;
		if(!empty($id)){
			$url .= '&id='.$id;
		}
		return $url;
	}

}
