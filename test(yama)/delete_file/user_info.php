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
    $stmt = $pdo->prepare("SELECT * FROM wear_user WHERE id = $uid ");
    $result = $stmt->execute();
        if($result === false){
            queryError($stmt);
        } else {
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $view = '';
            $view .= '<div>';
            $view .= '<table>';
                $view .= '<tr>';
                    $view .= '<th>ユーザーID</th>';
                    $view .= '<th>名前</th>';
                    $view .= '<th>年齢</th>';
                    $view .= '<th>身長</th>';
                    $view .= '<th>フォロワー数</th>';
                    $view .= '<th>コーディネート数</th>';
                    $view .= '<th>指示力</th>';
                    $view .= '<th>影響力</th>';
                $view .= '</tr>';
                $view .= '<tr>';
                    $view .= '<th class="u_id"><a id="look" disabled style="color:blue;text-decoration:underline">'.$result['id'].'</a></th>';
                    $view .= '<th class="u_name">'.$result['name'].'</th>';
                    $view .= '<th class="u_age">'.$result['age'].'</th>';
                    $view .= '<th class="u_tall">'.$result['tall'].'</th>';
                    $view .= '<th class"=u_follow">'.$result['follower'].'</th>';
                    $view .= '<th class="u_cordinate">'.$result['cordinate'].'</th>';
                    $view .= '<th class"=u_power">'.$result['power'].'</th>';
                    $view .= '<th class="u_influence">'.$result['influence'].'</th>';
                $view .= '</tr>';
                $view .= '</table>';
                $view .= '</div>';
                $view .= '<a disabled id="offer" class="'.$result['id'].'" style="color:blue;text-decoration:underline">オファーする</a><br>';
                $view .= '<a href="top.php" id="backbtn">戻る</a>';

                echo $view;
        }




