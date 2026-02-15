<h1>Edit User</h1>

<form action="<?= BASE_URL ?>admin/users/<?= $user['id'] ?>/update" method="POST">

    <label>Name</label>
    <input type="text" name="name" value="<?= htmlspecialchars($user['name']) ?>" required>

    <label>Email</label>
    <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required>

    <button type="submit" class="button-primary">Save Changes</button>
</form>