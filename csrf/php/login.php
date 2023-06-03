<?php
//$dsn = "mysql:dbname=php1_login;host=localhost;charset=utf8mb4";
$dsn = "mysql:dbname=php1_login;host=mysql;charset=utf8mb4";
$db_user = "php1";
$db_password = "pjk-3kjf-Abc";

$msg = '';

if (!empty($_POST)) {
    $name = $_POST['name'];
    try {
        $dbh = new PDO($dsn, $db_user, $db_password);
        $sql = "SELECT * FROM userlist WHERE name = :name";
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(':name', $name);
        $stmt->execute();
        $result = $stmt->fetch();

        if (!empty($result) and password_verify($_POST['password'], $result['password'])) {
            session_start();
            $_SESSION['id'] = $result['id'];
            $_SESSION['name'] = $result['name'];
            http_response_code(301);
            header('Location: index.php');
        } else {
            $msg = '名前またはパスワードが間違っています';
        }


    } catch (PDOException $e) {
        print("データベースへの接続失敗\n" . $e->getMessage());
    } finally {
        $dbh = null;
    }
}
?>



<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="css/form.css">
</head>

<body>
    <div class="box-form">
        <h1>Login</h1>
        <form method="post">
            <font color='red' size="5"><?php echo $msg; ?></font>
            <input type="text" name="name" required placeholder="Username">
            <br>
            <input type="password" name="password" required placeholder="Password">
            <br>
            <input type="submit" value="Log in" class="submit-btn">
        </form>
        <p>Not a member? <a href="signup.php">sign up now</a></p>
    </div>
</body>

</html>
