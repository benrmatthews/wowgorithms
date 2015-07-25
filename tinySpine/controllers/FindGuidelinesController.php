<?php
Class FindGuidelinesController extends Controller{
	
	public function index(){
		$this->set('categories', BrandCategory::getAll());
		$this->set('logs', Logs::getAll());
		$this->render('findguidelines/index');
	}
	
	public function brandRedirect(){
		if(empty($_GET['q'])){
			return;
		}
		$slug = $_GET['q'];
		$brand = new Brand();
		$brand->withSlug($slug);
		if($brand->hasId()){
			$brand->registerClick();
			$this->gaBrandClickRegister($brand);
			header('Location: '.$brand->url);
			exit;
		}
	}
	
	
	public function gaBrandClickRegister($brand){
		if(($brand instanceof Brand) 
		&& $brand->hasId()){
		
			function gaParseCookie()
			{
				if (isset($_COOKIE['_ga'])) {
					list($version, $domainDepth, $cid1, $cid2) = explode('.', $_COOKIE["_ga"]);
					$contents = array('version' => $version, 'domainDepth' => $domainDepth, 'cid' => $cid1 . '.' . $cid2);
					$cid = $contents['cid'];
		
				} else {
					$cid = gaGenUUID();
				}
				return $cid;
			}
		
			function gaGenUUID()
			{
				return sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
						// 32 bits for "time_low"
						mt_rand(0, 0xffff), mt_rand(0, 0xffff),
						// 16 bits for "time_mid"
						mt_rand(0, 0xffff),
						// 16 bits for "time_hi_and_version",
						// four most significant bits holds version number 4
						mt_rand(0, 0x0fff) | 0x4000,
						// 16 bits, 8 bits for "clk_seq_hi_res",
						// 8 bits for "clk_seq_low",
						// two most significant bits holds zero and one for variant DCE1.1
						mt_rand(0, 0x3fff) | 0x8000,
						// 48 bits for "node"
						mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
				);
			}
		
			$c = curl_init();
			$cid = gaParseCookie();
			$url = "https://www.google-analytics.com/collect?v=1&tid=UA-42305594-1&cid=".$cid."&t=event&ec=".$brand->slug."&ea=shortCut&el=noLabel&ev=1";
		
			curl_setopt($c, CURLOPT_URL, $url);
			curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($c, CURLOPT_POST, 0 );
		
			$output = curl_exec($c);
		
			if(!$output) {
				trigger_error('Erreur curl: '.curl_error($c), USER_WARNING);
			}
			curl_close($c);
		}
	}
	
	public function download(){
		header('Cache-Control: no-cache, must-revalidate');
		header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
		header('Content-type: application/json');
		header('Content-Description: File Transfer');
		header('Content-Type: application/octet-stream');
		header('Content-Disposition: attachment; filename=findguidelines.json'); 
		header('Content-Transfer-Encoding: binary');
		header('Connection: Keep-Alive');
		header('Pragma: public');
		$brands = Brand::getAll();
		echo json_encode($brands);
	}


	public function error404(){
		header("HTTP/1.0 404 Not Found");
		$this->render('findguidelines/error404');
	}
	
	
}