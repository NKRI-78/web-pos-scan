<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'Order::index');

$routes->get('/tracking', 'Order::tracking');

$routes->post('/remove-cart', 'Order::removeCart');

$routes->get('/delivery', 'Delivery::index');

$routes->post('/delivery/save-payment-courier', 'Delivery::savePaymentCourier');

$routes->get('/shipping', 'Shipping::index');

$routes->post('/shipping/get-city', 'Shipping::getCity');

$routes->get('/categories/(:num)', 'Product::categories/$1');

$routes->post('/shipping/save-personal-info', 'Shipping::savePersonalInfo');

$routes->get('/checkout', 'Checkout::index');

$routes->post('/checkout/add-to-cart', 'Checkout::addToCart');

$routes->post('/checkout/checkout-order', 'Checkout::checkoutOrder');
