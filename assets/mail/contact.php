<?php

if (!$_POST) exit;

// Validate email
function isEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

$name     = trim($_POST['name']);
$email    = trim($_POST['email']);
$phone    = trim($_POST['phone']);
$comments = trim($_POST['comments']);

if ($name == '') {
    echo '<div class="alert alert-error">You must enter your name.</div>';
    exit();
} else if ($email == '') {
    echo '<div class="alert alert-error">You must enter your email address.</div>';
    exit();
} else if (!isEmail($email)) {
    echo '<div class="alert alert-error">You must enter a valid email address.</div>';
    exit();
} else if ($phone == '') {
    echo '<div class="alert alert-error">Please fill all fields!</div>';
    exit();
} else if ($comments == '') {
    echo '<div class="alert alert-error">You must enter your comments.</div>';
    exit();
}

// Define recipient email address
$address = "muhammadusman00265@gmail.com";
$e_subject = 'Contact Form Submission';

// Construct email message
$e_body = "You have been contacted by $name, their additional message is as follows:" . PHP_EOL . PHP_EOL;
$e_content = "\"$comments\"" . PHP_EOL . PHP_EOL;
$e_reply = "You can contact $name via email: $email" . PHP_EOL;

$msg = wordwrap($e_body . $e_content . $e_reply, 70);

$headers = "From: $email" . PHP_EOL;
$headers .= "Reply-To: $email" . PHP_EOL;
$headers .= "MIME-Version: 1.0" . PHP_EOL;
$headers .= "Content-type: text/plain; charset=utf-8" . PHP_EOL;

if (mail($address, $e_subject, $msg, $headers)) {
    echo "<div class='alert alert-success'>";
    echo "<h3>Email Sent Successfully.</h3>";
    echo "<p>Thank you <strong>" . htmlspecialchars($name, ENT_QUOTES, 'UTF-8') . "</strong>, your message has been submitted to us.</p>";
    echo "</div>";
} else {
    echo '<div class="alert alert-error">ERROR! Unable to send email. Please try again later.</div>';
}
?>
