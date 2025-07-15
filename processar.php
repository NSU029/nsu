<?php
date_default_timezone_set('Europe/Lisbon');

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nome = isset($_POST['name']) ? htmlspecialchars(trim($_POST['name'])) : '';
    $email = isset($_POST['email']) ? htmlspecialchars(trim($_POST['email'])) : '';

    $phone = isset($_POST['phone']) ? htmlspecialchars(trim($_POST['phone'])) : '';
    $website = isset($_POST['website']) ? htmlspecialchars(trim($_POST['website'])) : '';
    $preferreddate = isset($_POST['preferreddate']) ? trim($_POST['preferreddate']) : '';
    $company = isset($_POST['company']) ? htmlspecialchars(trim($_POST['company'])) : '';
    $category = isset($_POST['category']) ? htmlspecialchars(trim($_POST['category'])) : '';
    $budget = isset($_POST['budget']) ? htmlspecialchars(trim($_POST['budget'])) : '';

    $assunto = isset($_POST['subject']) ? htmlspecialchars(trim($_POST['subject'])) : '';
    $mensagem = isset($_POST['message']) ? htmlspecialchars(trim($_POST['message'])) : '';

    // validação de campos
    $erro = false;
    $mensagens_erro = [];

    if (empty($nome))
        $mensagens_erro[] = "Nome é obrigatório";
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL))
        $mensagens_erro[] = "Email válido é obrigatório";
    if (empty($category))
        $mensagens_erro[] = "Categoria é obrigatória";
    if (empty($assunto))
        $mensagens_erro[] = "Assunto é obrigatório";
    if (empty($mensagem))
        $mensagens_erro[] = "Mensagem é obrigatória";

    // Formatar data
    $preferreddate_db = null;
    if (!empty($preferreddate)) {
        $date_obj = DateTime::createFromFormat('Y-m-d', $preferreddate);
        if ($date_obj !== false) {
            $preferreddate_db = $date_obj->format('Y-m-d');
        }
    }

    $data_envio = date('Y-m-d H:i:s');

    // Conexão à base de dados
    $hostname = "sql107.infinityfree.com";
    $username = "if0_39469160";
    $password = "5Xpw8Wlmb4";
    $database = "if0_39469160_calculadora_ambiental";

    $conn = mysqli_connect($hostname, $username, $password, $database);
    if (!$conn)
        die("Erro de conexão: " . mysqli_connect_error());

    $conn->set_charset("utf8mb4");

    // Inserir dados
    $stmt = $conn->prepare("INSERT INTO contactos (nome, email, telefone, website, data_preferida, empresa, categoria, orcamento, assunto, mensagem, data_envio) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssssssss", $nome, $email, $phone, $website, $preferreddate_db, $company, $category, $budget, $assunto, $mensagem, $data_envio);

    if ($stmt->execute()) {

        // ---------- Enviar Email ----------
        $para = "nessuino29@gmail.com";
        $assunto_email = "Nova submissão de formulário no site";

        $corpo = "Recebeste uma nova submissão:\n\n";
        $corpo .= "Nome: $nome\n";
        $corpo .= "Email: $email\n";
        $corpo .= "Telefone: $phone\n";
        $corpo .= "Website: $website\n";
        $corpo .= "Data Preferida: $preferreddate_db\n";
        $corpo .= "Empresa: $company\n";
        $corpo .= "Categoria: $category\n";
        $corpo .= "Orçamento: $budget\n";
        $corpo .= "Assunto: $assunto\n";
        $corpo .= "Mensagem:\n$mensagem\n\n";
        $corpo .= "Data de envio: $data_envio\n";

        $headers = "From: noreply@teusite.com\r\n";
        $headers .= "Reply-To: $email\r\n";
        $headers .= "Content-Type: text/plain; charset=utf-8\r\n";

        // -----------------------------------
    }

    $stmt->close();
    $conn->close();

} else {
    // Redirecionar para página de contactos se erro via POST
    header("Location: index.php?p=contactos");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora Ambiental</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">


    <style>
        html,
        body {
            margin: 0;
        }

        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .custom-green {
            background-color: #2d5a27 !important;
            border-color: #2d5a27 !important;
        }

        .text-custom-green {
            color: #2d5a27 !important;
        }

        .border-custom-green {
            border-color: #2d5a27 !important;
        }

        .btn-custom-green {
            background-color: #2d5a27;
            border-color: #2d5a27;
            color: white;
        }

        .btn-outline-custom-green {
            color: #2d5a27;
            border-color: #2d5a27;
            background-color: transparent;
        }

        .btn-outline-custom-green:hover {
            background-color: #2d5a27;
            border-color: #2d5a27;
            color: white;
        }
    </style>

</head>

<body class="gradient-bg">

    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">

                <?php if ($erro): ?>
                    <!-- Card de Erro -->
                    <div class="card border-danger shadow-sm mb-4">
                        <div class="card-header bg-danger text-white text-center">
                            <h4 class="mb-0">
                                <i class="bi bi-exclamation-triangle"></i> Erro no Processamento
                            </h4>
                        </div>
                        <div class="card-body">
                            <div class="alert alert-danger mb-0">
                                <h5 class="alert-heading">Foram encontrados os seguintes erros:</h5>
                                <ul class="mb-0">
                                    <?php foreach ($mensagens_erro as $erro_msg): ?>
                                        <li><?php echo $erro_msg; ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                            <div class="text-center mt-3">
                                <a href="contactos.php" class="btn btn-danger">
                                    <i class="bi bi-arrow-left"></i> Voltar ao Formulário
                                </a>
                            </div>
                        </div>
                    </div>
                <?php else: ?>
                    <!-- Card de Sucesso -->
                    <div class="card border-custom-green shadow-sm mb-4">
                        <div class="card-header custom-green text-white text-center">
                            <h4 class="mb-0">
                                <i class="bi bi-check-circle"></i> Mensagem Recebida com Sucesso!
                            </h4>
                        </div>
                        <div class="card-body">
                            <div class="alert alert-success text-center mb-4"
                                style="background-color: #d4edda; border-color: #2d5a27; color: #155724;">
                                <p class="mb-0 fs-5">
                                    <i class="bi bi-envelope-check"></i> Obrigado pelo teu contacto! Recebemos a tua
                                    mensagem e responderemos em breve.
                                </p>
                            </div>

                            <!-- Dados Enviados -->
                            <h5 class="mb-3 text-muted">
                                <i class="bi bi-info-circle"></i> Resumo dos Dados Enviados:
                            </h5>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="card bg-light">
                                        <div class="card-body">
                                            <h6 class="card-title text-custom-green">
                                                <i class="bi bi-person"></i> Nome Completo
                                            </h6>
                                            <p class="card-text mb-0 fw-bold"><?php echo $nome; ?></p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <div class="card bg-light">
                                        <div class="card-body">
                                            <h6 class="card-title text-custom-green">
                                                <i class="bi bi-envelope"></i> Email
                                            </h6>
                                            <p class="card-text mb-0 fw-bold"><?php echo $email; ?></p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <div class="card bg-light">
                                        <div class="card-body">
                                            <h6 class="card-title text-custom-green">
                                                <i class="bi bi-telephone"></i> Telefone
                                            </h6>
                                            <p class="card-text mb-0 fw-bold"><?php echo $phone; ?></p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <div class="card bg-light">
                                        <div class="card-body">
                                            <h6 class="card-title text-custom-green">
                                                <i class="bi bi-globe"></i> Website
                                            </h6>
                                            <p class="card-text mb-0 fw-bold"><?php echo $website; ?></p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <div class="card bg-light">
                                        <div class="card-body">
                                            <h6 class="card-title text-custom-green">
                                                <i class="bi bi-calendar-event"></i> Data Preferida para Contacto
                                            </h6>
                                            <p class="card-text mb-0 fw-bold"><?php echo $preferreddate_formatted; ?></p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <div class="card bg-light">
                                        <div class="card-body">
                                            <h6 class="card-title text-custom-green">
                                                <i class="bi bi-building"></i> Empresa/Organização
                                            </h6>
                                            <p class="card-text mb-0 fw-bold"><?php echo $company; ?></p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <div class="card bg-light">
                                        <div class="card-body">
                                            <h6 class="card-title text-custom-green">
                                                <i class="bi bi-tags"></i> Categoria do Contacto
                                            </h6>
                                            <p class="card-text mb-0 fw-bold"><?php echo $category; ?></p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <div class="card bg-light">
                                        <div class="card-body">
                                            <h6 class="card-title text-custom-green">
                                                <i class="bi bi-currency-euro"></i> Orçamento Estimado
                                            </h6>
                                            <p class="card-text mb-0 fw-bold"><?php echo $budget; ?></p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 mb-3">
                                    <div class="card bg-light">
                                        <div class="card-body">
                                            <h6 class="card-title text-custom-green">
                                                <i class="bi bi-tag"></i> Assunto
                                            </h6>
                                            <p class="card-text mb-0 fw-bold"><?php echo $assunto; ?></p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 mb-3">
                                    <div class="card bg-light">
                                        <div class="card-body">
                                            <h6 class="card-title text-custom-green">
                                                <i class="bi bi-chat-text"></i> Mensagem
                                            </h6>
                                            <p class="card-text mb-0"><?php echo nl2br($mensagem); ?></p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="card custom-green text-white">
                                        <div class="card-body">
                                            <h6 class="card-title">
                                                <i class="bi bi-clock"></i> Data e Hora do Envio
                                            </h6>
                                            <p class="card-text mb-0 fw-bold"><?php echo $data_envio; ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Botões de Ação -->
                            <div class="text-center mt-4">
                                <a href="index.php?p=contactos" class="btn btn-outline-custom-green me-2">
                                    <i class="bi bi-arrow-left"></i> Voltar aos Contactos
                                </a>
                                <a href="index.php" class="btn btn-custom-green">
                                    <i class="bi bi-house"></i> Ir para Início
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

            </div>
        </div>
    </div>

</body>

</html>