<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <link rel="stylesheet" type="text/css" href="resource/css/main.css"></link>
	    <link rel="stylesheet" type="text/css" href="resource/css/style-login.css"></link>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script src="resource/js/classie.js"></script>
          <script type="text/javascript" src="resource/js/functions.js"></script>
        <script>
         window.onload = init();
        
      function checkForm(form)
      {
          
        if(form.nickname.value == "") {
          alert("Error: Nickname ist leer!");
          form.nickname.focus();
          form.action="";
          return false;
        }
    
        
          if(form.password.value.length < 6) {
            alert("Error: Passwort muss mehr als 6 Stellen haben!");
            form.password.focus();
            form.action="";
            return false;
          }
    
          if(form.password.value == form.nickname.value) {
            alert("Error: Passwort muss sich vom Nickname unterscheiden!");
            form.password.focus();
            form.action="";
            return false;
          }
            
        if(form.password.value != "" && form.password.value == form.password-confirm.value)
        {
          alert("Error: Passwörter stimmen nicht überein!");
          form.password.focus();
          form.action="";
          return false;
        }
        
        if(form.password.value =="" || form.forename.value=="" || form.name.value=="" || form.email.value=="" || form.birthdate-day.value=="" || form.birthdate-year.value=="" || form.month-list.value=="" ||form.birthdate-year.value==""  || form.grad-list.value=="" || form.class-list.value=="" || form.start-list.value=="")
        {
          alert("Error: Es müssen alle Felder ausgefüllt werden!");
          form.action="";
          return false;
        }
        
        return true;
      }
        </script>
    </head>
<header>
    <section><a href="login.php">
        <img src="/resource/pictures/logo.png" /></a>
    </section>
    <nav class="mobile-bar">
        
    </nav>
</header>
<body bgcolor="#FFFFFF">
  <div class="background-form">
    <div class="content-registration-wrapper">
            <form class="registration-wrapper" method="post" onsubmit="checkForm(this);" action="create-user.php">
                <div class="registration-row">
                    <label>Nickname</label>
                    <input type="text" id="nickname" placeholder="Nickname" name="nickname" size="20" maxlength="20">
                </div>
                <div class="registration-row">
                    <label>Name</label>
                    <input type="text" id="forename" placeholder="Vorname" name="forename" class="registration-name" size="30">
                    <input type="text" id="name" placeholder="Nachname" name="name" class="registration-name" size="30">
                </div>
                <div class="registration-row">
                    <label>Email</label>
                    <input type="text" id="email" placeholder="Email" name="email" size="30">
                </div>
                <div class="registration-row">
                    <label>Abschlussjahr / Klasse / Jahrgang</label>
                    <?php include('select_gradyear.php') ?>
                    <?php include('select_absclass.php') ?>
                    <?php include('select_startyear.php') ?>
                </div>
                <div class="registration-row">
                    <label>Passwort erstellen</label>
                    <input type="password" id="password" name="password" size="30">
                </div>
                <div class="registration-row">
                    <label>Passwort bestätigen</label>
                    <input type="password" id="password-confirm" name="password-confirm" size="30">
                </div>
                <div class="registration-row">
                    <label>Geburtsdatum</label>
                    <input type="text" id="birthdate-day" placeholder="Tag" name="birthdate-day" maxlength="2" size="2">
                    <?php include('select_month.php'); ?>
                    <input type="text" id="birthdate-year" placeholder="Jahr" name="birthdate-year" maxlength="4" size="4">
                </div>
                <div class="registration-row">
                    <label>Telefonnummer (optional)</label>
                    <input type="text" id="phonenumber"  placeholder="Telefonnummer" name="phonenumber" class="registration-input" maxlength="15" size="15">
                </div>
                <div class="registration-row">
                    <label>PLZ / Ort (optional)</label>
                    <input type="text" id="plz" placeholder="PLZ" name="plz" maxlength="4" size="4">
                    <input type="text" id="place" placeholder="Ort" name="place" size="30">
                </div>
                 <div class="registration-row">
                    <label>Adresse (optional)</label>
                    <input type="text" id="address" placeholder="Adresse" name="address" size="30">
                </div>
                    <input type="submit" class='bt-registrate' value="Registrieren!">
        </form>
   	 <?php   if(isset($_GET['valid_nickname'])){
                echo "<div> Nickname bereits vorhanden! </div>";
   	            }
             if(isset($_GET['valid_email'])){
                echo "<div> Email bereits vorhanden! </div>";
   	            }
     ?>
    </div>
    <?php include 'footer.php'; ?>
    </div></div>    
</body></html>