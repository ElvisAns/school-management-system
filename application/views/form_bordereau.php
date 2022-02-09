<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Confirmer transaction</title>
  	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="<?=base_url("assets/css/style_form_check.css")?>">
</head>
<body>
	
      <h2></h>

<div class="wrapper">
    <div class="container">
        <article class="part card-details">
            <h1>
               Confirmation de payment
            </h1>
            <br>
            <h6 style="font-size: 10px;">Vous etes sur le point de proceder à une transaction<br>recompletez la somme perçu avec attention, ce processus n'est pas editable une fois accepté</h6>
            <hr>
            <form action="<?=base_url("borderaux")?>" method="post" autocomplete="off">
			<div class="input-item csv">
				<input type="hidden" name="slip_num_id" value="{slip_num_id}">
				<input type="hidden" name="author" value="{author}">
				<input type="hidden" name="Fonction" value="{Fonction}">
				<input type="hidden" name="somme_total" value="{somme_total}">
				<input type="hidden" name="nom_de_leleve" value="{nom_de_leleve}">
				<input type="hidden" name="copyright" value="{copyright}">
				<input type="hidden" name="date" value="{date}">
                <input type="hidden" name="student_id" value="{student_id}">
                <input type="hidden" name="student_fname" value="{student_fname}">
                <input type="hidden" name="student_classe" value="{student_classe}">
                <input type="hidden" name="student_name" value="{nom_de_leleve}">
				<input type="hidden" name="action" value="print">

				<label for="">somme minerval ($)</label>
				<input type="hidden"  name="minerval" value="{minerval}" >
				<input type="number" class="money" step="0.01"  value="{minerval}" disabled class="csv" name="new_amount_minerval" >
			</div>

			<div class="input-item csv">
				<label for="">somme Cantine ($)</label>
				<input type="hidden" name="Quantine" value="{Quantine}">
				<input type="number"  step="0.01"  class="csv" value="{Quantine}" disabled name="new_amount_Quantine" >
			</div>


			<div class="input-item csv">
				<label for="">somme construction ($)</label>
				<input type="hidden" name="construction" value="{construction}">
				<input type="number"   step="0.01" class="csv" value="{construction}" disabled name="new_amount_construction" >
			</div>
			
			<div class="input-item csv">
				<label for="">somme bibliotheque ($)</label>
				<input type="hidden" name="bibliotheque" value="{bibliotheque}">
				<input type="number"  class="csv"  step="0.01" value="{bibliotheque}" disabled name="new_amount_bibliotheque" >
			</div>
			
			<div class="input-item csv">
				<label for="">somme transport ($)</label>
				<input type="hidden" name="transport" value="{transport}">
				<input type="number"  class="csv"  step="0.01"  value="{transport}" disabled name="new_amount_transport" >
			</div>

			<div class="input-item csv">
				<label for="">Veuillez retaper ce text  <span style="color:red;">{random}</span></label>
				<input type="hidden" name="randomn_generated" value="{random}">
				<input type="text"  class="csv"  name="randomn_check" minlength="5" required>
			</div>
				<input type="submit" id="lancer"  name="submit" value="Enregistrer">
				<input type="reset" name="" value="Reinitialiser">
				<a href="<?=base_url("dashboard/finances/0/0/0/0/2/")?>">Annuler la transaction</a>
		</form>
        </article>
    </div>
</div>
  <script type="text/javascript" src="<?=base_url()?>/assets/js/jquery-3.5.1.min.js"></script>
<script>
$(document).ready(function(){

if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}

</script>
</body>
</html>