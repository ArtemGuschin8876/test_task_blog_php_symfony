# Test Task Blog

Простое блог-приложение на Symfony с REST API для управления постами и пользователями.

## Описание задачи

Тестовое задание на создание REST API для блога с базовым функционалом:

* Система управления пользователями (CRUD операции)
* Система управления постами (CRUD операции) 
* Связь между пользователями и их постами
* Подсчет количества постов по автору
* Аутентификация пользователей
* Документирование API через Swagger
* Контейнеризация приложения в Docker

Приложение должно предоставлять REST API endpoints для работы с сущностями "Пользователи" и "Посты", включая стандартные операции создания, чтения, обновления и удаления данных.

## Технологии

* PHP с фреймворком Symfony
* PostgreSQL база данных
* Nginx веб-сервер
* Docker & Docker Compose

## Требования

* Docker
* Docker Compose

## Установка и запуск

1. Клонируйте репозиторий:
   ```
   git clone https://github.com/ваш-username/test_task_blog.git
   cd test_task_blog
   ```

2. Запустите проект:
   ```
   docker-compose up -d
   ```

3. Приложение будет доступно по адресу http://localhost:9000

## Структура проекта

* app - PHP приложение на Symfony (порт 9000)
* nginx - веб-сервер (порт 8085)
* database - PostgreSQL база данных (порт 5432)

## API

### Аутентификация

`POST /api/login_check` - проверка аутентификации пользователя

### Посты

* `GET /api/posts/` - получить все посты
* `POST /api/posts/` - создать новый пост
* `GET /api/posts/{id}` - получить конкретный пост
* `PUT /api/posts/{id}` - обновить пост
* `DELETE /api/posts/{id}` - удалить пост
* `GET /api/posts/count/{id}` - получить количество постов автора

### Пользователи

* `GET /api/users/` - получить всех пользователей
* `POST /api/users/` - создать нового пользователя
* `GET /api/users/{id}` - получить конкретного пользователя
* `DELETE /api/users/{id}` - удалить пользователя

## Команды для разработки

Запуск сервисов:
```
docker-compose up
docker-compose up -d
docker-compose logs -f app
docker-compose down
```

Другие команды:
```
docker-compose exec app bash
docker-compose exec app php bin/console cache:clear
docker-compose exec app composer install
docker-compose exec app php bin/phpunit
```

## Примеры использования

Создать пользователя:
```
curl -X POST http://localhost:9000/api/users/ \
  -H "Content-Type: application/json" \
  -d '{"name": "Иван Иванов", "email": "ivan@example.com"}'
```

Создать пост:
```
curl -X POST http://localhost:9000/api/posts/ \
  -H "Content-Type: application/json" \
  -d '{"title": "Мой первый пост", "content": "Содержание поста...", "author_id": 1}'
```

Получить все посты:
```
curl http://localhost:9000/api/posts/
```
