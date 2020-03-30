<?php

    use Couchbase\Bucket;
    use Couchbase\PasswordAuthenticator;

    /**
     * Class CouchbaseDatabase
     * Build for 2.6 version of PHP SDK.
     * This class assumes you are using user based authentication.
     * If you are using an older version of couchbase, you will need to
     * modify the contructor to use the older bucket based password syntax.
     */
    class CouchbaseDatabase {
        /**
         * @var Bucket
         */
        private $bucket;
        /**
         * @var CouchbaseCluster
         */
        private $db;

        /**
         * CouchbaseDatabase constructor.
         * @param string $url Couchbase server url e.g., couchbase://localhost
         * @param string $userName Couchbase user name.
         * @param string $password Couchbase user password.
         * @param string|NULL $bucketName Name of the bucket to open if desired. Buckets can be open after construction
         *     using the openBucket method.
         * @throws Exception If url, username or password are not provided, this exception will be thrown.
         */
        public function __construct(string $url, string $userName, string $password, string $bucketName = NULL) {
            if ($url !== '' && $userName !== '' && $password !== '') {
                $authenticator = new PasswordAuthenticator();
                $authenticator->username($userName)->password($password);
                $this->db = new CouchbaseCluster(
                    $url
                );
                $this->db->authenticate($authenticator);
                if ($bucketName) {
                    $this->openBucket($bucketName);
                }
            } else {
                throw new Exception(
                    'You must provide a url, user name and password to connect to the database.', 600
                );
            }
        }

        /**
         * Used to generate unique IDs for inserting items into the database.
         *
         * @return string
         */
        protected static function createID() {
            return (string)(uniqid(mt_rand(1, 1000), FALSE));
        }

        /**
         * PHP does timestamps in microseconds while many clients such as JavaScript use milliseconds.
         * Use this function when you need a timestamp to maintain consistency.
         *
         * @return int Millisecond timestamp
         */
        public static function createTimeStamp() {
            return time() * 1000;
        }

        /**
         * Perform a bucket get operation.
         *
         * @param string|array $id The id(s) of the document(s) to be retrieved.
         *
         * @param bool $full By default this function returns the value property of the document.
         * If this parameter is set to true, the full document object will bre returned instead of just the value
         *     property.
         *
         * @return mixed|stdClass
         */
        public function get($ids, $full = FALSE) {
            try {
                if (!is_array($id)) {
                    $id = (string)$id;
                }
                $doc = $this->bucket->get($ids);
                if ($full) {
                    return $doc;
                }
                if (is_string($doc->value)) {
                    return json_decode($doc->value);
                }
                /*If multiple IDs were passed in, we get back multiple docs. Return them as an array.*/
                if (is_array($doc)) {
                    $vals = [];
                    foreach ($doc as $d) {
                        if ($d->value) {
                            $vals[] = $d->value;
                        }
                    }

                    return $vals;
                }

                return $doc->value;
            } catch (Exception $e) {
                //this is the key is not found on the server error. just return null;
                if ($e->getCode() === 13) {
                    return NULL;
                } else {
                    throw $e;
                }
            }
        }

        /**
         * Return the currently open bucket
         * or opens a bucket if the name parameters is provided
         * and returns that bucket the reference to the bucket from the internal hash map.
         * @param string $name Name of the bucket to get. If not provided the currently open bucket will be returned.
         *
         * @return Bucket
         */
        public function getBucket(string $name = NULL) {
            if ($name) {
                return $this->db->openBucket($name);
            }

            return $this->bucket;
        }

        /**
         * Performs a bucket insert operation.
         *
         * @param $data object
         *
         * @param null $id String to act as the key for the record. If one is not provided, it is auto-generated using
         *     the createID function.
         *
         * @param null|array $options expiry(integer), persist_to(integer), replicate_to(integer)
         * @return mixed If the insert is successful, the id of the inserted document is returned.
         */
        public function insert($data, string $id = NULL, $options = NULL) {
            if (empty($id)) {
                $id = self::createID();
            }
            if (is_array($options)) {
                $result = $this->bucket->insert($id, $data, $options);
            } else {
                $result = $this->bucket->insert($id, $data);
            }

            return $id;
        }

        /**
         * @param string $bucketName Name of the bucket to open.
         */
        public function openBucket(string $bucketName) {
            $this->bucket = $this->db->openBucket($bucketName);
        }

        /**
         * Perform an N1QL query on the specified bucket.
         * Make sure you have the appropriate indexes created for the bucket.
         *
         * @param $sql string
         * @param bool $full By default only the rows property is returned.
         * If this flag is set to true, the full object returned by the query will be returned instead.
         *
         * @return mixed
         */
        public function query($sql, $full = FALSE) {
            $data = $this->bucket->query(CouchbaseN1qlQuery::fromString($sql));
            if ($full) {
                return $data;
            }

            return $data->rows;
        }

        /**
         * Performs a bucket delete operation.
         *
         * @param string|array $ids The id(s) of the document(s) to be deleted.
         *
         * @return mixed
         */
        public function remove($ids, $options = NULL) {
            try {
                if (!is_array($ids)) {
                    $ids = (string)$ids;
                }
                if (is_array($options)) {
                    $result = $this->bucket->remove($ids, $options);
                } else {
                    $result = $this->bucket->remove($ids);
                }

                return $result;
            } catch (Exception $e) {
                //this is the key is not found on the server error. just return null;
                if ($e->getCode() === 13) {
                    return FALSE;
                } else {
                    throw $e;
                }
            }
        }

        /**
         * Performs a bucket replace operation.
         *
         * @param $data object Document data.
         * @param string $id The id of the document to be updated.
         *
         * @param $options array Bucket options.
         *
         * @return mixed
         */
        public function replace($data, string $id, $options = NULL) {
            if (is_array($options)) {
                $result = $this->bucket->replace($id, $data, $options);
            } else {
                $result = $this->bucket->replace($id, $data);
            }

            return $result;
        }

        /**
         * Performs a bucket update operation.
         *
         * @param $data object Document data.
         * @param string $id The id of the document to be updated.
         *
         * @param $options array Bucket options.
         *
         * @return mixed If the upsert is successful, the id will be returned,
         * otherwise, the result of the operation is returned.
         */
        public function upsert($data, string $id = NULL, $options = NULL) {
            if (empty($id)) {
                $id = self::createID();
            }
            if (is_array($options)) {
                $result = $this->bucket->upsert($id, $data, $options);
            } else {
                $result = $this->bucket->upsert($id, $data);
            }
            if ($result) {
                return $id;
            }

            return $result;
        }
    }