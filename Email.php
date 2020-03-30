<?php

    class Email
    {
        /**
         * @var string The to email address.
         */
        public $to;
        /**
         * @var string The from email address.
         */
        public $from;
        /**
         * @var string Email message body.
         */
        public $message;
        /**
         * @var string Email subject.
         */
        public $subject;
        /**
         * @var array Collection of string to be converted to headers.
         */
        protected $headers = [];
        /**
         * @var array Collection of email addresses to CC the email to.
         */
        protected $cc = [];
        /**
         * @var array Collection of email addresses to BCC the email to.
         */
        protected $bcc = [];

        /**
         * Email constructor.
         *
         * @param string $message Body of email
         * @param string $to Email address of recipient.
         * @param string|null $subject Email subject line.
         * @param string|null $from Email address to use in From header.
         */
        public function __construct($message, $to, $subject = NULL, $from = NULL)
        {
            $this->to = $to;
            $this->message = $message;
            if (is_string($from)) {
                $this->from = $from;
            }
            if (is_string($subject)) {
                $this->subject = $subject;
            }
        }

        /**
         * @param bool $html Should the email be sent using HTML format?
         */
        public function send($html = TRUE)
        {
            if ($html) {
                // To send HTML mail, the Content-type header must be set
                $this->addHeader('MIME-Version: 1.0');
                $this->addHeader('Content-type: text/html; charset=iso-8859-1');
            }

            return mail($this->to, $this->subject, $this->message, $this->createHeaders());
        }

        /**
         * If a string is passed as an argument, it will be added to to the existing array of CC recipients.
         * If an is passed in, that array will be used and will overwrite any previously set values.
         *
         * @param string|array $emails
         */
        public function cc($emails)
        {
            if (is_array($emails)) {
                $this->cc = $emails;
            } else {
                array_push($this->cc, $emails);
            }
        }

        /**
         * If a string is passed as an argument, it will be added to to the existing array of BCC recipients.
         * If an is passed in, that array will be used and will overwrite any previously set values.
         *
         * @param string|array $emails
         */
        public function bcc($emails)
        {
            if (is_array($emails)) {
                $this->bcc = $emails;
            } else {
                array_push($this->bcc, $emails);
            }
        }

        /**
         * Adds a header string to the collection for later serialization.
         *
         * @param string $header
         */
        protected function addHeader($header)
        {
            array_push($this->headers, $header);
        }

        /**
         * Creates the headers in the expected format adding lines endings and separators.
         *
         * @return null|string
         */
        private function createHeaders()
        {
            if (empty($this->headers)) {
                return NULL;
            }
            if (is_string($this->from)) {
                $this->addHeader('From: ' . $this->from);
            }
            if (!empty($this->cc)) {
                $this->addHeader('Cc: ' . implode(',', $this->cc));
            }
            if (!empty($this->bcc)) {
                $this->addHeader('Bcc: ' . implode(',', $this->bcc));
            }

            return implode("\r\n", $this->headers);
        }
    }