<!DOCTYPE html>
<html>
<head>
    <title>Cadastro de Alunos</title>
</head>
<body>
    <h2>Cadastro de Alunos</h2>
    <form method="post">
        <?php for ($i = 0; $i < 10; $i++): ?>
            <label for="nome<?php echo $i; ?>">Nome do Aluno <?php echo $i + 1; ?>:</label>
            <input type="text" id="nome<?php echo $i; ?>" name="nome<?php echo $i; ?>" required><br>
            <label for="nota<?php echo $i; ?>">Nota do Aluno <?php echo $i + 1; ?>:</label>
            <input type="number" step="0.01" id="nota<?php echo $i; ?>" name="nota<?php echo $i; ?>" required><br><br>
        <?php endfor; ?>
        <input type="submit" value="Enviar">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $alunos = [];
        for ($i = 0; $i < 10; $i++) {
            $nome = $_POST["nome$i"];
            $nota = (float) $_POST["nota$i"];
            $alunos[] = ['nome' => $nome, 'nota' => $nota];
        }

        function calcularMedia($alunos) {
            $soma = 0;
            foreach ($alunos as $aluno) {
                $soma += $aluno['nota'];
            }
            return $soma / count($alunos);
        }

        function encontrarMaiorNota($alunos) {
            $maiorNota = -1;
            $nomeAluno = '';
            foreach ($alunos as $aluno) {
                if ($aluno['nota'] > $maiorNota) {
                    $maiorNota = $aluno['nota'];
                    $nomeAluno = $aluno['nome'];
                }
            }
            return $nomeAluno;
        }

        $media = calcularMedia($alunos);
        echo "Média de nota da classe: " . number_format($media, 2) . "<br>";

        $alunoMaiorNota = encontrarMaiorNota($alunos);
        echo "Aluno com maior nota: $alunoMaiorNota<br>";
    }
    ?>
</body>
</html>
