<?php
    try {
        $connection = new PDO('mysql:dbname=db_name;host=db_host;charset=utf8', 'db_username', 'db_password');
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e) {
    	echo $e->getMessage();                         
   	};

    $domain = "https://example.com/url/"; # with / at the end