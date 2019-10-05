### Потраченное время
- 15:43 - 16:40 Установка  Laravel
- Вёрстка формы
- Отправка формы на сервер
- Обработка на сервере
- Обработка ошибок формы на фронте


Запуск docker-контейнеров:
```bash
docker-compose up --build -d
```
На домашнем компьютере у меня проект находится в ntfs директории, поэтому я не смог монтировать какую-то постоянную директорию для сохранения данных базы и при каждом перезапуске контейнера база будет стираться. Подробнее [на stackoverflow](https://stackoverflow.com/questions/44878062/initdb-could-not-change-permissions-of-directory-on-postgresql-container)


Миграции
docker-compose exec php php artisan migrate
