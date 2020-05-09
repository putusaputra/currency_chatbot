<?php
namespace App\Classes;

use GuzzleHttp\Client;

class Currency {
	public static function getCurrency($currency) {
		$client = new Client();
		$uri = 'https://api.exchangeratesapi.io/latest?base=' . $currency;
		$response = $client->get($uri);
		$results = json_decode($response->getBody()->getContents());

		$date = date('d F Y', strtotime($results->date));
		$data = "Here's the exchange rates based on " . $currency . " currency\nDate: " . $date . "\n";

		foreach ($results->rates as $key => $value) {
			$data .= $key . " - " . $value . "\n";
		}

		return $data;
	}
}