
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ujn-esystem";
$heure_entree_min = "07:30"; //defaultly
$heure_entree_max = "07:59"; //defaultly
$heure_sortie_min = "12:00"; //defaultly
$heure_sortie_max = "12:30"; //defaultly
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql0 = "SELECT * FROM attendance_time WHERE id=1";
$result0 = $conn->query($sql0);
if ($result0 = $conn->query($sql0)) {
    while ($fetched0 = $result0->fetch_row()) {
      $heure_entree_min = $fetched0[1];
      $heure_entree_max = $fetched0[2];
      $heure_sortie_min = $fetched0[3];
      $heure_sortie_max = $fetched0[4];
    }
}

?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {font-family: Arial, Helvetica, sans-serif;}
* {box-sizing: border-box;}

/* Button used to open the contact form - fixed at the bottom of the page */
.open-button {
  background-color: #555;
  color: white;
  padding: 16px 20px;
  border: none;
  cursor: pointer;
  opacity: 0.8;
  position: fixed;
  bottom: 23px;
  right: 28px;
  width: 280px;
}

/* The popup form - hidden by default */
.form-popup {
  display: none;
  position: fixed;
  bottom: 0;
  right: 15px;
  border: 3px solid #f1f1f1;
  z-index: 9;
}

/* Add styles to the form container */
.form-container {
  max-width: 300px;
  padding: 10px;
  background-color: white;
}

/* Full-width input fields */
.form-container input[type=text], .form-container input[type=password] {
  width: 100%;
  padding: 15px;
  margin: 5px 0 5px 0;
  border: none;
  background: #f1f1f1;
}

/* When the inputs get focus, do something */
.form-container input[type=text]:focus, .form-container input[type=password]:focus {
  background-color: #ddd;
  outline: none;
}

/* Set a style for the submit/login button */
.form-container .btn {
  background-color: #4CAF50;;
  color: white;
  padding: 16px 20px;
  border: none;
  cursor: pointer;
  width: 100%;
  margin-bottom:10px;
  opacity: 0.8;
}

/* Add a red background color to the cancel button */
.form-container .cancel {
  background-color: #555;
}

/* Add some hover effects to buttons */
.form-container .btn:hover, .open-button:hover {
  opacity: 1;
}
</style>
</head>
<body>

<button class="open-button" onclick="openForm()">Configuration</button>

<div class="form-popup" id="myForm">
  <form action="update.php" class="form-container" method=POST>
    <h2>Configuration Temps</h2>

    <label style="color:#4CAF50;"><i>Temps d'arrivee(ex:08:00, 08:30)</i></label>
    <input type="text" placeholder=<?php echo $heure_entree_min;?> id="field1" name="field1" required>
    <input type="text" placeholder=<?php echo $heure_entree_max;?> id="field2" name="field2" required>
    <label style="color:#4CAF50;"><i>Temps sortie(ex:12:00, 12:30)</i></label>
    <input type="text" placeholder=<?php echo $heure_sortie_min;?> id="field3" name="field3" required>
    <input type="text" placeholder=<?php echo $heure_sortie_max;?> id="field4" name="field4" required>

    <button type="submit" class="btn">Mettre a jour</button>
    <button type="button" class="btn cancel" onclick="closeForm()">Fermer</button>
  </form>
</div>
<script>

function openForm() {
  document.getElementById("myForm").style.display = "block";
}

function closeForm() {
  
  document.getElementById("myForm").style.display = "none";

  setTimeout(function(){window.location.href="http://localhost/ujn-e-system";},3000)
}

</script>

</body>
</html>