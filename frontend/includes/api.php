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

function apiPost($endpoint, $data = []) {
    $url = API_BASE_URL . $endpoint;
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Accept: application/json'
    ]);
    
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    
    if(curl_errno($ch)) {
        curl_close($ch);
        return ['error' => curl_error($ch)];
    }
    
    curl_close($ch);
    
    if ($response !== false) {
        $decoded = json_decode($response, true);
        return is_array($decoded) ? $decoded : ['error' => 'Invalid response'];
    }
    
    return ['error' => 'No response'];
}

function apiPut($endpoint, $data = []) {
    $url = API_BASE_URL . $endpoint;
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Accept: application/json'
    ]);
    
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    
    if(curl_errno($ch)) {
        curl_close($ch);
        return ['error' => curl_error($ch)];
    }
    
    curl_close($ch);
    
    if ($response !== false) {
        $decoded = json_decode($response, true);
        return is_array($decoded) ? $decoded : ['error' => 'Invalid response'];
    }
    
    return ['error' => 'No response'];
}

function apiPostMultipart($endpoint, $data = [], $fileField = null, $filePath = null) {
    $url = API_BASE_URL . $endpoint;

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
    curl_setopt($ch, CURLOPT_POST, true);

    $postData = $data;
    if ($fileField && $filePath && file_exists($filePath)) {
        $postData[$fileField] = new CURLFile($filePath);
    }

    curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Accept: application/json'
    ]);

    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    if(curl_errno($ch)) {
        curl_close($ch);
        return ['error' => curl_error($ch)];
    }

    curl_close($ch);

    if ($response !== false) {
        $decoded = json_decode($response, true);
        return is_array($decoded) ? $decoded : ['error' => 'Invalid response'];
    }

    return ['error' => 'No response'];
}

function apiDelete($endpoint) {
    $url = API_BASE_URL . $endpoint;
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Accept: application/json'
    ]);
    
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    
    if(curl_errno($ch)) {
        curl_close($ch);
        return ['error' => curl_error($ch)];
    }
    
    curl_close($ch);
    
    if ($response !== false) {
        $decoded = json_decode($response, true);
        return is_array($decoded) ? $decoded : ['error' => 'Invalid response'];
    }
    
    return ['error' => 'No response'];
}
?>
