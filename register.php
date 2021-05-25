<?php
$bdd = new PDO('mysql:host=localhost;dbname=biblio;charset=utf8', 'root', '');
if(isset($_POST["username"]) && isset($_POST["pass"]) && isset($_POST["cin"]) && isset($_POST["phone"]) && isset($_POST["mail"]) && isset($_POST["adresse"]))
{
	$res=$bdd->prepare("SELECT * FROM users where username=?");
	$res->execute(array($_POST["username"]));
	$count=$res->rowCount();
	if($count==0)
	{
		$ins=$bdd->prepare("INSERT INTO `users`(`username`, `password`, `cin`, `phone`, `email`, `address`, `role`) VALUES (?,?,?,?,?,?,?)");
		$ins->execute(array($_POST["username"],$_POST["pass"],$_POST["cin"],$_POST["phone"],$_POST["mail"],$_POST["adresse"],"null"));
		header("Location: index.php");
	}
	else
	{
		$err="This username is already existed ! Please enter another one.";
	}

}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Register</title>
</head>
<style type="text/css">
	body
	{
		background-image: url("biblio.jpg");
	}

	.from
	{
		background-color: rgb(0,0,0,0.7);
		width: 35%;
		padding: 12px;
		margin-top: 150px;
		margin-left: 450px;
	}

	.from h2
	{
		color: white;
		font-weight: normal;
		font-size: 35px;
		margin-left: 12px;
	}

	.from span
	{
		opacity: 0;
	}

	.inp1
	{
		background-color: rgb(0,0,0,0.1);
		border : none;
		border-bottom: 1px solid white;
		color: white;
		font-size: 18px;
	}

	.inp2
	{
		background-color: rgb(0,0,0,0.1);
		border : none;
		border-bottom: 1px solid white;
		color: white;
		font-size: 18px;
		width: 90%;
	}

	.btn
	{
		background-color: rgb(0,0,0,0.1);
		color: white;
		padding: 8px;
		width: 150px;
		border : none;
		border : 1px solid rgb(255,255,255,0.5);
		text-align: center;
		cursor: pointer;
		outline: none;
		border-radius: 3px;
	}

	.btn:hover
	{
		background-color: red;
	}

	.error
	{
		color: red;
		font-size: 18px;
		font-weight: bold;
	}
</style>
<body>
	<div class="from">
		<form action="register.php" method="post">
			<h2>Sing up</h2>
			<p class="error">
				<?php
					if(isset($err))
					{
						echo $err;
					}
				?>
			</p>
			<p>
				<input class="inp1" type="text" name="username" required="" placeholder="Username"> <span>hhhh</span> <input class="inp1" type="password" name="pass" required="" placeholder="Password">
			</p>
			<br/>
			<p>
				<input class="inp1" type="text" name="cin" required="" placeholder="CIN"> <span>hhhh</span> <input class="inp1" type="text" name="phone" required="" placeholder="Phone">
			</p>
			<br/>
			<p>
				<input class="inp2" type="email" name="mail" required="" placeholder="Email">
			</p>
			<br/>
			<p>
				<input class="inp2" type="text" name="adresse" required="" placeholder="Address">
			</p>
			<br/>
			<p>
				<input class="btn" type="submit" value="Sing up">
			</p>
		</form>
	</div>
</body>
</html>