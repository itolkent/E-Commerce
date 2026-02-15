<?php
// Home & catalog
$router->get('', [HomeController::class, 'index']);
$router->get('category/{slug}', [ProductController::class, 'category']);
$router->get('product/{slug}', [ProductController::class, 'detail']);
$router->get('search', [ProductController::class, 'search']);
$router->get('products', [ProductController::class, 'index']);
$router->get('profile/edit', [AuthController::class, 'editProfile']);
$router->post('profile/edit', [AuthController::class, 'editProfilePost']);

// Cart
$router->get('cart', [CartController::class, 'index']);
$router->get('cart/add/{id}', [CartController::class, 'add']);
$router->post('cart/update', [CartController::class, 'update']);
$router->get('cart/remove/{id}', [CartController::class, 'remove']);
$router->get('cart/clear', [CartController::class, 'clear']);

// Auth
$router->get('login', [AuthController::class, 'login']);
$router->post('login', [AuthController::class, 'loginPost']);
$router->get('register', [AuthController::class, 'register']);
$router->post('register', [AuthController::class, 'registerPost']);
$router->get('logout', [AuthController::class, 'logout']);
$router->get('profile', [AuthController::class, 'profile']);
$router->post('profile', [AuthController::class, 'profilePost']);
$router->post('profile/avatar', [AuthController::class, 'updateAvatar']);

// Checkout
$router->get('checkout', [CheckoutController::class, 'shipping']);
$router->post('checkout/shipping', [CheckoutController::class, 'saveShipping']);
$router->get('checkout/payment', [CheckoutController::class, 'payment']);
$router->post('checkout/payment', [CheckoutController::class, 'savePayment']);
$router->get('checkout/review', [CheckoutController::class, 'review']);
$router->post('checkout/place-order', [CheckoutController::class, 'placeOrder']);
// Orders
$router->get('orders', [OrderController::class, 'history']);
$router->get('order/{id}', [OrderController::class, 'detail']);

// Admin
$router->get('admin', [AdminController::class, 'dashboard']);
$router->get('admin/products', [AdminController::class, 'products']);
$router->get('admin/products/create', [AdminController::class, 'createProduct']);
$router->post('admin/products/store', [AdminController::class, 'storeProduct']);
$router->get('admin/products/edit/{id}', [AdminController::class, 'productEdit']);
$router->post('admin/products/update/{id}', [AdminController::class, 'productUpdate']);
$router->get('admin/products/delete/{id}', [AdminController::class, 'productDelete']);
$router->get('admin/orders', [AdminController::class, 'orders']);
$router->post('admin/order/status/{id}', [AdminController::class, 'orderStatus']);
$router->get('admin/orders', [AdminOrderController::class, 'index']);
$router->get('admin/orders/{id}', [AdminOrderController::class, 'show']);
$router->post('admin/orders/status/{id}', [AdminOrderController::class, 'updateStatus']);
$router->get('admin/users', [AdminUserController::class, 'index']);
$router->get('admin/reports', [AdminController::class, 'reports']);
$router->get('admin/users', [AdminUserController::class, 'index']);
$router->get('admin/users/{id}', [AdminUserController::class, 'userinfo']);
$router->get('admin/users/{id}/edit', [AdminUserController::class, 'edit']);
$router->post('admin/users/{id}/update', [AdminUserController::class, 'update']);
$router->post('admin/users/{id}/delete', [AdminUserController::class, 'delete']);
$router->post('admin/users/{id}/role', [AdminUserController::class, 'updateRole']);