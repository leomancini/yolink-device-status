<?php
	require('lib/yolink.php');
	header('Content-Type: application/json');

	$secretsFile = file_get_contents('config/secrets.json');
	$secrets = json_decode($secretsFile, true);

	$sensorsFile = file_get_contents('config/sensors.json');
	$sensors = json_decode($sensorsFile, true);
	
	$response = [
		"temperatureHumiditySensors" => [
			[
				"metadata" => [
					"name" => "Temperature & Humidity Sensor",
					"room" => "Bedroom"
				],
				"data" => getDeviceState([
					"type" => "THSensor",
					"id" => $sensors['BedroomTempHumiditySensor']['id'],
					"token" => $sensors['BedroomTempHumiditySensor']['token']
				])
			]
		],
		"doorSensors" => [
			[
				"metadata" => [
					"name" => "Freezer",
					"room" => "Kitchen"
				],
				"data" => getDeviceState([
					"type" => "DoorSensor",
					"id" => $sensors['FreezerDoorSensor']['id'],
					"token" => $sensors['FreezerDoorSensor']['token']
				])
			],
			[
				"metadata" => [
					"name" => "Filing Cabinet",
					"room" => "Bedroom"
				],
				"data" => getDeviceState([
					"type" => "DoorSensor",
					"id" => $sensors['FilingCabinetDoorSensor']['id'],
					"token" => $sensors['FilingCabinetDoorSensor']['token']
				])
			]
		]
	];

	echo json_encode($response);
?>