<?php
	require_once("./classes/loginclass.php");
	//echo "gebruikersnaam: ".$_GET['em']."<br>";
	//echo "wachtwoord: ".$_GET['pw'];
	if (isset($_POST['submit']))
	{
		if( !strcmp($_POST['password'],$_POST['passwordcheck']))
		{
		echo "sla het niuewe wachtwoord op <br> ";
		loginclass::update_password($_POST['email'],$_POST['password']);
		}
		else
		{
		echo "de wachtwoorden zijn niet gelijk";
		}
	}
	else
	{
?>
	welkom op de site, uw account word geactiveerd nadat u een nieuw wachtwoord heeft gekozen.
	<form action='activatie.php'method='POST'>
		<table>
		<tr>
			<td>password (maximaal 12 tekens)</td>
			<td><input type='password' name='password' size=12 maxlength=12></td>
		</tr>
			<td>confirm password</td>
			<td><input type='password' name='passwordcheck' size=12 maxlength=12></td>
		<tr>
		</tr>
			<td>&nbsp;</td>
			<td><input type='submit' name='submit' value='submit'>
				<input type='hidden' name='email' value='<?php echo $_GET['em'];?>'></td>
		<tr>
		</tr>
		<table>
	</form>
<?php
	}
	?>