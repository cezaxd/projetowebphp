<html>
<meta http-equiv="Content-Type"'.' content="text/html; charset=utf8"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="style.css">
<style>
	footer{
    position: absolute;
    bottom: -400px;
	width: 100%;
    background: gray;
}
.main-content{
    display: flex;
}
.main-content .box{
    flex-basis: 50%;
    padding: 10px 20px;
}
.box h2{
    font-size: 18px;
    font-weight: 600;
    text-transform: uppercase;
}
.box .content{
    margin: 20px 0 0 0;
    position: relative;
}
.box .content:after{
    position: absolute;
    content: '';
    width: 15%;
    height: 2px;
    background: #f12020;
    top: -10px;
}
.box .content:before{
    position: absolute;
    content: '';
    height: 2px;
    width: 100%;
    background: black;
    top: -10px;
}
.left .content .social{
    margin: 20px 0 0 0;
}
.left .content .social a{
    padding: 0 2px;
}
.left .content .social a span{
    width: 40px;
    height: 40px;
    background: #1a1a1a;
    text-align: center;
    line-height: 40px;
    border-radius: 5px;
    font-size: 18px;
    transition: 0.3s;
}
.left .content .social a span:hover{
    background: #f12020;
}
.left .content p{
    text-align: justify;
}
.center .content .fas{
    font-size: 23px;
    background: #1a1a1a;
    width: 45px;
    height: 45px ;
    line-height: 45px;
    text-align: center;
    border-radius: 50%;
    transition: 0.3s;
    cursor: pointer;
}
.center .content .fas:hover{
    background: #f12020;
}
.center .content .text{
    font-size: 17px;
    font-weight: 500;
    padding-left: 10px;
}
.center .content .phone{
    margin: 10px 0;
}
.center .content .msg{
    margin-top: 10px;
}
.right form input, .right form textarea{
    width: 100%;
    font-size: 17px;
    background: white;
    padding-left: 10px;
    border: 1px solid #222222;
}
.right form input{
    height: 35px;
}
.right form input:focus,
.right form textarea:focus{
    outline-color: #3498db;
}
.right form .text{
    font-size: 17px;
    margin-bottom: 2px;
    color: white;
}
.right form .btn{
    margin-top: 10px;
}
.right form .btn button{
    height: 40px;
    width: 100%;
    background: #f12020;
    font-size: 17px;
    font-weight: 500;
    cursor: pointer;
    transition: .3s;
}
.right form .btn button:hover{
    background: white;
}
.bottom .center{
    padding: 5px;
    font-size: 15px;
    background: #151515;
    text-align: center;
}
.bottom .center span{
    color: #656565;
}
.bottom .center a{
    color: white;
    text-decoration: none;
}
.bottom .center a:hover{
    text-decoration: underline;
}
@media screen and (max-width: 900px){
    footer{
        position: fixed;
        bottom: 0px;
    }
    .main-content{
        flex-wrap: wrap;
        flex-direction: column;
    }
    .main-content .box{
        margin: 5px 0;
    }
}
</style>
<body>
<?php
session_start();
	if(isset($_POST['ac'])){
		$servername = "localhost";
		$username = "root";
		$password = "";

		$conn = new mysqli($servername, $username, $password);

		if ($conn->connect_error) {
		    die("Connection failed: " . $conn->connect_error);
		} 

		$sql = "USE bookstore";
		$conn->query($sql);

		$sql = "SELECT * FROM book WHERE BookID = '".$_POST['ac']."'";
		$result = $conn->query($sql);

		while($row = $result->fetch_assoc()){
			$bookID = $row['BookID'];
			$quantity = $_POST['quantity'];
			$price = $row['Price'];
		}

		$sql = "INSERT INTO cart(BookID, Quantity, Price, TotalPrice) VALUES('".$bookID."', ".$quantity.", ".$price.", Price * Quantity)";
		$conn->query($sql);
	}

	if(isset($_POST['delc'])){
		$servername = "localhost";
		$username = "root";
		$password = "";

		$conn = new mysqli($servername, $username, $password);

		if ($conn->connect_error) {
		    die("Connection failed: " . $conn->connect_error);
		} 

		$sql = "USE bookstore";
		$conn->query($sql);

		$sql = "DELETE FROM cart";
		$conn->query($sql);
	}

	$servername = "localhost";
	$username = "root";
	$password = "";

	$conn = new mysqli($servername, $username, $password);

	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	} 

	$sql = "USE bookstore";
	$conn->query($sql);	

	$sql = "SELECT * FROM book";
	$result = $conn->query($sql);
?>	

<?php
if(isset($_SESSION['id'])){
	echo '<header>';
	echo '<blockquote>';
	echo '<form class="hf" action="logout.php"><input class="hi" type="submit" name="submitButton" value="Logout"></form>';
	echo '<form class="hf" action="edituser.php"><input class="hi" type="submit" name="submitButton" value="Edit Profile"></form>';
	echo '</blockquote>';
	echo '</header>';
}

