<div class="login-container">

    <div class="login-box">

        <h1 class="login-title">Create an Account</h1>

        <?php if (!empty($_SESSION['error'])): ?>
            <p class="login-error">
                <?= $_SESSION['error'];
                unset($_SESSION['error']); ?>
            </p>
        <?php endif; ?>

        <form action="<?= BASE_URL ?>register" method="POST">

            <!-- CSRF TOKEN (REQUIRED) -->
            <input type="hidden" name="<?= CSRF_TOKEN_NAME ?>" value="<?= $csrf ?>">

            <div class="form-group">
                <label>Name</label>
                <input type="text" name="name" class="input-field" required>
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" class="input-field" required>
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="input-field" required>
            </div>

            <button type="submit" class="button-primary">Register</button>

        </form>

        <div class="login-links">
            <p>Already have an account?
                <a href="<?= BASE_URL ?>login">Login here</a>
            </p>
        </div>

    </div>

</div>