<?php
    session_start();

    // 関数読み込み
    include('funcs/funcs.php');
    chkSsid();

    //クリックジャッキング対策
    header('X-FRAME-OPTIONS: SAMEORIGIN');

    // ログインユーザーのID取得
    $id = $_SESSION['id'];
    $name = $_SESSION['name'];
    $casual = $_SESSION['casual'];
    $girly = $_SESSION['girly'];


    // DB接続
    $pdo = db_con();
    // 各ユーザーとの相関を計算する
    // ユーザー毎との相関を入れる空配列
    $array = [];

    $stmt = $pdo->prepare("SELECT * FROM wear_user INNER JOIN bland_matrix ON wear_user.bland2 = bland_matrix.bland_name");
    $result = $stmt->execute();
    if($result === false){
        queryError($statement);
    } else {
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // var_dump($result);
        // exit();
        foreach($result as $con){
            // var_dump($con['id']);
            // exit();
            // 相関数値を算出
            // casual
            $casual_int = $con['casual'];
            $girly_int = $con['girly'];

            // 2点間の距離を求める
            // 横の差異
            $diff_side = $casual - $casual_int;
            // 縦の差異
            $diff_length = $girly - $girly_int;
            // 三平方の定理で距離を出す
            $comp = ($diff_side* $diff_side) + ($diff_length * $diff_length);
            $comp = sqrt($comp);
            $comp = round($comp,3); 
            // var_dump($comp);
            // exit();

            // 距離が30以内のもののみを配列に追加する
            if($comp <= 30){
                $array_temp = ['id'=>$con['id'], 'compare'=>$comp];
                array_push($array,$array_temp);    
            }
        }
        // セッションに入れる
        $_SESSION['compare'] = $array;
    }
    // $array = json_encode($array);
    // var_dump($array);

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


