<?php
    /**
     * User: Jeremy Wischusen
     *
     * This class will eventually replace the manager base class.
     *
     * This class is meant to be extended by classes that manage access to a single Couchbase bucket.
     */

    use Couchbase\Bucket;

    /**
     * Class CouchBaseBucket
     * Base class for bucket classes.
     */
    class DatabaseBaseBucket {
        /**
         * The name of bucket this instance will interact with.
         * @var string
         */
        protected $bucket;
        /**
         * @var CouchbaseDatabase
         */
        protected $db;

        /**
         * CouchBaseBucket constructor.
         * @param string $bucket
         * @param CouchbaseDatabase $db
         */
        public function __construct($bucket, $db) {
            $this->db = $db;
            $this->bucket = $bucket;
            $db->openBucket($bucket);
        }

        /**
         * Gets a document by id.
         *
         * @param string|array $id The id(s) of the document(s) to be retrieved.
         *
         * @return mixed|stdClass
         * @throws Exception
         */
        public function get($id, $bucket = NULL) {
            if (!$bucket) {
                $bucket = $this->bucket;
            }

            return $this->db->get($bucket, $id);
        }

        /**
         * @param $ids array The document IDs to retrieve.
         * @return array|mixed
         * @throws Exception
         */
        public function getAll($ids) {
            return $this->db->getAll($this->bucket, $ids);
        }

        /**
         * Get a direct reference to a Couchbase Bucket.
         * @param string $bucket
         * @return Bucket
         */
        public function getBucket(string $bucket) {
            return $this->db->getBucket($bucket);
        }

        public function getDocumentWhere($sql) {
            return $this->db->getDocumentWhere($this->bucket, $sql);
        }

        public function getURL() {
            return $this->db->getURL();
        }

        /**
         * Creates a document.
         *
         * @param string $id The id of the document to be created.
         *
         * @param $data object Document data.
         */
        public function insert($data, $id = NULL, $options = NULL) {
            return $this->db->insert($this->bucket, $data, $id, $options);
        }

        public function isBucketSet() {
            return NULL === $this->bucket;
        }

        /**
         * @param $sql string - This is converted to an CouchbaseN1qlQuery.
         * @return mixed
         */
        public function query($sql, $bucket = NULL) {
            if (!$bucket) {
                $bucket = $this->bucket;
            }

            return $this->db->query($bucket, $sql);
        }

        /**
         * Remove the documents with the specified id(s).
         * @param $id string|array
         * @param null $options
         * @return mixed
         * @throws Exception
         */
        public function remove($id, $options = NULL) {
            return $this->db->remove($this->bucket, $id, $options);
        }

        /**
         * Replaces a document.
         *
         * @param string $id The id of the document to be retrieved.
         *
         * @param $data object Document data.
         */
        public function replace($data, $id, $options = NULL) {
            return $this->db->replace($this->bucket, $data, $id, $options);
        }

        /**
         * Replaces a document.
         *
         * @param string $id The id of the document to be retrieved.
         *
         * @param $data object Document data.
         */
        public function upsert($data, $id = NULL, $options = NULL) {
            return $this->db->upsert($this->bucket, $data, $id, $options);
        }

        /**
         * Performs a Couchbase View Query
         *
         * @param $viewQuery CouchbaseViewQuery
         * @deprecated This will not be possible in CouchBase 5 as views have been removed.
         *
         */
        public function viewQuery($viewQuery) {
            return $this->db->viewQuery($this->bucket, $viewQuery);
        }
    }