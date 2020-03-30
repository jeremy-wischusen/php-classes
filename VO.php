<?php
    /**
     * VO Class Definition
     */

    class VO {
        protected $isValid = TRUE;
        private $privateOne = '';
        private $privateThree = FALSE;
        private $privateTwo = 0;
        protected static $propertyManager;
        protected $protectedOne = '';
        protected $protectedThree = FALSE;
        protected $protectedTwo = 0;
        public $publicOne = '';
        public $publicThree = TRUE;
        public $publicTwo = 0;
        protected $validationErrorMessages = [];

        public function __construct() {
            /**
             * By passing the instance of the VO to this anonymous class the for loop
             * used to set the properties does not have access to non-public properties
             * which is would have access to if the loop was in side the VO instance.
             * This prevents outside sources from passing in a value for variables that
             * should not be set externally.
             */
            self::$propertyManager = new class {
                public function setProperties(VO $vo, object $props) {
                    foreach ($vo as $k => $v) {
                        if (property_exists($props, $k)) {
                            $propsValue = $props->$k;
                            /*If the property is initialized to null, we allow it to be sett to anything*/
                            if ($vo->$k === NULL) {
                                $vo->$k = $propsValue;
                                continue;
                            }
                            $expectedType = gettype($vo->$k);
                            $propsType = gettype($propsValue);
                            if ($expectedType != $propsType) {
                                $class = get_class($vo);
                                $vo->addValidationErrorMessage(
                                    "Property $k of class $class expects type $expectedType. Got $propsType with value $propsValue."
                                );
                            } else {
                                if ($expectedType === 'boolean') {
                                    $vo->$k = $this->toBoolean($propsValue);
                                } elseif (is_string($propsValue)) {
                                    $vo->$k = trim($propsValue);
                                } else {
                                    $vo->$k = $propsValue;
                                }
                            }
                        }
                    }
                }

                private function toBoolean($value) {
                    if (is_bool($value)) {
                        return $value;
                    }
                    if (is_string($value)) {
                        $value = strtolower(trim($value));
                        if ($value === 'true') {
                            return TRUE;
                        }
                        if ($value === 'false') {
                            return FALSE;
                        }
                    }
                    if (is_numeric($value)) {
                        if ($value === 1) {
                            return TRUE;
                        }
                        if ($value === 0) {
                            return FALSE;
                        }
                    }

                    return NULL;
                }
            };
        }

        public function addValidationErrorMessage($message) {
            $this->isValid = FALSE;
            $this->validationErrorMessages[] = $message;
        }

        public function setData($props) {
            self::$propertyManager->setProperties($this, $props);
        }
    }