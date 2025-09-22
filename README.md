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
| ![welcome](https://github.com/user-attachments/assets/0e17d13c-d9f3-4089-946a-dd6442fd349f) | ![register](https://github.com/user-attachments/assets/c140d5bc-b270-4664-bc67-2b56368bc59d) | ![login](https://github.com/user-attachments/assets/12d58132-00d5-47fe-94e1-471d394a56e2)|

| Список заметок |                                       Редактирование                                       |
|:---:|:------------------------------------------------------------------------------------------:|
| ![notes](https://github.com/user-attachments/assets/ffbd24de-7c60-42f5-af98-b249aaa71020)| ![update](https://github.com/user-attachments/assets/f2f43cb0-da04-4a6d-9465-bba730c9603f)|

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
    npm run build
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
- 🏷️ Теги и фильтры
 
---

## 🎥 Демонстрация

*GIF-демонстрация работы приложения будет добавлена позже.*

---

## 🧪 Postman-коллекция

В репозитории есть коллекция для тестирования API:

- Коллекция: [`postman/Notes-app.postman_collection.json`](postman/Notes-app.postman_collection.json)  
- Окружение: [`postman/Notes-app-env.json`](postman/Notes-app-env.json)

**Использование:**
1. Импортируйте коллекцию и окружение в Postman.
2. Укажите `{{host}}` = `http://localhost:8000/api/v1`.
3. Выполните `Account → register/login`, сохраните `{{token}}`.
4. Дальше используйте CRUD-запросы к заметкам.

## 👤 Автор

- **GitHub:** [Donk1hong](https://github.com/Donk1hong)
- **Вопросы и предложения:** [Issues](https://github.com/Donk1hong/Notes-app/issues)

---

> ✨ Учебный проект для практики разработки на Laravel.
