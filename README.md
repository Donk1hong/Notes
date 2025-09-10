# 📝 Notes-app

![Laravel](https://img.shields.io/badge/Laravel-10.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-^8.1-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-8.0-4479A1?style=for-the-badge&logo=mysql&logoColor=white)
![License](https://img.shields.io/badge/License-MIT-green?style=for-the-badge)
![Status](https://img.shields.io/badge/Status-Active-success?style=for-the-badge)

> Простое и удобное веб-приложение для создания и хранения личных заметок.  
> Разработано на **Laravel (PHP)** в рамках учебной практики.

---

## 📚 Содержание

- [🚀 Основные возможности](#-основные-возможности)
- [📸 Скриншоты](#-скриншоты)
- [⚙️ Технологический стек](#️-технологический-стек)
- [🔧 Установка и запуск](#-установка-и-запуск)
- [📂 Структура проекта](#-структура-проекта)
- [🛠 Будущие улучшения](#-будущие-улучшения)
- [🎥 Демонстрация](#-демонстрация)
- [👤 Автор](#-автор)

---

## 🚀 Основные возможности

- 👋 **Приветственная страница**
- 🔐 **Регистрация и аутентификация** пользователей
- 📝 **CRUD**: создание, просмотр, редактирование и удаление заметок
- 🗂️ **Хранение заметок** в базе данных с привязкой к пользователю
- 🔒 **Безопасность**: валидация, CSRF-защита, авторизация
- 📱 **Адаптивный интерфейс**

---

## 📸 Скриншоты

| Приветствие |                                         Регистрация                                          |                                           Вход                                            |
|:---:|:--------------------------------------------------------------------------------------------:|:-----------------------------------------------------------------------------------------:|
| ![welcome](https://github.com/user-attachments/assets/fd87e1ce-6bc5-42e8-b063-dcf222a7e201) | ![register](https://github.com/user-attachments/assets/b448bc24-ba04-4d34-a968-3bbd90a7c6a3) | ![login](https://github.com/user-attachments/assets/5edcad8c-d2ca-4723-87f0-640446cfa64e) |

| Список заметок |                                       Редактирование                                       |
|:---:|:------------------------------------------------------------------------------------------:|
| ![notes](https://github.com/user-attachments/assets/dddebe90-2bf1-48b1-9448-d4bad6aaea9e) | ![update](https://github.com/user-attachments/assets/45a1c8d6-8884-4137-901a-db52fb07621c) |

---

## ⚙️ Технологический стек

- **Backend:** Laravel (PHP)
- **Frontend:** Blade, CSS, JavaScript
- **ORM:** Eloquent
- **База данных:** MySQL
- **Контроль версий:** Git + GitHub

---

## 🔧 Установка и запуск

1. **Клонирование репозитория**
    ```bash
    git clone https://github.com/Donk1hong/Notes-app.git
    cd Notes-app
    ```

2. **Установка зависимостей**
    ```bash
    composer install
    npm install
    ```

3. **Настройка окружения**
    ```bash
    cp .env.example .env
    ```
   Отредактируйте `.env` и укажите параметры подключения к БД:
    - `DB_DATABASE`
    - `DB_USERNAME`
    - `DB_PASSWORD`

4. **Генерация ключа приложения и миграции**
    ```bash
    php artisan key:generate
    php artisan migrate
    ```

5. **Запуск сервера разработки**
    ```bash
    php artisan serve
    ```

6. **Откройте в браузере:** [http://localhost:8000](http://localhost:8000)

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

## 🛠 Будущие улучшения

- 📌 Категории заметок
- 🔍 Поиск по заметкам
- 🏷️ Теги и фильтры
- 🌙 Темная тема
- ☁️ Экспорт/импорт (PDF, TXT, Markdown)
- 📡 REST API
- 📱 PWA / мобильная версия
- 👥 Совместный доступ

---

## 🎥 Демонстрация

*GIF-демонстрация работы приложения будет добавлена позже.*

---

## 👤 Автор

- **GitHub:** [Donk1hong](https://github.com/Donk1hong)
- **Вопросы и предложения:** [Issues](https://github.com/Donk1hong/Notes-app/issues)

---

> ✨ Учебный проект для практики разработки на Laravel.
