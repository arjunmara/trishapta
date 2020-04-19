<?php

return [
  'gcm' => [
      'priority' => 'normal',
      'dry_run' => false,
      'apiKey' => 'AAAA2wqGQE0:APA91bFLOZRFbw_PfcjaobLedx3AZ-R26S6qtWjSe7MJJdBQVudwljyuQdmwMmSBp2nz_FHH5HMBYXDKHk8qYcTirPv8m-0WhybswfM_X9408uK9LMzzmFwm3oF8N5EGUN3JVKPjui_n',
  ],
  'fcm' => [
        'priority' => 'normal',
        'dry_run' => false,
        'apiKey' => 'AAAA2wqGQE0:APA91bFLOZRFbw_PfcjaobLedx3AZ-R26S6qtWjSe7MJJdBQVudwljyuQdmwMmSBp2nz_FHH5HMBYXDKHk8qYcTirPv8m-0WhybswfM_X9408uK9LMzzmFwm3oF8N5EGUN3JVKPjui_n',
  ],
  'apn' => [
      'certificate' => __DIR__ . '/iosCertificates/apns-dev-cert.pem',
      'passPhrase' => '1234', //Optional
      'passFile' => __DIR__ . '/iosCertificates/yourKey.pem', //Optional
      'dry_run' => true
  ]
];