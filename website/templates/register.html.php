<h1>Registrieren !!!!</h1>



<form action="" method="POST">	
	<input type="email" name="email" placeholder="E-Mail" value="<?= (isset($email)) ? htmlspecialchars($email) : "" ?>"></input>
	<input type="password" name="password" placeholder="Password"></input>
	<input type="submit" value="Registrieren"></input>
</form>
