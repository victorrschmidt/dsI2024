<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar - Biblioteca Virtual</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter&family=Noto+Sans+Osmanya&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="/style.css">
</head>
<body>
    <header class="container-fluid grey">
        <nav class="container navbar navbar-expand-lg py-3">
            <div id="header-content" class="container-fluid">
                <section id="header-left-content" class="overflow-hidden">
                    <span id="avatar-icon" class="material-symbols-outlined">account_circle</span>
                    <div class="d-flex flex-column">
                        <p class="m-0"><?php echo $NOME ?></p>
                        <p class="m-0"><?php echo $EMAIL; ?></p>
                    </div>
                </section>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#header-right-content" aria-controls="header-right-content" aria-expanded="false" aria-label="Abrir menu">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <section id="header-right-content" class="collapse navbar-collapse">
                    <ul id="header-right-content-list" class="navbar-nav">
                        <li class="nav-item">
                            <a href="<?php echo base_url(); ?>adicionar" class="d-flex align-items-center">
                                <span class="material-symbols-outlined header-icon">add</span>
                                <p class="m-0">Adicionar livro</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo base_url(); ?>menu_admin" class="d-flex align-items-center">
                                <span class="material-symbols-outlined header-icon">menu_book</span>
                                <p class="m-0">Livros disponíveis</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo base_url(); ?>usuarios" class="d-flex align-items-center">
                                <span class="material-symbols-outlined header-icon">person</span>
                                <p class="m-0">Lista de usuários</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo base_url(); ?>logout" class="btn btn-danger">Encerrar sessão</a>
                        </li>
                    </ul>
                </section>
            </div>
        </nav>
    </header>
    <main class="container py-3">
        <h1 class="text-center my-3">Atualizar informações do livro #<?php echo $id; ?></h1>
        <form method="POST" action="<?php echo base_url(); ?>editar_livro" id="form-atualizar" class="d-flex flex-column w-100 p-4 mx-auto border border-2 rounded">
            <input name="id" value="<?php echo $id; ?>" type="hidden">
            <div class="mb-3">
                <label for="input-atualizar-titulo" class="form-label">Título do livro</label>
                <input id="input-atualizar-titulo" name="titulo" class="form-control<?php if (isset($TITULO_ERROR)) echo ' is-invalid'; ?>" type="text" pattern="^(?=.*[a-zA-Z]).{1,128}$" maxlength="128" value="<?php echo $titulo; ?>" required autofocus>
            </div>
            <?php if (isset($TITULO_ERROR)) { ?>
                <p class="text-danger mb-4">Livro "<?php echo $TITULO_ERROR_DESC; ?>" já cadastrado.</p>
            <?php } ?>
            <div class="mb-4">
                <label for="input-atualizar-quantidade" class="form-label">Quantidade em estoque</label>
                <input id="input-atualizar-quantidade" name="quantidade" class="form-control" type="number" step="1" min="0" max="4294967294" value="<?php echo $quantidade; ?>" required>
            </div>
            <div class="mb-3">
                <label for="input-atualizar-autor" class="form-label">Nome do(a) autor(a)</label>
                <input id="input-atualizar-autor" name="autor" class="form-control" type="text" pattern="^(?=.*[a-zA-Z]).{1,128}$" maxlength="128" value="<?php echo $autor; ?>" required>
            </div>
            <div class="mb-3">
                <label for="input-atualizar-editora" class="form-label">Nome da editora</label>
                <input id="input-atualizar-editora" name="editora" class="form-control" type="text" pattern="^(?=.*[a-zA-Z]).{1,128}$" maxlength="128" value="<?php echo $editora; ?>" required>
            </div>
            <div class="mb-4">
                <label for="input-atualizar-ano" class="form-label">Ano de publicação</label>
                <input id="input-atualizar-ano" name="ano" class="form-control" type="number" step="1" min="0" max="2023" value="<?php echo $ano; ?>" required>
            </div>
            <button class="btn btn-primary fs-5" type="submit">Atualizar</button>
        </form>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>