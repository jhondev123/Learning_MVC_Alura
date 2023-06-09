<?php $this->layout('layout'); ?>
    <main class="container">
        <form class="container__formulario" method="post">
            <h2 class="formulario__titulo">Efetue login</h2>
            <div class="formulario__campo">
                <label class="campo__etiqueta" for="usuario">E-mail</label>
                <input name="email" type="email" class="campo__escrita" required
                       placeholder="Digite seu usuário" id='usuario' />
            </div>

            <div class="formulario__campo">
                <label class="campo__etiqueta" for="senha">Senha</label>
                <input type="password" name="password" class="campo__escrita" required placeholder="Digite sua senha"
                       id='senha' />
            </div>
            <a class="formulario__botao" href="/registro">Não possui uma conta ?</a>
            <input class="formulario__botao" type="submit" value="Entrar" />
        </form>

    </main>
