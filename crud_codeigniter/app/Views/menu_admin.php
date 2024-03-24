<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu admin - Biblioteca Virtual</title>
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
                            <a href="<?php echo base_url(); ?>menu_admin" class="link-active d-flex align-items-center">
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
        <h1 class="text-center my-3">Livros disponíveis</h1>
        <?php if (isset($MENSAGEM)) { ?>
            <p class="text-center text-success mb-4 fs-4"><?php echo $MENSAGEM; ?></p>
        <?php } ?>
        <form method="GET" action="<?php echo base_url(); ?>menu_admin" id="form-ordem" class="mb-4">
            <div class="input-group">
                <select class="form-control" name="ordem">
                    <option value="a_z" <?php if (isset($a_z)) echo 'selected'; ?>>A-Z (crescente)</option>
                    <option value="z_a" <?php if (isset($z_a)) echo 'selected'; ?>>Z-A (decrescente)</option>
                    <option value="id_c" <?php if (isset($id_c) || !$ORDENADO) echo 'selected'; ?>>ID (crescente)</option>
                    <option value="id_d" <?php if (isset($id_d)) echo 'selected'; ?>>ID (decrescente)</option>
                    <option value="qtd_c" <?php if (isset($qtd_c)) echo 'selected'; ?>>Quantidade (crescente)</option>
                    <option value="qtd_d" <?php if (isset($qtd_d)) echo 'selected'; ?>>Quantidade (decrescente)</option>
                </select>
                <button class="btn btn-primary" type="submit">Aplicar</button>
            </div>
        </form>
        <form method="GET" action="<?php echo base_url(); ?>menu_admin" class="mb-4 d-flex align-items-end">
            <div class="w-25">
                <label for="input-titulo" class="form-label">Pesquisa por título</label>
                <input id="input-titulo" name="pesquisa" class="form-control" type="text" maxlength="128" value="<?php if (isset($PESQUISA)) echo $PESQUISA; ?>" placeholder="Digite o título do livro">
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
                    <th scope="col">Ano</th>
                    <th scope="col">Editora</th>
                    <th scope="col">Disponíveis</th>
                    <th scope="col">EDITAR</th>
                    <th scope="col">EXCLUIR</th>
                </thead>
                <tbody>
                <?php foreach ($LIVROS as $livro) { ?>
                    <tr valign="middle">
                        <th scope="row"><?php echo $livro['id']; ?></th>
                        <td><?php echo $livro['titulo']; ?></td>
                        <td><?php echo $livro['autor']; ?></td>
                        <td><?php echo $livro['ano']; ?></td>
                        <td><?php echo $livro['editora']; ?></td>
                        <td><?php echo $livro['quantidade']; ?></td>
                        <td>
                            <form method="GET" action="<?php echo base_url(); ?>editar">
                                <input name="id" value="<?php echo $livro['id']; ?>" type="hidden">
                                <input name="titulo" value="<?php echo $livro['titulo']; ?>" type="hidden">
                                <input name="autor" value="<?php echo $livro['autor']; ?>" type="hidden">
                                <input name="ano" value="<?php echo $livro['ano']; ?>" type="hidden">
                                <input name="editora" value="<?php echo $livro['editora']; ?>" type="hidden">
                                <input name="quantidade" value="<?php echo $livro['quantidade']; ?>" type="hidden">
                                <button class="btn btn-primary d-flex align-items-center" type="submit">
                                    <span class="material-symbols-outlined">edit</span>
                                </button> 
                            </form>
                        </td>
                        <td>
                            <form method="POST" action="<?php echo base_url(); ?>excluir_livro">
                                <input name="excluir_livro" value="<?php echo $livro['id']; ?>" type="hidden">  
                                <button class="btn btn-danger d-flex align-items-center" type="submit">
                                    <span class="material-symbols-outlined">close</span>
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