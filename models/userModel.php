<?php
    class userModel {
        public function insertFakeData($account) {
            for($i = 0; $i < $account; $i++) {
                mysql_query("INSERT INTO `0_Usrs` VALUES(NULL, 'Username_$i', MD5(1234$i), 1, 1, 1, 0, 0, '0001-01-01', '00:00:00');");
            }
        }        
    }
?>