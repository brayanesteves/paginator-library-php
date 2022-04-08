<?php
    class DB {
        public static function connect() {
            if(!$link = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME)) {
                die('Error connect server');
            }

            if(!mysqli_select_db($link, DB_NAME)) {
                die('Error select data base');
            }

            return $link;
        }
    }
?>