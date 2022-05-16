<!DOCTYPE html>
<html lang="FR" class="no-js">

<head>
	<meta charset="UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Projet TP Formulaire</title>
	<meta name="description" content="Blueprint: Blueprint: Responsive Multi-Column Form" />
	<meta name="keywords" content="responsive form, inputs, html5, responsive, multi-column, fluid, media query, template" />
	<meta name="author" content="Codrops" />
	<link rel="shortcut icon" href="../favicon.ico">
	<link rel="stylesheet" type="text/css" href="css/default.css" />
	<link rel="stylesheet" type="text/css" href="css/component.css" />
	<script src="js/modernizr.custom.js"></script>
</head>
<?php
$errnom = $errprenom = $erremail = $errcountry = $errbio = $errcv = $errurl = $errtalent = $errdate = "";
$errlangue = $errpfe = $errhexa = $errip = $errphone = $erroccupation = $erraffliations = "";
$nom = $prenom = $cv = $affiliations = $occupation = $date = $pfe = $hexa = $url = $ip = $phone = $lang = $age = $email = "";
$bd = 0;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$bd = 1;
	function verifier($data)
	{
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
	if (empty($_POST['first_name'])) {
		$bd = 0;
		$errnom = "Saisissez votre prénom";
	} else {
		$nom = verifier($_POST["first_name"]);
		if (!preg_match("/^[a-zA-Z-' ]*$/", $nom)) {
			$errnom = "Seules les lettres sont autorisées.";
			$bd = 0;
		}
	}

	if (empty($_POST['last_name'])) {
		$bd = 0;
		$errprenom = "Saisissez votre nom";
	} else {
		$prenom = verifier($_POST["last_name"]);
		if (!preg_match("/^[a-zA-Z-' ]*$/", $prenom)) {
			$errprenom = "Seules les lettres sont autorisées.";
			$bd = 0;
		}
	}
	if (empty($_POST['email'])) {
		$erremail = "Saisissez votre Adresse E-mail";
		$bd = 0;
	} else {
		$email = verifier($_POST["email"]);
		if (!preg_match("/^[a-zA-Z0-9 ]*.@fso\.ump\.ma$/", $email)) {
			$erremail = "E-mail invalide.";
			$bd = 0;
		}
	}
	if ((empty($_POST['country'])) || ($_POST['country'] == "")) {
		$errcountry = "Sélectionnez une ville";
		$bd = 0;
	} else {
		$country = $_POST['country'];
	}
	if (empty($_POST['bio'])) {
		$bd = 0;
		$errcv = "Ecrire votre CV";
	} else {
		$cv = verifier($_POST["bio"]);
		if (!preg_match("/^[a-zA-Z-': ]*$/", $cv)) {
			$bd = 0;
			$errcv = "Seules les lettres et les charactères spéciaux sont autorisés.";
		}
	}
	if (empty($_POST['phone'])) {
		$errphone = "Saisissez votre Numero de Téléphone";
		$bd = 0;
	} else {
		$phone = verifier($_POST['phone']);
		if (!preg_match('/^\+212[567][0-9]{8}+$/', $phone)) {
			$errphone = "Numéro de téléphone invalide.";
			$bd = 0;
		}
	}
	if (empty($_POST['affiliations'])) {
		$erraffliations = "Ecrire votre affiliations";
		$bd = 0;
	} else {
		$affiliations = verifier($_POST["affiliations"]);
		if (!preg_match("/^[a-zA-Z-': ]*$/", $cv)) {
			$bd = 0;
			$erraffliation = "Seules les lettres et les charactères spéciaux sont autorisés.";
		}
	}
	if ((empty($_POST['occupation'])) || ($_POST['occupation'] == "")) {
		$erroccupation = "Choisissez une matière";
		$bd = 0;
	} else {
		$occupation = $_POST['occupation'];
	}
	if (empty($_POST['cat_name'])) {
		$errhexa = "Sasissez un hexadécimale";
		$bd = 0;
	} else {
		$hexa = verifier($_POST["cat_name"]);
		if (!preg_match("/^[A-F0-9]*$/", $hexa)) {
			$bd = 0;
			$errhexa = "Nombre invalide.";
		}
	}
	if (empty($_POST['gagdet'])) {
		$errip = "Saisissez une adresse IP";
		$bd = 0;
	} else {
		$ip = verifier($_POST["gagdet"]);
		if (!filter_var($ip, FILTER_VALIDATE_IP)) {
			$bd = 0;
			$errip = "Adresse IP invalide";
		}
	}
	if ((empty($_POST['talent'])) || $_POST['talent'] == "") {
		$bd = 0;
		$errtalent = "Séléctionnez un langage";
	} else {
		$talent = $_POST['talent'];
	}

	if (empty($_POST["drink"])) {
		$bd = 0;
		$errurl = "Saisissez un URL";
	} else {
		$url = verifier($_POST["drink"]);
		if (!filter_var($url, FILTER_VALIDATE_URL)) {
			$bd = 0;
			$errurl = "URL invalide.";
		}
	}
	if (empty($_POST['date'])) {
		$bd = 0;
		$errdate = "Entrez votre date de naissance";
	} else {
		$daten = explode('-', $_POST['date']);
		$mois = $daten[1];
		$jour = $daten[2];
		$annee = $daten[0];
		if (count($daten) == 3 && checkdate($mois, $jour, $annee)) {
			$date = $_POST['date'];
		} else {
			$bd = 0;
			$errdate = 'Date invalide.';
		}
	}
	if (empty($_POST['weapon'])) {
		$bd = 0;
		$errlangage = "Saisissez votre langage prefere";
	} else {
		$langage = ($_POST['weapon']);
		if (!preg_match("/^[a-zA-Z-' ]*$/", $langage)) {
			$errnom = "Seules les lettres sont autorisées.";
			$bd = 0;
		}
	}
	if (empty($_POST['comments'])) {
		$errpfe = "Décrivez votre PFE";
		$bd = 0;
	} else {
		$pfe = verifier($_POST["comments"]);
		if (!preg_match("/^[a-zA-Z-':,\. \-]*$/", $pfe)) {
			$bd = 0;
			$errpfe = "Seules les lettres sont autorisées.";
		}
	}

	if ($bd == 1) {
		$servername = "localhost";
		$username = "missa";
		$password = "missa2209";
		$dbname = "miniproject";
		try {
			$conn = new PDO(
				"mysql:host=$servername;dbname=miniproject",
				$username,
				$password
			);
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			var_dump($conn);
			$sql = "INSERT INTO 
			project(nom,prenom,email,country,cv,phone,affiliations,occupation,hexa,ip,talent,url,date,langagepref,pfe)VALUES 
			('$nom','$prenom','$email','$country','$cv','$phone','$affiliations','$occupation','$hexa','$ip','$talent','$url','$date','$langage','$pfe')";
			$conn->exec($sql);
		} catch (PDOException $e) {
			echo "failed: " . $e->getMessage();
		}
		$conn = null;
	}
}
?>

