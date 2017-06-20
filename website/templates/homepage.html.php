<!Doctype>
<html>
	<head>

		<link rel="stylesheet" href="CSS/index.css">
    <link rel="stylesheet" href="CSS/dashboard.css">
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

		<?= $taskbar; ?>

    <div class="container-fluid">
      <div class="row">

        <div class="main">
          <h1 class="page-header">Dashboard</h1>

          <div class="row placeholders">
            <!--<div class="col-xs-6 col-sm-2 placeholder IsMovie" role="button">
              <img src="http://www.impawards.com/2016/posters/xmen_apocalypse_ver18_xxlg.jpg" width="200" height="200" class="img-responsive" alt="Generic placeholder thumbnail">
              <h4>Label</h4>
              <span class="text-muted">Something else</span>
            </div>
            <div class="col-xs-6 col-sm-2 placeholder IsMovie" role="button">
              <img src="https://s-media-cache-ak0.pinimg.com/originals/bb/ff/10/bbff106591f93093c9693f749bb12d06.jpg" width="200" height="200" class="img-responsive" alt="Generic placeholder thumbnail">
              <h4>Label</h4>
              <span class="text-muted">Something else</span>
            </div>
            <div class="col-xs-6 col-sm-2 placeholder IsMovie" role="button">
              <img src="https://kaneshorrorblog.files.wordpress.com/2010/12/the_dark_knight_movie_poster.jpg" width="200" height="200" class="img-responsive" alt="Generic placeholder thumbnail">
              <h4>Label</h4>
              <span class="text-muted">Something else</span>
            </div>
            <div class="col-xs-6 col-sm-2 placeholder IsMovie" role="button">
              <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRYmqQmr5RQkvbC34FMqgoC5bgWitPlC_TgECFScsY7wkjfLlqP" width="200" height="200" class="img-responsive" alt="Generic placeholder thumbnail">
              <h4>Label</h4>
              <span class="text-muted">Something else</span>
            </div>
            <div class="col-xs-6 col-sm-2 placeholder IsMovie" role="button">
              <img src="http://img.moviepostershop.com/the-magnificent-seven-movie-poster-2016-1020776374.jpg" width="200" height="200" class="img-responsive" alt="Generic placeholder thumbnail">
              <h4>Label</h4>
              <span class="text-muted">Something else</span>
            </div>
            <div class="col-xs-6 col-sm-2 placeholder IsMovie" role="button">
              <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRJBC5XK_HmO30HN3MrDxXOn5N__xm_bwDBOPcw0qpNn60o9ORH_g" width="200" height="200" class="img-responsive" alt="Generic placeholder thumbnail">
              <h4>Label</h4>
              <span class="text-muted">Something else</span>
            </div>-->

            <?php
							//var_dump($Movies);
						 	//var_dump($Movies["BackGroundImgURL"]);
							foreach ($Movies as $key)
							{
								//echo var_dump($value);
								echo '<div class="col-xs-6 col-sm-2 placeholder IsMovie" role="button">';
		              echo '<img src="'. $key["BackGroundImgURL"] . '" width="200" height="200" class="img-responsive" alt="Generic placeholder thumbnail">';
		              echo '<h4>'. $key["Name"] . '</h4>';
		              echo '<span class="text-muted">Release: ' . date("d.m.Y", strtotime($key["ReleaseDate"])) . '</span>';
		            echo '</div>';
							}
						 ?>

          </div>

          <h2 class="sub-header">Section title</h2>

        </div>
      </div>
    </div>

	</body>
</html>
