<?php

    use htmlacademy\ex\EmptyDataException;
    use htmlacademy\ex\FileAccessException;
    use htmlacademy\ex\FileFormatException;
    use htmlacademy\ex\SourceFileException;
    use htmlacademy\utils\DatasetConverter;
    use htmlacademy\utils\FileExport;

    require '../vendor/autoload.php';
    try {
        $sqlConverter = new DatasetConverter();

        $exports = [
            'categories'   => new FileExport("{$_SERVER['DOCUMENT_ROOT']}/data/categories.csv", ['name', 'icon']),
            'cities'       => new FileExport("{$_SERVER['DOCUMENT_ROOT']}/data/cities.csv", ['city', 'lat', 'long']),
            'users'        => new FileExport(
                "{$_SERVER['DOCUMENT_ROOT']}/data/users.csv", ['email', 'name', 'password', 'dt_add']
            ),
            'profiles'     => new FileExport(
                "{$_SERVER['DOCUMENT_ROOT']}/data/profiles.csv", ['address', 'bd', 'about', 'phone', 'skype']
            ),
            'task'         => new FileExport(
                "{$_SERVER['DOCUMENT_ROOT']}/data/tasks.csv",
                ['dt_add', 'category_id', 'description', 'expire', 'name', 'address', 'budget', 'lat', 'long']
            ),
            'testimonials' => new FileExport(
                "{$_SERVER['DOCUMENT_ROOT']}/data/opinions.csv", ['dt_add', 'rate', 'description']
            ),
            'response'     => new FileExport(
                "{$_SERVER['DOCUMENT_ROOT']}/data/replies.csv", ['dt_add', 'rate', 'description']
            ),
        ];
        foreach ($exports as $name => $export) {
            $export->import();
            $records = $export->getData();
            switch ($name) {
                case 'categories':
                    $sqlConverter->convertCategories($records);
                    break;
                case 'cities':
                    $sqlConverter->convertCities($records);
                    break;
                case 'users':
                    $sqlConverter->convertUsers($records);
                    break;
                case 'profiles':
                    $sqlConverter->convertProfiles($records);
                    break;
                case 'task':
                    $sqlConverter->convertTasks($records);
                    break;
                case 'testimonials':
                    $sqlConverter->convertTestimonials($records);
                    break;
                case 'response':
                    $sqlConverter->convertTaskResponse($records);
                    break;
            }
        }

        var_dump($records);
    } catch (SourceFileException $e) {
        var_dump("Не удалось обработать csv файл: " . $e->getMessage());
    } catch (FileFormatException $e) {
        var_dump("Неверная форма файла импорта: " . $e->getMessage());
    } catch (RuntimeException $e) {
        var_dump($e->getMessage());
    } catch (EmptyDataException $e) {
        var_dump("Unable to start: " . $e->getMessage());
    } catch (FileAccessException $e) {
        var_dump("Unable to start: " . $e->getMessage());
    }
