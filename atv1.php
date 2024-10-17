<!DOCTYPE html>
<html>
<head>
    <title>Cadastro de Produtos</title>
</head>
<body>
    <h2>Cadastro de Produtos</h2>
    <form method="post">
        <?php for ($i = 0; $i < 5; $i++): ?>
            <label for="nome<?php echo $i; ?>">Nome do Produto <?php echo $i + 1; ?>:</label>
            <input type="text" id="nome<?php echo $i; ?>" name="nome<?php echo $i; ?>" required><br>
            <label for="preco<?php echo $i; ?>">Preço do Produto <?php echo $i + 1; ?>:</label>
            <input type="number" step="0.01" id="preco<?php echo $i; ?>" name="preco<?php echo $i; ?>" required><br><br>
        <?php endfor; ?>
        <input type="submit" value="Enviar">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $produtos = receberProdutos();

        $qtdInferiores50 = contarProdutosInferiores($produtos, 50);
        echo "Quantidade de produtos com preço inferior a R\$50,00: $qtdInferiores50<br>";

        $produtosEntre50e100 = listarProdutosEntre($produtos, 50, 100);
        echo "Produtos com preço entre R\$50,00 e R\$100,00: " . implode(", ", $produtosEntre50e100) . "<br>";

        $mediaSuperiores100 = calcularMediaSuperiores($produtos, 100);
        echo "Média dos preços dos produtos com preço superior a R\$100,00: " . number_format($mediaSuperiores100, 2) . "<br>";
    }

    function receberProdutos() {
        $produtos = [];
        for ($i = 0; $i < 5; $i++) {
            $nome = $_POST["nome$i"];
            $preco = (float) $_POST["preco$i"];
            $produtos[] = ['nome' => $nome, 'preco' => $preco];
        }
        return $produtos;
    }

    function contarProdutosInferiores($produtos, $limite) {
        $contagem = 0;
        foreach ($produtos as $produto) {
            if ($produto['preco'] < $limite) {
                $contagem++;
            }
        }
        return $contagem;
    }

    function listarProdutosEntre($produtos, $minimo, $maximo) {
        $lista = [];
        foreach ($produtos as $produto) {
            if ($produto['preco'] >= $minimo && $produto['preco'] <= $maximo) {
                $lista[] = $produto['nome'];
            }
        }
        return $lista;
    }

    function calcularMediaSuperiores($produtos, $limite) {
        $soma = 0;
        $contagem = 0;
        foreach ($produtos as $produto) {
            if ($produto['preco'] > $limite) {
                $soma += $produto['preco'];
                $contagem++;
            }
        }
        return $contagem > 0 ? $soma / $contagem : 0;
    }
    ?>
</body>
</html>
