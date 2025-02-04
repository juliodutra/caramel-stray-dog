<div class="login-form">
    <?= $this->Form->create() ?>
    <?= $this->Form->control('email') ?>
    <?= $this->Form->control('password') ?>

    <div class="social-login">
        <a href="/oauth/google">Google Login</a>
        <a href="/oauth/facebook">Facebook Login</a>
    </div>

    <?= $this->Form->button('Login') ?>
    <?= $this->Form->end() ?>
</div>