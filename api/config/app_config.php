<?php

$url = filter_input(INPUT_SERVER, 'REQUEST_URI', FILTER_SANITIZE_URL);
$https = filter_input(INPUT_SERVER, 'HTTPS', FILTER_VALIDATE_BOOLEAN);
$host = filter_input(INPUT_SERVER, 'HTTP_HOST', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

$protocol = $https ? 'https://' : 'http://';

$path = parse_url($url, PHP_URL_PATH);
$segments = explode('/', $path);

if (count($segments) > 1) {
    $folder = $segments[1];
} else {
    $folder = '';
}

$url = $protocol . $host . '/' . $folder;

return (object) array(
            'deputadoId' => 204379,
            'deputadoNome' => 'Acácio Favacho',
            'legislatura' => 57,
            'appName' => "SISGab - v1.0",
            'appURL' => $url,
            'urlWWW' => $url . '/www',
            'logUrl' => "../../api/log/",
            'key' => "Gabinete414Acacio",
            'clientKey' => "cda2c99fbf5e19f20d331299c15a4491"
);
