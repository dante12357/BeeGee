<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=1, shrink-to-fit=no">
    <link rel="stylesheet" type="text/css" href="/src/style/style.css"/>

    <base href="/">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
          integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    <script
            src="https://code.jquery.com/jquery-3.5.1.js"
            integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
            crossorigin="anonymous"></script>
    <script type="text/javascript" src="/src/script/index.js"></script>

</head>
<body>
<div class="wrapper">
    <?php if (isset($_SESSION['auth'])) : ?>
        Hello, <?php echo $_SESSION['login']; ?><br>
        <a class="btn btn-danger" id="logout" href="/customer/logout">logout</a>
    <?php else : ?>
        <a class="btn btn-success"  id="loginPage" href="/customer/login">Log In</a>
    <?php endif; ?>
    <a class="btn btn-primary" id="taskPage" href="task/taskList/?page=1">Task</a>

    <div id="error" style="color: red;"></div>
    <div id="success" style="color: green;"></div>
    <div id="result"></div>

    <noscript>Include JS or nothing will work</noscript>
</div>


</body>
</html>
