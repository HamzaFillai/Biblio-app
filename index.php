<?php
$bdd = new PDO('mysql:host=localhost;dbname=biblio;charset=utf8', 'root', '');
if(isset($_POST["username"]) && isset($_POST["pass"]))
{
	$rep=$bdd->prepare("SELECT * FROM users where username = ? and password = ?");
	$rep->execute(array($_POST["username"],$_POST["pass"]));
	$count=$rep->rowCount();
	$don=$rep->fetch();
	if($count==1)
	{
		if($don["role"]=="chef")
		{
			header("Location: home.php");
		}
		else
		{
			header("Location: register.php");
		}
	}
	else
	{
		$err="Your username or password is incorrect !";
	}
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	
</head>
<style type="text/css">
	@import "https://use.fontawesome.com/releases/v5.5.0/css/all.css";
	body
	{
		background-image: url("biblio.jpg");
	}

	.form
	{
		background: rgb(0,0,0,0.7);
		color: white;
		width: 20%;
		margin-top: 200px;
		margin-left: 550px;
		padding: 20px;
	}

	.form h2
	{
		font-weight: normal;
		font-size: 35px;
		margin-left: 12px;
	}

	.inp1
	{
		background-color: rgb(0,0,0,0.1);
		border : none;
		border-bottom: 1px solid white;
		font-size: 20px;
		color: white;
	}

	.inp2
	{
		background-color: rgb(0,0,0,0.1);
		color: white;
		padding: 8px;
		width: 100px;
		border : none;
		border : 1px solid rgb(255,255,255,0.5);
		text-align: center;
		cursor: pointer;
		outline: none;
		border-radius: 3px;
	}

	.inp2:hover
	{
		background-color: red;
	}

	 span
	{
		opacity: 0;
 	}

	.form a
	{
		text-decoration: none;
		color: red;
	}

	.err
	{
		color: rgb(204,0,0);
		font-size: 17px;
		font-weight: bold;
	}
</style>
<body>
	<div class="form">
		<form action="index.php" method="post">
			<h2>Sing in</h2>
			<p class="err">
				<?php
					if(isset($err))
					{
						echo $err;
					}
				?>
			</p>
			<p>
				<i class="fas fa-user fa-lg"></i><span>hh</span><input class="inp1" type="text" name="username" required="" placeholder="Username">
			</p>
			<br/>
			<p>
				<i class="fas fa-lock"></i><span>hh</span><input class="inp1" type="password" name="pass" required="" placeholder="Password">
			</p>
			<br/>
			<p>
				<input class="inp2" type="submit" value="Sing in">
			</p>
		</form>
		<p>If you don't have an account , <a href="register.php">Click here !</a></p>
	</div>
</body>
<script type="text/javascript">
	window.history.forward();
</script>
</html>