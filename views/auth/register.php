<div id="auth">
    <form id="register-form" enctype="multipart/form-data" action="<?=BASE_PATH?>auth/save" method="post">
        <input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
        <ul>
             <li>
                <h2>Регистрация</h2>
                <span class="required_notification">Необходимые для регистрации поля отмечены *</span>
           </li>
            <li>
                <label for="email">E-mail *</label>
                <input type="email" name="email" value="" maxlength="64" required="required">
                <span class="messages">
                    <?php if(!empty($_SESSION['email_error'])):?>
                        <?=$_SESSION['email_error']?>
                        <?php unset($_SESSION['email_error']);?>
                    <?php endif;?>
                </span>
            </li>
            <li>
                <label for="password">Пароль *</label>
                <input type="password" name="password" maxlength="32" required="required">
                <span class="messages">
                    <?php if(!empty($_SESSION['pass_error'])):?>
                        <?=$_SESSION['pass_error']?>
                        <?php unset($_SESSION['pass_error']);?>
                    <?php endif;?>
                </span>
            </li>
            <li>
                <label for="check_password">Еще-раз пароль *</label>
                <input type="password" name="check_password" maxlength="32" required="required">
                <span class="messages"></span>
            </li>
            <li>
                <button class="btn-submit">Регистрация</button>
            </li>
        </ul>
    </form>
</div>