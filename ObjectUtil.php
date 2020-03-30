<?php

    /**
     * User: Jeremy Wischusen
     */
    class ObjectUtil {
        /**
         * Compare the objects and return an object with the properties that are different.
         * @param $old object
         * @param $new object
         * @return stdClass
         */
        public static function diff($old, $new) {
            if (!$old && $new) {
                $diff = $new;
            } elseif ($old && !$new) {
                $diff = $old;
            } elseif (is_array($old)) {
                $diff = [];
                if (is_array($new)) {
                    foreach ($old as $k => $v) {
                        $d = self::diff($v, $new[$k]);
                        if ($d) {
                            $diff[$k] = $d;
                        }
                    }
                }
            } else {
                $diff = new stdClass();
                foreach ($old as $k => $v) {
                    $aProp = $old->$k;
                    if (is_object($aProp) || is_array($aProp)) {
                        $d = self::diff($aProp, $new->$k);
                        if ($d) {
                            $diff->$k = $d;
                        }
                    } else {
                        $bProp = $new->$k;
                        if ($aProp !== $bProp) {
                            $diff->$k = $bProp;
                        }
                    }
                }
            }
            if (count((array)$diff)) {
                return $diff;
            }

            return NULL;
        }

        public static function isEmpty($obj) {
            $o = (array)$obj;
            $e = empty($o);

            return $e;
        }
    }