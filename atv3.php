<!DOCTYPE html>
<html>
<head>
    <title>Contagem de Números</title>
</head>
<body>
    <h2>Contagem de Números</h2>
    <form method="post">
        <?php for ($i = 0; $i < 10; $i++): ?>
            <label for="numero<?php echo $i; ?>">Número <?php echo $i + 1; ?>:</label>
            <input type="number" id="numero<?php echo $i; ?>" name="numero<?php echo $i; ?>" required><br><br>
        <?php endfor; ?>
        <input type="submit" value="Enviar">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $numeros = [];
        for ($i = 0; $i < 10; $i++) {
            $numeros[] = (int) $_POST["numero$i"];
        }

        $negativos = 0;
        $positivos = 0;
        $pares = 0;
        $impares = 0;

        foreach ($numeros as $numero) {
            if ($numero < 0) {
                $negativos++;
            } elseif ($numero > 0) {
                $positivos++;
            }

            if ($numero % 2 == 0) {
                $pares++;
            } else {
                $impares++;
            }
        }

        echo "Quantidade de números negativos: $negativos<br>";
        echo "Quantidade de números positivos: $positivos<br>";
        echo "Quantidade de números pares: $pares<br>";
        echo "Quantidade de números ímpares: $impares<br>";
    }
    ?>
</body>
</html>
