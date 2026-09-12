<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Pessoas</title>

    <link rel="stylesheet" href="css/style.css">

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f4f6f9;
        }

        nav {
            background: #1e293b;
            padding: 15px 30px;
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
        }

        nav a {
            color: white;
            text-decoration: none;
            padding: 10px 16px;
            border-radius: 8px;
            transition: 0.2s;
        }

        nav a:hover {
            background: #334155;
        }

        .container {
            max-width: 1200px;
            margin: 30px auto;
            padding: 0 20px;
        }

        .btn {
            display: inline-block;
            background: #2563eb;
            color: white;
            padding: 9px 14px;
            border-radius: 7px;
            text-decoration: none;
            border: none;
            cursor: pointer;
        }

        .btn:hover {
            background: #1d4ed8;
        }

        .btn-danger {
            background: #dc2626;
        }

        .btn-danger:hover {
            background: #b91c1c;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border-radius: 10px;
            overflow: hidden;
        }

        th,
        td {
            padding: 12px;
            border-bottom: 1px solid #e5e7eb;
            text-align: left;
        }

        th {
            background: #1e293b;
            color: white;
        }

        input,
        select {
            box-sizing: border-box;
        }
    </style>
</head>

<body>

<nav>
    <a href="index.php?pagina=home">Início</a>
    <a href="index.php?pagina=cadastrar">Cadastrar Pessoa</a>
    <a href="index.php?pagina=listar">Listar Pessoas</a>
    <a href="index.php?pagina=pesquisar">Pesquisar Pessoas</a>
    <a href="movimentacaocreate.php">Nova Movimentação</a>
    <a href="movimentacaolist.php">Movimentações</a>
</nav>

<div class="container">
    <?= $content ?>
</div>

</body>
</html>