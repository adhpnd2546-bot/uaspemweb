<?php
define('API_BASE_URL', 'http://127.0.0.1:8000/api');

function apiGet($endpoint) {
    $url = API_BASE_URL . $endpoint;
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Accept: application/json'
    ]);
    
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    
    if(curl_errno($ch)) {
        curl_close($ch);
        return [];
    }
    
    curl_close($ch);
    
    if ($httpCode >= 200 && $httpCode < 300 && $response !== false) {
        $decoded = json_decode($response, true);
        return is_array($decoded) ? $decoded : [];
    }
    
    return [];
}
?>
