<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Сброс пароля - Приложение Notes</title>
</head>
<body>
    <h2>Сброс пароля</h2>

    <p>Здравствуйте!</p>

    <p>Вы получили это письмо потому что был запрошен сброс пароля для вашей учетной записи в приложении Notes.</p>

    <p>
        <a href="{{ $url }}" style="background-color: #d4a574; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; display: inline-block;">
            Сбросить пароль
        </a>
    </p>

    <p>Ссылка для сброса пароля будет действительна в течение {{ $expire }} минут.</p>

    <p>Если вы не запрашивали сброс пароля, просто проигнорируйте это письмо.</p>

    <br>

    <p>С уважением,<br>
    Команда {{ config('app.name') }}</p>
</body>
</html>
