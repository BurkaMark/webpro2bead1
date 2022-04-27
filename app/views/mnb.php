<?php
   require APPROOT . '/views/includes/head.php';
?>

<div class="navbar">
	<?php
		require APPROOT . '/views/includes/navigation.php';
	?>
</div>

<div class="container_data">
	<h1>A Magyar Nemzeti Bank jelenlegi valuta árfolyamai</h1>
	
	<h2>Keresés valuta átváltására:</h2>

	<div class="wrapper_data">
		<form action="<?php echo URLROOT; ?>/mnb/GetExchangeRates" method ="POST">
			<input type="text" placeholder="Valutáról" name="curr1">
			<span class="invalidFeedback">
				<?php echo $data['curr1Error']; ?>
			</span>
			
			<input type="text" placeholder="Valutára" name="curr2">
			<span class="invalidFeedback">
				<?php echo $data['curr2Error']; ?>
			</span>

			<button id="search" type="submit" value="submit">Átváltás</button>
		</form>

		<span class="invalidFeedback">
			<?php echo $data['rate1Error']; ?>
			<?php echo $data['rate2Error']; ?>
		</span>
	</div>

	<div id="currencies_item">
		<?php if(!empty($data['curr1'])): ?>
			<h2>A keresés eredménye:</h2>
			<table>
				<tr>
					<th><?php echo $data['curr1']; ?></th>
					<th><?php echo $data['curr2']; ?></th>
				</tr>
				<tr>
					<td><?php echo $data['unit1']; ?></td>
					<td><?php echo $data['rate1']; ?></td>
				</tr>
			</table>
			<br>
			<h2>Visszaváltás:</h2>
			<table>
				<tr>
					<th><?php echo $data['curr2']; ?></th>
					<th><?php echo $data['curr1']; ?></th>
				</tr>
				<tr>
					<td><?php echo $data['unit2']; ?></td>
					<td><?php echo $data['rate2']; ?></td>
				</tr>
			</table>
		<?php endif; ?>
	</div>
</div>
</body>