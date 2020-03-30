<?php

    /**
     * Description of CURLRequest
     *
     * @author jeremy
     */
    class CURLRequest {
        public $curl;
        private $url;

        public function __construct($url = NULL, $options = NULL) {
            $this->url = $url;
            $this->init();
            if (is_array($options)) {
                foreach ($options as $opt => $value) {
                    curl_setopt($this->curl, $opt, $value);
                }
            }
        }

        public function execute() {
            return curl_exec($this->curl);
        }

        public function setOption($name, $value) {
            curl_setopt($this->curl, $name, $value);
        }

        public function setPostData($data) {
            curl_setopt($this->curl, CURLOPT_POSTFIELDS, http_build_query($data));
            curl_setopt($this->curl, CURLOPT_POST, 1);
        }

        public function setData($data) {
            curl_setopt($this->curl, CURLOPT_POSTFIELDS, $data);
            curl_setopt($this->curl, CURLOPT_POST, 1);
        }

        public function setUrl($url) {
            curl_setopt($this->curl, CURLOPT_URL, $url);
        }

        public function setMethod($method) {
            curl_setopt($this->curl, CURLOPT_CUSTOMREQUEST, $method);
        }

        public function getLastError() {
            return curl_error($this->curl);
        }

        public function getInfo() {
            return curl_getinfo($this->curl);
        }

        public function getCode() {
            $i = $this->getInfo();

            return $i['http_code'];
        }

        public function __destruct() {
            curl_close($this->curl);
        }

        private function init() {
            $this->curl = curl_init($this->url);
        }
    }

?>