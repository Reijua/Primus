<?php
    echo '<div id="content-wrapper">
            <form method="post" onsubmit="return checkvalue(this)" action="/create-user.php" >
                
                <div class="registration-wrapper">
                    <h1>Profil erstellen</h1>
                    <div class="registration-row">
                        <label>Nickname</label>
                        <input type="text" id="nickname" name="nickname" size="30">
                    </div>
                    <div class="registration-row">
                        <label>Vorname</label>
                        <input type="text" id="forename" name="forename" size="30">
                    </div>
                    <div class="registration-row">
                        <label>Nachname</label>
                        <input type="text" id="name" name="name" size="30">
                    </div>
                    <div class="registration-row">
                        <label>Passwort</label>
                        <input type="password" id="password" name="password" size="30">
                    </div>
                    <div class="registration-row">
                        <label>Geburtsdatum</label>
                        <input type="date" id="birthdate" name="birthdate" size="30">
                    </div>
                    <div class="registration-row">
                        <label>Telefonnummer</label>
                        <input type="number" id="phonenumber" name="phonenumber" size="30">
                    </div>
                    <div class="registration-row">
                        <label>Email</label>
                        <input type="text" id="email" name="email" size="30">
                    </div>
                    <input type="submit" value="hinzuf&uuml;gen">
                </div> 
        </form>
        </div>';
?>