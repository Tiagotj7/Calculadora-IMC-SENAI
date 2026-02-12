<?php

class IMC
{
    /**
     * Valida se peso e altura são valores realistas.
     *
     * @param float $peso   Peso em kg
     * @param float $altura Altura em metros
     * @return bool
     */
    public function validarEntrada(float $peso, float $altura): bool
    {
        // Peso deve ser maior que 0 e menor que um limite máximo razoável
        if ($peso <= 0 || $peso > 400) {
            return false;
        }

        // Altura deve ser maior que 0 e até 3 metros (limite realista)
        if ($altura <= 0 || $altura > 3) {
            return false;
        }

        return true;
    }

    /**
     * Calcula o IMC com base no peso e altura.
     *
     * Fórmula: IMC = peso / (altura * altura)
     *
     * @param float $peso   Peso em kg
     * @param float $altura Altura em metros
     * @return float        IMC com 2 casas decimais
     *
     * @throws InvalidArgumentException Se os dados forem inválidos
     */
    public function calcularIMC(float $peso, float $altura): float
    {
        if (!$this->validarEntrada($peso, $altura)) {
            throw new InvalidArgumentException('Peso ou altura inválidos.');
        }

        $imc = $peso / ($altura * $altura);

        // Arredonda para 2 casas decimais para apresentação
        return round($imc, 2);
    }

    /**
     * Classifica o IMC de acordo com faixas padrão.
     *
     * - Abaixo de 18.5: "Abaixo do peso"
     * - 18.5 a 24.9:    "Peso normal"
     * - 25 a 29.9:      "Sobrepeso"
     * - 30 ou mais:     "Obesidade"
     *
     * @param float $imc
     * @return string
     */
    public function classificarIMC(float $imc): string
    {
        if ($imc < 18.5) {
            return 'Abaixo do peso';
        } elseif ($imc < 25) {
            return 'Peso normal';
        } elseif ($imc < 30) {
            return 'Sobrepeso';
        } else {
            return 'Obesidade';
        }
    }
}
