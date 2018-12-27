<?php
    include('company_class.php');
    class VIEW{
        function __construct(){
            $this->CP = new COMPANY;

        }

        // 企業がユーザー検索した場合の処理
        public function companySearchUserList($array){
            $users = $this->CP->userListSearch($array);
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
        }

        // 企業がリストから1ユーザーを選択した場合
        public function CompanySelectUser($uid){
            $user = $this->CP->userSearch($uid);
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
                    $view .= '<th class="u_id"><a id="look" disabled style="color:blue;text-decoration:underline">'.$user['id'].'</a></th>';
                    $view .= '<th class="u_name">'.$user['name'].'</th>';
                    $view .= '<th class="u_age">'.$user['age'].'</th>';
                    $view .= '<th class="u_tall">'.$user['tall'].'</th>';
                    $view .= '<th class"=u_follow">'.$user['follower'].'</th>';
                    $view .= '<th class="u_cordinate">'.$user['cordinate'].'</th>';
                    $view .= '<th class"=u_power">'.$user['power'].'</th>';
                    $view .= '<th class="u_influence">'.$user['influence'].'</th>';
                $view .= '</tr>';
                $view .= '</table>';
                $view .= '</div>';
                $view .= '<a disabled id="offer" class="'.$user['id'].'" style="color:blue;text-decoration:underline">オファーする</a><br>';
                $view .= '<a href="top.php" id="backbtn">戻る</a>';

            echo $view;
        }
    }
