<section id="form-cad" class="form-cad hidden">
    <form action="processa.php" method="post">
        <h2>Cadastro</h2>
        <input type="hidden" name="acao" value="cadastro">
        
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required>
        
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        
        <label for="senha">Senha:</label>
        <input type="password" id="senha" name="senha" required>

        <label for="tipo_usuario">Tipo de Usuário:</label>
        <select id="tipo_usuario" name="tipo_usuario" required>
            <option value="cliente">Cliente</option>
            <option value="funcionario">Funcionário</option>
            <option value="administrador">Administrador</option>
        </select>

        <button class="btn btn-login" onclick="mudarForm()" type="button">Login</button>
        <button class="btn btn-cad" type="submit">Cadastrar</button>
    </form>
</section>
