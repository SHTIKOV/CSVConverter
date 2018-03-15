# CSVConverter
This class created for convert array data to CSV file


```php
    /* Объявление класса */
    $ConvertCSVObj = new CommonClasses\ConvertCSV (';');
    /* Установка заголовка содержимого */
    $ConvertCSVObj->setTitle ("Информация о игроках");
    /* Установка контента */
    $ConvertCSVObj->setContent ($stringCSV);
    /* Установка кодировки */
    $ConvertCSVObj->setCharset ('utf-8');
    /* Установка имени файла */
    $ConvertCSVObj->setFileName ("Это_имя_файла_".date ("Y-m-d_H-i-s"));
    /* Преобразование установленного массива в CSV строку с добавлением шапки по названию полей */
    $ConvertCSVObj->convert (true);
    /* Получение CSV файла для скачивания */
    $response = $ConvertCSVObj->getDownloadFile ()
```

