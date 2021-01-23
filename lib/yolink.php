<?php
	function getDeviceState($params) {
		global $secrets;

		$postFields = '{
			"method":"'.$params['type'].'.getState",
			"time":'.time().',
			"targetDevice": "'.$params['id'].'",
			"token": "'.$params['token'].'"
		}';
		
		$secKey = md5($postFields.strtolower($secrets['YoLink']['SecKey']));
		
		$curl = curl_init();
		
		curl_setopt_array($curl, array(
			CURLOPT_URL => $secrets['YoLink']['APIBaseURL'],
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => '',
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => 'POST',
			CURLOPT_POSTFIELDS => $postFields,
			CURLOPT_HTTPHEADER => array(
				'Content-Type: application/json',
				'YS-CSID: '.$secrets['YoLink']['CSID'],
				'KTT-YS-BRAND: yolink',
				'YS-SEC: '.$secKey
			),
		));
		
		$response = curl_exec($curl);
		
		curl_close($curl);

		$json = json_decode($response, true);

		return $json['data'];
	}
?>