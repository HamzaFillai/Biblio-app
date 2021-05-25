<?php
$bdd = new PDO('mysql:host=localhost;dbname=biblio;charset=utf8', 'root', '');
$res=$bdd->query("SELECT * FROM livre");
if(isset($_POST["titre"]) && isset($_POST["auteur"]) && isset($_POST["isbn"]) && isset($_POST["genre"]) && isset($_POST["editeur"]) && isset($_POST["prix"]) && isset($_POST["page"]) && isset($_POST["qtedispo"]) && isset($_POST["qtetotal"]) && isset($_POST["date"]) && isset($_POST["resume"]) && isset($_POST["image"]))
{
	$repi=$bdd->prepare("SELECT * FROM livre WHERE isbn = ?");
	$repi->execute(array($_POST["isbn"]));
	$counti=$repi->rowCount();
	if($counti==1)
	{
		$erri = "OK";
	}
	else
	{
		$ins=$bdd->prepare("INSERT INTO `livre`(`isbn`, `titre`, `auteur`, `editeur`, `genre`, `prix`, `nbrpage`, `qtedisponible`, `qtetotal`, `anneeparution`, `resume`) VALUES (?,?,?,?,?,?,?,?,?,?,?)");
		$ins->execute(array($_POST["isbn"],$_POST["titre"],$_POST["auteur"],$_POST["editeur"],$_POST["genre"],$_POST["prix"],$_POST["page"],$_POST["qtedispo"],$_POST["qtetotal"],$_POST["date"],$_POST["resume"]));
		$vali = "Nice";
	}
}

if(isset($_POST["username"]) && isset($_POST["mail"]) && isset($_POST["phone"]) && isset($_POST["adresse"]) && isset($_POST["cin"]))
{
	$rep=$bdd->prepare("SELECT * FROM users where 	username = ?");
	$rep->execute(array($_POST["username"]));
	$count=$rep->rowCount();
	$repu=$bdd->prepare("SELECT * FROM users where cin = ?");
	$repu->execute(array($_POST["cin"]));
	$countu=$repu->rowCount();
	if($count==1)
	{
		$err = "This username is alreadyexist. Enter another one !";
	}
	elseif ($countu==1) {
		$erru =  "Enter YOUR CIN !!";
	}
	else
	{
		$insa=$bdd->prepare("INSERT INTO `users`(`username`, `password`, `cin`, `phone`, `email`, `address`, `role`) VALUES (?,?,?,?,?,?,?)");
		$insa->execute(array($_POST["username"],$_POST["username"].$_POST["cin"],$_POST["cin"],$_POST["phone"],$_POST["mail"],$_POST["adresse"],"null"));
		$val =  "He has been added successfully.";
	}
}

if(isset($_POST["user"]) && isset($_POST["CIN"]) && isset($_POST["mail"]) && isset($_POST["phone"]) && isset($_POST["adress"]) && isset($_POST["gestion"]))
{
	$rep=$bdd->prepare("SELECT * FROM users where username = ?");
	$rep->execute(array($_POST["user"]));
	$count=$rep->rowCount();
	$repbu=$bdd->prepare("SELECT * FROM users where cin = ?");
	$repbu->execute(array($_POST["CIN"]));
	$countbc=$repbu->rowCount();
	if($count==1)
	{
		$errb = "This username is alreadyexist. Enter another one !";
	}
	elseif ($countbc==1) {
		$errbc =  "Enter YOUR CIN !!";
	}
	else
	{
		$insb=$bdd->prepare("INSERT INTO `users`(`username`, `password`, `cin`, `phone`, `email`, `address`, `role`) VALUES (?,?,?,?,?,?,?)");
		$insb->execute(array($_POST["user"],$_POST["user"].$_POST["CIN"],$_POST["CIN"],$_POST["phone"],$_POST["mail"],$_POST["adress"],$_POST["gestion"]));
		$valb="OK";
	}
}

$repp=$bdd->prepare("SELECT * FROM users WHERE role = ?");
$repp->execute(array("chef"));
$donn=$repp->fetch();
$rec=$donn["username"];

