<?php

$msg = '';
//$dsn = "mysql:dbname=php1_login;host=localhost;charset=utf8mb4";
$dsn = "mysql:dbname=php1_login;host=mysql;charset=utf8mb4";
$db_user = "php1";
$db_password = "pjk-3kjf-Abc";


if (!empty($_POST)) {
    $name = $_POST["name"];
    $password = password_hash($_POST["password"],PASSWORD_DEFAULT);

    try {
        $dbh = new PDO($dsn, $db_user, $db_password);
        $sql = "SELECT * FROM userlist WHERE name = :name";
        $stmt_select = $dbh->prepare($sql);
        $stmt_select->bindValue(':name', $name);
        $stmt_select->execute();
        $result = $stmt_select->fetch();
        if (empty($result)) {
            $sql = "INSERT INTO userlist (name, password)VALUES(:name, :password)";
            $stmt = $dbh->prepare($sql);
            $params = array(':name' => $name, ':password' => $password);
            $stmt->execute($params);
            //登録完了・ログイン処理後index.phpに移動
            $stmt_select->execute();
            $result = $stmt_select->fetch();
            session_start();
            $_SESSION['id'] = $result['id'];
            $_SESSION['name'] = $result['name'];

            http_response_code(301);
            header('Location: index.php');
        } else {
            $msg = 'この名前は既に使われています。';
        }
    } catch (PDOException $e) {
        print("データベース＜エラー＞\n" . $e->getMessage());
    } finally {
        $dbh = null;
    }
}
?>


<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>Sign up</title>
    <link rel="stylesheet" href="css/form.css">
</head>

<body>
    <div class="box-form">
        <h1>Sign up</h1>
        <form action="" method="post">
            <font color='red' size="5"><?php echo $msg; ?></font>
            <input type="text" name="name" required placeholder="Username">
            <br>
            <input type="password" name="password" required placeholder="Password">
            <br>
            <input type="submit" value="Sign up" class="submit-btn">
        </form>
        <p>Already a member? <a href="login.php">Log in</a></p>
    </div>
</body>

</html>
