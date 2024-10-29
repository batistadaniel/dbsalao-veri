session_start();
require 'conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $acao = $_POST['acao'];

    // Lógica de cadastro
    if ($acao === 'cadastro') {
        $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRING);
        $tipo_usuario = filter_input(INPUT_POST, 'tipo_usuario', FILTER_SANITIZE_STRING); // Novo campo

        if (empty($nome) || empty($email) || empty($senha) || empty($tipo_usuario)) {
            $_SESSION['msg'] = "<p class='msg'>Por favor, preencha tudo.</p>";
            header("Location: index.php");
            exit();
        }

        // Verifica se o email já está cadastrado
        $query_verifica_email = "SELECT id FROM usuarios WHERE email = ?";
        $stmt = mysqli_prepare($conexao, $query_verifica_email);
        mysqli_stmt_bind_param($stmt, 's', $email);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);

        if (mysqli_stmt_num_rows($stmt) > 0) {
            $_SESSION['msg'] = "<p class='msg'>Email já cadastrado.</p>";
            header("Location: index.php");
            exit();
        }

        // Insere o novo usuário
        $create_user = "INSERT INTO usuarios (nome, email, senha, tipo_usuario) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_prepare($conexao, $create_user);
        mysqli_stmt_bind_param($stmt, 'ssss', $nome, $email, $senha, $tipo_usuario);
        
        if (mysqli_stmt_execute($stmt)) {
            $_SESSION['msg'] = "<p class='msg' style='color:green'>Usuário cadastrado com sucesso.</p>";
            header("Location: index.php");
        } else {
            $_SESSION['msg'] = "<p class='msg'>Erro ao cadastrar usuário.</p>";
            header("Location: index.php");
        }
    }

    // Lógica de login
    elseif ($acao === 'login') {
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRING);

        $verifica = "SELECT * FROM usuarios WHERE email = ? AND senha = ?";
        $stmt = mysqli_prepare($conexao, $verifica);
        mysqli_stmt_bind_param($stmt, 'ss', $email, $senha);
        mysqli_stmt_execute($stmt);
        $resultado = mysqli_stmt_get_result($stmt);
        $usuario = mysqli_fetch_assoc($resultado);

        if ($usuario) {
            $_SESSION['usuario'] = $usuario['email'];
            $_SESSION['tipo_usuario'] = $usuario['tipo_usuario']; // Armazena o tipo do usuário
            header("Location: home.php");
            exit();
        } else {
            $_SESSION['msg'] = "<p class='msg'>E-mail ou senha inválidos!</p>";
            header("Location: index.php");
            exit();
        }
    }
} else {
    header("Location: index.php");
    exit();
}
