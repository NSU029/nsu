<?php
date_default_timezone_set('Europe/Lisbon');

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = isset($_POST['name']) ? htmlspecialchars(trim($_POST['name'])) : '';
    $email = isset($_POST['email']) ? htmlspecialchars(trim($_POST['email'])) : '';

    $phone = isset($_POST['phone']) ? htmlspecialchars(trim($_POST['phone'])) : '';
    $website = isset($_POST['website']) ? htmlspecialchars(trim($_POST['website'])) : '';
    $preferredDate = isset($_POST['preferreddate']) ? trim($_POST['preferreddate']) : '';
    $company = isset($_POST['company']) ? htmlspecialchars(trim($_POST['company'])) : '';
    $category = isset($_POST['category']) ? htmlspecialchars(trim($_POST['category'])) : '';
    $budget = isset($_POST['budget']) ? htmlspecialchars(trim($_POST['budget'])) : '';

    $subject = isset($_POST['subject']) ? htmlspecialchars(trim($_POST['subject'])) : '';
    $message = isset($_POST['message']) ? htmlspecialchars(trim($_POST['message'])) : '';

    // Field validation
    $error = false;
    $errorMessages = [];

    if (empty($name))
        $errorMessages[] = "Name is required";
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL))
        $errorMessages[] = "A valid email is required";
    if (empty($category))
        $errorMessages[] = "Category is required";
    if (empty($subject))
        $errorMessages[] = "Subject is required";
    if (empty($message))
        $errorMessages[] = "Message is required";

    // Format preferred date
    $preferredDateDb = null;
    if (!empty($preferredDate)) {
        $dateObj = DateTime::createFromFormat('Y-m-d', $preferredDate);
        if ($dateObj !== false) {
            $preferredDateDb = $dateObj->format('Y-m-d');
        }
    }

    $submissionDate = date('Y-m-d H:i:s');

    // Database connection
    $hostname = "sql107.infinityfree.com";
    $username = "if0_39469160";
    $password = "5Xpw8Wlmb4";
    $database = "if0_39469160_calculadora_ambiental";

    $conn = mysqli_connect($hostname, $username, $password, $database);
    if (!$conn)
        die("Connection error: " . mysqli_connect_error());

    $conn->set_charset("utf8mb4");

    // Insert data
    $stmt = $conn->prepare("
        INSERT INTO contactos 
        (nome, email, telefone, website, data_preferida, empresa, categoria, orcamento, assunto, mensagem, data_envio) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
    ");
    $stmt->bind_param(
        "sssssssssss",
        $name,
        $email,
        $phone,
        $website,
        $preferredDateDb,
        $company,
        $category,
        $budget,
        $subject,
        $message,
        $submissionDate
    );

    if ($stmt->execute()) {

        // ---------- Send Email ----------
        $to = "nessuino29@gmail.com";
        $emailSubject = "New form submission on the site";

        $body = "You have received a new submission:\n\n";
        $body .= "Name: $name\n";
        $body .= "Email: $email\n";
        $body .= "Phone: $phone\n";
        $body .= "Website: $website\n";
        $body .= "Preferred Date: $preferredDateDb\n";
        $body .= "Company: $company\n";
        $body .= "Category: $category\n";
        $body .= "Budget: $budget\n";
        $body .= "Subject: $subject\n";
        $body .= "Message:\n$message\n\n";
        $body .= "Submission Date: $submissionDate\n";

        $headers = "From: noreply@yourwebsite.com\r\n";
        $headers .= "Reply-To: $email\r\n";
        $headers .= "Content-Type: text/plain; charset=utf-8\r\n";

        // You still need to call mail($to, $emailSubject, $body, $headers);
    }

    $stmt->close();
    $conn->close();

} else {
    // Redirect to contact page if not POST
    header("Location: index.php?p=contactos");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Environmental Calculator</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" />

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

                <?php if ($error): ?>
                    <!-- Error Card -->
                    <div class="card border-danger shadow-sm mb-4">
                        <div class="card-header bg-danger text-white text-center">
                            <h4 class="mb-0">
                                <i class="bi bi-exclamation-triangle"></i> Processing Error
                            </h4>
                        </div>
                        <div class="card-body">
                            <div class="alert alert-danger mb-0">
                                <h5 class="alert-heading">The following errors were found:</h5>
                                <ul class="mb-0">
                                    <?php foreach ($errorMessages as $errMsg): ?>
                                        <li><?php echo $errMsg; ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                            <div class="text-center mt-3">
                                <a href="contacts.php" class="btn btn-danger">
                                    <i class="bi bi-arrow-left"></i> Back to Form
                                </a>
                            </div>
                        </div>
                    </div>
                <?php else: ?>
                    <!-- Success Card -->
                    <div class="card border-custom-green shadow-sm mb-4">
                        <div class="card-header custom-green text-white text-center">
                            <h4 class="mb-0">
                                <i class="bi bi-check-circle"></i> Message Successfully Received!
                            </h4>
                        </div>
                        <div class="card-body">
                            <div class="alert alert-success text-center mb-4"
                                style="background-color: #d4edda; border-color: #2d5a27; color: #155724;">
                                <p class="mb-0 fs-5">
                                    <i class="bi bi-envelope-check"></i> Thank you for your contact! We have received your
                                    message and will respond shortly.
                                </p>
                            </div>

                            <!-- Submitted Data -->
                            <h5 class="mb-3 text-muted">
                                <i class="bi bi-info-circle"></i> Summary of Submitted Data:
                            </h5>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="card bg-light">
                                        <div class="card-body">
                                            <h6 class="card-title text-custom-green">
                                                <i class="bi bi-person"></i> Full Name
                                            </h6>
                                            <p class="card-text mb-0 fw-bold"><?php echo $name; ?></p>
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
                                                <i class="bi bi-telephone"></i> Phone
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
                                                <i class="bi bi-calendar-event"></i> Preferred Contact Date
                                            </h6>
                                            <p class="card-text mb-0 fw-bold"><?php echo $preferredDateFormatted; ?></p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <div class="card bg-light">
                                        <div class="card-body">
                                            <h6 class="card-title text-custom-green">
                                                <i class="bi bi-building"></i> Company/Organization
                                            </h6>
                                            <p class="card-text mb-0 fw-bold"><?php echo $company; ?></p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <div class="card bg-light">
                                        <div class="card-body">
                                            <h6 class="card-title text-custom-green">
                                                <i class="bi bi-tags"></i> Contact Category
                                            </h6>
                                            <p class="card-text mb-0 fw-bold"><?php echo $category; ?></p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <div class="card bg-light">
                                        <div class="card-body">
                                            <h6 class="card-title text-custom-green">
                                                <i class="bi bi-currency-euro"></i> Estimated Budget
                                            </h6>
                                            <p class="card-text mb-0 fw-bold"><?php echo $budget; ?></p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 mb-3">
                                    <div class="card bg-light">
                                        <div class="card-body">
                                            <h6 class="card-title text-custom-green">
                                                <i class="bi bi-tag"></i> Subject
                                            </h6>
                                            <p class="card-text mb-0 fw-bold"><?php echo $subject; ?></p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 mb-3">
                                    <div class="card bg-light">
                                        <div class="card-body">
                                            <h6 class="card-title text-custom-green">
                                                <i class="bi bi-chat-text"></i> Message
                                            </h6>
                                            <p class="card-text mb-0"><?php echo nl2br($message); ?></p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="card custom-green text-white">
                                        <div class="card-body">
                                            <h6 class="card-title">
                                                <i class="bi bi-clock"></i> Submission Date & Time
                                            </h6>
                                            <p class="card-text mb-0 fw-bold"><?php echo $submissionDate; ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="text-center mt-4">
                                <a href="index-en.php?p=contacts" class="btn btn-outline-custom-green me-2">
                                    <i class="bi bi-arrow-left"></i> Back to Contacts
                                </a>
                                <a href="index-en.php" class="btn btn-custom-green">
                                    <i class="bi bi-house"></i> Go to Home
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