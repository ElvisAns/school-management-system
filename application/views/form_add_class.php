<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Creer une nouvelle classe</title>
  	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="<?=base_url("assets/css/style_form_check.css")?>">
	<style type="text/css">
		 .button_action{
		 	background-color: #00b0ff; 
		 	border-color: #eee; 
		 	border-style: solid; 
		 	color: #fef; 
		 	background-color: #00b0ff; 
		 	color: white; font-family: 'Montserrat', sans-serif; 
		 	font-size: 12px; 
		 	text-transform: uppercase; 
		 	padding: 14px 49px;
		 	text-align: left;
		 }

		 .submittt{
		 	margin-top: 20px;
		 	margin-bottom:50px;
		 }

		 .go{
		 	margin-top: -25px;
		 	margin-bottom: 50px;
		 	background-color: #eba134; 
		 }

	</style>
</head>
<body>
	
      <h2></h>

<div class="wrapper">
    <div class="container">
        <article class="part card-details">
            <h1>
               Creation des classes
            </h1>
            <br>
            <h6 style="font-size: 10px;">Vous etes sur le point d'ajouter une classe<br>
            Veuillez etre prudent car ces noms pourrons etre utilisé dans tout le systeme 
            </h6>
            <div style="font-size: 12px; padding: 10px; color: blue;">Les classes deja existantes:<p>{classes}</p></div>
            <hr>
            <form action="<?=base_url("dashboard/ajouter_classe")?>" method="post" autocomplete="off">

			<div id="iskapa">
				
			</div>

			<div class="input-item csv">
				<button id="add" type="button" class="button_action">Ajouter un champ d'entree</button>
				<button type="submit" id="lancer" class="button_action submittt">Engister</button>
				<button type="button" id="dash" class="button_action go">RETOUR AU CONTROL</button>
			</div>

		</form>
        </article>
    </div>
</div>
  <script type="text/javascript" src="<?=base_url()?>/assets/js/jquery.min.js"></script>
<script>
$(document).ready(function(){

if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}

let classe=0;

$('#dash').on("click",function(){
	var conf=confirm("Souhaitez vous Retourner vers le tableau de bord?");

	if(conf)
	window.location.href = "<?=base_url("dashboard")?>"
});

$("#add").on("click", function(e){


	var input = $('<br><label>Inserez ensuite le nom de la classe</label><input type="text"  class="'+classe+'" name="classe'+classe+'" placeholder="Nom de la classe ici"/></br>');

	$("form>#iskapa").append('<br><label>Inserez le nom de la classe</label><input type="text"  class="'+classe+'" name="classe'+classe+'" placeholder="Nom de la classe ici"/></br>');

	classe++;
});

});

</script>
</body>
</html>