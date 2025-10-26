<?php
// test_client.php

// 1. Incluir o autoloader do Composer, que carrega a biblioteca
require 'vendor/autoload.php';

// 2. Importar as classes
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ConnectException;

/**
 * httpClient.php (Função Reutilizável)
 * * Realiza uma chamada HTTP GET para uma URL, medindo o tempo 
 * e logando o resultado no formato especificado.
 *
 * @param string $url A URL para a qual fazer a requisição.
 * @return string|null O corpo da resposta em caso de sucesso, ou null em caso de falha.
 */
function simpleGet(string $url): ?string
{
    // 3. Inicializa o cliente Guzzle com um timeout de 5 segundos
    $client = new Client([
        'timeout' => 5.0,
    ]);

    $startTime = microtime(true); // Marca o tempo de início

    try {
        // 4. Executa a requisição usando a biblioteca Guzzle
        $response = $client->request('GET', $url);

        // 5. Calcula a duração e formata
        $durationMs = (microtime(true) - $startTime) * 1000;
        $statusCode = $response->getStatusCode();

        // 6. Loga o sucesso (conforme "Saída esperada" do exercício)
        printf(
            "[INFO] GET %s -> %d (%.0f ms)\n",
            $url,
            $statusCode,
            $durationMs
        );

        // 7. Retorna o corpo da resposta como string
        return $response->getBody()->getContents();

    } catch (ConnectException $e) {
        // Trata erros de conexão (ex: DNS, rede, timeout)
        $durationMs = (microtime(true) - $startTime) * 1000;
        printf(
            "[ERROR] GET %s -> [TIMEOUT/DNS] (%.0f ms) | Erro: %s\n",
            $url,
            $durationMs,
            $e->getMessage()
        );
        return null;

    } catch (RequestException $e) {
        // Trata erros de HTTP (ex: 404, 500)
        $durationMs = (microtime(true) - $startTime) * 1000;
        $statusCode = $e->hasResponse() ? $e->getResponse()->getStatusCode() : '---';

        printf(
            "[ERROR] GET %s -> %s (%.0f ms) | Erro: %s\n",
            $url,
            $statusCode,
            $durationMs,
            $e->getMessage()
        );
        return null;
    }
}

// --- Bloco de Teste / Execução ---
// Este bloco só roda quando executamos "php test_client.php"
// (Verifica se este é o script principal sendo executado)
if (basename(__FILE__) === basename($_SERVER['SCRIPT_FILENAME'])) {
    
    // Usamos uma API pública de testes
    $testUrl = 'https://jsonplaceholder.typicode.com/todos/1';
    
    echo "--- Testando Módulo HTTP Reutilizável ---\n";
    $data = simpleGet($testUrl);

    if ($data) {
        echo "--- Dados Recebidos ---\n";
        
        // Decodifica o JSON para exibição formatada
        $jsonData = json_decode($data);
        echo json_encode($jsonData, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
        echo "\n";
    } else {
        echo "--- Teste falhou ---\n";
    }
    echo "-----------------------------------------\n";
}