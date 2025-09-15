Test Task Blog
Простое блог-приложение на Symfony с REST API для управления постами и пользователями.
🚀 Технологии

PHP с фреймворком Symfony
PostgreSQL база данных
Nginx веб-сервер
Docker & Docker Compose

📋 Требования

Docker
Docker Compose

⚡ Быстрый старт

Клонируйте репозиторий:

bashgit clone https://github.com/ваш-username/test_task_blog.git
cd test_task_blog

Запустите проект:

bashdocker-compose up -d

Приложение будет доступно по адресу:


API: http://localhost:9000
Swagger UI: http://localhost:9000/api/doc (если настроено)

🗂️ Структура проекта
Проект состоит из следующих сервисов:

app - PHP приложение на Symfony (порт 9000)
nginx - веб-сервер (порт 8085)
database - PostgreSQL база данных (порт 5432)

📚 API Документация
Аутентификация
Проверка аутентификации пользователя
httpPOST /api/login_check
Посты
Получить все посты
httpGET /api/posts/
Создать новый пост
httpPOST /api/posts/
Получить конкретный пост
httpGET /api/posts/{id}
Обновить пост
httpPUT /api/posts/{id}
Удалить пост
httpDELETE /api/posts/{id}
Получить количество постов автора
httpGET /api/posts/count/{id}
Пользователи
Получить всех пользователей
httpGET /api/users/
Создать нового пользователя
httpPOST /api/users/
Получить конкретного пользователя
httpGET /api/users/{id}
Удалить пользователя
httpDELETE /api/users/{id}
🛠️ Разработка
Запуск в режиме разработки
bash# Запустить все сервисы
docker-compose up

# Запустить в фоновом режиме
docker-compose up -d

# Посмотреть логи
docker-compose logs -f app

# Остановить сервисы
docker-compose down
Работа с базой данных
bash# Выполнить миграции
docker-compose exec app php bin/console doctrine:migrations:migrate

# Создать новую миграцию
docker-compose exec app php bin/console doctrine:migrations:generate

# Загрузить фикстуры (если есть)
docker-compose exec app php bin/console doctrine:fixtures:load
Полезные команды
bash# Зайти в контейнер приложения
docker-compose exec app bash

# Очистить кэш Symfony
docker-compose exec app php bin/console cache:clear

# Установить зависимости Composer
docker-compose exec app composer install

# Запустить тесты (если настроены)
docker-compose exec app php bin/phpunit
🗃️ База данных
Приложение использует PostgreSQL. Данные сохраняются в Docker volume для персистентности.
Подключение к базе данных:

Host: localhost
Port: 5432
Database: symfony
Username: symfony
Password: symfony

🔧 Конфигурация
Основные настройки находятся в файлах:

docker-compose.yml - конфигурация Docker сервисов
.env - переменные окружения Symfony
config/ - конфигурация Symfony

📝 Примеры использования API
Создание пользователя
bashcurl -X POST http://localhost:9000/api/users/ \
  -H "Content-Type: application/json" \
  -d '{
    "name": "Иван Иванов",
    "email": "ivan@example.com"
  }'
Создание поста
bashcurl -X POST http://localhost:9000/api/posts/ \
  -H "Content-Type: application/json" \
  -d '{
    "title": "Мой первый пост",
    "content": "Содержание поста...",
    "author_id": 1
  }'
Получение всех постов
bashcurl http://localhost:9000/api/posts/
🚨 Решение проблем
Проблемы с портами
Если порты заняты, измените их в docker-compose.yml:
yamlports:
  - "8080:80"  # вместо 8085:80 для nginx
  - "9001:9000" # вместо 9000:9000 для app
Проблемы с правами доступа
bash# Исправить права на папки Symfony
sudo chown -R $USER:$USER var/ vendor/
Пересборка контейнеров
bashdocker-compose down
docker-compose up --build
📄 Лицензия
Этот проект создан в рамках тестового задания.
🤝 Разработка
1.Создайте форк репозитория
2.Создайте ветку для новой функциональности
3.Внесите изменения и создайте pull request

Контакт: newmsiartem@gmail.com
