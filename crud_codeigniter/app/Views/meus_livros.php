<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meus livros - Biblioteca Virtual</title>
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
                            <a href="<?php echo base_url(); ?>menu" class="d-flex align-items-center">
                                <span class="material-symbols-outlined header-icon">menu_book</span>
                                <p class="m-0">Livros disponíveis</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo base_url(); ?>meus_livros" class="link-active d-flex align-items-center">
                                <span class="material-symbols-outlined header-icon">collections_bookmark</span>
                                <p class="m-0">Meus livros</p>
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
        <h1 class="text-center my-3">Meus livros</h1>
        <?php if (isset($MENSAGEM)) { ?>
            <p class="text-center text-success mb-4 fs-4">Livro devolvido com sucesso!</p>
        <?php } ?>
        <form method="GET" action="<?php echo base_url(); ?>meus_livros" id="form-ordem" class="mb-4">
            <div class="input-group">
                <select class="form-control" name="ordem">
                    <option value="a_z" <?php if (isset($a_z) || !$ORDENADO) echo 'selected'; ?>>A-Z (crescente)</option>
                    <option value="z_a" <?php if (isset($z_a)) echo 'selected'; ?>>Z-A (decrescente)</option>
                    <option value="data_c" <?php if (isset($data_c)) echo 'selected'; ?>>Aluguel (mais recentes)</option>
                    <option value="data_d" <?php if (isset($data_d)) echo 'selected'; ?>>Aluguel (mais antigos)</option>
                </select>
                <button class="btn btn-primary" type="submit">Aplicar</button>
            </div>
        </form>
        <form method="GET" action="<?php echo base_url(); ?>meus_livros" class="mb-4 d-flex align-items-end form-ordem">
            <div class="w-25">
                <label for="input-titulo" class="form-label">Pesquisa por título</label>
                <input id="input-titulo" name="pesquisa" class="form-control" type="text" maxlength="128" placeholder="Digite o título do livro">
            </div>
            <button class="btn btn-primary" type="submit">
                <span class="material-symbols-outlined header-icon fs-5">search</span>
            </button>
        </form>
        <div class="table-responsive">
            <table id="tabela-livros" class="table table-striped border border-2">
                <thead>
                    <th scope="col">#</th>
                    <th scope="col">Título</th>
                    <th scope="col">Autor(a)</th>
                    <th scope="col">Data de aluguel</th>
                    <th scope="col">DEVOLVER</th>
                </thead>
                <tbody>
                <?php foreach ($LIVROS as $livro) { ?>
                    <tr valign="middle">
                        <th scope="row"><?php echo $livro['id']; ?></th>
                        <td><?php echo $livro['titulo']; ?></td>
                        <td><?php echo $livro['autor']; ?></td>
                        <td><?php echo $livro['inicio']; ?></td>
                        <td>
                            <form method="POST" action="<?php echo base_url(); ?>devolver_livro">
                                <input name="devolver_livro" value="<?php echo $livro['id']; ?>" type="hidden">  
                                <button class="btn btn-danger d-flex align-items-center" type="submit">
                                    <span class="material-symbols-outlined">undo</span>
                                </button> 
                            </form>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>