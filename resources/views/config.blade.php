<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="{{ route('config') }}" method="post">
        <?php

        if (session()->has('data')) {
            $data = session('data');
            $array = json_decode($data, true);

            if (is_array($array) && !empty($array)) {
                $firstArray = $array[0];
                $firstItemOfArray = $firstArray[0];


                for ($i = 0; $i < count($firstItemOfArray); $i++) {
                    # code...
                    echo "<p>$firstItemOfArray[$i]</p> <select name=\"ocorrencia\">
            <option value=\"arquivo\">arquivo</option>
            <option value=\"ocorrencia\">ocorrencia</option>
            <option value=\"placa\">placa</option>
            <option value=\"cidade\">cidade</option>
            <option value=\"estado\">estado</option>
            <option value=\"data\">data</option>
            </select>";
                }
                // 

                echo "<button type=\"submit\">Enviar</button>";
            }
        } else {
            return redirect()->route('import');
        }

        ?>
    </form>

</body>

</html>

<?php

?>