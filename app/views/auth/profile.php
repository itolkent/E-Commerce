<div class="profile-container">

    <h1>My Profile</h1>

    <div class="profile-card">

        <div class="profile-avatar">
            <label for="avatarUpload" class="avatar-label">
                <img src="<?= BASE_URL ?>assets/uploads/avatars/<?= $user['avatar'] ?>" alt="Avatar" class="avatar-img">
            </label>

            <form action="<?= BASE_URL ?>profile/avatar" method="POST" enctype="multipart/form-data">
                <input type="file" id="avatarUpload" name="avatar" accept="image/*" style="display:none"
                    onchange="this.form.submit()">
                <input type="hidden" name="<?= CSRF_TOKEN_NAME ?>" value="<?= $csrf ?>">
            </form>
        </div>


        <div class="profile-info">
            <p><strong>Name:</strong>
                <?= htmlspecialchars($user['name']) ?>
            </p>
            <p><strong>Email:</strong>
                <?= htmlspecialchars($user['email']) ?>
            </p>
            <p><strong>Member Since:</strong>
                <?= date('F j, Y', strtotime($user['created_at'])) ?>
            </p>
        </div>

    </div>

    <div class="profile-actions">
        <a href="<?= BASE_URL ?>orders" class="button-primary">My Orders</a>
        <a href="<?= BASE_URL ?>profile/edit" class="button-primary">Edit Profile</a>
        <a href="<?= BASE_URL ?>logout" class="btn-logout">Logout</a>
    </div>

</div>