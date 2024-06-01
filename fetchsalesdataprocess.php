<?php
require 'vendor/autoload.php';

\Stripe\Stripe::setApiKey('sk_test_51PLVTDFCE9FRCBdhRpO63uVEKOhxUFAicEhLuACpEhNGafqL08ARqvi89kyZ7krL64bZO3yDQU9KOsfRXV92SKzR003p0aZflK');

header('Content-Type: application/json');

try {
    // Fetch all charges (may require pagination if there are many charges)
    $charges = \Stripe\Charge::all(['limit' => 100]);
    $totalAmount = 0;
    $totalOrders = 0; // Initialize total orders count
    $salesData = [];

    // Iterate through charges to calculate the total amount and prepare chart data
    foreach ($charges->data as $charge) {
        if ($charge->paid && !$charge->refunded) {
            $totalAmount += $charge->amount;
            $totalOrders++; // Increment total orders count

            $date = date('Y-m-d', $charge->created);
            if (!isset($salesData[$date])) {
                $salesData[$date] = 0;
            }
            $salesData[$date] += $charge->amount / 100; // Convert to dollars
        }
    }

    // Prepare data for the chart
    $chartData = [];
    foreach ($salesData as $date => $amount) {
        $chartData[] = ['date' => $date, 'amount' => $amount];
    }

    // Return the data as JSON
    echo json_encode([
        'totalAmount' => $totalAmount / 100, // Convert to dollars
        'totalOrders' => $totalOrders, // Total number of orders
        'chartData' => $chartData
    ]);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}