if(!isset($_SESSION['id'])){
	echo '<header>';
	echo '<blockquote>';
	echo '<a href="index.php"><img src="image/logo.png"></a>';
	echo '<form class="hf" action="Register.php"><input class="hi" type="submit" name="submitButton" value="Registre-se"></form>';
	echo '<form class="hf" action="login.php"><input class="hi" type="submit" name="submitButton" value="Login"></form>';
	echo '</blockquote>';
	echo '</header>';
}
echo '<blockquote>';
	echo "<table id='myTable' style='width:80%; float:left'>";
	echo "<tr>";
    while($row = $result->fetch_assoc()) {
	    echo "<td>";
	    echo "<table>";
	   	echo '<tr><td>'.'<img src="'.$row["Image"].'"width="80%">'.'</td></tr><tr><td style="padding: 5px;">Titulo: '.$row["BookTitle"].'</td></tr><tr><td style="padding: 5px;">ISBN: '.$row["ISBN"].'</td></tr><tr><td style="padding: 5px;">Autor(a): '.$row["Author"].'</td></tr><tr><td style="padding: 5px;">Tipo: '.$row["Type"].'</td></tr><tr><td style="padding: 5px;">Preço:R$'.$row["Price"].'</td></tr><tr><td style="padding: 5px;">
	   	<form action="" method="post">
	    Quantidade: <input type="number" value="1" name="quantity" style="width: 20%"/><br>
	   	<input type="hidden" value="'.$row['BookID'].'" name="ac"/>
	   	<input class="button" type="submit" value="Adcionar ao Carrinho"/>
	   	</form></td></tr>';
	   	echo "</table>";
	   	echo "</td>";
    }
    echo "</tr>";
    echo "</table>";

	$sql = "SELECT book.BookTitle, book.Image, cart.Price, cart.Quantity, cart.TotalPrice FROM book,cart WHERE book.BookID = cart.BookID;";
	$result = $conn->query($sql);

    echo "<table style='width:20%; float:right;'>";
    echo "<th style='text-align:left;'><i class='fa fa-shopping-cart' style='font-size:24px'></i> Carrinho:<form style='float:right;' action='' method='post'><input type='hidden' name='delc'/><input class='cbtn' type='submit' value='Esvazia compra'></form></th>";
    $total = 0;
    while($row = $result->fetch_assoc()){
    	echo "<tr><td>";
    	echo '<img src="'.$row["Image"].'"width="20%"><br>';
    	echo $row['BookTitle']."<br>R$".$row['Price']."<br>";
    	echo "Quantidade: ".$row['Quantity']."<br>";
    	echo "Preço Total: R$".$row['TotalPrice']."</td></tr>";
    	$total += $row['TotalPrice'];
    }
    echo "<tr><td style='text-align: right;background-color: #f2f2f2;''>";
    echo "Total: <b>Preço:R$".$total."</b><center><form action='checkout.php' method='post'><input class='button' type='submit' name='checkout' value='Comprar'></form></center>";
    echo "</td></tr>";
	echo "</table>";
	echo '</blockquote>';

?>
	<footer>
		<div class="main-content">
			<div class="left box">
				<h2> Sobre nós</h2>
				<div class="content">
					<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Amet iste facilis harum eos vel incidunt distinctio corrupti iure? Rem</p>
				
					<div class="social">
						<a href="#"><span class="fab fa-facebook-f"></span></a>
						<a href="#"><span class="fab fa-twitter"></span></a>
						<a href="#"><span class="fab fa-instagram"></span></a>
						<a href="#"><span class="fab fa-youtube"></span></a>
					</div>
				</div>
			</div><!--left box-->
			<div class="center box">
				<h2>Endereço</h2>
				<div class="content">
					<div class="place">
						<span class="fas fa-map-marker"></span>
						<span class="text">Av.Brasil, Nova Capital</span>
					</div>

					<div class="phone">
						<span class="fas fas fa-phone-alt"></span>
						<span class="text">+55 83 9999-9999</span>
					</div>

					<div class="email">
						<span class="fas fa-envelope"></span>
						<span class="text">exemplo@exemplo.com</span>
					</div>
				</div>
			</div>
			<div class="right box">
				<h2>Contato</h2>
				<div class="content">
					<form action="#">
						<div class="email">
							<div class="text">Email *</div>
							<input type="email" required>
						</div>
						<div class="msg">
							<div class="text">Mensagem *</div>
							<textarea rows="2" cols="25" required></textarea>
						</div>
						<div class="btn">
							<button type="submit">Enviar</button>
						</div>
					</form>
				</div>
			</div>
		</div><!--main-content-->
		<div class="bottom">
			<div class="center">
				<span class="credit">Criado por <a href="#">Cezar</a></span>
				<span class="far fa-copyright">2022 Todos os diteitos reservados</span>
			</div>
		</div>
	</footer>
	<script src="https://kit.fontawesome.com/a076d05399.js"></script>
</body>
</html>