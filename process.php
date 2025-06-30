<?php
// process.php

// Check if the form was submitted via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Receive and sanitize form data
    $name = isset($_POST['name']) ? htmlspecialchars(trim($_POST['name'])) : '';
    $email = isset($_POST['email']) ? htmlspecialchars(trim($_POST['email'])) : '';
    $subject = isset($_POST['subject']) ? htmlspecialchars(trim($_POST['subject'])) : '';
    $message = isset($_POST['message']) ? htmlspecialchars(trim($_POST['message'])) : '';
    
    // Validate if all fields were filled
    $error = false;
    $error_messages = [];
    
    if (empty($name)) {
        $error_messages[] = "Name is required";
        $error = true;
    }
    
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_messages[] = "Valid email is required";
        $error = true;
    }
    
    if (empty($subject)) {
        $error_messages[] = "Subject is required";
        $error = true;
    }
    
    if (empty($message)) {
        $error_messages[] = "Message is required";
        $error = true;
    }
    
    // Submission date and time
    $submission_date = date('d/m/Y H:i:s');
} else {
    // If not submitted via POST, redirect to contacts page
    header("Location: contacts.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Message Processed - Personal Website</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <style>
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
                                    <?php foreach ($error_messages as $error_msg): ?>
                                        <li><?php echo $error_msg; ?></li>
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
                                <i class="bi bi-check-circle"></i> Message Received Successfully!
                            </h4>
                        </div>
                        <div class="card-body">
                            <div class="alert alert-success text-center mb-4" style="background-color: #d4edda; border-color: #2d5a27; color: #155724;">
                                <p class="mb-0 fs-5">
                                    <i class="bi bi-envelope-check"></i> Thank you for contacting us! We have received your message and will respond shortly.
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
                                                <i class="bi bi-clock"></i> Submission Date and Time
                                            </h6>
                                            <p class="card-text mb-0 fw-bold"><?php echo $submission_date; ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Action Buttons -->
                            <div class="text-center mt-4">
                                <a href="index-en.php#contacts" class="btn btn-outline-custom-green me-2">
                                    <i class="bi bi-arrow-left"></i> Back to Contacts
                                </a>
                                <a href="index-en.php" class="btn btn-custom-green">
                                    <i class="bi bi-house"></i> Go to Home
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
                
                <!-- Additional Information -->
                <div class="card border-custom-green shadow-sm">
                    <div class="card-header custom-green text-white text-center">
                        <h5 class="mb-0">
                            <i class="bi bi-lightbulb"></i> Next Steps
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row text-center">
                            <div class="col-md-4 mb-3">
                                <i class="bi bi-1-circle-fill text-custom-green" style="font-size: 3rem;"></i>
                                <h6 class="mt-2">Analysis</h6>
                                <p class="text-muted small">We will analyze your message</p>
                            </div>
                            <div class="col-md-4 mb-3">
                                <i class="bi bi-2-circle-fill text-custom-green" style="font-size: 3rem;"></i>
                                <h6 class="mt-2">Response</h6>
                                <p class="text-muted small">We will respond within 24-48h</p>
                            </div>
                            <div class="col-md-4 mb-3">
                                <i class="bi bi-3-circle-fill text-custom-green" style="font-size: 3rem;"></i>
                                <h6 class="mt-2">Follow-up</h6>
                                <p class="text-muted small">We will follow up on your request</p>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>


</body>
</html>