if(isset($_POST["mod"]))
{
	$repm=$bdd->prepare("SELECT * FROM users WHERE role = ?");
	$repm->execute(array("chef"));
	$don=$repm->fetch();
	if($_POST["passo"]==$don["password"])
	{
		if($_POST["passn"]==$_POST["passc"])
		{
			$mod=$bdd->prepare("UPDATE `users` SET `password`=? WHERE role=?");
			$mod->execute(array($_POST["passn"],"chef"));
			$valpn="nice";
		}
		else
		{
			$errn="oups";
		}
	}
	else
	{
		$erro="oups";
	}
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Home</title>
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
 
</head>
<style type="text/css">
	@import "https://use.fontawesome.com/releases/v5.5.0/css/all.css";
	*
	{
		margin : 0;
		padding: 0;
		box-sizing: border-box;
	}

	body
	{
		background: rgb(255,221,187);
	}

	.sec
	{
		background-image: url("book.jpg");
		height: 600px;
		background-repeat: no-repeat;
		background-position: center;
	}

	.sec h1
	{
		color: rgb(147,73,0);
		font-size: 60px;
		font-weight: normal;
		margin-top: 40px;
		text-align: center;
		animation-name: example;
  		animation-duration: 4s;
	}

	@keyframes example {
		from {margin-left: -1310px;}
		to {text-align: center;}
	}

	.sec p
	{
		color: white;
		line-height: 30px;
		font-size: 30px;
		text-align: center;
		font-weight: bold;
		animation-name: examplee;
		animation-duration: 4s;
	}

	@keyframes examplee {
		from {margin-left: -1310px;}
		to {text-align: center;}
	}

	.emojis
	{
		margin-top: 20px;
	}

	.dis
	{
		margin-top: 30px;
		display: flex;
		justify-content: space-around;
	}

	.dis p
	{
		border-top: 6px solid rgb(128,64,0);
		background: white;
		padding: 15px;
		font-size: 19px;
	}

	footer
	{
		background: rgb(191,96,0);
		color: white;
		text-align: right;
		height: 28px;
	}

	footer p
	{
		margin-top: 20px;
	}

	.modal-bg
	{
		position: fixed;
		width: 100%;
		height: 100vh;
		top: 0;
		left: 0;
		background-color: rgb(0,0,0,0.5);
		display: flex;
		justify-content: center;
		align-items: center;
		visibility: hidden;
		opacity: 0;
		transition: visibility 0.5s, opacity 0.5s;
	}

	.bg-active
	{
		visibility: visible;
		opacity: 1;
	}

	.modal
	{
		position: relative; 
		padding: 12px;
		background: rgb(106,73,43);
		width: 30%;
		height: 95%;
		display: flex;
		justify-content: center;
		align-items: center; 
		flex-direction: column;
		text-align: center;
		border-radius: 8px;
	}

	.modal-close
	{
		position: absolute;
		top: 10px;
		right: 10px;
		font-weight: bold;
		cursor: pointer;
	}

	.modal tr
	{
		height: 40px;
		color: white;
	}

	.modal .inp1
	{
		font-size: 17px;
	}

	.modal label
	{
		font-size: 17px;
	}

	.modal .inp2
	{
		width: 200px;
		height: 150px;
	}

	.modal h1
	{
		color: #e3d18a;
		font-family: cursive;
	}

	.modal .btn
	{
		padding: 5px;
		background: #e3d18a;
		width: 100px;
		cursor: pointer;
		border-radius: 3px;
		font-weight: bold;
		font-size: 17px;
	}

	.ajoutadh
	{
		position: fixed;
		width: 100%;
		height: 100vh;
		top: 0;
		left: 0;
		background: rgb(0,0,0,0.5);
		display: flex;
		justify-content: center;
		align-items: center;
		visibility: hidden;
		opacity: 0;
		transition: visibility 0.5s, opacity 0.5s;
	}

	.bg-act
	{
		visibility: visible;
		opacity: 1;
	}

	.formadh
	{
		position: relative;
		padding: 12px;
		background: rgb(106,73,43);
		width: 30%;
		height: 43%;
		display: flex;
		justify-content: center;
		align-items: center; 
		flex-direction: column;
		text-align: center;
		border-radius: 8px;
	}

	.formadh tr
	{
		height: 40px;
		color: white;
	}

	.formadh label
	{
		font-size: 17px;
	}

	.formadh .inp1
	{
		font-size: 17px;
	}

	.ajoutadh h1
	{
		color: #e3d18a;
		font-family: cursive;
	}

	.formadh .inp2
	{
		padding: 5px;
		background: #e3d18a;
		width: 100px;
		cursor: pointer;
		border-radius: 3px;
		font-weight: bold;
		font-size: 17px;
	}

	.ajoutadh-close
	{
		position: absolute;
		top: 10px;
		right: 10px;
		font-weight: bold;
		cursor: pointer;
	}

	.ajoutb
	{
		position: fixed;
		width: 100%;
		height: 100vh;
		top: 0;
		left: 0;
		background: rgb(0,0,0,0.5);
		display: flex;
		justify-content: center;
		align-items: center;
		visibility: hidden;
		opacity: 0;
		transition: visibility 0.5s, opacity 0.5s;
	}

	.bg-ac
	{
		visibility: visible;
		opacity: 1;
	}

	.formb
	{
		position: relative;
		padding: 12px;
		background: rgb(106,73,43);
		width: 30%;
		height: 57%;
		display: flex;
		justify-content: center;
		align-items: center; 
		flex-direction: column;
		text-align: center;
		border-radius: 8px;
	}

	.formb tr
	{
		height: 40px;
		color: white;
	}

	.formb h1
	{
		color: #e3d18a;
		font-family: cursive;
	}

	.formb label
	{
		font-size: 17px;
	}

	.formb .inp1
	{
		font-size: 17px;
	}

	.formb .inp2
	{
		padding: 5px;
		background: #e3d18a;
		width: 100px;
		cursor: pointer;
		border-radius: 3px;
		font-weight: bold;
		font-size: 17px;
	}

	.modp
	{
		position: fixed;
		width: 100%;
		height: 100vh;
		top: 0;
		left: 0;
		background: rgb(0,0,0,0.5);
		display: flex;
		justify-content: center;
		align-items: center;
		visibility: hidden;
		opacity: 0;
		transition: visibility 0.5s, opacity 0.5s;
	}

	.bg-a
	{
		visibility: visible;
		opacity: 1;
	}

	.formp
	{
		position: relative;
		padding: 12px;
		background: rgb(106,73,43);
		width: 28%;
		height: 40%;
		display: flex;
		justify-content: center;
		align-items: center; 
		flex-direction: column;
		text-align: center;
		border-radius: 8px;
	}

	.formp tr
	{
		height: 40px;
		color: white;
	}

	.formp h1
	{
		color: #e3d18a;
		font-family: cursive;
	}

	.formp label
	{
		font-size: 17px;
	}

	.formp .inp1
	{
		font-size: 17px;
	}

	.formp .inp2
	{
		padding: 5px;
		background: #e3d18a;
		width: 100px;
		cursor: pointer;
		border-radius: 3px;
		font-weight: bold;
		font-size: 17px;
	}

	@media screen and (max-width: 1400px)
	{

		.formbn,.formadh
		{
			width: 60%;
			height: 75%;
		}

		.formb h1
		{
			color: #e3d18a;
			font-family: cursive;
			font-size: 20px;
		}

		.formb label
		{
			font-size: 13px;
		}

		.formb .inp1
		{
			font-size: 13px;
		}

		.formb .inp2
		{
			padding: 5px;
			background: #e3d18a;
			width: 100px;
			cursor: pointer;
			border-radius: 3px;
			font-weight: bold;
			font-size: 13px;
		}

		.formadh label
		{
			font-size: 13px;
		}

		.formadh .inp1
		{
			font-size: 13px;
		}

		.ajoutadh h1
		{
			color: #e3d18a;
			font-family: cursive;
			font-size: 20px;
		}

		.formadh .inp2
		{
			padding: 5px;
			background: #e3d18a;
			width: 100px;
			cursor: pointer;
			border-radius: 3px;
			font-weight: bold;
			font-size: 13px;
		}

		.modal
		{
			height: 100%;
			width: 60%;
		}

		.modal tr
		{
			height: 15px;
			color: white;
		}

		.modal .inp1
		{
			font-size: 10px;
		}

		.modal label
		{
			font-size: 10px;
		}

		.modal .inp2
		{
			width: 150px;
			height: 100px;
		}

		.modal h1
		{
			color: #e3d18a;
			font-family: cursive;
			font-size: 18px;
		}

		.modal .btn
		{
			padding: 5px;
			background: #e3d18a;
			width: 100px;
			cursor: pointer;
			border-radius: 3px;
			font-weight: bold;
			font-size: 13px;
		}

		.formp h1
		{
			color: #e3d18a;
			font-family: cursive;
			font-size: 20px;
		}

		.formp label
		{
			font-size: 13px;
		}

		.formp .inp1
		{
			font-size: 13px;
		}

		.formp .inp2
		{
			padding: 5px;
			background: #e3d18a;
			width: 100px;
			cursor: pointer;
			border-radius: 3px;
			font-weight: bold;
			font-size: 13px;
		}

		.formp
		{
			width: 60%;
			height: 60%;
		}

	}

	@media screen and (max-width: 900px)
	{
		.emojis
		{
			display: none;
		}
		.dis
		{
			display: block;
			text-align: center;
		}
		.limen
		{
			color: red;
		}
	}
</style>
<body>
	<nav class="navbar navbar-expand-lg navbar-light" style="background-color: rgb(202,101,0);color: white;">
	  <a class="navbar-brand" href="home.php" style="color: white;font-size: 30px">Admin</a>
	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
	    <span class="navbar-toggler-icon"></span>
	  </button>

	  <div class="collapse navbar-collapse" id="navbarSupportedContent" >
	    <ul class="navbar-nav mr-auto">
	      <li class="nav-item">
	        <a class="nav-link" href="home.php" style="color: white;">Home</a>
	      </li>
	      <li class="nav-item">
	        <a class="nav-link" style="color: white;" href="emprunt.php">Emprunt</a>
	      </li>
	      <li class="nav-item dropdown">
	        <a style="color: white;" class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	          List
	        </a>
	        <div style="background-color: rgb(202,101,0);" class="dropdown-menu" aria-labelledby="navbarDropdown">
	          <a style="text-decoration: none;color: white;padding: 5px" href="listlivre.php">Livres</a><br/><br/>
	          <a style="text-decoration: none;color: white;padding: 5px" href="listadh.php">Adhérents</a><br/><br/>
	          <a style="text-decoration: none;color: white;padding: 5px" href="listb.php">Bibliothécaires</a><br/><br/>
	        </div>
	      </li>
	      <li class="nav-item dropdown">
	        <a style="color: white;" class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	          Ajouter
	        </a>
	        <div style="background-color: rgb(202,101,0);" class="dropdown-menu" aria-labelledby="navbarDropdown">
	          <a id="ajout" style="text-decoration: none;color: white;padding: 5px;cursor: pointer;">Livres</a><br/><br/>
	          <a id="ajouta" style="text-decoration: none;color: white;padding: 5px;cursor: pointer;">Adhérents</a><br/><br/>
	          <a id="ajoutb" style="text-decoration: none;color: white;padding: 5px;cursor: pointer;" >Bibliothécaires</a><br/><br/>
	        </div>
	      </li>
	      <li class="nav-item">
	        <a id="profil" class="nav-link" style="cursor: pointer;color: white;">Profil</a>
	      </li>
	    </ul>
	    <form class="form-inline my-2 my-lg-0">
	      <a style="color: white; text-decoration: none;" href="index.php" type="submit">Se deconnecter</a>
	    </form>
	  </div>
	</nav>

	<div class="sec">
		<span style="opacity: 0;">d</span>
		<h1>Bienvenu !</h1>
		<br/>
		<br/>
		<br/>
		<p>La lecture est importante. Si vous savez lire, alors le monde s'ouvre à vous.</p>
		<br/>
		<br/>
		<p>La lecture nous ouffre un endroit où aller losrque nous devons rester où nous sommes.</p>
		<br/>
		<br/>
		<p>La plus belle parselle pour atteindre la connaissance est la lecture</p>
		<br/>
		<br/>
		<p>Seuls la lecture et le savoir donnent les belles manières de l'esprit</p>
		<br/>
		<br/>
	</div>

	<div class="dis">
		<p>Gestion des Livres</p>
		<br/>
		<p>Gestion des Adhérents</p>
		<br/>
		<p>Gestion des Emprunts</p>
	</div>

	<div class="modal-bg">
		<form class="modal" action="home.php" method="post">
			<h1>Ajouter un livre</h1>
			<p>
				<?php
				 if(isset($erri))
				 {?>
				 	
				 	<script>swal('OUPS!', 'This ISBN is already exist. Enter another one !', 'error');</script>
				 <?php
				}
				?>
				<?php
				 if(isset($vali))
				 {?>
				 	
				 	<script>swal('Good!', 'This book has been added !', 'success');</script>
				 <?php	
				 }
				?>
			</p>
			<table>
				<tr>
					<td align="right"><label>Titre : </label></td>
					<td><input class="inp1" type="text" name="titre" required=""></td>
				</tr>
				<tr>
					<td align="right"><label>Auteur : </label></td>
					<td><input class="inp1" type="text" name="auteur" required=""></td>
				</tr>
				<tr>
					<td align="right"><label>Code ISBN : </label></td>
					<td><input class="inp1" type="text" name="isbn" required=""></td>
				</tr>
				<tr>
					<td align="right"><label>Genre : </label></td>
					<td><input class="inp1" type="text" name="genre" required=""></td>
				</tr>
				<tr>
					<td align="right"><label>Editeur : </label></td>
					<td><input class="inp1" type="text" name="editeur" required=""></td>
				</tr>
				<tr>
					<td align="right"><label>Prix : </label></td>
					<td><input class="inp1" type="text" name="prix" required=""></td>
				</tr>
				<tr>
					<td align="right"><label>Nombre de pages : </label></td>
					<td><input class="inp1" type="text" name="page" required=""></td>
				</tr>
				<tr>
					<td align="right"><label>Quantité totale : </label></td>
					<td><input class="inp1" type="text" name="qtetotal" required=""></td>
				</tr>
				<tr>
					<td align="right"><label>Quantité disponible : </label></td>
					<td><input class="inp1" type="text" name="qtedispo" required=""></td>
				</tr>
				<tr>
					<td align="right"><label>Anneé de parution : </label></td>
					<td><input class="inp1" type="date" name="date" required=""></td>
				</tr>
				<tr>
					<td align="right"><label>Résumé : </label></td>
					<td><textarea name="resume" required="" class="inp2"></textarea></td>
				</tr>
				<tr hidden>
					<td align="right"><label>Image : </label></td>
					<td><input type="file" name="image" hidden></td>
				</tr>
			</table>
			<br/>
			<input class="btn" type="submit" value="Ajouter">
			<span style="background: red; color: white; width: 20px;" id="close" class="modal-close">X</span>
		</form>
	</div>

	<div class="ajoutadh">
		<form class="formadh" action="home.php" method="post">
			<h1>Ajouter un adhérent</h1>
			<p>
				<?php
				 if(isset($err))
				 {?>
				 	
				 	<script>swal('OUPS!', 'This usrname is already exist. Enter another one !', 'error');</script>
				 <?php
				}
				?>
				<?php
				 if(isset($val))
				 {?>
				 	
				 	<script>swal('Good job!', 'He has been added !', 'success');</script>
				 <?php	
				 }
				?>
				<?php
				if(isset($erru))
				 {?>
				 	<script>swal('OUPS', "I think it's not his CIN !", 'error');</script>
				 <?php	
				 }
				?>
			</p>
			<span id="ver"></span>
			<table>
				<tr>
					<td align="right"><label>Username : </label></td>
					<td><input class="inp1" ype="text" name="username" id="username" required=""></td>
				</tr>
				<tr>
					<td align="right"><label>Email : </label></td>
					<td><input class="inp1" type="email" name="mail" ismap="mail" required=""></td>
				</tr>
				<tr>
					<td align="right"><label>Phone : </label></td>
					<td><input class="inp1" type="text" name="phone" id="phone" required=""></td>
				</tr>
				<tr>
					<td align="right"><label>Adresse : </label></td>
					<td><input class="inp1" type="text" name="adresse" id="adresse" required=""></td>
				</tr>
				<tr>
					<td align="right"><label>CIN : </label></td>
					<td><input class="inp1" type="text" name="cin" id="cin" required=""></td>
				</tr>
			</table>
			<input class="inp2" type="submit" name="Ajouter">	
			<span style="background: red; color: white; width: 20px;" id="closea" class="ajoutadh-close">X</span>	
		</form>
	</div>
		
	<div class="ajoutb">
		<form class="formb" action="home.php" method="post">
			<h1>Ajouter un bibliothécaire</h1>
			<p>
				<?php
				 if(isset($errb))
				 {?>
				 	<script>swal('OUPS!', 'This usrname is already exist. Enter another one !', 'error');</script>
				 <?php
				}
				?>
				<?php
				 if(isset($valb))
				 {?>
				 	
				 	<script>swal('Good job!', 'He has been added !', 'success');</script>
				 <?php	
				 }
				?>
				<?php
				if(isset($errbc))
				 {?>
				 	<script>swal('OUPS', "I think it's not his CIN !", 'error');</script>
				 <?php	
				 }
				?>
			</p>
			<table>
				<tr>
					<td align="right"><label>Username : </label></td>
					<td><input class="inp1" type="text" name="user" required=""></td>
				</tr>
				<tr>
					<td align="right"><label>CIN : </label></td>
					<td><input class="inp1" type="text" name="CIN" required=""></td>
				</tr>
				<tr>
					<td align="right"><label>Email : </label></td>
					<td><input class="inp1" type="email" name="mail" required=""></td>
				</tr>
				<tr>
					<td align="right"><label>Phone : </label></td>
					<td><input class="inp1" type="text" name="phone" required=""></td>
				</tr>
				<tr>
					<td align="right"><label>Adresse : </label></td>
					<td><input class="inp1" type="text" name="adress" required=""></td>
				</tr>
				<tr>
					<td align="right"><label>Role : </label></td>
					<td>
						<select class="inp1" name="gestion">
							<option value="">Selectionner un role</option>
							<option value="Gestionnaire d'Adhérents">Gestionnaire d'Adhérents</option>
							<option value="Gestionnaire d'Achats">Gestionnaire d'Achats</option>
							<option value="Gestionnaire d'Emprunts">Gestionnaire d'Emprunts</option>
						</select>
					</td>
				</tr>
			</table>
			<input class="inp2" type="submit" value="Ajouter">
			<span style="background: red; color: white; width: 20px;" id="closeb" class="ajoutadh-close">X</span>	
		</form>
	</div>

	<div class="modp">
		<form class="formp" action="home.php" method="post">
			<h1>Modifier mon profil</h1>
			<p>
				<?php
				 if(isset($erro))
				 {?>
				 	<script>swal('OUPS!', 'This is not your old password !', 'error');</script>
				 <?php
				}
				?>
				<?php
				 if(isset($valpn))
				 {?>
				 	
				 	<script>swal('Good job!', 'Your password has been changed successfully.', 'success');</script>
				 <?php	
				 }
				?>
				<?php
				if(isset($errn))
				 {?>
				 	<script>swal('OUPS', "Passwords don't appear to match !", 'error');</script>
				 <?php	
				 }
				?>
			</p>
			</p>
			<table>
				<tr>
					<td align="right"><label>Username : </label></td>
					<td><input disabled="true" class="inp1" type="test" name="user" required="" value=<?php if(isset($rec)) echo $rec;?>></td>
				</tr>
				<tr>
					<td align="right"><label>Old password : </label></td>
					<td><input class="inp1" type="password" name="passo" required=""></td>
				</tr>
				<tr>
					<td align="right"><label>New password : </label></td>
					<td><input class="inp1" type="password" name="passn" required=""></td>
				</tr>
				<tr>
					<td align="right"><label>Confirm password : </label></td>
					<td><input class="inp1" type="password" name="passc" required=""></td>
				</tr>
			</table>
			<input class="inp2" type="submit" name="mod" value="Modifier">
			<span style="background: red; color: white; width: 20px;" id="closep" class="ajoutadh-close">X</span>	
		</form>
	</div>

	<footer>
		<p>Powered By : Hamza Filali © 2021</p>
	</footer>
</body>
<script type="text/javascript">
	var ajout = document.getElementById("ajout");
	var ajouta = document.getElementById("ajouta");
	var ajoutb = document.getElementById("ajoutb");
	var profil = document.getElementById("profil");
	var close = document.getElementById("close");
	var closea = document.getElementById("closea");
	var closeb = document.getElementById("closeb");
	var closep = document.getElementById("closep");
	var modalbg = document.querySelector(".modal-bg");
	var ajoutadh = document.querySelector(".ajoutadh");
	var ajoutbib = document.querySelector(".ajoutb");
	var modp = document.querySelector(".modp");
	
	ajout.addEventListener("click",function(){
			modalbg.classList.add("bg-active");
		});

	ajouta.addEventListener("click",function(){
			ajoutadh.classList.add("bg-act");
		});

	ajoutb.addEventListener("click",function(){
			ajoutbib.classList.add("bg-ac");
		});

	profil.addEventListener("click",function(){
			modp.classList.add("bg-a");
		});

	close.addEventListener("click",function(){
			modalbg.classList.remove("bg-active");
		});

	closea.addEventListener("click",function(){
			ajoutadh.classList.remove("bg-act");
		});

	closeb.addEventListener("click",function(){
			ajoutbib.classList.remove("bg-ac");
		});

	closep.addEventListener("click",function(){
			modp.classList.remove("bg-a");
		});
</script>
</html>
