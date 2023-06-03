<?php
session_start();
if (isset($_SESSION['id'])) {
    $id = $_SESSION['id'];
    $name = $_SESSION['name'];
} else {
    http_response_code(301);
    header('Location: login.php');
}

$msg = '';
//$dsn = "mysql:dbname=php1_login;host=localhost;charset=utf8mb4";
$dsn = "mysql:dbname=php1_login;host=mysql;charset=utf8mb4";
$db_user = "php1";
$db_password = "pjk-3kjf-Abc";


if (!empty($_POST)) {
    $newpassword = password_hash($_POST["newpassword"],PASSWORD_DEFAULT);

    try {
        $dbh = new PDO($dsn, $db_user, $db_password);
        $sql = "UPDATE userlist SET name = :name, password = :password WHERE id = :id";
        $stmt = $dbh->prepare($sql);
        $params = array(':name' => $name, ':password' => $newpassword, ':id' => $id);
        $stmt->execute($params);
        //変更完了・ログイン処理後logout.phpに移動

        http_response_code(301);
        header('Location: logout.php');

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
    <title>Change Password</title>
    <link rel="stylesheet" href="css/form.css">
</head>

<body>
    <div class="box-form">
        <h1>Change Password</h1>
        <form action="" method="post">
            <font color='red' size="5"><?php echo $msg; ?></font>
            <p type="text" name="name" id="input"><?php echo $name; ?></p>
            <br>
            <input type="newpassword" name="newpassword" required placeholder="NewPassword">
            <br>
            <input type="submit" value="Change Password" class="submit-btn">
        </form>
    </div>
</body>

</html>