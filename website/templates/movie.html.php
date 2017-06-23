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

    <div class="container-fluid">
      <div class="row">

        <div class="main">

          <div class="page-header"></div>

          <div class="thumbnail">

              <!--<h1> The Movename is <b><?= htmlspecialchars($MovieData['Name'])?></b></h1>-->

							<?php
							if($UserRights > 1){
								echo '<a href="/Edit-Movie='. $MovieData['ID'] .'"> <img src="http://simpleicon.com/wp-content/uploads/pencil.png" alt="" class="edit-pencile" role="button"></a>';
							}
							?>

              <br>

              <div class="col-xs-6 col-sm-2 placeholder">
                <img src="MoviePoster/<?= htmlspecialchars($MovieData['ImageURL'])?>" width="200" height="200" class="img-responsive" alt="Generic placeholder thumbnail">
              </div>

              <b>Name:</b> <?= htmlspecialchars($MovieData['Name'])?>
              <br>
              <br>
              <b>Beschreibung:</b><br>
               <?= htmlspecialchars($MovieData['Content'])?>
              <br>
              <br>
              <br>
              <b>Erscheinungs Datum: </b> <?= htmlspecialchars(date("d.m.Y", strtotime($MovieData["ReleaseDate"])))?>
              <br>
              <br>
              <b>Trailer:</b></br>
              <iframe width="610" height="365" src="https://www.youtube.com/embed/<?= htmlspecialchars($MovieData['TrailerURL'])?>" frameborder="0" allowfullscreen></iframe>
              <br>
              <br>
              <br>

              <b>Tags: </b> <?= htmlspecialchars($MovieData['Tags'])?>
              <br>
							<br>

              <b>Freigegeben ab: </b> <?= htmlspecialchars($MovieData['PG'])?>
              <br>

          </div>

          <h2 class="sub-header">Kommentare <span class="label label-success label-as-badge"><?= $MovieData['CommentCount'] ?></span></h2>

          <div class="thumbnail">
						<form class="form-signin" action="/movie=<?= $MovieData['ID'] ?>" method="POST">

							<div class="form-group">
						    <label for="commentWriteTitel">Dein Titel</label>
						    <input type="email" class="form-control" name="commentWriteTitel" id="commentWriteTitel" placeholder="Dein Titel">

								<label for="commentWriteTitel">Dein Kommentar</label>
								<textarea class="form-control" name="commentWriteTitel" id="commentWriteTitel" rows="4" cols="80" placeholder="Dein Kommentar"></textarea>

								<br>

								<input type="submit" class="btn btn-success" name="PostMyComment" value="Kommentar Posten">
								
						  </div>

			      </form>
          </div>

					<?php

					foreach ($Comments as $key)
					{
						echo '<div class="thumbnail">';

	          echo '</div>';
					}

					?>

        </div>
      </div>
    </div>

	</body>
</html>
