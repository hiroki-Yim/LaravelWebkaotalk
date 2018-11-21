<?php

return [
	'AUTH_URL'			=> 'https://kauth.kakao.com',
	'API_URL'      	=> 'https://kapi.kakao.com',
	'API_VERSION'  	=> '/v1',

	'REDIRECT_URL' 	=> env('KAKAO_URL','/auth/kakaologincallback'),

	'API_KEY'   => env('KAKAO_KEY', 'd97a570e533908bbaa3fa0a08c4397a3'),
	'ADMIN_KEY' => env('KAKAO_ADMIN_KEY', '16717ab6fac5ff1d6906fe728d3f0ece'),
];