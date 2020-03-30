<?php
    /**
     * DAO Class Definition
     *
     */

    /**
     * Class DAO Abstract base class for data access objects.
     */
    class DAO {
        /**
         * @var DatabaseBaseBucket;
         */
        protected $db;

        /**
         * DAO constructor.
         * @param null $db DatabaseBaseBucket
         * @throws Exception
         */
        public function __construct(DatabaseBaseBucket $db = NULL) {
            if ($db) {
                $this->setDB($db);
            }
        }

        /**
         * @param $vo BaseVO
         * @return mixed
         */
        public function create($vo, $id = NULL, $opts = NULL) {
            if (is_string($id) && $id === '') {
                $id = NULL;
            }

            return $this->db->insert($vo, $id, $opts);
        }

        /**
         * Converts an array into a string usable in an SQL IN or USE KEYS query.
         * @param $array
         * @example [value1,value2,value3] would be converted to ['value1','value2','value3']
         */
        protected function createQuotedStringsArray($array) {
            return "['" . implode(
                    "','",
                    $array
                ) . "']";
        }

        /**
         * @param $id string
         * @return mixed
         */
        public function delete($ids, $opts = NULL) {
            return $this->db->remove($ids, $opts);
        }

        /**
         * @param $id string|array
         * @return mixed
         */
        public function get($id) {
            if (is_string($id) && $id === '') {
                return NULL;
            }

            return $this->db->get($id);
        }

        public function getAll(array $ids) {
            return $this->db->getAll($ids);
        }

        public function query($sql) {
            return $this->db->query($sql);
        }

        /**
         * @param $db DatabaseBaseBucket
         * @throws Exception
         */
        protected function setDB($db) {
            $this->db = $db;
        }

        /**
         * @param $vo BaseVO
         * @return mixed
         */
        public function update($vo, $id, $opts = NULL) {
            return $this->db->replace($vo, $id, $opts);
        }

        public function upsert($vo, $id = NULL, $opts = NULL) {
            if (is_string($id) && $id === '') {
                $id = NULL;
            }

            return $this->db->upsert($vo, $id, $opts);
        }
    }