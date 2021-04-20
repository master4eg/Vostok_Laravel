<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Document</title>
</head>
<style>body {
        font-family: DejaVu Sans
    }</style>
<body>
<div style="text-align: center;">
    <h1>Очень Важный Официальный Документ</h1>
    <h2>{{ $user['firstName'] }} {{ $user['secondName'] }} {{ $user['middleName'] }}</h2>
    <h2>Его долг: {{ $user['debt'] }}</h2>
    <h2>Госпошлина: {{ $user['stateFee'] }}</h2>
</div>
</body>
</html>
