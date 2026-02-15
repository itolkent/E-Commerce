<h1>User #<?= $user['id'] ?></h1>

<p><strong>Name:</strong> <?= htmlspecialchars($user['name']) ?></p>
<p><strong>Email:</strong> <?= htmlspecialchars($user['email']) ?></p>
<p><strong>Joined:</strong> <?= $user['created_at'] ?></p>

<div class="admin-actions">
    <a href="<?= BASE_URL ?>admin/users/<?= $user['id'] ?>/edit" class="button-primary">Edit</a>

    <form action="<?= BASE_URL ?>admin/users/<?= $user['id'] ?>/delete" method="POST" style="display:inline;">
        <button class="button-danger" onclick="return confirm('Delete this user?')">Delete</button>
    </form>
    <h3>Role</h3>
    <p>Current role: <strong>
            <?= htmlspecialchars($user['role']) ?>
        </strong></p>

    <form action="<?= BASE_URL ?>admin/users/<?= $user['id'] ?>/role" method="POST">
        <label>Change Role</label>
        <select name="role">
            <option value="user" <?= $user['role'] === 'user' ? 'selected' : '' ?>>User</option>
            <option value="admin" <?= $user['role'] === 'admin' ? 'selected' : '' ?>>Admin</option>
        </select>

        <button type="submit">Update Role</button>
    </form>
</div>