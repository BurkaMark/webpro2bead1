<?php
   require APPROOT . '/views/includes/head.php';
?>

<div class="navbar">
	<?php
		require APPROOT . '/views/includes/navigation.php';
	?>
</div>

<div class="container">
	<h1>A Magyar Nemzeti Bank jelenlegi valuta árfolyamai</h1>
	
	<h3>Keresés valuta átváltására:</h3>

	<form action="<?php echo URLROOT; ?>/mnb/GetExchangeRates" method ="POST">
		<input type="text" placeholder="Valutáról" name="curr1">
		<span class="invalidFeedback">
			<?php echo $data['trailError']; ?>
		</span>
		<input type="text" placeholder="Valutára" name="curr2">
		<span class="invalidFeedback">
			<?php echo $data['trailError']; ?>
		</span>

		<button id="submit" type="submit" value="submit">Átváltás</button>
	</form>

	<span class="invalidFeedback">
        <?php echo $data['trailError']; ?>
    </span>

	<div class="container-item">
		<table>
			<tr>
				<th>curr1</th>
				<th>curr2</th>
			</tr>
			<tr>
				<td>unit1</td>
				<td>unit2</td>
			</tr>
			<tr>
				<td>rate1</td>
				<td>rate2</td>
			</tr>
		</table>	
	</div>
</div>
</body>