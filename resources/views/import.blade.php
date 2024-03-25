<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Import Archives</title>
</head>

<body>
    <form action="{{ route('import') }}" method="post" enctype="multipart/form-data"> 
        @csrf
        <input type="file" name="xlsx_file" accept=".xlsx">
        <button type="submit">Enviar</button>
    </form>
</body>

</html>