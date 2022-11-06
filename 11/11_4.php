<?php 

$url = 'https://api.github.com/gists';
$data = [
    'public' => true,
    'description' => "자신의 내용을 gist로 나타냄.",
    'files' => [basename(__FILE__) => 
                    ['content' => file_get_contents(__FILE__)]
                ]
];
$c = curl_init($url);
curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
curl_setopt($c, CURLOPT_POST, true);
curl_setopt($c, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
curl_setopt($c, CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($c, CURLOPT_USERAGENT, 'learning-php-7/exercise');

$response = curl_exec($c);
if($response === false) {
    print "요청을 생성할 수 없습니다.";
} else {
    $info = curl_getinfo($c);
    if($info['http_code'] != 201) {
        print "gist를 생성할 수 없습니다. 오류 코드: {$info['http_code']}\n";
        print $response;
    } else {
        $body = json_decode($response);
        print "{$body->html_url} gist를 생성했습니다.\n";
    }
}






?>