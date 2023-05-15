API de Clientes
Uma API para gerenciamento de clientes e seus endereços.

Tecnologias utilizadas
Laravel 8
MySQL

Como instalar e executar
Clone este repositório
Instale as dependências do projeto rodando o comando composer install
Faça uma cópia do arquivo .env.example e renomeie para .env
Configure as variáveis de ambiente de acordo com o seu ambiente (ex.: conexão com banco de dados)
Execute o comando php artisan key:generate para gerar a chave da aplicação
Rode as migrations e seeds com o comando php artisan migrate --seed
Inicie a aplicação com o comando php artisan serve

Métodos da Api

GET /api/clientes: Retorna uma lista de todos os clientes cadastrados no sistema.

GET /api/clientes/{id}: Retorna as informações do cliente com o ID especificado.

POST /api/clientes: Cria um novo cliente com as informações especificadas no corpo da requisição.

PUT /api/clientes/{id}: Atualiza as informações do cliente com o ID especificado com base nas informações fornecidas no corpo da requisição.

DELETE /api/clientes/{id}: Remove o cliente com o ID especificado.

GET /api/clientes/{id}/enderecos: Retorna uma lista de todos os endereços associados ao cliente com o ID especificado.

GET /api/clientes/{id}/enderecos/{endereco_id}: Retorna as informações do endereço com o ID especificado associado ao cliente com o ID especificado.

POST /api/clientes/{id}/enderecos: Cria um novo endereço associado ao cliente com o ID especificado, com base nas informações fornecidas no corpo da requisição.

PUT /api/clientes/{id}/enderecos/{endereco_id}: Atualiza as informações do endereço com o ID especificado associado ao cliente com o ID especificado com base nas informações fornecidas no corpo da requisição.

DELETE /api/clientes/{id}/enderecos/{endereco_id}: Remove o endereço com o ID especificado associado ao cliente com o ID especificado.


Enviei um arquivo Dump do banco de dados e a collection da API, que são ferramentas essenciais para o desenvolvimento e testes da aplicação.

O arquivo Dump é uma cópia completa da base de dados utilizada pela aplicação. Ele contém todas as tabelas, registros e relacionamentos, permitindo que a base de dados seja facilmente restaurada em um ambiente de desenvolvimento ou produção.

Já a collection da API é uma representação da API em formato JSON. Ela descreve todas as rotas disponíveis, seus parâmetros, possíveis respostas e exemplos de requisições e respostas. É uma ferramenta muito útil para testar a API e verificar se todas as rotas estão funcionando corretamente.