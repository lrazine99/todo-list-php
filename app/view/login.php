<title><?= $path ?></title>
<link href="<?= SCRIPTS ?>css/login.css" rel="stylesheet">
</head>
<body>





<div class="container">
    <h1>Login</h1>
    <p><?=htmlentities(($_SESSION['error'])) ?></p>

<form action="/" method="POST">
    
    <input required type="text" name="username" id="" placeholder="username..">
    <input required type="password" name="password" id="" placeholder="password..">

    
    <button type="submit" value="modifier">Se connecter</button>

</form>
</div>