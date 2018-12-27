<?php
    // include('funcs/funcs.php');
    include('db_class.php');

    class USER{
        function __construct(){
            $this->db = new DB();
        }

        public function searchUser($table){
            echo $this->db->selectAllData($table);
        }


    }

    $user = new USER;
    $user->searchUser('wear_user');
    // echo 'テストユーザー';