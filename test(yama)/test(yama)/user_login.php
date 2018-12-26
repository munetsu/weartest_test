<?php
    session_start();

    include('funcs/funcs.php');
    $_SESSION['chk_ssid'] = session_id();
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    
    <h2>一般ログイン</h2>
    <form action="user_login_check.php" method="post">
        <input type="text" name="name">
        <input type="submit" value="ログイン">
    </form>
</body>
</html>




