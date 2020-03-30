<?php

    /**
     * DateTimeUtil.php
     */
    class DateTimeUtil {
        /**
         * Converts a HTML5 date string to a millisecond timestamp.
         * @param $date string HTML 5 Formatted date yyyy-mm-dd
         */
        public static function HTML5DateToTimeStamp($date) {
            return strtotime($date) * 1000;
        }

        /**
         * Strip everything but the digits from the date.
         * @param $date string Date
         */
        protected static function cleanDate($date) {
            return preg_replace('/[\D]/', '', $date);
        }

        public static function dateTimestampToMilliseconds(DateTime $d) {
            return $d->getTimestamp() * 1000;
        }

        /**
         * Converts a date string to a millisecond time stamp.
         *
         * @param $date
         * @return false|int
         */
        public static function dateToTimestamp($date) {
            return strtotime($date) * 1000;
        }

        /**
         * Returns a millisecond timestamp for the specified number of days in the future.
         * @param $days Number Number of days in the future.
         * @return false|int
         */
        public static function daysFromNow($days) {
            return self::microToMilliseconds(strtotime('+' . $days . ' days'));
        }
        /**
         * Returns a millisecond timestamp for the specified number of days in the past.
         * @param $days Number Number of days in the past.
         * @return false|int
         */
        public static function daysAgo($days) {
            return self::microToMilliseconds(strtotime('-' . $days . ' days'));
        }
        /**
         * Returns a millisecond timestamp for the specified number of years in the future.
         * @param $years Number Number of years in the future.
         * @return false|int
         */
        public static function yearsFromNow($years) {
            return self::microToMilliseconds(strtotime('+' . $years . ' days'));
        }
        /**
         * Returns a millisecond timestamp for the specified number of years in the past.
         * @param $years Number Number of years in the past.
         * @return false|int
         */
        public static function yearsAgo($years) {
            return self::microToMilliseconds(strtotime('-' . $years . ' days'));
        }

        /**
         * @param $date string Date
         * @param string $delimiter string Default /. Return the formatted date using this as the separator. E.g,
         *     04.09.1977 becomes 04/09/1977.
         */
        public static function formatDateString($date, $delimiter = '/') {
            $parts = self::getDateParts($date, TRUE);

            return implode($delimiter, $parts);
        }

        /**
         *
         * Strip the input string of any delimiters and parse it into month day and year parts.
         *
         * @param $date string Date
         * @param bool $cleanFirst Clean up the date string removing all non-numeric characters.
         * @return array
         */
        public static function getDateParts($date, $cleanFirst = FALSE) {
            if ($cleanFirst) {
                $date = self::cleanDate($date);
            }
            $parts = [];
            $parts['month'] = substr($date, 0, 2);
            $parts['day'] = substr($date, 2, 2);
            $parts['year'] = substr($date, 4, 4);

            return $parts;
        }

        /**
         * @param $dob
         * @param $age
         * @return bool
         */
        public static function isOlderThan($dob, $age) {
            /*
             * Convert strings to timestamps. Otherwise assume a timestamp was passed in.
             */
            if (is_string($dob)) {
                $dob = strtotime($dob) * 1000;
            }
            /*
             * If the string was converted above or a timestamp was passed in the value should be numeric.
             * This check prevents things like booleans being passed in for the dob and producing a positive result.
             */
            if (!is_numeric($dob)) {
                return FALSE;
            }
            $min = strtotime('+' . $age . ' years', self::toMicroSeconds($dob));
            $now = time();
            $older = ($now > $min);

            return $older;
        }

        /**
         *
         * Clean up and parse the date string to make sure it is a valid date as defined by:
         * http://php.net/manual/en/function.checkdate.php
         *
         * @param $date string Date
         * @return bool|string
         */
        public static function isValidDate($date, $fullYearRequired = TRUE) {
            $date = self::cleanDate($date);
            $dateLength = strlen($date);
            if ($fullYearRequired) {
                if ($dateLength !== 8) {
                    return 'Invalid date. Date must be in mm/dd/yyyy format separated by forward slashes (/), decimals (.) or dashes (-).';
                }
            } elseif ($dateLength !== 6) {
                return 'Invalid date. Date must be in mm/dd/yy format separated by forward slashes (/), decimals (.) or dashes (-).';
            }
            $parts = self::getDateParts($date);

            return checkdate($parts['month'], $parts['day'], $parts['year']);
        }

        public static function microToMilliseconds($micro) {
            return $micro * 1000;
        }

        /**
         * Equivalent to JavScript new Date().getTime().
         * JavaScript works in milliseconds while php time() returns seconds.
         * This function converts the time() output to milliseconds.
         *
         */
        public static function timeStampMilliseconds() {
            return time() * 1000;
        }

        /**
         * Converts JS milliseconds timestamp to a formatted date using separator. E.g., 04/09/1977
         *
         * @param $time int Millisecond timestamp.
         * @param string $delimiter string Default /. Return the formatted date using this as the separator.
         * @return float|int
         */
        public static function timeStampToDate($time, $delimiter = '/') {
            $time = $time / 1000;
            $date = getdate($time);
            $result = [];
            $result['m'] = $date['mon'];
            $result['d'] = $date['mday'];
            $result['y'] = $date['year'];

            return implode($delimiter, $result);
        }

        /**
         * Converts JS milliseconds timestamp to an array containing the month, day and year, hours, minutes and
         * seconds.
         *
         * @param $time int Millisecond timestamp.
         * @return array Contains the individual date parts as an associative array: month,day,year,hours,
         *     minutes,seconds
         */
        public static function timeStampToDateParts($time) {
            $time = $time / 1000;
            $date = getdate($time);
            $result = [];
            $result['month'] = $date['mon'];
            $result['day'] = $date['mday'];
            $result['year'] = $date['year'];
            $result['hours'] = $date['hours'];
            $result['minutes'] = $date['minutes'];
            $result['seconds'] = $date['seconds'];

            return $result;
        }

        /**
         * Converts JS milliseconds HTML5 date format. See HTML5 Specification RFC 3339 - IETF.
         *
         * @param $time int Millisecond timestamp.
         * @return string HTML 5 Formatted date yyyy-mm-dd
         */
        public static function timeStampToHTML5Date($time) {
            $time = $time / 1000;
            $date = getdate($time);
            $result = [];
            $result['year'] = $date['year'];
            $m = $date['mon'];
            if ($m < 10) {
                $m = '0' . $m;
            }
            $result['month'] = $m;
            $d = $date['mday'];
            if ($d < 10) {
                $d = '0' . $d;
            }
            $result['day'] = $d;

            return implode("-", $result);
        }

        /**
         * Converts JS milliseconds timestamp to micro seconds.
         *
         * @param $time Millisecond timestamp.
         * @return float|int
         */
        public static function toMicroSeconds($time) {
            return round($time / 1000);
        }
    }