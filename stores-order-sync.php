<?php
/*
Plugin Name: Store Order Sync
Description: Syncs orders between WooCommerce and Hub.
Version: 1.0
Author: Redoy Islam
*/

// Hook into WooCommerce order placement
add_action('woocommerce_new_order', 'sync_order_to_hub', 10, 1);

// Function to send order data to Hub
function sync_order_to_hub($order_id) {
    // Get order object
    $order = wc_get_order($order_id);

    // Prepare order data
    $order_data = array(
        'order_id' => $order_id,
        'total' => $order->get_total(),
        // Add more data as needed
    );

    // Send order data to Hub (pseudo code)
    send_data_to_hub($order_data);
}

// Function to receive updates from Hub and sync with store
function receive_updates_from_hub($order_id, $hub_data) {
    // Update order status based on hub data
    $order = wc_get_order($order_id);
    $new_status = $hub_data['status'];
    $order->update_status($new_status);

    // Add order note if available
    if (!empty($hub_data['note'])) {
        $order->add_order_note($hub_data['note']);
    }
}

// Simulated function to send data to Hub
function send_data_to_hub($order_data) {
    // Replace this with actual code to send data to Hub
    // Example:
    // $response = wp_remote_post('http://hub.example.com/api/orders', array(
    //     'body' => $order_data,
    // ));
}

// Simulated function to receive updates from Hub
function receive_data_from_hub() {
    // Replace this with actual code to receive data from Hub
    // Example:
    // $hub_data = wp_remote_get('http://hub.example.com/api/orders/123');
    // $hub_data = json_decode($hub_data['body'], true);
    // receive_updates_from_hub(123, $hub_data);
}

// Cron job to periodically check for updates from Hub
function check_hub_updates() {
    // Call function to receive updates from Hub
    receive_data_from_hub();
}
// Schedule the cron job to run every hour
if (!wp_next_scheduled('check_hub_updates')) {
    wp_schedule_event(time(), 'hourly', 'check_hub_updates');
}

// Hook into WooCommerce order status change
add_action('woocommerce_order_status_changed', 'sync_order_status_change_to_hub', 10, 3);

// Function to sync order status changes with Hub
function sync_order_status_change_to_hub($order_id, $old_status, $new_status) {
    // Prepare data to send to Hub
    $order_data = array(
        'order_id' => $order_id,
        'status' => $new_status,
        // Add more data as needed
    );

    // Send order status change to Hub
    send_data_to_hub($order_data);
}
