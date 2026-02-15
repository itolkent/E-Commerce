<?php
echo password_hash("123123", PASSWORD_DEFAULT);
// project-root/
// ├─ public/
// │  ├─ index.php
// │  ├─ .htaccess
// │  ├─ assets/
// │  │  ├─ css/
// │  │  └─ js/
// ├─ app/
// │  ├─ config/
// │  │  ├─ config.php
// │  │  └─ routes.php
// │  ├─ core/
// │  │  ├─ Controller.php
// │  │  ├─ Model.php
// │  │  ├─ View.php
// │  │  ├─ Router.php
// │  │  └─ Database.php
// │  ├─ models/
// │  │  ├─ Product.php
// │  │  ├─ Category.php
// │  │  ├─ User.php
// │  │  ├─ Cart.php
// │  │  ├─ Order.php
// │  │  ├─ OrderItem.php
// │  │  ├─ Coupon.php
// │  │  └─ Review.php
// │  ├─ controllers/
// │  │  ├─ HomeController.php
// │  │  ├─ ProductController.php
// │  │  ├─ CartController.php
// │  │  ├─ AuthController.php
// │  │  ├─ CheckoutController.php
// │  │  ├─ OrderController.php
// │  │  ├─ AdminController.php
// │  │  └─ ApiController.php
// │  ├─ middleware/
// │  │  ├─ AuthMiddleware.php
// │  │  └─ AdminMiddleware.php
// │  └─ views/
// │     ├─ layouts/
// │     │  └─ main.php
// │     ├─ home/
// │     │  └─ index.php
// │     ├─ product/
// │     │  ├─ list.php
// │     │  └─ detail.php
// │     ├─ cart/
// │     │  └─ index.php
// │     ├─ auth/
// │     │  ├─ login.php
// │     │  ├─ register.php
// │     │  └─ profile.php
// │     ├─ checkout/
// │     │  ├─ step_shipping.php
// │     │  ├─ step_payment.php
// │     │  └─ step_review.php
// │     ├─ order/
// │     │  ├─ history.php
// │     │  └─ detail.php
// │     └─ admin/
// │        ├─ dashboard.php
// │        ├─ products.php
// │        ├─ product_form.php
// │        ├─ orders.php
// │        ├─ users.php
// │        └─ reports.php
// └─ vendor/ (if you later add Composer libs)