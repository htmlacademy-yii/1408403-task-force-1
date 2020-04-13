<?php


    namespace htmlacademy\utils;


    use htmlacademy\ex\EmptyDataException;
    use htmlacademy\ex\FileAccessException;

    class DatasetConverter
    {
        public function __construct()
        {
        }

        public function convertCategories($csvData)
        {
            if (empty($csvData)) {
                throw new EmptyDataException('No Data provided for method: ' . __FUNCTION__);
            }

            $filePath = $_SERVER['DOCUMENT_ROOT'] . '/db/categories.sql';

            $file = fopen($filePath, 'w+');

            if (!file_exists($filePath)) {
                throw new FileAccessException('Cannot create a file');
            }

            foreach ($csvData as $row) {
                $sql = "INSERT INTO category (`name`, `slug`) VALUES ('{$row[0]}','{$row[1]}' );\n";
                fwrite($file, $sql);
            }
            fclose($file);
        }

        public function convertCities($csvData)
        {
            if (empty($csvData)) {
                throw new EmptyDataException('No Data provided for method: ' . __FUNCTION__);
            }
            $filePath = $_SERVER['DOCUMENT_ROOT'] . '/db/cities.sql';

            $file = fopen($filePath, 'w+');

            if (!file_exists($filePath)) {
                throw new FileAccessException('Cannot create a file');
            }

            foreach ($csvData as $row) {
                $sql = "INSERT INTO city (`name`, `lat`, `long`) VALUES ('{$row[0]}','{$row[1]}', '{$row[2]}' );\n";
                fwrite($file, $sql);
            }
            fclose($file);
        }

        public function convertUsers($csvData)
        {
            if (empty($csvData)) {
                throw new EmptyDataException('No Data provided for method: ' . __FUNCTION__);
            }
            $filePath = $_SERVER['DOCUMENT_ROOT'] . '/db/users.sql';

            $file = fopen($filePath, 'w+');

            if (!file_exists($filePath)) {
                throw new FileAccessException('Cannot create a file');
            }

            foreach ($csvData as $row) {
                $sql = 'INSERT INTO user (`email`, `full_name`, `password`, `registration_date`)' .
                    "VALUES ('{$row[0]}','{$row[1]}','{$row[2]}','" . $this->formatToProperDatetime($row[3]) . "');\n";
                fwrite($file, $sql);
            }
            fclose($file);
        }

        private function formatToProperDatetime($data)
        {
            return str_replace($data, "$data 00:00:00", $data);
        }

        public function convertProfiles($csvData)
        {
            if (empty($csvData)) {
                throw new EmptyDataException('No Data provided for method: ' . __FUNCTION__);
            }
            $filePath = $_SERVER['DOCUMENT_ROOT'] . '/db/profiles.sql';

            $file = fopen($filePath, 'w+');

            if (!file_exists($filePath)) {
                throw new FileAccessException('Cannot create a file');
            }

            foreach ($csvData as $key => $row) {
                $userId = ++$key;
                $cityId = mt_rand(1, 1108);
                $birthday = $this->formatToProperDatetime($row[1]);
                $bio = $row[2] ?? '';
                $tel = $row[3] ?? '';
                $skype = $row[4] ?? '';
                $sql = 'INSERT INTO user_profile (user_id, city_id, birthday, bio, tel, skype) ' .
                    "VALUES ({$userId}, {$cityId}, '{$birthday}','{$bio}','{$tel}', '{$skype}');\n";
                fwrite($file, $sql);
            }
            fclose($file);
        }

        public function convertTasks($csvData)
        {
            if (empty($csvData)) {
                throw new EmptyDataException('No Data provided for method: ' . __FUNCTION__);
            }
            $filePath = $_SERVER['DOCUMENT_ROOT'] . '/db/tasks.sql';

            $file = fopen($filePath, 'w+');

            if (!file_exists($filePath)) {
                throw new FileAccessException('Cannot create a file');
            }

            foreach ($csvData as $row) {
                $createdAt = $this->formatToProperDatetime($row[0]);
                $createdByUserId = mt_rand(1, 21);
                $title = $row[4];
                $description = $row[2] ?? '';
                $categoryId = $row[1] ?? 1;
                $cityId = mt_rand(1, 1108);;
                $budget = $row[6];
                $expiration = $this->formatToProperDatetime($row[3]);
                $lat = $row[7];
                $long = $row[8];
                $sql =
                    'INSERT INTO task (`created_at`, `created_by_user_id`, `title`, `description`, `category_id`, `city_id`, `budget`, `expiration`, `lat`, `long`) ' .
                    "VALUES ('{$createdAt}',{$createdByUserId},'{$title}','{$description}',{$categoryId},{$cityId}, {$budget}, '{$expiration}', {$lat}, {$long});\n";
                fwrite($file, $sql);
            }
            fclose($file);
        }

        public function convertTestimonials($csvData)
        {
            if (empty($csvData)) {
                throw new EmptyDataException('No Data provided for method: ' . __FUNCTION__);
            }
            $filePath = $_SERVER['DOCUMENT_ROOT'] . '/db/testimonials.sql';

            $file = fopen($filePath, 'w+');

            if (!file_exists($filePath)) {
                throw new FileAccessException('Cannot create a file');
            }

            foreach ($csvData as $row) {
                $userId = mt_rand(1, 21);
                $createdAt = $this->formatToProperDatetime($row[0]);
                $createdByUserId = mt_rand(1, 21);
                $taskId = mt_rand(1, 10);
                $rank = $row[1];
                $comment = $row[2] ?? '';

                $sql = 'INSERT INTO testimonial (user_id, created_at, created_by_user_id, task_id, `rank`, comment) ' .
                    "VALUES ({$userId},'{$createdAt}',{$createdByUserId},{$taskId},{$rank}, '{$comment}');\n";
                fwrite($file, $sql);
            }
            fclose($file);
        }

        public function convertTaskResponse($csvData)
        {
            if (empty($csvData)) {
                throw new EmptyDataException('No Data provided for method: ' . __FUNCTION__);
            }
            $filePath = $_SERVER['DOCUMENT_ROOT'] . '/db/responses.sql';

            $file = fopen($filePath, 'w+');

            if (!file_exists($filePath)) {
                throw new FileAccessException('Cannot create a file');
            }

            foreach ($csvData as $row) {
                $taskId = mt_rand(1, 10);
                $createdAt = $this->formatToProperDatetime($row[0]);
                $userId = mt_rand(1, 21);
                $userPrice = $row[1];
                $comment = $row[2];
                $sql = 'INSERT INTO response (task_id, created_at, user_id, user_price, comment) ' .
                    "VALUES ({$taskId},'{$createdAt}',{$userId},{$userPrice},'{$comment}');\n";
                fwrite($file, $sql);
            }
            fclose($file);
        }

    }
