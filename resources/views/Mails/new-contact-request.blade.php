<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Nuova richiesta di contatto</h1>
    <h3>Mittente: {{ $lead->name }}</h3>
    <p>mail mittente: {{ $lead->email }}</p>
    <p>Messaggio: {{ $lead->message }}</p>
</body>
</html>