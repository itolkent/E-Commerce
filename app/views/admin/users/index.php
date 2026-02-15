<h1>Manage Users</h1>

<table class="admin-table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Joined</th>
            <th></th>
        </tr>
    </thead>

    <tbody>
        <?php foreach ($users as $user): ?>
            <tr>
                <td>
                    <?= $user['id'] ?>
                </td>
                <td>
                    <?= htmlspecialchars($user['name']) ?>
                </td>
                <td>
                    <?= htmlspecialchars($user['email']) ?>
                </td>
                <td>
                    <?= $user['created_at'] ?>
                </td>
                <td>
                    <a href="<?= BASE_URL ?>admin/users/<?= $user['id'] ?>" class="button-small">Info</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>