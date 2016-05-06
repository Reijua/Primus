<?php
// subject
$subject = 'Anmeldung Primus Romulus';
// message
$message = '
<html>
 <head>
  <title>Anmeldedaten</title>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,700" rel="stylesheet" type="text/css">
  <style type="text/css">
   body{
    margin: 30px 0;
    padding: 0 !important;
    line-height: 1.1;
    font-family: "Open Sans", Arial,sans-serif !important;
    font-weight: 300;
    font-size: 15px;
    color: #444444;
    background-color: #FFFFFF;
   }

   a:link, a:visited{
    color: #3498DB;
    text-decoration: none;
   }

   a:hover{
    text-decoration: underline;
   }

   strong{
    color: #333333;
    font-size: 1em;
   }

   .unwrap{
    white-space: nowrap;
   }

   .header{
    width: 100%;
    max-width: 700px;
    margin: 0 auto;
    text-align: right;
   }

   .content-holder{
    width: 100%;
    max-width: 700px;
    margin: 0 auto;
    padding: 0;
   }
    .content-holder .content{
     padding: 30px 10px;
    }
   .footer{
    width: 100%;
    max-width: 700px;
    margin: 0 auto;
    padding: 10px 0;
    border-top: 1px solid #CCCCCC;
    text-align: center;
    font-size: 0.8em;
   }
  </style>
 </head>
 <body>
  <div class="header">
   <img src="http://plattform.primus-romulus.net/resource/pictures/logo.png"/>
  </div>
  <div class="content-holder">
   <div class="content">
    Hallo '.$forename.',<br />
    <br />
    Wir freuen uns sehr, dass du Interesse an Primus Romulus hast! Wie du sicherlich weißt, sind wir ein Verein von HTL – Kaindorf Absolventen und versuchen dir Vorteile zu schaffen indem wir exklusive Jobangebote von Unternehmen für dich anbieten.
    <br />
    <br />
    Aber nicht nur dieser wirtschaftliche Vorteil liegt uns am Herzen. Es ist uns auch sehr wichtig, die Aktivität innerhalb des Vereins aufrecht zu erhalten. Das wollen wir mit regelmäßigen Events und Vorträgen von top Führungskräften umsetzen.
    <br />
    <br />
    Somit bieten wir dir die Chance, dich fortzubilden und mit uns neue Fähigkeiten zu lernen damit du bessere Chancen als Mitbewerber in deiner Branche hast. Außerdem kannst du dir ein privates Netzwerk mit wichtigen Kontakten aufbauen!
    <br />
    <br />
    Im folgenden Abschnitt findest du deine Zugangsdaten:<br />
    <br />
    <table width="100%" cellpadding="0" cellspacing="0" style="font-size:15px;">
     <tr>
      <td width="30%"><strong>Nickname:</strong></td>
      <td width="70%">'.$nickname.'</td>
     </tr>
     <tr>
      <td width="30%"><strong>Passwort:</strong></td>
      <td width="70%">'.$user_password.'</td>
     </tr>
    </table>
    <br />
    Wir dürfen dich herzlich willkommen heißen in der Community und hoffentlich sehen wir uns beim nächsten Event!
    Solltest du dich nicht anmelden können, wende dich bitte per E-Mail an <a href="mailto:support@primus-romulus.net" class="unwrap">support@primus-romulus.net</a>.<br />
    <br />
    Mit freundlichen Grüßen<br />
    <br />
    <br />
    Primus Romulus
   </div>
  </div>
  <div class="footer">
   Copyright &copy;'.date("Y").' Primus Romulus
  </div>
 </body>
</html>
';

// To send HTML mail, the Content-type header must be set
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
$headers .= 'From: <office@primus-romulus.net>' . "\r\n";

// Mail it
mail($email, $subject, $message, $headers);
?>