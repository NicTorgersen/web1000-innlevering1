<?php
    class Register {
        private $_file,
                $_fields = array();

        public function __construct ($file, array $fields) {
            if (empty($file) || sizeof($fields) < 1)
                return new Exception('Needs file or fields...');
            $this->_file = $file;

            foreach ($fields as $key => $value) {
                $this->_fields[$key] = htmlspecialchars(trim($value));
            }
        }

        public function __destruct () {
            unset($this->_fields);
            unset($this->_file);
        }

        public function insert () {
            if ($this->_file = fopen($this->_file, 'a')) {
                fwrite($this->_file, $this->makeString($this->_fields) . PHP_EOL);
                fclose($this->_file);

                return 'Registrert.';
            } else {
                throw new Exception('File could not be opened...');
            }
        }

        private function makeString (array $array) {
            return implode(';', $array);
        }
    }