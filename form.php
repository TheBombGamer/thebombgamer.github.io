<?php
// Form processing function
function processForm() {
    $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $phone = filter_var($_POST['phone'], FILTER_SANITIZE_STRING);
    $message = filter_var($_POST['message'], FILTER_SANITIZE_STRING);

    // Input validation
    if (empty($name) || empty($email) || empty($phone) || empty($message)) {
        echo 'Please fill in all required fields.';
        return;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo 'Invalid email address.';
        return;
    }

    // Email configuration
    $to = 'speight-kyle@outlook.com';
    $subject = 'Contact Form Submission';

    $body = "
        <html>
            <body>
                <h2>Contact Form Submission</h2>
                <p>Name: $name</p>
                <p>Email: $email</p>
                <p>Phone: $phone</p>
                <p>Message: $message</p>
            </body>
        </html>
    ";

    $headers = [
        'From: ' . $email,
        'Reply-To: ' . $email,
        'X-Mailer: PHP/' . phpversion(),
        'MIME-Version: 1.0',
        'Content-Type: text/html; charset=UTF-8'
    ];

    // Send email
    if (mail($to, $subject, $body, implode("\r\n", $headers))) {
        header('Location: thank-you.php');
        exit;
    } else {
        echo 'Error sending email. Please try again later.';
    }
}

// Call the form processing function
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    processForm();
}
?>
