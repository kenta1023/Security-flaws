<!DOCTYPE html>
<html>

	<head>
		<meta charaset="utf-8">
		<title>SQL-Injection</title>
		<meta name="viewport" content="width=device-width, inital-scale=1">
		<link rel="stylesheet" href="style.css">
	</head>

	<body>
		<h1>XSSを試せるページ</h1>
		<form method="POST" action="">
			<input type="text" name="name" required placeholder="Bob"><br>
			<input type="submit" value="submit" class="submit-btn">
		</from>
	</body>

</html>



<?php
$dsn = "mysql:dbname=sql-injection;host=mysql;charset=utf8mb4";
$db_user = "user";
$db_password = "user025pass";

if(!empty($_POST)){
	$name = $_POST['name'];
	try{
		$dbh = new PDO($dsn, $db_user, $db_password);
    	$sql = $dbh->prepare('SELECT * FROM userlist WHERE name=\'' . $name . '\';');
		$sql ->execute();
		echo "<table>\n";
		echo "<tr><th>id</th><th>name</th><th>TEL</th></tr>\n";
		while( $result = $sql->fetch(PDO::FETCH_ASSOC)){
			echo "<tr>\n<td>". $result['id'] . "</td>\n";
			echo "<td>" . $result['name'] . "</td>\n";
			echo "<td>" . $result['TEL'] . "</td>\n</tr>\n";
		}
		echo "</table>\n";
	}catch(PDOException $e){
		//コメントを解除でエラー文をweb上に表示
		//print($e->getMessage());
	}finally{
		$dbh = null;
	}
}
?>


