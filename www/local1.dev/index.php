<?php
session_start();
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Expires: " . date("r"));
header("content-type:text/html;charset=utf-8");
ini_set("display_errors", 1);
error_reporting(E_ALL);

define ("ROOT_PATH", dirname(__FILE__));

require_once(ROOT_PATH."/core.php");
$core=new core;


		if($core->operationresult[0]!=-1){
		print ($core->operationresult[1]);
		}
		$core->getHTMLtemplates(); 
		 ?>

