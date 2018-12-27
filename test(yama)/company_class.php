<?php
    session_start();
    // DBクラス読み込み
    include('db_class.php');
    //クリックジャッキング対策
    header('X-FRAME-OPTIONS: SAMEORIGIN');

    class COMPANY{
        function __construct(){
            $this->db = new DB;
        }

        // ユーザー検索
        public function userListSearch($array){
            
            $ageStart = $array[0];
            $ageEnd = $array[1];
            $users = $_SESSION['compare']; //recommend_class
            $result = array();
            foreach($users as $user){
                $user_id = $user['id'];
                // DBクラスのインスタンス化
                $res =$this->db->selectBetween('wear_user',$user_id,$ageStart,$ageEnd);
                $result[] = $res;
            }
            return $result;
        }

        // 1ユーザー表示
        public function userSearch($uid){

            $cid = $_SESSION['cid'];
            
            // 検索条件
            $where = 'id = '.$uid.'';
            $user = $this->db->selectWhere('wear_user',$where);
            return $user;
        }

        // ユーザーへのオファー処理
        public function offerFromCom($uid){
            $cid = $_SESSION['cid'];
            // 検索条件
            $where = "user_id = ".$uid." AND company_id = ".$cid."";
            $offer = $this->db->selectWhere('matching',$where);
            $flag = $offer['flag'];
            if($offer === false){
                // insertの変数
                $column = 'user_id, company_id, flag';
                $values = $uid.','.$cid.',1';
                $this->db->insert('matching',$column,$values);

            } else if($flag == 1){
                // UPDATEの変数
                $view = '';
                $view .= '<p>オファー済みです</p>';
                $view .= '<a href="top.php">戻る</a>';
                echo $view;
                exit(); 
            }
            $view = '';
            $view .= '<p>オファー完了しました</p>';
            $view .= '<a href="top.php">戻る</a>';

            echo $view;
        }

    } 
    $company = new COMPANY;








            // // 企業ログイン
        // public function login(){
        //     $name = h($_POST['name']);
        //     // データが空だった場合
        //     if(empty($_POST)) {
        //         header("Location: login.php");
        //         exit();
        //     } else {
        //         $result = $this->db->selectAllData('bland_matrix');
        //         $result = $result[0];
        //         // $returnArray = array();

        //         foreach($result as $res){
        //             if($res['bland_name'] == $name){
        //                 // $returnArray[] = $res['bland_id'];
        //                 // $returnArray[] = $res['bland_name'];
        //                 // $returnArray[] = $res['casual'];
        //                 // $returnArray[] = $res['girly'];
        //                 $_SESSION['cid'] = $res['bland_id'];
        //                 $_SESSION['name'] = $res['bland_name'];
        //                 $_SESSION['casual'] = $res['casual'];
        //                 $_SESSION['girly'] = $res['girly'];
        //                 header('Location: top.php');
        //                 break;
        //                 exit();
        //             }
        //           }
        //     }
        // }
