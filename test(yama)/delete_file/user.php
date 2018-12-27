<?php
    session_start();

    // 関数読み込み
    include('funcs/funcs.php');
    chkSsid();

    //クリックジャッキング対策
    header('X-FRAME-OPTIONS: SAMEORIGIN');

    $user = $_SESSION['compare'];
    $ageStart = $_POST['ageS'];
    $ageEnd = $_POST['ageE'];
    // var_dump($_SESSION['cid']);
    // exit();
    // var_dump($user);

    // DB接続
    $pdo = db_con();
    $users = [];
    foreach($user as $div){
        $user_id = $div['id'];
        $stmt = $pdo->prepare("SELECT * FROM wear_user WHERE id = $user_id AND age BETWEEN $ageStart AND $ageEnd");
        $result = $stmt->execute();
        if($result === false){
            queryError($statement);
        } else {
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            array_push($users,$result);
        }
    }

    // var_dump($users);
    // HTMLへの記載
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
    foreach($users as $list){
        $view .= '<tr>';
            $view .= '<th class="u_id"><a id="look" disabled style="color:blue;text-decoration:underline">'.$list['id'].'</a></th>';
            $view .= '<th class="u_name">'.$list['name'].'</th>';
            $view .= '<th class="u_age">'.$list['age'].'</th>';
            $view .= '<th class="u_tall">'.$list['tall'].'</th>';
            $view .= '<th class"=u_follow">'.$list['follower'].'</th>';
            $view .= '<th class="u_cordinate">'.$list['cordinate'].'</th>';
            $view .= '<th class"=u_power">'.$list['power'].'</th>';
            $view .= '<th class="u_influence">'.$list['influence'].'</th>';
        $view .= '</tr>';
    }
    $view .= '</table>';
    $view .= '</div>';
    $view .= '<a href="top.php" id="backbtn">戻る</a>';

    echo $view;


