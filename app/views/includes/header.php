<header class="site-header">
    <nav class="main-navigation">
        <a class="brand-name" href="<?= BASE_URL ?>">Kent Shop</a>

        <button class="menu-toggle" type="button" data-bs-toggle="collapse" data-bs-target="#mainMenu">
            <span class="menu-icon"></span>
        </button>

        <div class="menu-container collapse" id="mainMenu">
            <ul class="menu-list">

                <li class="menu-item">
                    <a href="<?= BASE_URL ?>" class="menu-link">Home</a>
                </li>

                <li class="menu-item">
                    <a href="<?= BASE_URL ?>products" class="menu-link">Products</a>
                </li>

                <li class="menu-item">
                    <a href="<?= BASE_URL ?>cart" class="menu-link">Cart</a>
                </li>
                <?php if (isset($_SESSION['user'])): ?>
                    <a href="<?= BASE_URL ?>orders">My Orders</a>
                <?php endif; ?>
                <?php if (!empty($_SESSION['user_id'])): ?>

                    <?php if (!empty($_SESSION['is_admin'])): ?>
                        <li class="menu-item">
                            <a href="<?= BASE_URL ?>admin" class="menu-link">Admin Dashboard</a>
                        </li>
                    <?php endif; ?>

                    <li class="menu-item">
                        <a href="<?= BASE_URL ?>profile" class="menu-link">Profile</a>
                    </li>

                    <li class="menu-item">
                        <a href="<?= BASE_URL ?>logout" class="menu-button logout-button">Logout</a>
                    </li>

                <?php else: ?>

                    <li class="menu-item">
                        <a href="<?= BASE_URL ?>login" class="menu-button login-button">Login</a>
                    </li>

                <?php endif; ?>

            </ul>
        </div>
    </nav>
</header>