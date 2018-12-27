<?php
    session_start();

    // 関数読み込み
    include('funcs/funcs.php');
    chkSsid();

    //クリックジャッキング対策
    header('X-FRAME-OPTIONS: SAMEORIGIN');

    // POSTデータ取得
    $uid = $_POST['id'];
    $cid = $_SESSION['cid'];

    // DB接続
    $pdo = db_con();
    $stmt = $pdo->prepare("SELECT * FROM matching WHERE user_id = $uid AND company_id = $cid ");
    $result = $stmt->execute();
    if($result === false){
        queryError($stmt);
    } else {
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $flag = $result['flag'];
        if($result === false){
            $statement = $pdo->prepare("INSERT INTO matching (user_id, company_id, flag) VALUES($uid, $cid, 1)");
            $res = $statement->execute();
            if($res === false){
                queryError($statement);
                exit();
            }
        } else if($flag == 0){
            $statement = $pdo->prepare("UPDATE matching SET flag = 1 WHERE user_id = $uid AND company_id = $cid");
            $res = $statement->execute();
            if($res === false){
                queryError($statement);
                exit();
            } else {
                $view = '';
                $view .= '<p>重複してる・・・</p>';
                $view .= '<a href="top.php">戻る</a>';
                echo $view;
                exit(); 
            }
        } else if($flag == 1){
            $view = '';
            $view .= '<p>オファー済みです</p>';
            $view .= '<a href="top.php">戻る</a>';
            echo $view;
            exit(); 
        }
    }

    $view = '';
    $view .= '<p>オファー完了しました</p>';
    $view .= '<a href="top.php">戻る</a>';

    echo $view;






