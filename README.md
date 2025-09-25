# 📝 Notes-app

![Laravel](https://img.shields.io/badge/Laravel-10.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-^8.1-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-8.0-4479A1?style=for-the-badge&logo=mysql&logoColor=white)
![License](https://img.shields.io/badge/License-MIT-green?style=for-the-badge)
![Status](https://img.shields.io/badge/Status-Active-success?style=for-the-badge)

> Простое и удобное веб-приложение для **создания и хранения личных заметок**.  
> Разработано на **Laravel (PHP)** в рамках учебной практики.

---

## 📚 Содержание

- [🚀 Основные возможности](#-основные-возможности)
- [📸 Скриншоты](#-скриншоты)
- [⚙️ Технологический стек](#️-технологический-стек)
- [🔧 Установка и запуск](#-установка-и-запуск)
- [📂 Структура проекта](#-структура-проекта)
- [🧪 Postman-коллекция](#-postman-коллекция)
- [👤 Автор](#-автор)

---

## 🚀 Основные возможности

- 👋 Приветственная страница  
- 🔐 Регистрация и аутентификация пользователей  
- 📝 **CRUD**: создание, просмотр, редактирование и удаление заметок  
- 🗂️ Хранение заметок в базе данных с привязкой к пользователю  
- 🔒 Безопасность: валидация, CSRF-защита, авторизация  
- 📱 Адаптивный интерфейс  

---

## 📸 Скриншоты

| Приветствие | Регистрация | Вход |
|:---:|:---:|:---:|
| ![welcome](https://github.com/user-attachments/assets/7d51f437-ba30-4d85-8318-4125ad88b631) | ![register](https://github.com/user-attachments/assets/eb06aefd-f41a-4834-87da-a2a47dcb2ab0) | ![login](https://github.com/user-attachments/assets/611ac9f2-9a72-44e7-bb48-1c0a967cffdf) |

| Список заметок | Создание | Редактирование |
|:---:|:---:|:---:|
| ![notes](https://github.com/user-attachments/assets/7a7d0843-2db7-4227-955b-b4e41d989f73) | ![create](https://github.com/user-attachments/assets/ce001aa4-08f9-41ad-9670-7431c121e085) | ![update](https://github.com/user-attachments/assets/9ff0f364-d662-4896-9db2-b3fc47f24a87) |

---

## ⚙️ Технологический стек

- **Backend:** Laravel (PHP)  
- **Frontend:** Blade, CSS, JavaScript  
- **ORM:** Eloquent  
- **База данных:** MySQL  
- **Контроль версий:** Git + GitHub  

---

## 🔧 Установка и запуск

```bash
# 1. Клонирование репозитория
git clone https://github.com/Donk1hong/Notes-app.git
cd Notes-app

# 2. Установка зависимостей
composer install
npm install

# 3. Настройка окружения
cp .env.example .env
# укажите параметры подключения к БД (DB_DATABASE, DB_USERNAME, DB_PASSWORD)

# 4. Генерация ключа и миграции
php artisan key:generate
php artisan migrate

# 5. Запуск сервера разработки
php artisan serve
```

🔗 Приложение будет доступно по адресу:  
👉 `http://localhost:8000`

---

## 📂 Структура проекта

<details>
<summary>Примерная структура</summary>

```
Notes-app/
├── app/
│   ├── Http/
│   ├── Models/
│   └── ...
├── bootstrap/
├── config/
├── database/
│   └── migrations/
├── public/
├── resources/
│   ├── views/
│   └── ...
├── routes/
│   └── web.php
├── .env.example
├── composer.json
└── ...
```

</details>

---

## 🧪 Postman-коллекция

Для тестирования API эндпоинтов доступна готовая Postman-коллекция.

[<img src="https://run.pstmn.io/button.svg" alt="Run In Postman" style="width: 128px; height: 32px;">](https://app.getpostman.com/run-collection/47984426-16a9fcd6-2c58-4bce-a699-d410b4e39099?action=collection%2Ffork&source=rip_markdown&collection-url=entityId%3D47984426-16a9fcd6-2c58-4bce-a699-d410b4e39099%26entityType%3Dcollection%26workspaceId%3Dfac36783-f246-4412-8ce6-2432522bb708)

Коллекция для тестирования API доступна в двух форматах в репозитории:
-   **Коллекция:** [`postman/Notes-app.postman_collection.json`](./postman/Notes-app.postman_collection.json)
-   **Окружение:** [`postman/Notes-app-env.postman_environment.json`](./postman/Notes-app-env.postman_environment.json)

### Использование:
1.  **Скачайте файлы** из папки `postman/` или нажмите кнопку «Run in Postman» выше.
2.  Импортируйте коллекцию и окружение в Postman.
3.  В окружении установите переменную `host` (по умолчанию: `http://localhost:8000/api/v1`).
4.  Выполните запросы из папки **`Account`** (`register` или `login`), чтобы получить токен. Он автоматически сохранится в переменную `token`.
5.  Используйте CRUD-запросы из папки **`Notes`** (`create`, `get all`, `get one`, `update`, `delete`). Токен будет автоматически подставляться в заголовки.

---

## 👤 Автор

-   **GitHub:** [Donk1hong](https://github.com/Donk1hong)

---

## ✨ Учебный проект для практики разработки на Laravel.
