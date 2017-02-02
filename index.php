<?php

// 値がポストされたというのを擬似的に実行
$_POST['name'] = 'yamauchi';
//$_POST['score'] = 11;
$_POST['score'] = 'x); delete from users';

define('DB_DATABASE', 'dotinstall_db');
define('DB_USERNAME', 'dbuser');
define('DB_PASSWORD', 'pass');
define('PDO_DSN', 'mysql:dbhost=localhost;dbname=' . DB_DATABASE);

try {
	// connect
	$db = new PDO(PDO_DSN, DB_USERNAME, DB_PASSWORD);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	// insert
	//$db->exec("insert into users(name, score) values('taguchi', 55)");
	//$sql = "insert into users(name, score) values('" . $_POST['name'] . "'," .
	//					$_POST['score'] . ")";
	//echo $sql . "<br>\n";
	//$db->exec($sql);
	//echo "user added!<br>\n";

	//$stmt = $db->prepare("insert into users (name, score) values (?,?)");
	$stmt = $db->prepare("insert into users (name, score) values (:name, :score)");
	//$stmt->execute(['taguchi', 44]);
	//$stmt->execute([44, 'taguchi']);
	//$stmt->execute([$_POST['name'], $_POST['score']]);
	//$stmt->execute([':name' => 'fkoji', ':score' => 80]);
	$stmt->execute([':score' => 80, ':name' => 'fkoji'] );
	echo "inserted: " . $db->lastInsertId() . "<br>\n";

	// disconnect
	$db = null;

}catch(PDOException $e){
	echo $e->getMessage();
	exit;
}

echo 'OK!';
