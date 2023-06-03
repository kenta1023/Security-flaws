<?php
session_start();
if (isset($_SESSION['id'])) {
    $name = $_SESSION['name'];
} else {
    http_response_code(301);
    header('Location: login.php');
}
?>


<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>home</title>
    <link rel="stylesheet" href="css/main.css">
</head>

<body>
    <section class="main">
        <h1>ようこそ---<strong><?php echo $name; ?></strong>---</h1>
        <h2>ログイン完了です</h2>
        <p>
            CSRFでは他のページを訪れた際に仕組まれているPOSTにより、勝手にCSRFの脆弱性を含むこのページ上の操作を行われてしまう。
        </p>
        <button type="button" onclick="location.href='logout.php'">ログアウト</button>
        <button type="button" onclick="location.href='change-password.php'">パスワード変更</button>
    </section>

</body>

</html>