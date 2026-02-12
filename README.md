```markdown
# Calculador de IMC - Relatório do Projeto

## Integrantes do Grupo

- Tiago Carvalho Gonçalves - Desenvolvedor FullStack  
- Jonatas Pitta Chaves - Arquiteto de Testes  
- Rafael Evangelista Almeida Santos - Gerente de Projeto  

## Objetivo

Criar um sistema web para calcular o Índice de Massa Corporal (IMC) com testes unitários.

## Estrutura do Projeto

- `index.php`: Página web com formulário  
- `IMC.php`: Classe com lógica de cálculo  
- `IMCTest.php`: Testes unitários  

## Bugs Encontrados e Corrigidos

### Bug 1: Cálculo Incorreto do IMC

- **Localização:** Função `calcularIMC()` em `IMC.php`  
- **Problema:**  
  ```php
  return $peso / $altura;
  ```
  (deveria ser altura ao quadrado)  
- **Teste que Falhou:** Teste 1  
- **Solução:**  
  ```php
  return $peso / ($altura * $altura);
  ```

### Bug 2: [Descrever se houver outro bug encontrado]

- **Localização:** [Função e arquivo onde o bug foi identificado]  
- **Problema:** [Descrição do comportamento incorreto observado]  
- **Teste que Falhou:** [Qual teste apontou o erro]  
- **Solução:** [O que foi alterado para corrigir o bug]  

## Como Executar

### Testes Unitários

No diretório do projeto, executar:

```bash
php IMCTest.php
```
```
