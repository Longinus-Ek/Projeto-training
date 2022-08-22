<?php include __DIR__ . '/../inicio-html.php'; ?>
    <form action="/realiza-cadastro" method="post">
        <div class="form-group">
            <label for="email">E-mail:</label>
            <input type="email" name="email" id="email" class="form-control">
        </div>
        <div class="form-group">
            <label for="senha">Senha:</label>
            <input type="password" name="senha" id="senha" class="form-control">
        </div>
        <div class="form-group">
            <label for="senha2">Digite novamente sua senha:</label>
            <input type="password" name="senha2" id="senha2" class="form-control">
        </div>
        <button class="btn btn-primary">
            Realizar Cadastro
        </button>
    </form>
    <form action="/login" method="post">
        <button class="btn btn-secondary">
            Pagina de login
        </button>
    </form>
    
  
<?php include __DIR__ . '/../fim-html.php'; ?>