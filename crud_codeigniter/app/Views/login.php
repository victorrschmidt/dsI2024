<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Biblioteca Virtual</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter&family=Noto+Sans+Osmanya&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="/style.css">
</head>
<body class="d-flex flex-column gap-3 py-3">
    <header class="container d-flex flex-column align-items-center gap-2">
        <img src="/img/logo.png" class="d-block mx-auto" width="64" alt="Biblioteca-Virtual-logo">
        <h1 class="text-center fs-4 m-0">Acessar a Biblioteca Virtual</h1>
    </header>
    <main id="main-login" class="container d-flex flex-column gap-3">
        <form id="form-login" method="POST" action="<?php echo base_url(); ?>validar_login" class="grey d-flex flex-column p-4 border border-2 rounded">
            <div class="mb-3">
                <label for="input-login-email" class="form-label">Email</label>
                <input id="input-login-email" name="email" class="form-control<?php if (isset($LOGIN_ERROR)) echo ' is-invalid' ?>" type="email" maxlength="128" required autofocus>
            </div>
            <div class="mb-3">
                <label for="input-login-senha" class="form-label">Senha</label>
                <input id="input-login-senha" name="senha" class="form-control<?php if (isset($LOGIN_ERROR)) echo ' is-invalid' ?>" type="password" maxlength="128" required>
            </div>
            <?php if (isset($LOGIN_ERROR)) { ?>
                <p class="text-danger mb-4">Usuário ou senha incorreto.</p>
            <?php } ?>
            <button class="btn btn-success" type="submit">Entrar</button>
        </form>
        <div class="d-flex flex-column align-items-center p-4 border border-2 rounded">
            <p class="text-center">Não possui uma conta?</p>
            <a href="<?php echo base_url(); ?>criar_conta" class="btn btn-primary w-75">Criar conta</a>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>