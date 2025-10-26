# atv_biblioteca

Aplicar o conceito de reuso de software via bibliotecas externas, passando por todas as etapas essenciais:  
Busca e comparação de bibliotecas; 
Escolha justificada; 
Implementação prática; 
Documentação técnica do uso e dos critérios de escolha.


# Módulo HTTP Reutilizável (PHP)

## 📦 Biblioteca utilizada

`guzzlehttp/guzzle` (v7.9.2 ou mais recente)

## 🧰 Instalação

O projeto utiliza o [Composer](https://getcomposer.org/) para gerenciar dependências.

1.  **Instale o Guzzle:**
    (Se você não tem o `composer.json`, rode `composer init -y` primeiro)

    ```bash
    composer require guzzlehttp/guzzle
    ```

2.  **Verifique o `vendor/autoload.php`:**
    O Guzzle (e suas dependências) serão instalados na pasta `vendor/`. O arquivo `test_client.php` já inclui o `vendor/autoload.php` para carregar a biblioteca.

## ⚙️ Execução

Para rodar o protótipo funcional, execute o script `test_client.php` via linha de comando:

```bash
php test_client.php

## 🔍 Saída esperada

--- Testando Módulo HTTP Reutilizável ---
[INFO] GET [https://jsonplaceholder.typicode.com/todos/1](https://jsonplaceholder.typicode.com/todos/1) -> 200 (315 ms)
--- Dados Recebidos ---
{
    "userId": 1,
    "id": 1,
    "title": "delectus aut autem",
    "completed": false
}
-----------------------------------------