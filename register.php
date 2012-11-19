<?php
if(isset($_POST['submit']))
{
	//het pad naar de loginclass
	require_once('classes/loginclass.php');
	//code om op te slaan
	if (loginclass::emailaddress_exists($_POST['username']))
	{
		/*meld dat emailadres bestaat*/
		/*stuur terug naar regisreergedeelte */
		echo "there already has been made an account using this emailaddress,<br>
			  please use another address.<br>
			  you'll be send to the registrationpage";
	}
	else
	{
		/*schrijf gegevens naar databasie en stuur activatielink*/
		loginclass::insert_into_logingegevens($_POST);
		echo("an activationmail has been send to your emailaddress");
	}
}
else
{
?>
<form action='register.php' method='post'>
	<table>
		<tr>
			<td>First name</td>
			<td><input type='text' name = 'firstname'></td>
		</tr>
		<tr>
			<td>Insertion</td>
			<td><input type='text' name = 'insertion'></td>
		</tr>
		<tr>
			<td>surname</td>
			<td><input type='text' name = 'surname'></td>
		</tr>
		<tr>
			<td>address</td>
			<td><input type='text' name = 'address'></td>
		</tr>
		<tr>
			<td>adress number</td>
			<td><input type='text' name = 'addressnumber'></td>
		</tr>
		<tr>
			<td>city</td>
			<td><input type='text' name = 'city'></td>
		</tr>
		<tr>
			<td>zipcode</td>
			<td><input type='text' name = 'zipcode'></td>
		</tr>
		<tr>
			<td>country</td>
			<td><input type='text' name = 'country'></td>
		</tr>
		<tr>
			<td>phone number</td>
			<td><input type='text' name = 'phonenumber'></td>
		</tr>
		<tr>
			<td>cellphone number</td>
			<td><input type='text' name = 'cellnumber'></td>
		</tr>
		<tr>
			<td>email</td>
			<td><input type='text' name = 'username'></td>
		</tr>	
		<tr>
			<td></td>
			<td><input type='submit' name = 'submit' value = 'submit'></td>
		</tr>
	</table>
</form>
<?php
}
?>