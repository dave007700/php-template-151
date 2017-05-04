<!Doctype>
<html>
	<head>
		
	</head>
	
	<body>
		<h1><center>Login</center></h1>
		
		<br>
		<br>
		
		<center>
			<form action="" method="POST">	
				<input type="email" name="email" placeholder="E-Mail" value="<?= (isset($email)) ? htmlspecialchars($email) : "" ?>"></input>
				<input type="password" name="password" placeholder="Password"></input>
				<input type="submit" value="Einloggen"></input>
			</form>
		</center>
		
	</body>
</html>