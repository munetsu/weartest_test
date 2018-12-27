<?php
    include('db_class.php');

    class RECOMMEND{
        function __construct(){
            $this->db = new DB;
            $this->recommend();
        }

        // 企業ログイン時にレコメンド対象のユーザーを検出
        public function recommend(){
            // ログインユーザーのID取得
            $cid = $_SESSION['cid']; //企業id
            $name = $_SESSION['name']; //企業名
            $casual = $_SESSION['casual']; //ブランド軸(casual)
            $girly = $_SESSION['girly']; //ブランド軸(girly)

            // ユーザー毎との相関を入れる空配列
            $array = [];

            // DBクラスから読み出し
            $result = $this->db->selectJoin('wear_user','bland_matrix','bland2','bland_name','power');
            $result = $result[0];
            foreach($result as $res){
                // 相関数値を算出
                // casual
                $casual_int = $res['casual']; //X軸と仮定
                $girly_int = $res['girly']; //Y軸と仮定

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

                // // 距離が30以内のもののみを配列に追加する
                if($comp <= 30){
                    // 角度の算出
                    $katamuki = $girly_int / $casual_int; //m2
                    $katamuki2 = $girly / $casual; //m1
                    $tan = abs(($katamuki2 - $katamuki) / 1+ $katamuki2*$katamuki);
                    // 参考サイト：https://sci-pursuit.com/math/trigonometric-function-table.html
                    // 30度以内でのユーザーを検出
                    if($tan < 0.55431){
                        $array_temp = ['id' =>$res['id'], 'compare' => $tan];
                        array_push($array,$array_temp);
                    }                
                }
            }
            // セッションに入れる
            $_SESSION['compare'] = $array;
        }

    }
    $recommend = new RECOMMEND;