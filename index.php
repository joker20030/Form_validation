<!DOCTYPE HTML>  
<html>
<head>
  <title>registrazione</title>
  <link rel="stylesheet" type="text/css"href="stile.css"/>
</head>
<body align="center">  

<?php
// definisce le variabili e imposta i valori vuoti
$nameErr = $cogErr = $etàErr = $emailErr= $cellErr = $nkErr = $genderErr = $viaErr = $NviaErr = $capErr = $comErr = "";
$name = $cog  = $età =$email= $cell = $nk = $gender = $via = $Nvia = $cap = $com = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  //nome
  if (empty($_POST["name"])) {
    $nameErr = "Il nome è richiesto";
  } else {
    $name = test_input($_POST["name"]);
    // controlla se il nome contiene solo lettere e spazi bianchi
    if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
      $nameErr = "Sono consentiti solo lettere e spazi bianchi";
    }
  }

  //cognome
  if (empty($_POST["cog"])) {
    $cogErr = "Il cognome è richiesto";
  } else {
    $cog = test_input($_POST["cog"]);
    // controlla se il cognome contiene solo lettere e spazi bianchi
    if (!preg_match("/^[a-zA-Z-' ]*$/",$cog)) {
      $cogErr = "Sono consentiti solo lettere e spazi bianchi";
    }
  }

  //età
  if(empty($_POST["età"]) || $_POST['età'] > 2022 ){
    $etaErr = "non si può essere nato in questo anno";
  }else{
    $età = test_input($_POST["età"]);
  }
  
  //email
  if (empty($_POST["email"])) {
    $emailErr = "l'email e richiesta";
  } else {
    $email = test_input($_POST["email"]);
    // controlla se l'indirizzo email è ben formato
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Il'email non è valida";
    }
  }

  //numero di cellulare
  if(strlen($_POST['cell']) != 10){
    $cellErr = "numero non valido";
  }else{
    $cell = test_input($_POST['cell']);
  }

  //via,numero via,cap,comune
  if(empty($_POST['via']) && empty($_POST['cap']) && empty($_POST['com']) && empty($_POST['nv'])){
    $viaErr= $capErr = $comErr = "l'indirizzo è richiesto";
  }else{
    $via = test_input($_POST['via']);


    if(strlen($_POST['cap'] ) == 5 && strlen($_POST['nv'] )){
      $cap = test_input($_POST['cap']);
      $Nvia = test_input($_POST['nv']);
    }else{
      $viaErr= $capErr = $comErr = $NviaErr = "l'indirizzo è errato o incompleto";
    }

    $com = test_input($_POST['com']);
  }

  //nickname
  if(empty($_POST['nk'])){
    $nkErr = "il nickname è richiesta";
  }else{
    $nk = test_input($_POST["nk"]);
    // controlla del nickname che deve essere diverso dal nome
    if($_POST['nk'] == $_POST['name'] && $_POST['nk'] == $POST['cog']){
      $nkErr = "il nickname deve essere diverso dal nome";
    }
  }

  //sesso
  if (empty($_POST["gender"])) {
    $genderErr = "sesso è richiesto";
  } else {
    $gender = test_input($_POST["gender"]);
  }
}
function test_input($data) {
  //trim — Elimina gli spazi bianchi (o altri caratteri) dall'inizio e dalla fine di una stringa
  $data = trim($data);

  //stripslashes — Deseleziona una stringa tra virgolette
  $data = stripslashes($data);

  //htmlspecialchars — Converte caratteri speciali in entità HTML
  $data = htmlspecialchars($data);
  return $data;
}
?>

<h2>REGISTRAZIONE<sh2>

<p><span class="error">* campo obbligatorio</span></p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" align="center">  

  Nome: <input type="text" name="name" value="">
  <span class="error">* <?php echo $nameErr;?></span>
  <?php echo "&nbsp;&nbsp;"; ?>

  Cognome: <input type="text" name="cog" value="<?php echo $cog;?>">
  <span class="error">* <?php echo $cogErr;?></span>
  <br><br>

  Età: <input  type="date" name="età" value="<?php echo $età ?>">
   <span class="error">* <?php echo $etàErr;?></span>
   <?php echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"; ?>

  Email: <input type="text" name="email" placeholder="example@gmail.com"; value="<?php echo $email;?>">
   <span class="error">* <?php echo $emailErr;?></span>
   <br><br>
   
   Via<input type="text" name="via" value="<?php echo $via ?>">
   Nr.<input type="tel" name="nv" value="<?php echo $Nvia ?>">
   Cap<input type="tel" name="cap" value="<?php echo $cap ?>">
   Comune<input type="tel" name="com" value="<?php echo $com ?>">
   <span class="error">*<?php echo $comErr;?></span>
   <br><br>

  Cellulare: <input type="tel" placeholderx="+39 1234567891"; name="cell" value="<?php echo $cell ?>">
  <span class="error"><?php echo $cellErr;?></span>
  <?php echo "&nbsp;&nbsp;"; ?>

  Nickname: <input type="text" name="nk" value="<?php echo $nk;?>">
  <span class="error">*<?php echo $nkErr; ?></span>
  <br><br>

  Sesso:
  <input type="radio" name="gender"  value="Femmina">Femmina
  <input type="radio" name="gender"  value="Maschio">Maschio
  <input type="radio" name="gender"  value="Altro">Altro  
  <span class="error">* <?php echo $genderErr;?></span>
  <br><br>

  <input type="submit" name="submit" value="registrazione">
  <br><br><br><br>    
</form>

<h1>TABELLA DATI</h1>
<table border="1" align="center" bgcolor="#ffffff" >
<tr bgcolor="#000000">
  <th><b>NOME</b></th>
  <th><b>COGNOME</b></th>
  <th><b>ETA'</b></th>
  <th><b>EMAIL</b></th>
  <th><b>CELLULARE</b></th>
  <th><b>INDIRIZZO</b></th>
  <th><b>NICKNAME</b></th>
  <th><b>SESSO</b></th>
</tr>
<?php if(!empty($_POST['submit'])){ ?>
<tr bgcolor="#000000">
  <td><?php echo $name ?></td>
  <td><?php echo $cog ?></td>
  <td><?php  echo $età ?></td>
  <td><?php echo $email ?></td>
  <td><?php echo $cell ?></td>
  <td><?php echo "Via"."&nbsp;".$via."&nbsp;/&nbsp;"."Cap"."&nbsp;/".$cap."&nbsp;/&nbsp;"."Comune"."&nbsp;".$com ?></td>
  <td><?php echo $nk?></td>
  <td><?php echo $gender ?></td>
</tr>
</table>
<?php }?>
</body>
</html>
