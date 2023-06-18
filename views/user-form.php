<?php
require_once "inicio-html.php";
?>
<main class="container">

    <form class="container__formulario"
          method="post">
        <h2 class="formulario__titulo">Faça o cadastro!</h2>

        <div class="formulario__campo">
            <label class="campo__etiqueta" for="nome">Qual é seu nome</label>
            <input name="nome"
                   value=""
                   class="campo__escrita"
                   required
                   id='nome'
            />
        </div>


        <div class="formulario__campo">
            <label class="campo__etiqueta" for="email">Digite seu e-mail</label>
            <input name="email"
                   value=""
                   class="campo__escrita"
                   required
                   placeholder="Exemplo teste@gmail.com"
                   id='email'
                   type="email"
            />
        </div>

        <div class="formulario__campo">
            <label class="campo__etiqueta" for="senha">Digite sua senha</label>
            <input name="senha"
                   value=""
                   class="campo__escrita"
                   required
                   placeholder="Exemplo teste@gmail.com"
                   id='senha'
                   type="password"
            />
        </div>
        <a class="formulario__botao" href="/registro?login">Já possui uma conta ?</a>

        <input class="formulario__botao" type="submit" value="Enviar" />

    </form>

</main>
<?php
require_once "fim-html.php";
?>