<?php
session_start();
$nameErr = $emailErr = $genderErr = $addressErr = $icErr = $contactErr = $usernameErr = $passwordErr = "";
$name = $email = $gender = $address = $ic = $contact = $uname = $upassword = "";
$cID;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if (empty($_POST["name"])) {
		$nameErr = "Digite seu nome:";
	}else{
		if (!preg_match("/^[a-zA-Z ]*$/", $name)){
			$nameErr = "Apenas letras e espaços brancos:";
			$name = "";
		}else{
			$name = $_POST['name'];

			if (empty($_POST["uname"])) {
				$usernameErr = "Digite seu nome de usuário:";
				$uname = "";
			}else{
				$uname = $_POST['uname'];

				if (empty($_POST["upassword"])) {
					$passwordErr = "Digite sua senha:";
					$upassword = "";
				}else{
					$upassword = $_POST['upassword'];

					if (empty($_POST["ic"])){
						$icErr = "Digite seu CPF:";
					}else{
						if(!preg_match("/^[0-9 -]*$/", $ic)){
							$icErr = "Por favor digite um CPF válido";
							$ic = "";
						}else{
							$ic = $_POST['ic'];

							if (empty($_POST["email"])){
								$emailErr = "Digite seu e-mail";
							}else{
								if (filter_var($email, FILTER_VALIDATE_EMAIL)){
									$emailErr = "Formato de e-mail inválido";
									$email = "";
								}else{
									$email = $_POST['email'];

									if (empty($_POST["contact"])){
										$contactErr = "Digite seu número";
									}else{
										if(!preg_match("/^[0-9 -]*$/", $contact)){
											$contactErr = "Por favor digite um número válido";
											$contact = "";
										}else{
											$contact = $_POST['contact'];

											if (empty($_POST["gender"])){
												$genderErr = "* Gênero é necessário";
												$gender = "";
											}else{
												$gender = $_POST['gender'];

												if (empty($_POST["address"])){
													$addressErr = "Digite seu endereço";
													$address = "";
												}else{
													$address = $_POST['address'];

													$servername = "localhost";
													$username = "root";
													$password = "";

													$conn = new mysqli($servername, $username, $password); 

													if ($conn->connect_error) {
													    die("Connection failed: " . $conn->connect_error);
													} 

													$sql = "USE bookstore";
													$conn->query($sql);

													$sql = "INSERT INTO users(UserName, Password) VALUES('".$uname."', '".$upassword."')";
													$conn->query($sql);

													$sql = "SELECT UserID FROM users WHERE UserName = '".$uname."'";
													$result = $conn->query($sql);
													while($row = $result->fetch_assoc()){
														$id = $row['UserID'];
													}

													$sql = "INSERT INTO customer(CustomerName, CustomerPhone, CustomerIC, CustomerEmail, CustomerAddress, CustomerGender, UserID) 
													VALUES('".$name."', '".$contact."', '".$ic."', '".$email."', '".$address."', '".$gender."', ".$id.")";
													$conn->query($sql);

													header("Location:index.php");
												}
											}
										}
									}
								}
							}
						}
					}
				}
			}
		}
	}
}												
function test_input($data){
	$data = trim($data);
	$data = stripcslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}
?>
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
<form method="post"  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
	<h1>Registre-se:</h1>
	Nome completo:<br><input type="text" name="name" placeholder="Digite seu nome completo...">
	<span class="error" style="color: red; font-size: 0.8em;"><?php echo $nameErr;?></span><br><br>

	Usuário:<br><input type="text" name="uname" placeholder="Digite seu usuário...">
	<span class="error" style="color: red; font-size: 0.8em;"><?php echo $usernameErr;?></span><br><br>

	Senha:<br><input type="password" name="upassword" placeholder="Digite sua senha...">
	<span class="error" style="color: red; font-size: 0.8em;"><?php echo $passwordErr;?></span><br><br>

	CPF:<br><input type="text" name="ic" placeholder="xxxxxxxxxx-xx">
	<span class="error" style="color: red; font-size: 0.8em;"><?php echo $icErr;?></span><br><br>

	E-mail:<br><input type="text" name="email" placeholder="example@email.com">
	<span class="error" style="color: red; font-size: 0.8em;"><?php echo $emailErr;?></span><br><br>

	Número:<br><input type="text" name="contact" placeholder="(83)1234-5678">
	<span class="error" style="color: red; font-size: 0.8em;"><?php echo $contactErr;?></span><br><br>

	<label>Gênero:</label><br>
	<input type="radio" name="gender" <?php if (isset($gender) && $gender == "Male") echo "checked";?> value="Male">Masculino
	<input type="radio" name="gender" <?php if (isset($gender) && $gender == "Female") echo "checked";?> value="Female">Femenino
	<input type="radio" name="gender" <?php if (isset($gender) && $gender == "Preifro não comentar") echo "checked";?> value="Prefiro não comentar">Prefiro não comentar
	<span class="error" style="color: red; font-size: 0.8em;"><?php echo $genderErr;?></span><br><br>

	<label>Senha:</label><br>
    <textarea name="address" cols="50" rows="5" placeholder="Digite seu endereço..."></textarea>
    <span class="error" style="color: red; font-size: 0.8em;"><?php echo $addressErr;?></span><br><br>

	<input class="button" type="submit" name="submitButton" value="Submit">
	<input class="button" type="button" name="cancel" value="Cancel" onClick="window.location='index.php';" />
</form>
</div>
</blockquote>
</center>
</body>
</html>