# Notes API (Laravel + Sanctum)

Простой REST API для заметок (регистрация, логин, CRUD заметок, смена пароля и удаление аккаунта). 
Документация доступна в **Swagger UI** и в **Postman-коллекции**. Проект разворачивается через **Docker Compose**.

---

## Стек
- **PHP / Laravel**
- **Sanctum** (Bearer токены)
- **OpenAPI 3.0** (Swagger UI, `L5_SWAGGER_GENERATE_ALWAYS=true`)
- **MySQL** (хост контейнера: `db`)
- **Mailhog** (для перехвата писем; UI по `http://localhost:8025`)
- **Docker / Docker Compose**

---

## Конфигурация (`.env`)

Проект ожидает следующие ключевые переменные окружения (ваши актуальные значения — ниже):

```dotenv
APP_NAME=Notes
APP_ENV=local
APP_KEY=base64:***
APP_DEBUG=true
APP_URL=http://localhost

LOG_CHANNEL=stack
LOG_LEVEL=debug

DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=notes
DB_USERNAME=root
DB_PASSWORD=root

MAIL_MAILER=smtp
MAIL_HOST=mailhog
MAIL_PORT=1025
MAIL_FROM_ADDRESS="test@example.com"
MAIL_FROM_NAME="MyApp"

L5_SWAGGER_GENERATE_ALWAYS=true
```

> **Важно:** `DB_HOST=db` — имя сервиса БД в `docker-compose.yml`.  
> **Mailhog:** для локалки почта не уходит наружу, а попадает в Mailhog UI (`http://localhost:8025`).

---

## Пример `docker-compose.yml` (минимально-достаточный)

> Подправьте под ваш образ/порты, если они отличаются.

```yaml
version: "3.9"
services:
  app:
    build:
      context: .
      dockerfile: Dockerfile
    ports:
      - "8000:8000"   # Laravel HTTP
    env_file: .env
    depends_on:
      - db
      - mailhog
    command: sh -c "php artisan serve --host=0.0.0.0 --port=8000"

  db:
    image: mysql:8.0
    restart: unless-stopped
    environment:
      MYSQL_DATABASE: notes
      MYSQL_ROOT_PASSWORD: root
      MYSQL_USER: root
      MYSQL_PASSWORD: root
    ports:
      - "3306:3306"
    volumes:
      - db_data:/var/lib/mysql

  mailhog:
    image: mailhog/mailhog:latest
    ports:
      - "1025:1025"  # SMTP
      - "8025:8025"  # Web UI

volumes:
  db_data:
```

---

## Аутентификация

Используется Bearer-токен (Sanctum/JWT). Получение токена двумя способами:

### Регистрация
`POST /api/v1/auth/register`
```json
{
  "email": "user@example.com",
  "password": "secret123",
  "password_confirmation": "secret123"
}
```

### Логин
`POST /api/v1/auth/login`
```json
{
  "email": "user@example.com",
  "password": "secret123"
}
```

Дальше добавляйте заголовок:
```
Authorization: Bearer <token>
```

---

## Эндпоинты (основные по OpenAPI)

### Users
- `POST /api/v1/auth/register` — регистрация
- `POST /api/v1/auth/login` — логин
- `POST /api/v1/auth/forgot-password` — отправка письма для сброса
- `POST /api/v1/auth/reset-password` — сброс пароля по токену
- `POST /api/v1/auth/logout` — выход (отзыв токена) *(требует Bearer)*
- `PATCH /api/v1/user/password` — смена пароля *(Bearer)*
- `DELETE /api/v1/user` — удалить аккаунт *(Bearer)*

### Notes
- `GET /api/v1/notes` — список заметок *(Bearer)*
- `POST /api/v1/notes` — создать *(Bearer)*
- `PUT /api/v1/notes/{note_id}` — обновить *(Bearer)*
- `PATCH /api/v1/notes/{note_id}` — частично обновить *(Bearer)*
- `DELETE /api/v1/notes/{note_id}` — удалить *(Bearer)*

---

## Swagger / OpenAPI

- **UI**: `GET /api/documentation`
- **Схема**: храните `openapi.json`/`openapi.yaml` в репозитории или генерируйте из кода.
- **Безопасность**: `bearerAuth` (JWT/Sanctum).

Если автоген отключён, используйте:
```bash
docker compose exec app php artisan l5-swagger:generate
```

---

## Postman-коллекция

Импортируйте коллекцию **Notes** по ссылке:
```
https://www.postman.com/roma1324465-2781074/workspace/apinotes/collection/47984426-013c1987-7fb1-43a8-ad6c-075810517cb2?action=share&source=copy-link&creator=47984426
```

Переменные:
- `base_url` — `http://localhost:8000` (или ваш порт)
- `token` — Bearer, полученный после логина/регистрации

Коллекция уже содержит:
- `GET /api/documentation`
- `auth` (register/login/forgot/reset/logout)
- `user` (password/delete)
- `notes` (CRUD)

---

## Примеры cURL

> Замените `<TOKEN>` на реальный токен.

**Список заметок**
```bash
curl -X GET http://localhost:8000/api/v1/notes   -H "Accept: application/json"   -H "Authorization: Bearer <TOKEN>"
```

**Создать заметку**
```bash
curl -X POST http://localhost:8000/api/v1/notes   -H "Content-Type: application/json"   -H "Authorization: Bearer <TOKEN>"   -d '{"title":"Моя заметка","category":"work","description":"Текст"}'
```

**Сброс пароля (шаг 1 — письмо)**
```bash
curl -X POST http://localhost:8000/api/v1/auth/forgot-password   -H "Content-Type: application/json"   -d '{"email":"user@example.com"}'
# Затем откройте Mailhog UI: http://localhost:8025 и используйте токен из письма
```

---

## Диагностика

- **401 Unauthorized:** проверьте заголовок `Authorization: Bearer <token>` и актуальность токена.
- **Swagger UI не открывается:** убедитесь, что маршрут `/api/documentation` активен и порт проброшен.
- **БД не коннектится:** `DB_HOST` должен совпадать с именем сервиса БД в compose (`db`), проверьте порт `3306` и креды.
- **Письма не приходят:** проверьте, что `MAIL_HOST=mailhog`, `MAIL_PORT=1025`, а Mailhog UI доступен по `http://localhost:8025`.
- **Миграции/сиды:** запустите `php artisan migrate --seed` внутри контейнера `app`.

---

## Лицензия
MIT
