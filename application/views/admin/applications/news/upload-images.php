<div class="container partner-feed">
	<div class="table-responsive">
		<h3>Bilder für ID: <?= $news_id ?> Name: <?= $news_title ?> hinzufügen</h3>
		<form method="post" enctype="multipart/form-data">
            <input type="file" name="my_file[]" multiple>
            <input type="submit" value="Upload"><br>
			<label for="rename">
			<input type="checkbox" id="rename" name="rename" value="rename"> Bildernamen verschlüsseln
			</label><br>
			<p style="margin-bottom: 20px">Bilder (.png, .jpeg, .jpg, .gif) dürfen jeweils nur maximal 8 Megabyte groß sein.</p>
        </form>
        <?php
            if (isset($_FILES['my_file'])) 
			{
                $myFile = $_FILES['my_file'];
                $fileCount = count($myFile["name"]);
				$uploaddir = "assets/images/news/".$news_id."/";
				$hash = (isset($_POST['rename']) && $_POST['rename'] == 'rename') ? true : false;
				$counter = 0;
				
				if (!create_directory($uploaddir, 0777, true)) 
				{
					echo "Fehler beim erstellen des Ordners: ".$uploaddir;
					return;
				}

                for ($i = 0; $i < $fileCount; $i++) {
                    /*?>
                        <p>File #<?= $i+1 ?>:</p>
                        <p>
                            Name: <?= $myFile["name"][$i] ?><br>
                            Temporary file: <?= $myFile["tmp_name"][$i] ?><br>
							Extension: <?= substr(strrchr($myFile['name'][$i], '.'), 1) ?><br>
                            Type: <?= $myFile["type"][$i] ?><br>
                            Size: <?= $myFile["size"][$i] ?><br>
                            Error: <?= $myFile["error"][$i] ?><br>
                        </p>
                    <?php */
					
					$ext = substr(strrchr($myFile['name'][$i], '.'), 1);
					if($ext == 'png' || $ext == 'jpg' || $ext == 'jpeg' || $ext == 'gif')
					{
						if($myFile["size"][$i] < 8 * 1024 * 1024)
						{
							if($hash)
								$saveName = md5(rand() * time()) . ".$ext";
							else
								$saveName = $myFile["name"][$i];
							
							move_uploaded_file($myFile['tmp_name'][$i], $uploaddir . $saveName);
							if(strlen($ext) > 0)
							{
								echo '<p><strong>'.$myFile["name"][$i].'</strong> erfolgreich als <strong>'.$saveName.'</strong> hochgeladen.</p>';
								$counter++;
							}
						}
						else
							echo '<p style="color: red">Fehler beim hochladen des Bildes '.$myFile["name"][$i].': Datei ist zu groß.</p>';
					}
					else
						echo '<p style="color: red">Fehler beim hochladen des Bildes '.$myFile["name"][$i].': Dateityp nicht erlaubt.</p>';
                }
				echo '<p style="color: green;">Upload von '.$counter.' Bildern abgeschlossen.</p>';
				
            }
        ?>
	</div>
</div>