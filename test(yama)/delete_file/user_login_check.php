<?php
    session_start();
    // 関数読み込み
    include('funcs/funcs.php');
    chkSsid();

    //クリックジャッキング対策
    header('X-FRAME-OPTIONS: SAMEORIGIN');

    $name = h($_POST['name']);

    // データが空だった場合
    if(empty($_POST)) {
        header("Location: login.php");
        exit();
    } else {

        // DB接続
        $pdo = db_con();

        // ログインチェック
        $sql ="SELECT * FROM wear_user";
        $stmt = $pdo->prepare($sql);
        $val = $stmt->execute();

        if($val ===false){
            queryError($stmt);
        } else {
            while($res = $stmt->fetch(PDO::FETCH_ASSOC)){
                if($res['name'] == $name){
                    $_SESSION['uid'] = $res['id'];
                    $_SESSION['name'] = $res['name'];
                    header('Location: top.php');
                    exit();
                    break;
                }
            }
            echo '<script>alert("ログインエラー");location.href="login.php";</script>';
            exit();
        }
    }

    // DB切断
    $pdo = null;
?>
