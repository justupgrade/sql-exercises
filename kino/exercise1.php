

<fieldset>
	<legend> buy ticket </legend>
	<form id='buy_ticket' method='post' action='exercise1action.php'> 
	<p><label>Amount: </label>
		<input type='number' name='amount' min='1' max='10' value='1'>
	</p>
	<p><label>Price: <strong style='color: orange'>30PLN</strong></label>
	</p>
	<p><label>Choose payment option:</label>
		<select name='payment'>
			<option value='karta'> Karta </option>
			<option value='gotowka'> Gotowka </option>
			<option value='przelew'> Przelew </option>
			<option value='nieoplacony'> Nieoplacony </option>
		</select>
	</p>
	<input type='hidden' name='price' value='30'>
	<input type='submit' value='next'>
	</form>
</fieldset>