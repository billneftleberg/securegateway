
<?php
// Ensure the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize user inputs
    $name = htmlspecialchars($_POST['name']);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $address = htmlspecialchars($_POST['address']);
    $city = htmlspecialchars($_POST['city']);
    $zip = htmlspecialchars($_POST['zip']);
    $cardNumber = htmlspecialchars($_POST['card-number']);
    $expiryDate = htmlspecialchars($_POST['expiry-date']);
    $cvv = htmlspecialchars($_POST['cvv']);

    // Perform backend validation
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die(json_encode(["status" => "error", "message" => "Invalid email address."]));
    }

    if (strlen($cardNumber) !== 16 || !is_numeric($cardNumber)) {
        die(json_encode(["status" => "error", "message" => "Invalid card number."]));
    }

    if (!preg_match('/^(0[1-9]|1[0-2])\/\d{2}$/', $expiryDate)) {
        die(json_encode(["status" => "error", "message" => "Invalid expiry date format."]));
    }

    if (strlen($cvv) !== 3 || !is_numeric($cvv)) {
        die(json_encode(["status" => "error", "message" => "Invalid CVV."]));
    }

    // Simulate payment processing (this should be replaced with actual payment gateway integration)
    $paymentProcessed = true; // Simulated flag

    if ($paymentProcessed) {
        echo json_encode(["status" => "success", "message" => "Payment successfully processed."]);
    } else {
        echo json_encode(["status" => "error", "message" => "Payment failed. Please try again."]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Invalid request method."]);
}
?>
