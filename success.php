<?php
require 'vendor/autoload.php';
require 'connection.php'; // Make sure this file includes the Database class with the iud method

\Stripe\Stripe::setApiKey('sk_test_51PLVTDFCE9FRCBdhRpO63uVEKOhxUFAicEhLuACpEhNGafqL08ARqvi89kyZ7krL64bZO3yDQU9KOsfRXV92SKzR003p0aZflK');

try {
    $input = file_get_contents('php://input');
    $event = json_decode($input);

    if($event === null || !isset($event->type)) {
        // If $event is null or type is not set, throw an exception or handle it as appropriate for your application
        throw new Exception("Invalid event data");
    }

    // Handle successful payment event
    if ($event->type == 'checkout.session.completed') {
        $session = $event->data->object;

        // Retrieve the line items from the checkout session
        $line_items = $session->display_items;

        // Iterate over line items to extract product IDs
        $product_ids = [];
        foreach ($line_items as $item) {
            $product_ids[] = $item->custom->product_id;
        }

        // Remove items from the cart in the database
        session_start();
        $email = $_SESSION["u"]["Email"];
        foreach ($product_ids as $product_id) {
            // Execute DELETE query to remove item from cart
            $query = "DELETE FROM `cart` WHERE `users_email` = '$email' AND `Product_id` = '$product_id'";
            Database::iud($query);
        }
    }

    // Return a success response
    echo json_encode(['success' => true]);
} catch (Exception $e) {
    // Handle errors
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}
?>
