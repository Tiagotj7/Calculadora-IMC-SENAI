Criar o Relatório (README.md)
Crie um arquivo README.md com o seguinte conteúdo:

# Calculador de IMC - Relatório do Projeto

## Integrantes do Grupo
- Tiago Carvalho Gonçalves
- Jonatas Pitta Chaves
- Rafael Evangelista Almeida Santos

## Objetivo
Criar um sistema web para calcular o Índice de Massa Corporal (IMC) com
testes unitários.

## Estrutura do Projeto
- `index.php`: Página web com formulário
- `IMC.php`: Classe com lógica de cálculo
- `IMCTest.php`: Testes unitários

## Bugs Encontrados e Corrigidos

### Bug 1: Cálculo Incorreto do IMC
- **Localização:** Função `calcularIMC()` em `IMC.php`
- **Problema:** `return $peso / $altura;` (deveria ser altura ao quadrado)
- **Teste que Falhou:** Teste 1
- **Solução:** `return $peso / ($altura * $altura);`

### Bug 2: [Descrever se houver outro bug encontrado]

## Como Executar

### Testes Unitários
php IMCTest.php
