<div id="auth">
    <form id="auth-form" action="<?=BASE_PATH?>auth/login/" method="post">
        <ul>
            <li><h2>Вход</h2></li>
            <li>
                <label for="email">E-mail</label>
                <input type="email" name="email" value="">
                <span class="mesages">
                    <?php if(!empty($_SESSION['login_error'])):?>
                        <?=$_SESSION['login_error']?>
                        <?php unset($_SESSION['login_error']);?>
                    <?php endif;?>
                </span>
            </li>
            <li>
                <label for="password">Пароль</label>
                <input type="password" name="password" value="">
                <span class="mesages"></span>
            </li>
            <li>
                <button class="btn-submit">Вход</button>
                <input type="checkbox" id="chbx" name="remember"> Запомнить меня
            </li>
            <li>
                <a href="<?=BASE_PATH?>auth/register/">Зарегистрироваться</a> | <a href="#">Забыли пароль?</a>
            </li>
        </ul>
    </form>
</div>