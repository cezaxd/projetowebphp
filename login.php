<html>
<link rel="stylesheet" href="style.css">
<body>
<header>
<blockquote>
    <a href="index.php"><img src="image/logo.png"></a>
</blockquote>
</header>
<blockquote>
<div class="container">
<center><h1>Login</h1></center>
<form action="checklogin.php" method="post">
    Usuário:<br><input type="text" placeholder="Digite seu usuário..." name="username"/>
    <br><br>
    Senha:<br><input type="password" placeholder="Digite sua senha..." name="pwd" />
    <br><br>
    <input class="button" type="submit" value="Login"/>
    <input class="button" type="button" name="cancel" value="Cancel" onClick="window.location='index.php';" />
</form>
</div>
<blockquote>
<?php
if(isset($_GET['errcode'])){
    if($_GET['errcode']==1){
        echo '<span style="color: red;">Usário ou senha invalidos.</span>';
    }elseif($_GET['errcode']==2){
        echo '<span style="color: red;">Porfavor entre.</span>';
    }
}

?>
</body>
</html>