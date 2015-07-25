<?php
define('ROOT', substr(dirname(__FILE__),0,strlen(dirname(__FILE__))));
define('BASEURL', 'http://localhost/findguidelines/');

include(ROOT.'/core/Configuration.php');
include(ROOT.'/core/Controller.php');
include(ROOT.'/core/DataSource.php');
include(ROOT.'/core/View.php');

include(ROOT.'/controllers/AdministrationController.php');
include(ROOT.'/controllers/FindGuidelinesController.php');

include(ROOT.'/classes/Brand.php');
include(ROOT.'/classes/User.php');
include(ROOT.'/classes/BrandCategory.php');
include(ROOT.'/classes/BrandClick.php');
include(ROOT.'/classes/Logs.php');
