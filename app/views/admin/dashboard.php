<div class="admin-dashboard">

    <h1 class="page-title">Admin Dashboard</h1>

    <div class="dashboard-grid">

        <div class="dashboard-card">
            <p class="card-title">Total Products</p>
            <p class="card-value">
                <?= $stats['total_products'] ?>
            </p>
        </div>

        <div class="dashboard-card">
            <p class="card-title">Total Orders</p>
            <p class="card-value">
                <?= $stats['total_orders'] ?>
            </p>
        </div>

        <div class="dashboard-card">
            <p class="card-title">Pending Orders</p>
            <p class="card-value">
                <?= $stats['pending_orders'] ?>
            </p>
        </div>

        <div class="dashboard-card">
            <p class="card-title">Total Users</p>
            <p class="card-value">
                <?= $stats['total_users'] ?>
            </p>
        </div>

    </div>

    <div class="dashboard-links">

        <a href="<?= BASE_URL ?>admin/products" class="dashboard-link">Manage Products</a>
        <a href="<?= BASE_URL ?>admin/orders" class="dashboard-link">Manage Orders</a>
        <a href="<?= BASE_URL ?>admin/users" class="dashboard-link">Manage Users</a>
        <a href="<?= BASE_URL ?>admin/reports" class="dashboard-link">Reports</a>

    </div>

</div>