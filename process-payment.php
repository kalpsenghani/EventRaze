<?php
session_start();
include('includes/config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $bookingid = $_POST['bookingid'];
    $card_number = $_POST['card_number'];
    $expiry_date = $_POST['expiry_date'];
    $cvv = $_POST['cvv'];
    $amount = $_POST['amount'];

    // Simulate the payment process (In real applications, you would use a payment gateway API here)
    $payment_successful = rand(0, 1);  // Randomly simulate success or failure (0 = failure, 1 = success)

    if ($payment_successful) {
        // Update the booking status to 'Paid'
        $sql = "UPDATE tblbookings SET PaymentStatus = 'Paid' WHERE BookingId = :bookingid";
        $query = $dbh->prepare($sql);
        $query->bindParam(':bookingid', $bookingid, PDO::PARAM_STR);
        $query->execute();

        echo '<script>alert("Payment Successful! Your booking has been confirmed.");</script>';
        echo "<script>window.location.href='my-bookings.php';</script>";
    } else {
        echo '<script>alert("Payment Failed! Please try again.");</script>';
        echo "<script>window.location.href='payment-form.php?bookingid=" . $bookingid . "';</script>";
    }
} else {
    // Redirect back to the booking page if the request method is not POST
    header("Location: index.php");
    exit();
}
?>
