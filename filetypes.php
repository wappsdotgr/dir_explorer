<?php

//
$ftypes = array(
	"html"		=> "html",
	"css"		=> "css",
	"js"		=> "js",
	"json"		=> "json",
	"php"		=> "php",
	"sqlite"	=> "sqlite",
	"mysql"		=> "mysql",
	"java"		=> "java",
	"txt"		=> "txt",
	"md"		=> "md",
	"git"		=> "git",
	"default"	=> "default"
);
/*
	""	=> "",
*/
//
function getExt($str) {
	global $ftypes;
	$ext = trim(substr($str, strrpos($str, '.') + 1));
	return array_key_exists($ext, $ftypes) ? $ftypes[$ext] : $ftypes['default'];
}
?>