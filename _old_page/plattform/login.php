<html>
<head>
<link rel="stylesheet" type="text/css" href="resource/css/style-login.css">
<link rel="stylesheet" type="text/css" href="resource/css/reset-pw.css">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
<script type="text/javascript">
    function clearTextbox(o) {
      o.value = "";
      o.onclick = null;
    }
    var changeCounter = 0;
    function changeFooter() {
    	if(changeCounter == 0)
      	{
      		document.getElementById("idfooter").style.height="150px";
      		changeCounter=1;
      	}else
      	{
      		document.getElementById("idfooter").style.height="45px";
      		changeCounter=0;
      	}
    }
    </script>
</head>
    <body>
    	<div class="desktop-wrapper">
    		<div class="desktop-background-image">
				<div class="desktop-login-text">
				</div>
			</div>
	        <div class="desktop-login-wrapper">
	        	<div class="desktop-content-holder">
	        		<h2>Anmelden</h2><?php   
				 if(isset($_GET['login'])){
				 echo "<div class='fail'> Ung&uuml;ltige Benutzerdaten! </div>";
					 
				 }?>
	        	</div>
	        	<div class="desktop-content">
		            <form method="POST" action="scripts/check_login.php">
		           		<strong><label>Nutzername</label></strong>
	           		<input class="desktop-user-textbox" value="" type="text" onclick="clearTextbox(this)" name="user" size="40">
	           		<strong><label>Passwort</label></strong>
	            	<input class="desktop-user-textbox" type="password" onclick="clearTextbox(this)" name="pass" size="40">
		            	<div class="desktop-user-container">
		            	<input class="desktop-user-button" id="button" type="submit" name="submit" value="Anmelden">
		            	</div>
		            </form>

	            	<a class="registration" href="registration.php">Registriere dich jetzt!</a>
	            	<a class="registration" style="float:right; margin-top:0px"href="#openModal">Passwort vergessen?</a>
    	
    	<div id="openModal" class="modalDialog">
			<div>
				<a href="#close" title="Close" class="close">X</a>
				<form method="POST" action="scripts/check_reset.php">
	            	<div class="content-holder">
	            		<h2 href="#openModal">Passwort vergessen?</h2>
	            	</div>
	           		<strong><label class="label-text">Email Adresse</label></strong></br>
	       			<input class="desktop-user-textbox" value="" type="email" name="email" size="40">
	       			<input class="desktop-user-button" id="button" type="submit" name="submit" value="Passwort zurücksetzen">
            	</form>
			</div>
		</div>
		            <div class="desktop-remember">
		            
	        		</div>
	        	</div>
		    </div>
		</div>
    	<div id="mobile" class="mobile-content">
			<div class="mobile-background-image">
				<div class="mobile-login-text">
					<strong>
						Melde dich bei deinem Primus Romulus-Konto an.
					</strong>
				</div>
			</div>
			<div class="mobile-content-wrapper">
				<form method="POST" action="scripts/check_login.php">
					<label>Nutzername</label>
	           		<input class="mobile-user-textbox" value="" type="text" onclick="clearTextbox(this)" name="user" size="40">
	           		<br/><br/>
	           		<label>Passwort</label>
	            	<input class="mobile-user-textbox" type="password" onclick="clearTextbox(this)" name="pass" size="40">
	            	<div id="idfooter" class="mobile-footer">
			            <div class="mobile-footer-left">
			            	<input class="mobile-user-button" id="button" onclick="" type="submit" name="submit" value="">
						</div>		
						<a href="javascript:changeFooter()">
							<div class="mobile-settings">
								<div class="mobile-circle"></div>
								<div class="mobile-circle"></div>
								<div class="mobile-circle"></div>
							</div>
						</a>
						<div class="mobile-text">
							<strong><label>Anmelden</label></strong>
						</div>
						<div id="idfootera" class="mobile-text-reg">
				            <a href="registration.php" >Registrieren</a>
				            <a href="registration.php" >Passwort vergessen</a>
				        </div>
					</div>
	            </form>
			</div>
			
		</div>
    </body>
</html> 