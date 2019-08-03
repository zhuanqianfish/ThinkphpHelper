<?php
return [
	// required
	'database_type' => 'sqlite',
	'database_file' => BASE_PATH.'tph3.db',
	'charset' => 'utf8',

	// [optional] Table prefix
	'prefix' => 'ims_',
 
	// [optional] driver_option for connection, read more from http://www.php.net/manual/en/pdo.setattribute.php
	'option' => [
		PDO::ATTR_CASE => PDO::CASE_NATURAL
	]
];
?>