<?php

    class DataGenerator {
        private static $booleanStrings = array(
            'true',
            'false'
        );
        private static $booleans = array(
            TRUE,
            FALSE
        );
        private static $captions = array(
            'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc sed luctus massa. Etiam finibus eget elit sit amet efficitur. Nullam malesuada libero et dignissim tempor. Etiam a libero vel enim pharetra tristique nec eget arcu. Nunc elementum tortor ipsum, vel tempor neque posuere eget. Nullam ac erat ex. Integer porta pulvinar tortor, lobortis facilisis lorem faucibus quis. Curabitur eget eleifend turpis. Fusce et tellus lacus.',
            'Mauris egestas eleifend mauris non pulvinar. Proin egestas lacus non massa interdum hendrerit. Sed tempor est tellus. Curabitur aliquet faucibus libero ac tempus. Donec orci magna, ullamcorper non mattis sed, malesuada auctor erat. Morbi vitae tortor id risus scelerisque venenatis. Nullam id nisl at orci malesuada sollicitudin. Integer eget odio scelerisque, tristique tortor a, accumsan nulla. Pellentesque finibus convallis enim, vitae laoreet urna sagittis efficitur. Etiam dapibus viverra viverra. Proin ac elementum neque. Nulla faucibus nulla nunc, at placerat magna convallis nec. Suspendisse rutrum tincidunt quam, et condimentum mauris maximus vitae. Cras euismod dui sapien, eget porttitor lorem fringilla quis.',
            'Quisque consequat sed nunc vitae vestibulum. Pellentesque cursus euismod condimentum. Mauris ut urna eros. Vivamus massa justo, rhoncus consequat convallis quis, dapibus eu eros. Nullam gravida ipsum eu tincidunt dignissim. Integer leo libero, interdum vitae quam quis, finibus posuere est. Suspendisse viverra urna vel ante egestas tincidunt. Morbi at tortor eu sapien semper aliquam. Sed quis risus ornare sapien facilisis sollicitudin. Vestibulum volutpat, lorem id tempor commodo, velit nunc congue massa, finibus eleifend eros nisl eget odio. Sed eros est, dictum vel eros nec, sodales rutrum est. In laoreet mattis enim vitae lobortis. Vivamus eros leo, sollicitudin sit amet euismod id, facilisis vitae nisl. Donec tempus, nunc a pretium viverra, metus ligula porta purus, sit amet fermentum tellus ipsum eu tortor. Nulla enim ex, feugiat at sagittis a, laoreet eget metus. Nam hendrerit molestie nibh ut faucibus.',
            'Suspendisse orci risus, fringilla ac placerat vitae, tincidunt a justo. Etiam eu lacus aliquet, gravida augue et, porta velit. Suspendisse potenti. Curabitur id metus ligula. Donec odio orci, congue vel felis id, venenatis congue libero. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Praesent purus tortor, lobortis nec leo ut, pellentesque feugiat purus. Aliquam erat volutpat. Nulla posuere turpis quis mi congue accumsan. Curabitur eu enim metus. Sed efficitur ut massa eget facilisis.',
            'Donec lacinia, elit sed dictum feugiat, enim eros iaculis nunc, volutpat tristique augue nisi vitae justo. Suspendisse potenti. Phasellus at ornare elit. Nunc sit amet vestibulum nunc, nec pharetra odio. Nam orci nisi, pharetra quis lectus non, elementum tristique felis. Sed vitae libero ac augue tincidunt pulvinar. Vestibulum bibendum eu lacus et finibus. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Curabitur nec tempus augue. Fusce eget vulputate felis. Nullam erat mauris, hendrerit eget massa eu, fermentum rutrum est. In consectetur fermentum consequat. Vestibulum vel velit egestas, auctor elit sodales, sollicitudin diam.'
        );
        private static $contactColorNames = array(
            'purple',
            'blue',
            'green',
            'red'
        );
        private static $contactMethodType = array(
            'work',
            'home'
        );
        private static $createLeadSources = array(
            "mobile",
            "web",
            "professional",
            "retail",
            "legacy"
        );
        private static $emailDomains = array(
            'gmail.com',
            'hotmail.com',
            'yahoo.com',
            'mail.com'
        );
        private static $firstNames = array(
            'Babette',
            'Ressie',
            'Modesta',
            'Dottie',
            'Myesha',
            'Lilia',
            'Alana',
            'Tandy',
            'Tashina',
            'Hobert',
            'Tari',
            'Margeret',
            'Edgar',
            'Ilana',
            'Lamonica',
            'Claudia',
            'Shandra',
            'Milly',
            'Meagan',
            'Jani',
            'Stella',
            'Gaye',
            'Lorina',
            'Amanda',
            'Hettie',
            'Lynelle',
            'Seymour',
            'Clarence',
            'Colin',
            'Anette',
            'Cristie',
            'Star',
            'Delsie',
            'Stormy',
            'Goldie',
            'Madie',
            'Catherin',
            'Shyla',
            'Boyce',
            'Ozie',
            'Soledad',
            'Galen',
            'Mandi',
            'Donella',
            'Shaina',
            'Rafael',
            'Garnet',
            'Cammie',
            'Chantay',
            'Kaycee'
        );
        private static $lastNames = array(
            'Mullikin',
            'Daffron',
            'Ruley',
            'Burkes',
            'Sealy',
            'Lacher',
            'Tran',
            'Dishman',
            'Yuan',
            'Etzel',
            'Enoch',
            'Correia',
            'Millington',
            'Lindblom',
            'Enders',
            'Stoops',
            'Thomasson',
            'Rodrique',
            'Accardo',
            'Pitman',
            'Mcgowin',
            'Rhode',
            'Gandara',
            'Peralto',
            'Oathout',
            'Stookey',
            'Leatham',
            'Plemons',
            'Ecker',
            'Kinzel',
            'Kirst',
            'Porto',
            'Gaither',
            'Unzueta',
            'Delisa',
            'Brashears',
            'Wrenn',
            'Dycus',
            'Pinheiro',
            'Wilke',
            'Russom',
            'Cardin',
            'Scala',
            'Burgher',
            'Sergeant',
            'Chadburn',
            'Deas',
            'Rivet',
            'Turnquist',
            'Riser'
        );
        private static $namePrefixes = array(
            'Mr',
            'Prof',
            'Mrs',
            'Dr',
            'Ms'
        );
        private static $phoneNumbers = array(
            "811-750-3975",
            "899-498-6695",
            "833-919-4514",
            "844-254-9878",
            "833-299-1643",
            "899-417-0127",
            "855-465-0804",
            "899-589-3679",
            "811-680-3334",
            "822-518-7469",
            "811-250-0540",
            "899-305-9757",
            "844-487-7225",
            "822-345-8048",
            "855-983-5236",
            "833-325-1736",
            "899-148-3641",
            "899-869-9172",
            "899-656-9935",
            "844-505-2313",
            "844-528-2692",
            "833-614-7978",
            "833-254-2895",
            "844-006-3208",
            "822-260-9635",
            "855-400-4780",
            "811-442-2476",
            "833-838-0378",
            "833-386-9111",
            "822-111-8018"
        );

        public static function boolean() {
            return self::getRandom(self::$booleans);
        }

        public static function booleanString() {
            return self::getRandom(self::$booleanStrings);
        }

        public static function caption() {
            $cap = self::getRandom(self::$captions);
            $words = explode(' ', $cap);
            $num = count($words);

            return implode(' ', array_slice($words, mt_rand(0, $num - 1), mt_rand(1, $num - 1)));
        }

        public static function contactColorCode() {
            return self::getRandom(self::$contactColorNames);
        }

        public static function contactMethodType() {
            return self::getRandom(self::$contactMethodType);
        }

        public static function createLeadSource() {
            return self::getRandom(self::$createLeadSources);
        }

        public static function email($userName = NULL) {
            $domain = '@' . self::getRandom(self::$emailDomains);
            if ($userName) {
                return $userName . $domain;
            }

            return time() . $domain;
        }

        public static function emailDomain() {
            return self::getRandom(self::$emailDomains);
        }

        public static function firstName() {
            return self::getRandom(self::$firstNames);
        }

        public static function fullName() {
            return self::getRandom(self::$firstNames) . ' ' . self::getRandom(self::$lastNames);
        }

        protected static function getRandom($collection) {
            return $collection[array_rand($collection)];
        }

        public static function id() {
            return (string)(uniqid(mt_rand(1, 1000), FALSE));
        }

        public static function lastName() {
            return self::getRandom(self::$lastNames);
        }

        public static function namePrefix() {
            return self::getRandom(self::$namePrefixes);
        }

        public static function password($length = 8, $strongEncrypt = FALSE) {
            $bytes = openssl_random_pseudo_bytes($length / 2, $strongEncrypt);
            if ($bytes !== FALSE) {
                return bin2hex($bytes);
            } else {
                $pass = array();
                for ($i = 0; $i < $length; $i++) {
                    $pass[] = chr(mt_rand(32, 126));
                }

                return implode($pass);
            }
        }

        public static function phoneNumber() {
            return (string)mt_rand(2000000000, 9999999999);
        }

        public static function randomAlphaNumericString($length) {
            return substr(base_convert(sha1(uniqid(mt_rand(), FALSE)), 16, 36), 0, $length);
        }

        public static function sessionID() {
            $rc = "EPT";
            $letters = "1234567890ABCDEFGHHIJKLMNOPQRSTUVWXYZ";
            for ($i = 0; $i < 29; $i++) {
                $r = (int)((mt_rand() * 100) % 35) + 1;
                $rc .= $letters{$r};
            }

            return $rc;
        }

        public static function timeStamp() {
            return time() * 1000;
        }

        /**
         * @return AddressVO
         */
        public static function validAddress($primary = FALSE) {
            $vo = new AddressVO();
            $vo->street = '100 50TH ST SW';
            $vo->apt = 'APT 125';
            $vo->city = 'Grand Rapids';
            $vo->state = 'MI';
            $vo->zip = '49548';
            $vo->primary = $primary;

            return $vo;
        }

        /**
         * @return AddressVO
         */
        public static function validAddressZipOnly($primary = FALSE) {
            $vo = new AddressVO();
            $vo->street = '100 50TH ST SW';
            $vo->apt = 'APT 125';
            $vo->city = '';
            $vo->state = '';
            $vo->zip = '49548';
            $vo->primary = $primary;

            return $vo;
        }

        /**
         * @return E911LocationVO
         */
        public static function validE911Location() {
            $avo = self::validAddress();
            $evo = new E911LocationVO();
            $evo->firstName = 'Roger';
            $evo->lastName = 'Stanley';
            $evo->phoneNumber = (string)self::phoneNumber();
            $evo->address = $avo->street;
            $evo->address2 = $avo->apt;
            $evo->city = $avo->city;
            $evo->state = $avo->state;
            $evo->zip = $avo->zip;

            return $evo;
        }

        public static function voicemailPassword() {
            $pw = '';
            for ($i = 0; $i < 4; $i++) {
                $pw .= mt_rand(0, 9);
            }

            return $pw;
        }
    }