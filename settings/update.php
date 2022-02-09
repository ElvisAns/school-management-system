<?php 
if(isset($_POST['field1'])&& isset($_POST['field2'])&& isset($_POST['field3'])&& isset($_POST['field4'])){
    $inA = $_POST['field1'];
    $inB = $_POST['field2'];
    $outA = $_POST['field3'];
    $outB = $_POST['field4'];
    
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "ujn-esystem";
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $sql6 = "UPDATE attendance_time SET heure_entree_min='$inA', heure_entree_max='$inB', heure_sortie_min='$outA', heure_sortie_max='$outB' WHERE id=1";//var_dump($sql6);
    if (mysqli_query($conn, $sql6)){
        header('Location: http://localhost/settings/timesetting.php');
        exit;
    }
}
?>