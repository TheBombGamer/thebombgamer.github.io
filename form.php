<?php
  $name = $_POST['name'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];
  $message = $_POST['message'];

  $to = 'speight-kyle@outlook.com';
  $subject = 'Contact Form Submission';
  $body = "Name: $name\nEmail: $email\nPhone: $phone\nMessage: $message";

  $headers = 'From: ' . $email . "\r\n" .
             'Reply-To: ' . $email . "\r\n" .
             'X-Mailer: PHP/' . phpversion();

  mail($to, $subject, $body, $headers);

  header('Location: https://thebombgamer.github.io/thank-you'); // Redirect to a thank-you page
  exit;
?>