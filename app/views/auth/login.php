<div class="login-container">

    <div class="login-box">

        <h2 class="login-title">Login</h2>

        <?php if (!empty($error)): ?>
            <div class="login-error">
                <?= View::escape($error) ?>
            </div>
        <?php endif; ?>

        <form method="post" action="<?= BASE_URL ?>login">

            <input type="hidden" name="<?= CSRF_TOKEN_NAME ?>" value="<?= $csrf ?>">

            <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" class="input-field" id="email" name="email" required placeholder="Enter your email">
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="input-field" id="password" name="password" required
                    placeholder="Enter your password">
            </div>

            <button type="submit" class="button-primary">Login</button>

            <div class="login-links">
                <a href="<?= BASE_URL ?>register">Don't have an account? Register</a>
            </div>

        </form>

    </div>

</div>