<?php
require 'vendor/autoload.php';
require 'connection.php'; // Make sure this file includes the Database class with the search method

\Stripe\Stripe::setApiKey('sk_test_51PLVTDFCE9FRCBdhRpO63uVEKOhxUFAicEhLuACpEhNGafqL08ARqvi89kyZ7krL64bZO3yDQU9KOsfRXV92SKzR003p0aZflK');

header('Content-Type: application/json');

try {
    $input = file_get_contents('php://input');
    $data = json_decode($input, true);

    $shipping_option = $data['shipping_option'];
    $code = $data['code'];

    // Fetch products and calculate the total amount
    session_start();
    $email = $_SESSION["u"]["Email"];
    $cart_rs = Database::search("SELECT product_details.Product_ID, product_details.Name, product_pics.Product_Image_Path, cart.qty, product_details.price
    FROM `cart`
    INNER JOIN `product_details` ON cart.Product_id = product_details.Product_ID
    INNER JOIN `product_pics` ON product_details.Product_ID = product_pics.Product_ID
    WHERE cart.users_email = '" . $email . "'");

    $line_items = [];
    while ($cart_data = $cart_rs->fetch_assoc()) {
        $line_items[] = [
            'price_data' => [
                'currency' => 'lkr',
                'product_data' => [
                    'name' => $cart_data['Name'],
                    
                ],
                'unit_amount' => $cart_data['price'] * 100,
            ],
            'quantity' => $cart_data['qty'],
        ];
    }

    // Adding shipping cost as a separate line item
    $line_items[] = [
        'price_data' => [
            'currency' => 'lkr',
            'product_data' => [
                'name' => 'Shipping',
            ],
            'unit_amount' => $shipping_option * 100, // Convert to cents
        ],
        'quantity' => 1,
    ];

    $checkout_session = \Stripe\Checkout\Session::create([
        'payment_method_types' => ['card'],
        'line_items' => [$line_items],
        'mode' => 'payment',
        'success_url' => 'http://localhost/eshop-final-viva-project/cart.php?payment=success',
        'cancel_url' => 'http://localhost/eshop-final-viva-project/cart.php?payment=cancel',
    ]);

    echo json_encode(['sessionId' => $checkout_session->id]);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}
