<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Session Test</title>
</head>
<body>
    <p>Session ID: {{ session()->getId() }}</p>
    <p>CSRF Token: {{ csrf_token() }}</p>
</body>
</html>
