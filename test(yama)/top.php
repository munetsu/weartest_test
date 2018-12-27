<?php
    session_start();
    include('recommend_class.php');

    //クリックジャッキング対策
    header('X-FRAME-OPTIONS: SAMEORIGIN');

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
    
    <h3>ユーザー検索</h3>
    <p>年齢</p>
    <select name="age" id="ageS"></select>
    <select name="age" id="ageE"></select>
    <button id="btn">検索する</button>
    <div id="describe"></div>

    <script
        src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
        crossorigin="anonymous">
    </script>
    <script src="ajax.js"></script>
</body>
</html>


