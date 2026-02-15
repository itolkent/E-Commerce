<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Edit Profile</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/styles.css">
</head>

<body>

    <div class="profile-container">

        <h1>Edit Profile</h1>

        <form action="<?= BASE_URL ?>profile/edit" method="POST" class="profile-form">

            <input type="hidden" name="<?= CSRF_TOKEN_NAME ?>" value="<?= $csrf ?>">

            <label>Name</label>
            <input type="text" name="name" value="<?= htmlspecialchars($user['name']) ?>" required>

            <label>Email</label>
            <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required>

            <label>New Password (optional)</label>
            <input type="password" name="password" placeholder="Leave blank to keep current password">

            <button type="submit" class="button-primary">Save Changes</button>

            <a href="<?= BASE_URL ?>profile" class="button-secondary" style="margin-top:10px;">Cancel</a>

        </form>

    </div>

</body>

</html>