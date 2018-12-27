<?php
    include('view_class.php');
    
    class AJAX{
        function __construct(){
            $this->POST = $_POST['action'];
            $this->judge();
        }

        // Ajaxごとの区分け
        public function judge(){
            // 企業→ユーザー検索Ajax処理
            if($this->POST == 'get_user_list_from_company'){
                $array = array();
                $array[] = $_POST['ageS'];
                $array[] = $_POST['ageE'];
    
                $this->view = new VIEW;
                return $this->view->companySearchUserList($array);
            }

            // 企業→1ユーザー選択したAjax処理
            if($this->POST == 'user_describe'){
                $uid = $_POST['id'];
                $this->view = new VIEW;
                return $this->view->CompanySelectUser($uid);
            }

            // 企業がユーザーにオファーしたAjax処理
            if($this->POST == 'offer_from_company'){
                $uid = $_POST['id'];
                $this->com = new COMPANY;
                return $this->com->offerFromCom($uid);
            }

        }
    }

    $ajax = new AJAX;
