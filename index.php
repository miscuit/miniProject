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
$nomErr = $prenomErr = $emailErr = $countryErr = $bioErr = $cvErr = $urlErr = $talentErr = $dateErr = "";
$langueErr = $pfeErr = $hexaErr = $ipErr = $phoneErr = $ocupationErr = $affiliationsErr = "";
$nom = $prenom = $cv = $affiliations = $occupation = $date = $pfe = $hexa = $url = $ip = $phone = $langage = $age = $email = "";
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
        $nomErr = "Saisissez votre prénom";
    } else {
        $nom = verifier($_POST["first_name"]);
        if (!preg_match("/^[a-zA-Z-' ]*$/", $nom)) {
            $nomErr = "Seules les lettres sont autorisées.";
            $bd = 0;
        }
    }

    if (empty($_POST['last_name'])) {
        $bd = 0;
        $prenomErr = "Saisissez votre nom";
    } else {
        $prenom = verifier($_POST["last_name"]);
        if (!preg_match("/^[a-zA-Z-' ]*$/", $prenom)) {
            $prenomErr = "Seules les lettres sont autorisées.";
            $bd = 0;
        }
    }
    if (empty($_POST['email'])) {
        $emailErr = "Saisissez votre Adresse E-mail";
        $bd = 0;
    } else {
        $email = verifier($_POST["email"]);
        if (!preg_match("/^[a-zA-Z0-9 ]*.@fso\.ump\.ma$/", $email)) {
            $emailErr = "E-mail invalide.";
            $bd = 0;
        }
    }
    if ((empty($_POST['country'])) || ($_POST['country'] == "")) {
        $countryErr = "Sélectionnez une ville";
        $bd = 0;
    } else {
        $country = $_POST['country'];
    }
    if (empty($_POST['bio'])) {
        $bd = 0;
        $cvErr = "Ecrire votre CV";
    } else {
        $cv = verifier($_POST["bio"]);
        if (!preg_match("/^[a-zA-Z-': ]*$/", $cv)) {
            $bd = 0;
            $cvErr = "Seules les lettres et les charactères spéciaux sont autorisés.";
        }
    }
    if (empty($_POST['phone'])) {
        $phoneErr = "Saisissez votre Numero de Téléphone";
        $bd = 0;
    } else {
        $phone = verifier($_POST['phone']);
        if (!preg_match('/^\+212[567][0-9]{8}+$/', $phone)) {
            $phoneErr = "Numéro de téléphone invalide.";
            $bd = 0;
        }
    }
    if (empty($_POST['affiliations'])) {
        $affiliationsErr = "Ecrire votre affiliations";
        $bd = 0;
    } else {
        $affiliations = verifier($_POST["affiliations"]);
        if (!preg_match("/^[a-zA-Z-': ]*$/", $cv)) {
            $bd = 0;
            $affiliationsErr= "Seules les lettres et les charactères spéciaux sont autorisés.";
        }
    }
    if ((empty($_POST['occupation'])) || ($_POST['occupation'] == "")) {
        $ocupationErr = "Choisissez une matière";
        $bd = 0;
    } else {
        $occupation = $_POST['occupation'];
    }
    if (empty($_POST['cat_name'])) {
        $hexaErr = "Sasissez un hexadécimale";
        $bd = 0;
    } else {
        $hexa = verifier($_POST["cat_name"]);
        if (!preg_match("/^[A-F0-9]*$/", $hexa)) {
            $bd = 0;
            $hexaErr = "Nombre invalide.";
        }
    }
    if (empty($_POST['gagdet'])) {
        $ipErr = "Saisissez une adresse IP";
        $bd = 0;
    } else {
        $ip = verifier($_POST["gagdet"]);
        if (!filter_var($ip, FILTER_VALIDATE_IP)) {
            $bd = 0;
            $ipErr = "Adresse IP invalide";
        }
    }
    if ((empty($_POST['talent'])) || $_POST['talent'] == "") {
        $bd = 0;
        $talentErr = "Séléctionnez un langage";
    } else {
        $talent = $_POST['talent'];
    }

    if (empty($_POST["drink"])) {
        $bd = 0;
        $urlErr = "Saisissez un URL";
    } else {
        $url = verifier($_POST["drink"]);
        if (!filter_var($url, FILTER_VALIDATE_URL)) {
            $bd = 0;
            $urlErr = "URL invalide.";
        }
    }
    if (empty($_POST['date'])) {
        $bd = 0;
        $dateErr = "Entrez votre date de naissance";
    } else {
        $daten = explode('-', $_POST['date']);
        $mois = $daten[1];
        $jour = $daten[2];
        $annee = $daten[0];
        if (count($daten) == 3 && checkdate($mois, $jour, $annee)) {
            $date = $_POST['date'];
        } else {
            $bd = 0;
            $dateErr = 'Date invalide.';
        }
    }
    if (empty($_POST['weapon'])) {
        $bd = 0;
        $langueErr = "Saisissez votre langage prefere";
    } else {
        $langage = ($_POST['weapon']);
        if (!preg_match("/^[a-zA-Z-' ]*$/", $langage)) {
            $nomErr = "Seules les lettres sont autorisées.";
            $bd = 0;
        }
    }
    if (empty($_POST['comments'])) {
        $pfeErr = "Décrivez votre PFE";
        $bd = 0;
    } else {
        $pfe = verifier($_POST["comments"]);
        if (!preg_match("/^[a-zA-Z-':,\. \-]*$/", $pfe)) {
            $bd = 0;
            $pfeErr = "Seules les lettres sont autorisées.";
        }
    }

    if ($bd==1){
		$servername = "localhost";
		$username = "ayaberroukech";
		$password = "ayaberroukech";
		$dbname="tpwebav";
		try {
			$conn = new PDO("mysql:host=$servername;dbname=$dbname", 
			$username, $password);
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			var_dump($conn);
			$sql = "INSERT INTO 
			projettp(nom,prenom,email,country,cv,phone,affiliations,occupation,hexa,ip,talent,url,date,langage,pfe)VALUES 
			('$nom','$prenom','$email','$country','$cv','$phone','$affiliations','$occupation','$hexa','$ip','$talent,$url,$date,$langage,$pfe','$url','$date','$langage','$pfe')";
			$conn->exec($sql);
		
		}
		catch(PDOException $e) {
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
        <form class="cbp-mc-form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                <div class="cbp-mc-column">
                    <label for="first_name"> Nom</label>
                    <input type="text" id="first_name" name="first_name" placeholder="Berroukech">
                    <span class="error"><?php echo "$nomErr";?></span>
                    <label for="last_name">Prénom</label>
                    <input type="text" id="last_name" name="last_name" placeholder="Aya">
                    <span class="error"><?php echo "$prenomErr";?></span>
                    <label for="email">Email Address</label>
                    <input type="text" id="email" name="email" placeholder="aya@fso.ump.ma">
                    <span class="error"><?php echo $emailErr;?></span>
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
                    <span class="error"><?php echo $countryErr;?></span>
                    <label for="bio">CV</label>
                    <textarea id="bio" name="bio"></textarea>
                    <span class="error"><?php echo $cvErr;?></span>
                </div>
                <div class="cbp-mc-column">
                    <label for="phone">Numero de telephone</label>
                    <input type="text" id="phone" name="phone" placeholder="+212 999 999">
                    <span class="error"><?php echo $phoneErr;?></span>
                    <label for="affiliations">Affiliations</label>
                    <textarea id="affiliations" name="affiliations"></textarea>
                    <span class="error"><?php echo $affiliationsErr;?></span>
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
                    <span class="error"><?php echo $ocupationErr;?></span>
                    <label for="cat_name">choisir un nombre Hexadicimale</label>
                    <input type="text" id="cat_name" name="cat_name" placeholder="F0A3">
                    <span class="error"><?php echo $hexaErr;?></span>
                    <label for="gagdet">Choisir une adresse IP</label>
                    <input type="text" id="gagdet" name="gagdet" placeholder="193.200.10.132">
                    <span class="error"><?php echo $ipErr;?></span>
                </div>
                <div class="cbp-mc-column">
                    <label>Vos talents en programmation</label>
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
                    <span class="error"><?php echo $talentErr;?></span>
                    <label for="drink">Site web URL</label>
                    <input type="text" id="drink" name="drink" placeholder="www.fso.ump.ma">
                    <span class="error"><?php echo $urlErr;?></span>
                    <label for="power">Votre date de naissance</label>
                    <span class="error"><?php echo $dateErr;?></span>
                    <input type="text" id="power" name="power" placeholder="01/01/2000">
                    <label for="weapon">Langage de Programation préféré</label>
                    <input type="weapon" id="weapon" name="weapon" placeholder="PHP">
                    <span class="error"><?php echo $langueErr;?></span>
                    <label for="comments">Dites A propos de votre PFE</label>
                    <textarea id="comments" name="comments"></textarea>
                    <span class="error"><?php echo $pfeErr;?></span>
                </div>
                <div class="cbp-mc-submit-wrap"><input class="cbp-mc-submit" type="submit" value="Enregistrer " /></div>
            </form>
        </div>
    </div>
</body>
</html>