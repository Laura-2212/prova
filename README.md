#  Locadora

Sistema de locação de filmes desenvolvido em **PHP 8** com banco de dados **PostgreSQL**, permitindo cadastro de clientes, gerenciamento de filmes e controle de aluguéis.

---

##  Tecnologias Utilizadas

* PHP 8
* PostgreSQL
* HTML5
* CSS3
* JavaScript
* PDO (PHP Data Objects)

---

##  Executando o Projeto

### 1. Clone o repositório

```bash
git clone <url-do-repositorio>
cd LocadoraStream
```

### 2. Inicie o servidor PHP

```bash
php -S 0.0.0.0:5000
```

### 3. Acesse a aplicação

Abra o navegador e acesse:

```text
http://localhost:5000/
```

Ou utilize o IP da máquina na rede:

```text
http://Meu_IP:5000
```

---

#  Banco de Dados

O sistema utiliza PostgreSQL com relacionamentos entre clientes, filmes e locações para garantir a integridade dos dados.

## Tabela: clientes

| Campo | Tipo         | Restrições       |
| ----- | ------------ | ---------------- |
| id    | SERIAL       | PRIMARY KEY      |
| nome  | VARCHAR(255) | NOT NULL         |
| email | VARCHAR(255) | UNIQUE, NOT NULL |
| senha | VARCHAR(255) | NOT NULL         |

### Descrição

Armazena os dados dos clientes cadastrados no sistema.

---

## Tabela: filmesByFuncionarios

| Campo          | Tipo         | Restrições  |
| -------------- | ------------ | ----------- |
| id             | SERIAL       | PRIMARY KEY |
| titulo         | VARCHAR(255) | NOT NULL    |
| diretor        | VARCHAR(255) |             |
| ano_lancamento | INTEGER      |             |
| imagem_url     | TEXT         | NOT NULL    |
| sinopse        | TEXT         |             |

### Descrição

Armazena os filmes disponíveis para locação.

---

## Tabela: aluguelfilme

| Campo          | Tipo        | Restrições           |
| -------------- | ----------- | -------------------- |
| id             | SERIAL      | PRIMARY KEY          |
| cliente_id     | INTEGER     | FOREIGN KEY          |
| filme_id       | INTEGER     | FOREIGN KEY          |
| status         | VARCHAR(50) | DEFAULT 'alugado'    |
| data_aluguel   | DATE        | DEFAULT CURRENT_DATE |
| data_devolucao | DATE        |                      |

### Descrição

Registra os aluguéis realizados pelos clientes.

---

# Restaurando o Banco

Para importar o banco através do arquivo de backup:

```bash
psql -U postgres -d cinema -f backup_locadora.sql
```

---

#  Configuração

As credenciais de acesso ao banco podem ser configuradas no arquivo:

```bash
db/conexao.php
```

Exemplo:

```php
$host = "localhost";
$dbname = "locadora";
$user = "postgres";
$password = "senha";
```

A conexão é realizada através do PDO, utilizando Prepared Statements para aumentar a segurança contra SQL Injection.

---

#  Estrutura do Projeto

```text
LocadoraStream/
│
|── CSS/
│   └── style.css
|
├── db/
│   └── conexao.php
│
|── edit_delet_filme.php
|── excluirFilme.php
|── abaFuncionarios.php
|── telaFuncionarios.php
├── index.php
├── filmes.php
├── alugarFilme.php
├── processa_aluguel.php
├── formulario_novo_filme.php
├── logout.php
|── README.md
│
└── backup_locadora.sql
```

---

#  Funcionalidades

###  Clientes

* Cadastro automático de usuários
* Login no sistema
* Logout seguro
* Visualização do catálogo de filmes

###  Filmes

* Cadastro de novos filmes
* Edição de filmes
* Exclusão de filmes
* Visualização de sinopse

###  Aluguéis

* Aluguel de filmes
* Controle de disponibilidade
* Registro de datas de aluguel
* Controle de devolução

---

#  Segurança

O sistema utiliza:

* Sessões PHP
* Prepared Statements
* Validação de formulários
* Controle de autenticação

---

#  Referências

* PHP PDO
* PostgreSQL
* PHP Sessions

---

#  Desenvolvedores

Projeto desenvolvido para fins acadêmicos e aprendizado de desenvolvimento web utilizando PHP e PostgreSQL.
