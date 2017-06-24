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

            <?php
							foreach ($Movies as $key)
							{
								echo '<a href="/movie='. $key["ID"] . '">';
									echo '<div class="col-xs-6 col-sm-2 placeholder IsMovie" role="button">';
									echo '<img src="MoviePoster/';
										if($key['HasImage'])
										{
			              	echo $key["ID"];
										}
										else
										{
											echo "default";
										}
										echo '.jpg" width="200" height="200" class="img-responsive" alt="Generic placeholder thumbnail">';
			              echo '<h4>'. $key["Name"] . '</h4>';
			              echo '<span class="text-muted">Release: ' . date("d.m.Y", strtotime($key["ReleaseDate"])) . '</span>';
			            echo '</div>';
								echo '</a>';
							}
						 ?>

          </div>

        </div>
      </div>
    </div>

	</body>
</html>