<body>
	<div class="container">
		<header class="clearfix">
			<span>Projet de TP <span class="bp-icon bp-icon-about" data-content="Ajouter le script PHP avec les filtres et les fonctions expression regulieres qui valident les données saisies dans ce formulaire appliquer aussi les régles de sécurité comme vue au cours"></span></span>
			<h1>Tec Web Avancée Formulaire</h1>
			<nav>
				<a href="http://www.emena.org/SMIS6" class="bp-icon bp-icon-prev" data-info="Site Cours"><span> Ajouter
						le script PHP avec les filtres et les fonctions expression regulieres qui valident les données
						saisies dans ce formulaire appliquer aussi les régles de sécurité comme vue au cours</span></a>
			</nav>
		</header>
		<div class="main">
			<form class="cbp-mc-form">
				<div class="cbp-mc-column">
					<label for="first_name"> Nom</label>
					<input type="text" id="first_name" name="first_name" placeholder="Alaoui">
					<label for="last_name">Prénom</label>
					<input type="text" id="last_name" name="last_name" placeholder="Driss">
					<label for="email">Email Address</label>
					<input type="text" id="email" name="email" placeholder="dris@fso.ump.ma">
					<label for="country">Pays</label>
					<select id="country" name="country">
						<option>Choisir Pays</option>
						<option>Russie</option>
						<option>Maroc</option>
						<option>Ile Comore</option>
						<option>Mali</option>
						<option>Mauritanie</option>
						<option>Madagascare</option>
						<option>Senegal</option>


					</select>
					<label for="bio">CV</label>
					<textarea id="bio" name="bio"></textarea>
				</div>
				<div class="cbp-mc-column">
					<label for="phone">Numero de telephone</label>
					<input type="text" id="phone" name="phone" placeholder="+212 999 999">
					<label for="affiliations">Affiliations</label>
					<textarea id="affiliations" name="affiliations"></textarea>
					<label>les cours</label>
					<select id="occupation" name="occupation">
						<option>Choisir la matière</option>
						<option>Web avancée</option>
						<option>Ad Réseau</option>
						<option>Systeme Exploitation</option>
						<option>Base Données Av</option>
						<option>PFE</option>
						<option>Architecture</option>
						<option>Algoritmique</option>

					</select>
					<label for="cat_name">choisir un nombre Hexadicimale</label>
					<input type="text" id="cat_name" name="cat_name" placeholder="F0A3">
					<label for="gagdet">Choisir une adresse IP</label>
					<input type="text" id="gagdet" name="gagdet" placeholder="193.200.10.132">
				</div>
				<div class="cbp-mc-column">
					<label>Vos talents en programation</label>
					<select id="talent" name="talent">
						<option>le langage Préféré</option>
						<option>Phyton</option>
						<option>C++</option>
						<option>JavaScript</option>
						<option>PHP</option>
						<option>C</option>
						<option>Java</option>
						<option>HTML</option>

					</select>
					<label for="drink">Site web URL</label>
					<input type="text" id="drink" name="drink" placeholder="www.Fso.ump.ma">
					<label for="power">Votre date de naissance</label>
					<input type="text" id="power" name="power" placeholder="la date">
					<label for="weapon">Langage Programation préféré</label>
					<input type="weapon" id="weapon" name="weapon" placeholder="PHP">
					<label for="comments">Dite A propos de votre PFE</label>
					<textarea id="comments" name="comments"></textarea>
				</div>
				<div class="cbp-mc-submit-wrap"><input class="cbp-mc-submit" type="submit" value="Enregistrer " /></div>
			</form>
		</div>
	</div>
</body>

</html>