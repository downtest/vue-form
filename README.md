## Тестовое задание Морозова Романа
Для growfood (11.2019)

### Потраченное время
- Установка окружения на docker\`е заняла день
- Вёрстка формы - 2.5 часа
- Продумывание структуру данных - 2-3 часа
- Отправка формы на сервер - 1.5 часа
- Обработка ошибок на фронте - 40 минут

### Как проверять:
```bash
# Клонируем проект с гита
git clone git@github.com:downtest/vue-form.git ./morozov-test

# Заходим в директорию
cd ./morozov-test

# Поднимаем docker-контейнеры
docker-compose up --build -d

# Установливаем php зависимости composer`ом
docker-compose exec php php artisan migrate

# Делаем миграцию
docker-compose exec php php artisan migrate
```

Далее можно открыть ссылку http://localhost:4547 (порт случайный, чтобы точно был бы свободным, т.к. 80ый часто занят на локальных компах разработчиков)

На домашнем компьютере у меня проект находится в ntfs директории, поэтому я не смог монтировать какую-то постоянную директорию для сохранения данных базы и при каждом перезапуске контейнера база будет стираться. Подробнее [на stackoverflow](https://stackoverflow.com/questions/44878062/initdb-could-not-change-permissions-of-directory-on-postgresql-container)

### Проблемы при разработке

`Docker:`
Целый день разбирался с ним, потому что мало с ним работаю, это моё слабое место.

`Как хранить дни недели у тарифа:`
Выбрана битовая строка типа 0101010, где каждый бит- день недели, т.к. это занимает меньше всего места и наглядно при просмотре. Также рассматривал другие варианты:

- В отдельной таблице days для того, чтобы выбирать тарифы по дням недели можно было бы через JOIN таблиц
- JSON\`ом в отдельной строке
- В базе отдельными колонками, то есть у таблицы тарифов будет на 7 колонок больше

\* Реализовал бинарную строку в обычной строке, т.к. не разобрался с типом binary() в миграциях ларавеля
