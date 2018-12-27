<?php
    include('funcs/funcs.php');
    class DB{
        function __construct(){
            $this->pdo = $this->db_con();
        }
        
        // テスト
        public function printEcho(){
            echo 'テスト';
        }

        // DB接続
        public function db_con(){
            $dbname = 'python';
            $id = 'root';
            $pw = '';
            try{
                $pdo = new PDO('mysql:dbname='.$dbname.';charset=utf8;host=localhost',$id,$pw);
            } catch (PDOException $e){
                exit('DbConnectError:'.$e->getMessage());
            }
            return $pdo;
        }

        // SELECT系
            // テーブルの全データを取得
            public function selectAllData($table){
                $stmt = $this->pdo->prepare("SELECT * FROM $table");
                $status = $stmt->execute();
                $resultArray = array();
                if($status === false){
                    queryError($stmt);
                } else {
                    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                //         if($result['id'] == true){
                    array_push($resultArray,$result);
                //         } else {
                //             var_dump('error');
                //         }
                }
                // print json_encode($resultArray,JSON_UNESCAPED_UNICODE);
                return $resultArray;
                // var_dump($resultArray);
            }

            // WHERE
            public function selectWhere($table,$where){
                $sql = "SELECT * FROM $table WHERE $where";
                $stmt = $this->pdo->prepare($sql);
                $result = $stmt->execute();
                if($result === false){
                    queryError($stmt);
                } else {
                    return $result = $stmt->fetch(PDO::FETCH_ASSOC);
                }
            }
            
            // 2テーブルの結合
            public function selectJoin($tableA, $tableB,$columA,$columB, $order){
                $sql = "SELECT * FROM $tableA INNER JOIN $tableB ON $tableA.$columA = $tableB.$columB ORDER BY $order DESC";
                $stmt = $this->pdo->prepare($sql);
                $result = $stmt->execute();
                $resultArray = array();
                if($result === false){
                    queryError($stmt);
                } else {
                    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    $resultArray[] = $result;
                }

                return $resultArray;
            }

            // 複数範囲でのテーブル検索
            public function selectBetween($table,$where,$bw1,$bw2){
                $sql = "SELECT * FROM $table WHERE id = $where AND age BETWEEN $bw1 AND $bw2";
                $stmt = $this->pdo->prepare($sql);
                $result = $stmt->execute();
                if($result === false){
                    queryError($statement);
                } else {
                    $result = $stmt->fetch(PDO::FETCH_ASSOC);
                }
                return $result;
            }

        // INSERT文
        public function insert($table,$column,$values){
            $sql = "INSERT INTO $table ($column) VALUES ($values)";
            $stmt = $this->pdo->prepare($sql);
            $result = $stmt->execute();
            if($result === false){
                queryError($stmt);
            }
        }

        // UPDATE文
        public function update($table,$column){
            $sql = "UPDATE $table SET $column";
            $stmt = $this->pdo->prepare($sql);
            $result = $stmt->execute();
            if($result === false){
                queryError($stmt);
            }
        }
    }




