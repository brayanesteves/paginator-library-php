<?php
    /**
     * Paginator version 0.0.1
     */
    class Paginator {
        /**
         * Data return paginator
         */
        private $_data;
        /**
         * Store data paginator
         */
        private $_pagination;

        public function __construct() {
            $this->_data      = array();
            $this->_paginator = array();
        }

        /**
         * @param $query {}
         * @param $page  {}
         * @param $limit {Account page}
         */
        public function paginate($query, $page = false, $limit = false) {
            if($limit && is_numeric($limit)) {
                $limit = $limit;
            } else {
                $limit = 10;
            }

            if($page && is_numeric($page)) {
                $page = $page;
                /**
                 * (page - 1) * limit
                 * Example:
                 * (2 - 1) * 10
                 * (1) * 10
                 * 10
                 */
                $init = ($page - 1) * $limit;
            } else {
                $page = 1;
                $init  = 0;
            }
            $result = mysqli_query(DB::connect(), $query);
            $record = mysqli_num_rows($result);
            $total   = ceil($record / $limit);
            $query  = $query . " LIMIT $init, $limit;";
            $result = mysqli_query(DB::connect(), $query);

            while($records = mysqli_fetch_assoc($result)) {
                $this->_data[] = $records;
            }

            $pagination            = array();
            $pagination['current'] = $page;
            $pagination['total']   = $total;

            /**
             * First & Previous
             */
            if($page > 1) {
                $pagination['first']    = 1;
                $pagination['previous'] = $page - 1;
            } else {
                $pagination['first']    = '';
                $pagination['previous'] = '';
            }

            /**
             * Last & Next
             */
            if($page < $total) {
                $pagination['last'] = $total;
                $pagination['next'] = $page + 1;
            } else {
                $pagination['last'] = '';
                $pagination['next'] = '';
            }

            $this->_pagination = $pagination;

            return $this->_data;
        }

        public function getPagination() {
            if($this->_pagination) {
                return $this->_pagination;
            } else {
                return false;
            }
        }

    }
?>