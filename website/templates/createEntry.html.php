<!Doctype>
<html>
	<head>

		<link rel="stylesheet" href="CSS/index.css">
    <link rel="stylesheet" href="CSS/MovieData.css">
    <link rel="stylesheet" href="CSS/movieCover.css">

		<!-- Import Ajax From Google Servers -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
		<!---------------------------------------------------------------------------------------->

		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

		<!-- Optional theme -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

		<!-- Latest compiled and minified JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

	</head>

	<body>

		<?= $taskbar ?>

    <?php if($UserRights > 1){?>

    <div class="container-fluid">
      <div class="row">

        <div class="main">

          <div class="thumbnail">

              <form class="" action="/New-Entry" method="POST">

                <h1>Neuen Eintrag erstellen</b></h1>

                <br>

                <b><label for="pictures[]">Filmposter: </label></b>
                <input type="file" name="Entry_pictures[]" />

                <br>
                <br>

                <b><label>Name:</label></b>
                <input type="text" name="Entry_Name" value="" required="true">

                <br>
                <br>

                <b><label>Beschreibung:</label></b><br><br>
                <textarea name="Entry_Content" rows="8" cols="80"></textarea>

                <br>
                <br>

                <b><label>Erscheinungs Datum: </label></b>
                <input type="date" name="Entry_Date" value="<?php echo date('Y-m-d'); ?>" required="true">

                <br>
                <br>

                <b><label>Trailer URL: </label></b>
                https://www.youtube.com/watch?v=
                <input type="text" name="Entry_Trailer" value="">

                <br>
                <br>

                <b><label>Tags:</label></b><br><br>
                <textarea name="Entry_Tags" rows="8" cols="80"></textarea>

                <br>
  							<br>

                <b><label>Freigegeben ab: </label></b>
                <input type="number" name="Entry_PG" value="0" min="0" required="true">

                <br>
                <br>

                <center>
                  <input type="submit" class="btn btn-success" name="Entry_Create_Button" value="Eintrag Erstellen">
                </center>

              </form>


          </div>


        </div>
      </div>
    </div>

    <?php } ?>

	</body>
</html>
