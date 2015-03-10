<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
{% if title is defined %}
    <title>{{ title }} : Admin</title>
{% else %}
    <title>Admin</title>
{% endif %}
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:700,300,600,400' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="/css/admin.css" media="screen">
    <script type="text/javascript" src="/js/jquery-2.1.3.min.js"></script>
</head>
<body>
    {{ content() }}
</body>
</html>