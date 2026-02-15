<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin – Reports</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/styles.css">
</head>

<body>

    <div class="report-container">

        <h1 class="page-title">Reports</h1>

        <div class="dashboard-grid">

            <div class="dashboard-card">
                <p class="card-title">Total Sales</p>
                <p class="card-value">$
                    <?= number_format($totalSales, 2) ?>
                </p>
            </div>

            <div class="dashboard-card">
                <p class="card-title">Total Orders</p>
                <p class="card-value">
                    <?= $orderStats['total_orders'] ?>
                </p>
            </div>

            <div class="dashboard-card">
                <p class="card-title">Completed Orders</p>
                <p class="card-value">
                    <?= $orderStats['completed_orders'] ?>
                </p>
            </div>

            <div class="dashboard-card">
                <p class="card-title">Pending Orders</p>
                <p class="card-value">
                    <?= $orderStats['pending_orders'] ?>
                </p>
            </div>

        </div>

        <h2 class="section-title">Top Selling Products</h2>
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Sold</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($topProducts as $p): ?>
                    <tr>
                        <td>
                            <?= $p['name'] ?>
                        </td>
                        <td>
                            <?= $p['qty'] ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <h2 class="section-title">Revenue by Month</h2>
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Month</th>
                    <th>Revenue</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($monthlyRevenue as $m): ?>
                    <tr>
                        <td>
                            <?= $m['month'] ?>
                        </td>
                        <td>$
                            <?= number_format($m['revenue'], 2) ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    </div>

</body>

</html>