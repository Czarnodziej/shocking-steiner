<!DOCTYPE html>
<html lang="pl">
    <head>
        <meta charset="utf-8">
    </head>
    <body>
        <div>Adres nadawcy: {{ $sender_email }}</div>
        <div>Imię: {{ $sender_name }}</div>
        <div>Temat: {{ $subject }}</div>
        <div>Treść: <br>
        {{ $email_content }}
        </div>
    </body>
</html>