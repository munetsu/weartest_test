<?php
    session_start();

    // 関数読み込み
    include('funcs/funcs.php');
    chkSsid();

    //クリックジャッキング対策
    header('X-FRAME-OPTIONS: SAMEORIGIN');

    // ログインユーザーのID取得
    $cid = $_SESSION['cid']; //企業id
    $name = $_SESSION['name']; //企業名
    $casual = $_SESSION['casual']; //ブランド軸(casual)
    $girly = $_SESSION['girly']; //ブランド軸(girly)
    // var_dumP($casual);
    // exit();

    // DB接続
    $pdo = db_con();
    // 各ユーザーとの相関を計算する
    // ユーザー毎との相関を入れる空配列
    $array = [];

    $stmt = $pdo->prepare("SELECT * FROM wear_user INNER JOIN bland_matrix ON wear_user.bland2 = bland_matrix.bland_name ORDER BY power DESC");
    // $stmt->bindValue('name',$name,PDO::PARAM_STR);
    $result = $stmt->execute();
    if($result === false){
        queryError($stmt);
    } else {
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // var_dump($result);
        // exit();
        foreach($result as $con){
            // var_dump($con['id']);
            // exit();
            // 相関数値を算出
            // casual
            $casual_int = $con['casual']; //X軸と仮定
            $girly_int = $con['girly']; //Y軸と仮定
            // var_dump($casual,$casual_int);
            // exit();

            // 直線の距離と角度の両方で検出
            // 2点間の距離を求める
            // 横の差異
            $diff_side = $casual - $casual_int;
            // // 縦の差異
            $diff_length = $girly - $girly_int;
            // // 三平方の定理で距離を出す
            $comp = ($diff_side* $diff_side) + ($diff_length * $diff_length);
            $comp = sqrt($comp);
            $comp = round($comp,3); 
            // // var_dump($comp);
            // // exit();

            // // 距離が30以内のもののみを配列に追加する
            if($comp <= 30){
                // 角度の算出
                $katamuki = $girly_int / $casual_int; //m2
                $katamuki2 = $girly / $casual; //m1
                $tan = abs(($katamuki2 - $katamuki) / 1+ $katamuki2*$katamuki);
                // 参考サイト：https://sci-pursuit.com/math/trigonometric-function-table.html
                // 30度以内でのユーザーを検出
                if($tan < 0.55431){
                    $array_temp = ['id' =>$con['id'], 'compare' => $tan];
                    array_push($array,$array_temp);
                }                
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


