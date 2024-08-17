<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRD - Laravel</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter&family=Noto+Sans+Osmanya&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body class="d-flex flex-column gap-3 py-3">
    <header class="container d-flex flex-column align-items-center gap-2">
        <h1 class="text-center fs-4 m-0">Adicionar usuário</h1>
    </header>
    <main class="container d-flex align-items-center flex-column gap-3">
        <form method="GET" action="{{url('adicionar')}}" class="w-25 grey d-flex flex-column p-4 border border-2 rounded">
            <div class="mb-3">
                <label for="nome" class="form-label">Nome</label>
                <input id="nome" name="nome" class="form-control" type="text" maxlength="128" required autofocus>
            </div>
            <div class="mb-3">
                <label for="sobrenome" class="form-label">Sobrenome</label>
                <input id="sobrenome" name="sobrenome" class="form-control" type="text" maxlength="128" required autofocus>
            </div>
            <div class="mb-3">
                <label for="idade" class="form-label">Idade</label>
                <input id="idade" name="idade" class="form-control" type="number" min="0" max="200" step="1" required autofocus>
            </div>
            <button class="btn btn-success" type="submit">Adicionar</button>
        </form>
    </main>
    <footer class="container d-flex align-items-center flex-column gap-3">
        <table class="w-75 table table-striped border border-2">
            <caption>Lista de usuários</caption>
            <thead>
                <th scope="col">#</th>
                <th scope="col">Nome</th>
                <th scope="col">Sobrenome</th>
                <th scope="col">Idade</th>
            </thead>
            <tbody>
                @foreach($usuarios as $usuario)
                    <tr>
                        <td>{{$usuario->id}}</td>
                        <td>{{$usuario->nome}}</td>
                        <td>{{$usuario->sobrenome}}</td>
                        <td>{{$usuario->idade}}</td>
                        <td>
                            <form method="GET" action="/deletar/{{$usuario->id}}">
                                <div class="form-group">
                                    <input type="submit" class="btn btn-danger" value="Deletar usuário">
                                </div>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>