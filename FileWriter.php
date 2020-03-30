<?php

    /**
     * Class FileWriter
     */
    class FileWriter {
        private $content = [];
        private $file;
        private $mode = 'w';

        public function __construct($file, $mode = NULL) {
            $this->file = $file;
            if (is_string($mode)) {
                $this->mode = $mode;
            }
        }

        /**
         * Content is stored internally in an array buffer until write is called.
         * @param $content string|array
         */
        public function addContent($content) {
            $this->content[] = $content;
        }

        public function fileExists() {
            return file_exists($this->file);
        }

        /**
         * Writes the content stored in the array buffer to the file specified in the constructor.
         * If the buffer is empty no write attempt will be made.
         */
        public function write() {
            if (!empty($this->content)) {
                return file_put_contents($this->file, json_encode($this->content));
            }
        }
    }