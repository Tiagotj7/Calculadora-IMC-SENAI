# 🧮 CALCULADORA DE IMC EM PHP

### Aplicação Web com PHP Orientado a Objetos, MySQL e Boas Práticas de Desenvolvimento
---

## Integrantes do Grupo

- Tiago Carvalho Gonçalves - Desenvolvedor FullStack  
- Jonatas Pitta Chaves - Arquiteto de Testes  
- Rafael Evangelista Almeida Santos - Gerente de Projeto  

---

## 📖 Sobre o Projeto

A **Calculadora de IMC** é uma aplicação web desenvolvida em **PHP 8+**, utilizando **Programação Orientada a Objetos (POO)** e persistência de dados em **MySQL**.

O sistema permite:

- Calcular o Índice de Massa Corporal (IMC)
- Classificar o resultado conforme padrões internacionais
- Armazenar os dados no banco de dados
- Validar entradas do usuário
- Aplicar boas práticas de segurança

O projeto foi estruturado com foco em organização, clareza de código e aplicação de conceitos fundamentais de backend.

---

# ✨ Funcionalidades

✔ Cálculo automático do IMC  
✔ Classificação baseada em faixas padrão  
✔ Validação de dados no backend  
✔ Persistência dos dados em banco MySQL  
✔ Uso de Prepared Statements (PDO)  
✔ Proteção contra XSS  
✔ Padrão PRG (Post → Redirect → Get)  
✔ Testes automatizados simples  
✔ Interface limpa e estilizada com CSS  

---

# 🏗 Estrutura do Projeto

```

/
├── index.php          # Interface + processamento da aplicação
├── IMC.php            # Classe com regras de negócio
├── testes.php         # Testes automatizados
├── database.sql       # Script de criação do banco
└── README.md

````

---

# ⚙️ Tecnologias Utilizadas

- **PHP 8+**
- **MySQL / MariaDB**
- **PDO**
- **HTML5**
- **CSS3**

---

# 🧠 Conceitos Aplicados

- Programação Orientada a Objetos (POO)
- Separação de responsabilidades
- Tratamento de exceções
- Segurança contra XSS
- Prevenção contra SQL Injection
- Validação de dados no servidor
- Padrão PRG (Post/Redirect/Get)

---

# 🗄️ Configuração do Banco de Dados

Execute o script abaixo no seu MySQL:

```sql
CREATE DATABASE IF NOT EXISTS calculador_imc
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_general_ci;

USE calculador_imc;

CREATE TABLE IF NOT EXISTS registros_imc (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NULL,
    peso DECIMAL(5,2) NOT NULL,
    altura DECIMAL(3,2) NOT NULL,
    imc DECIMAL(5,2) NOT NULL,
    classificacao VARCHAR(30) NOT NULL,
    data_calculo DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
);
````

---

# 🔧 Configuração da Conexão

No arquivo `index.php`, configure conforme seu ambiente:

```php
$pdo = new PDO(
    'mysql:host=localhost:3307;dbname=calculador_imc;charset=utf8mb4',
    'root',
    ''
);
```

Caso necessário, altere:

* Host
* Porta
* Usuário
* Senha

---

# ▶️ Como Executar o Projeto

### 1️⃣ Clonar o repositório

```bash
git clone https://github.com/seu-usuario/calculadora-imc.git
```

### 2️⃣ Configurar o banco de dados

Execute o script SQL fornecido acima.

### 3️⃣ Colocar o projeto no servidor local

* XAMPP → `htdocs`
* WAMP → `www`

### 4️⃣ Iniciar serviços

Inicie o **Apache** e o **MySQL**.

### 5️⃣ Acessar no navegador

```
http://localhost/calculadora-imc
```

---

# 🧪 Executando os Testes

Para rodar os testes:

```bash
php testes.php
```

Saída esperada:

```
PASSOU: Cálculo correto do IMC (70kg, 1.75m)
PASSOU: Classificação Peso normal
PASSOU: Classificação Sobrepeso
PASSOU: Validação entrada válida (70kg, 1.75m)
PASSOU: Validação peso inválido (0kg)
PASSOU: Validação altura inválida (3.5m)
```

---

# 📐 Fórmula Utilizada

[
IMC = \frac{peso}{altura^2}
]

---

# 🔐 Boas Práticas de Segurança

* Uso de `htmlspecialchars()` para evitar XSS
* Uso de `PDO::prepare()` para prevenir SQL Injection
* Validação rigorosa de dados antes do processamento
* Tratamento de exceções com `try/catch`
* Separação entre regra de negócio e camada de apresentação

---

# 🚀 Melhorias Futuras

* 📊 Página de listagem dos registros
* 🔎 Filtro por nome ou data
* 🗑️ Exclusão de registros
* ✏️ Edição de registros
* 📱 Layout responsivo
* 🧪 Testes com PHPUnit
* 🐳 Dockerização do projeto

---

# 📄 Licença

Este projeto é destinado para fins educacionais e profissionais.
