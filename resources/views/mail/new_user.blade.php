<!DOCTYPE html>
<html>
<head>
    <title>Laravel</title>

    <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

    <style>
        html, body {
            height: 100%;
        }

        body {
            margin: 0;
            padding: 0;
            width: 100%;
            display: table;
            font-weight: 400;
        }

        .container {
            text-align: center;
            display: table-cell;
            vertical-align: middle;
        }

        .content {
            text-align: center;
            display: inline-block;
            min-width: 300px;
        }

        .title {
            font-size: 96px;
        }
        p span {
            font-weight: 400;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="content">
        <div class="col-md-12">
            Welcome to ...!
            An account was created for you on ...
            Your password for login is: {{$password}}, please use this email for login.
        </div>
    </div>
</div>
</body>
</html>
