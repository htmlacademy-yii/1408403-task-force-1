<?php

    declare(strict_types = 1);

    namespace htmlacademy\utils;

    use htmlacademy\ex\FileFormatException;
    use htmlacademy\ex\SourceFileException;
    use SplFileObject;

    class FileExport
    {
        protected $fileName;
        protected $dataCols;
        protected $file;
        protected $result = [];

        public function __construct($fileName, $dataCols)
        {
            $this->fileName = $fileName;
            $this->dataCols = $dataCols;
        }

        public function getData() : array
        {
            return $this->result;
        }

        public function import() : void
        {
            if (!$this->validateColumns($this->dataCols)) {
                throw new FileFormatException("Not valid header columns");
            }

            if (!file_exists($this->fileName)) {
                throw new SourceFileException("No such file or directory");
            }
            $this->file = new SplFileObject($this->fileName, 'r');
            $this->file->setFlags(SplFileObject::READ_AHEAD);
            $this->file->setFlags(SplFileObject::SKIP_EMPTY);

            $header_data = $this->getColumnTitle();
            if ($header_data !== $this->dataCols) {
                throw new FileFormatException("Such columns not found");
            }

            while ($line = $this->getNextRow()) {
                $this->result[] = $line;
            }
        }

        /**
         * @param array $columns
         *
         * @return bool
         */
        private function validateColumns($columns) : bool
        {
            $result = true;
            if (count($columns)) {
                foreach ($columns as $column) {
                    if (!is_string($column)) {
                        $result = false;
                    }
                }
            } else {
                $result = false;
            }

            return $result;
        }

        private function getColumnTitle() : ?array
        {
            $this->file->rewind();
            return $this->file->fgetcsv();
        }

        /**
         * @return array|null
         */
        private function getNextRow() : ?array
        {
            $result = null;

            if ($this->file->valid()) {
                $this->file->next();
                $this->file::SKIP_EMPTY;

                $this->file::READ_AHEAD;

                $result = $this->file->fgetcsv();
            }

            return $result;
        }
    }
