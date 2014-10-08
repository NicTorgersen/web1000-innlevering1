<?php
    // Class View
    class View {
        private $_items = array(),
                $_files = array();

        public function __construct (array $files) {
            foreach ($files as $file => $filename) {
                // Åpne nåværende fil, og legg til under filnavn i filarrayen
                if (!file_exists($filename)) {
                    throw new Exception("File  doesn't exist.");
                }
                $this->_files[$file] = fopen($filename, 'r');
                // Del hver linje i tekstfilen på newline (\n)
                $fields = explode("\n", fread($this->_files[$file], filesize($files[$file])));
                // Går igjennom hver linje,
                // Eksploderer verdien, som i dette tilfellet er delt opp ved hjelp av semikolon
                foreach ($fields as $key => $value) {
                    $values = explode(";", $value);

                    if (!empty($value)) {

                        foreach ($values as $studentKey => &$studentValue) {
                            $studentValue = trim($studentValue);
                        }
                        // Legger til hver array under riktig filnavn i items arrayen
                        $this->_items[$file][$key] = $values;
                    }
                }
            }
        }

        public function __destruct () {
            foreach ($this->_files as $file => $filename) {
                // Lukker alle åpne filhåndtører
                $this->_files[$file] = fclose($this->_files[$file]);
            }
        }

        // Returnerer alle elementer
        public function displayAll () {
            return $this->_items;
        }

        // Returnerer hver student på et søkeord
        public function displayBy ($toDisplayBy) {
            // Sanitèrer input fra input felt i html
            $toDisplayBy = htmlspecialchars($toDisplayBy);
            // Holder alle objekter som er funnet
            $found = array();
            foreach ($this->_items as $itemKey => $arr) {
                // Sjekker topparrayen
                // for stringen student, som sier at denne inneholder studenter
                if ($itemKey == 'student') {
                    // Loop igjennom $arr
                    foreach ($arr as $arrKey => $valArr) {
                        // Looper igjennom hver student
                        // Sjekker alle verdier for søkeordet
                        foreach ($valArr as $value) {
                            // For å sortere på klassekode
                            // && $valKey == 3
                            if (strtolower($value) == strtolower($toDisplayBy)) {
                                $found[$arrKey] = $valArr;
                            }
                        }
                    }
                }
            }
            return $found;
        }
    }