# Demo Site for Perf Testing Tools

## Features

### Headers
+ cookies flags for web UI - top right corner access

Response times
Error rates


## Deploying
```bash
# git clone <repo>
composer.phar update
ln -s vendor/.htaccess
ln -s vendor/index.php
```

## Ideas

Иллюстрируем типы ручек
    Легкие
    Тяжелые
    С разными распределениями
    Кэшируемые
        Прогрев кэша показываем
Иллюстрируем типы боттлнеков
    Исчерпание ресурса
        Проца
            Считаем простые числа
            Или факториалы
        Памяти
        Диска
        Сети
        Прерывания
            Они скорее недоконфигурирование
    Недоконфигурирование
        Мало тредов
        Мало портов в ОС
    Внешний вызов
    Блокировки
Scripting and recording aspect
    Flash
    One-page app
    Static HTML
    Dynamic HTML
