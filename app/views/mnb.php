<?php
   require APPROOT . '/views/includes/head.php';
?>

<div id="section-landing">
	<?php
		require APPROOT . '/views/includes/navigation.php';
	?>

	<div class="text-landing">
		<h2>A Magyar Nemzeti Bank jelenlegi valuta árfolyamai:</h2>
		
		<?php
			$client = new SoapClient("http://www.mnb.hu/arfolyamok.asmx?wsdl");
			print $client->GetCurrencies()->GetCurrenciesResult . "\n";
			print $client->GetCurrentExchangeRates()->GetCurrentExchangeRatesResult . "\n";
		?>
</div>
</body>