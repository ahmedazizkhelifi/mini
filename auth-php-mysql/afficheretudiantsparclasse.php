<?php
   session_start();
   $classe=$_POST["classe"];
   if($_SESSION["autoriser"]!="oui"){
      header("location:login.php");
      exit();
   }
   if(date("H")<18)
      $bienvenue="Bonjour et bienvenue ".
      $_SESSION["prenomNom"].
      " dans votre espace personnel";
   else
      $bienvenue="Bonsoir et bienvenue ".
      $_SESSION["prenomNom"].
      " dans votre espace personnel";
   
 


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SCO-ENICAR Etudiants Par CLasse</title>
    <!-- Bootstrap core CSS -->
<link href="./assets/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap core JS-JQUERY -->
<script src="./assets/dist/js/jquery.min.js"></script>
<script src="./assets/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom styles for this template -->
    <link href="./assets/jumbotron.css" rel="stylesheet">
    <link href="./assets/new.css" rel="stylesheet">
    <style>
table, td, th {
  border: 1px solid;
}

table {
  width: 100%;
  border-collapse: collapse;
}
</style>
</head>
<body>
<nav class="navbar navbar-expand-md navbar-dark sticky-top bg-dark new_nav">
  <a class="navbar-brand" href="index.php"><img class ="new_logo"src="../assets/enicar.jpg" alt=""></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarsExampleDefault">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
      </li>
  
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="index.php" id="dropdown01" data-toggle="dropdown" aria-expanded="false">Gestion des Groupes</a>        <div class="dropdown-menu" aria-labelledby="dropdown01">
          <a class="dropdown-item" href="AfficherEtudiants.php">Lister tous les étudiants</a>
          <a class="dropdown-item" href="afficheretudiantsparclasse.php">Etudiants par Groupe</a>
          <a class="dropdown-item" href="ajouterGroupe.php">Ajouter Groupe</a>
          <a class="dropdown-item" href="modiferGroupe.php">Modifier Groupe</a>
          <a class="dropdown-item" href="supprimerGroupe.php">Supprimer Groupe</a>

        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-expanded="false">Gestion des Etudiants</a>
        <div class="dropdown-menu" aria-labelledby="dropdown01">
          <a class="dropdown-item" href="AjouterEtudiant.php">Ajouter Etudiant</a>
          <a class="dropdown-item" href="chercherEtudiant.php">Chercher Etudiant</a>
          <a class="dropdown-item" href="modifierEetudiant.php">Modifier Etudiant</a>
          <a class="dropdown-item" href="supprimerEtudiant.php">Supprimer Etudiant</a>


        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-expanded="false">Gestion des Absences</a>
        <div class="dropdown-menu" aria-labelledby="dropdown01">
          <a class="dropdown-item" href="saisirAbsence.php">Saisir Absence</a>
          <a class="dropdown-item" href="etatAbsence.php">État des absences pour un groupe</a>
        </div>
      </li>

      <li class="nav-item active">
        <a class="nav-link" href="deconnexion.php">Se Déconnecter <span class="sr-only">(current)</span></a>
      </li>

    </ul>
  
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="text" placeholder="Saisir un groupe" aria-label="Chercher un groupe">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Chercher Groupe</button>
    </form>
  </div>
</nav>

<main role="main">
        <div class="jumbotron">
            <div class="container">
              <h1 class="display-4">Afficher la liste d'étudiants par groupe</h1>
              <p>Cliquer sur la liste afin de choisir une classe!</p>
            </div>
          </div>

<div class="container">
<form>
<div class="form-group">
<p id="demo">Liste vide</p>
<label for="classe">Choisir une classe:</label><br>
<!--
<input list="classe">
<datalist id="classe" name="classe">
    <option value="1-INFOA">1-INFOA</option>
    <option value="1-INFOB">1-INFOB</option>
    <option value="1-INFOC">1-INFOC</option>
    <option value="1-INFOD">1-INFOD</option>
    <option value="1-INFOE">1-INFOE</option>
</datalist>
-->
<!--
<select id="classe" name="classe"  class="custom-select custom-select-sm custom-select-lg">
    <option value="1-INFOA">1-INFOA</option>
    <option value="1-INFOB">1-INFOB</option>
    <option value="1-INFOC">1-INFOC</option>
    <option value="1-INFOD">1-INFOD</option>
    <option value="1-INFOE">1-INFOE</option>
</select>-->
<input type="text" class="form-control" name="classe"  placeholder="classe" required autofocus  /><br /><br />
<button  type="submit"  onclick="refresh()" class="btn btn-primary btn-block active">Actualiser</button>
<p id="demo">Liste vide</p>
</div> 
</form>
</div>  
</main>
<script>
    function refresh()
     {
      var xmlhttp = new XMLHttpRequest();
        var url = "http://localhost/mini-projet-info1/auth-php-mysql/afficher.php";

    //Envoie de la requete
	xmlhttp.open("GET",url,true);
	xmlhttp.send();


     //Traiter la reponse
     xmlhttp.onreadystatechange=function()
            {  // alert(this.readyState+" "+this.status);
                if(this.readyState==4 && this.status==200){
                
                    myFunction(this.responseText);
                    alert(this.responseText);
                    console.log(this.responseText);
                    //console.log(this.responseText);
                }
            }
          

   function myFunction(response){
		var obj=JSON.parse(response);
        
      

    if (obj.success==1)
        { 
$Resultat = mysql_query("SELECT * from etudiant where Cin=''");
var out="<table  border=1 >";
     
      
      out+="<thead>";
      out+="<tr>";
      out+="<th> cin </th>";
      out+="<th> nom </th>";
      out+="<th> prenom </th>";
      out+="<th> adresse </th>";
      out+="<th> email </th>";
      out+="</tr>";
      out+="</thead>";
while ($LigneCourante = mysql_fetch_assoc($Resultat)) {
  out+="<tr> <th>"+
  $LigneCourante["cin"] +
			"</th><td>"+
      $LigneCourante["nom"]+
      "</td><td>"+
			$LigneCourante["prenom"]+
			"</td><td>"+
			$LigneCourante["adresse"]+
			"</td><td>"+
			$LigneCourante["email"]+
			"</td></tr>" ;
      document.getElementById("demo").innerHTML=out;
}
out+= "</TABLE>";
document.getElementById("demo").innerHTML=out;
}
       else document.getElementById("demo").innerHTML="Aucune Inscriptions!";


    }
  }
    </script>
<footer class="container">
    <p>&copy; ENICAR 2021-2022</p>
  </footer>
</body>
</html>