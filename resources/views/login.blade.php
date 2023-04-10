<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
</head>

<body>
    <h1>Enter customer email to login</h1>
    <form action="login" method="POST">
        @csrf
        <label for="">Email</label>
        <input type="text" name="email">
        <button type="submit">login</button>
    </form>
</body>

</html>