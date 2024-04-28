// File: hub-order-frontend.jsx

import React, { useState, useEffect } from 'react';
import ReactDOM from 'react-dom';

const HubOrderApp = () => {
    const [orders, setOrders] = useState([]);

    useEffect(() => {
        // Fetch orders from the server
        fetchOrders();
    }, []);

    const fetchOrders = async () => {
        try {
            const response = await fetch('/wp-json/hub-order-plugin/v1/orders');
            const data = await response.json();
            setOrders(data);
        } catch (error) {
            console.error('Error fetching orders:', error);
        }
    };

    return (
        <div>
            <h1>Hub Orders</h1>
            <table>
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Customer Name</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Order Date</th>
                        <th>Shipping Date</th>
                        <th>Order Notes</th>
                    </tr>
                </thead>
                <tbody>
                    {orders.map(order => (
                        <tr key={order.id}>
                            <td>{order.id}</td>
                            <td>{order.customer_name}</td>
                            <td>{order.email}</td>
                            <td>{order.status}</td>
                            <td>{order.order_date}</td>
                            <td>{order.shipping_date}</td>
                            <td>{order.order_notes}</td>
                        </tr>
                    ))}
                </tbody>
            </table>
        </div>
    );
};

// Render the React app
ReactDOM.render(<HubOrderApp />, document.getElementById('hub-order-app'));
