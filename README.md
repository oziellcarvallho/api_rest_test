# **Api REST Laravel**

## **Descrição**

Este projeto tem como objetivo desenvolver uma API Restful para o gerenciamento de projetos e tarefas. Nele, os usuários são divididos em Super Admin, com acesso total ao sitema, gerentes, responsáveis por cadastrar os projetos, e executores, encarregados de realizar as tarefas. A API utiliza um sistema de Controle de Acesso (ACL) para gerenciar as permissões com base no tipo de usuário.

## **Pré-requisitos para a instalação**

- Laravel Framework 6.20.44
- PHP 7.4.33
- Banco de Dados MySQL

## **Instalação**

Copie o arquivo “.env.example” dê no nome “.env” ao novo arquivo e faça a configuração do banco de dados.

Execute os comandos abaixo no termial:
- composer install
- php artisan jwt:secret
- composer dump-autoload
- php artisan migrate
- php artisan db:seed

## **Execução**

Execute o comando `php artisan serve` no terminal ou use um servidor ngnix ou apache.

## **Usuários pré cadastrados**

| Tipo | E-mail  | Senha |
|--|--|--|
| Super Admin | super@admin.com | 123456 |
| Gerente Teste | gerente@teste.com | 123456 |
| Executor Teste | executor@teste.com | 123456 |

## **Modelos**

| Modelo | Atributos |
|--|--|
| User | id, name, cpf, email, email_verified_at, password, type, remember_token, created_at, updated_at, deleted_at |
| Project | id, name, deadline, finished, user_id, created_at, updated_at, deleted_at |
| Task | id, title, description, deadline, finished, executor_id, project_id, created_at, updated_at, deleted_at |
| Group | id, parent_id, name, sort, created_at, updated_at |
| Permission | id, group_id, name, display_name, sort, created_at, updated_at |
| PermissionType | id, type, permission_id, created_at, updated_at |
| PermissionUser | id, permission_id, user_id |

## **Diagrama de Classes**

![ER](Diagram.png)

## **API**

Para testar a API utilize o **POSTMAN** e importe a collection disponibilizada na raiz do projeto que possui o nome **api_rest_test.postman_collection.json**

Todas as requests devem possuir o cabeçalho abaixo:

- Accept: application/json
- Content-Type: application/json
- Authorization: Bearer \*token\*

Quando aplicável, o body deve ser do tipo **JSON**

## **Rotas**

Url base: http://localhost:8000/api

### **Autenticação**
| Descrição | Método | Endpoint | Parâmetros | Retorno | 
|--|--|--|--|--|
| Login | POST | /auth/login | Body {email: string, password: string} | access_token: string, token_type: string, expires_in: int |
| Logout | POST | /auth/logout | | message: string |
| Refresh | POST | /auth/refresh | | access_token: string, token_type: string, expires_in: int |
| Eu | POST | /auth/me | | id: int, name: string, cpf: string, email: string, type: string, created_at: data_time - string, updated_at: data_time - string, deleted_at: data_time - string |

### **Usuários**

| Descrição | Método | Endpoint | Parâmetros | Retorno |
|--|--|--|--|--|
| Listar/Buscar Usuários | GET | /user | Query {(opcional) q=nome_ou_email} | users: Lista {id: int, name: string, cpf: string, email: string, type: string, created_at: data_time - string, updated_at: data_time - string, deleted_at: data_time - string} com paginação |
| Criar Usuário | POST | /user | Body {name: string, email: string, cpf: string, password: string , password_confirmation: string, type: string} | message: string, user: {id: int, name: string, cpf: string, email: string, type: string, created_at: data_time - string, updated_at: data_time - string} |
| Obter Usuário | GET | /user/{id} |  | user: {id: int, name: string, cpf: string, email: string, type: string, created_at: data_time - string, updated_at: data_time - string, deleted_at: data_time - string} |
| Editar Usuário | PUT | /user/{id} | Body {name: string, email: string, cpf: string, password: string , password_confirmation: string, type: string} | message: string, user: {id: int, name: string, cpf: string, email: string, type: string, created_at: data_time - string, updated_at: data_time - string, deleted_at: data_time - string} |
| Excluir Usuário | DELETE | /user/{id} |  | message: string, user: {id: int, name: string, cpf: string, email: string, type: string, created_at: data_time - string, updated_at: data_time - string, deleted_at: data_time - string} |

