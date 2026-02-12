    Calculadora de IMC - Relatório do Projeto
         Integrantes do Grupo
Tiago Carvalho Gonçalves - Desenvolvedor FullStack
Jonatas Pitta Chaves - Arquiteto de Testes
Rafael Evangelista Almeida Santos - Gerente de Projeto



                                Objetivo
Criar um sistema web para calcular o Índice de Massa Corporal (IMC) com testes unitários.
Estrutura do Projeto
O projeto é composto por três arquivos principais conforme detalhado abaixo:

index.php: Página web com formulário para entrada de dados.

IMC.php: Classe contendo a lógica para o cálculo do IMC.

IMCTest.php: Arquivo com os testes unitários para a classe IMC.php.

                               Detalhe
Bugs Encontrados e Corrigidos
O seguinte bug foi identificado durante a fase de testes e corrigido:
Bug 1: Cálculo Incorreto do IMC
                      

                         Descrição

Função calcularIMC() em IMC.php
Problema
A fórmula estava incorreta: return $peso / $altura; (deveria ser altura ao quadrado)
Teste que Falhou
Teste 1
Correção
A função foi atualizada para: return $peso / ($altura * $altura);

Bug 2: [Descrever se houver outro bug encontrado]
[Informações sobre o Bug 2]
Como Executar
Para garantir a qualidade e o funcionamento correto da lógica de cálculo, a execução dos testes unitários é recomendada.
Testes Unitários
Para executar os testes unitários, utilize o seguinte comando no terminal (assumindo que o PHP esteja instalado e configurado):

php IMCTest.php