Obs:
- Não há como cadastrar novos Super Admin e somente o Super Admin ou os Gerentes podem cadastrar novos usuários do tipo gerente ou executor.
- O campo "type" pode assumir dois valores "manager" (gerente) ou "executioner" (executor).
- Todos os parâmetros do Body da rota de edição de Usuário são opcionais.

### **Projetos**

| Descrição | Método | Endpoint | Parâmetros | Retorno |
|--|--|--|--|--|
| Listar/Buscar Projetos | GET | /project | Query {(opcional) q=nome} | projects: Lista {id: int, name: string, deadline: data_time - string, finished: data_time - string, user_id: int, created_at: data_time - string, updated_at: data_time - string, deleted_at: data_time - string} com paginação |
| Criar Projeto | POST | /project | Body {name: string, deadline: data_time - string} | message: string, project: {id: int, name: string, deadline: data_time - string, finished: data_time - string, user_id: int, created_at: data_time - string, updated_at: data_time - string} |
| Obter Projeto | GET | /project/{id} |  | project: {id: int, name: string, deadline: data_time - string, finished: data_time - string, user_id: int, created_at: data_time - string, updated_at: data_time - string, deleted_at: data_time - string} |
| Editar Projeto | PUT | /project/{id} | Body {name: string, deadline: data_time - string, finished: data_time - string} | message: string, project: {id: int, name: string, deadline: data_time - string, finished: data_time - string, user_id: int, created_at: data_time - string, updated_at: data_time - string, deleted_at: data_time - string} |
| Excluir Projeto | DELETE | /project/{id} |  | message: string, project: {id: int, name: string, deadline: data_time - string, finished: data_time - string, user_id: int, created_at: data_time - string, updated_at: data_time - string, deleted_at: data_time - string} |

Obs:
- Todos os parâmetros do Body da rota de edição de Projeto são opcionais.

### **Tarefas**

| Descrição | Método | Endpoint | Parâmetros | Retorno |
|--|--|--|--|--|
| Listar/Buscar Tarefas | GET | /task | Query {(opcional) q=título_ou_descrição} | tasks: Lista {id: int, title: string, description: string, deadline: data_time - string, finished: data_time - string, executor_id: int, project_id: int, created_at: data_time - string, updated_at: data_time - string, deleted_at: data_time - string} com paginação |
| Criar Tarefa | POST | /task | Body {title: string, (opcional) description: string, deadline: data_time - string, executor_id: int, project_id: int} | message: string, task: {id: int, title: string, description: string, deadline: data_time - string, finished: data_time - string, executor_id: int, project_id: int, created_at: data_time - string, updated_at: data_time - string} |
| Obter Tarefa | GET | /task/{id} |  | task: {id: int, title: string, description: string, deadline: data_time - string, finished: data_time - string, executor_id: int, project_id: int, created_at: data_time - string, updated_at: data_time - string, deleted_at: data_time - string} |
| Editar Tarefa | PUT | /task/{id} | Body {title: string, description: string, deadline: data_time - string, finished: data_time - string, executor_id: int, project_id: int} | message: string, task: {id: int, title: string, description: string, deadline: data_time - string, finished: data_time - string, executor_id: int, project_id: int, created_at: data_time - string, updated_at: data_time - string, deleted_at: data_time - string} |
| Excluir Tarefa | DELETE | /task/{id} |  | message: string, task: {id: int, title: string, description: string, deadline: data_time - string, finished: data_time - string, executor_id: int, project_id: int, created_at: data_time - string, updated_at: data_time - string, deleted_at: data_time - string} |

Obs:
- Todos os parâmetros do Body da rota de edição de Tarefa são opcionais.
- No campo "executor_id" deve ser informado o id de um usuário válido não excluído.

### **Erros**
| Descrição | Mensagem | Código Http |
|--|--|--|
| Usuário ou Senha incorretos | Unauthorized | 401 |
| Token inválido | Invalid token | 401 |
| Token expirado | Token expired | 401 |
| Token não encontrado | Token not found | 401 |
| Usuário não encontrado | User not found | 401 |
| Permissão Negada | Permission denied | 403 |
| Dados Inválidos | *Retorna uma mensagem com o erro específico no dado* | 400 |
| Falha de Sistema | *Retorna uma mensagem com o erro específico* | 500 |