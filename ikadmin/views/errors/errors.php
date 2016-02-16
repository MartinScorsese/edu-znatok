<?php
switch ($code) {
    case '404':
        header('HTTP/1.0 404 Not Found');
        break;
    case '403':
        header('HTTP/1.0 403 Forbidden');
        break;  
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link href="<?=BASE_PATH ?>css/reset.css" media="screen" rel="stylesheet" type="text/css">
	<link href="<?=BASE_PATH ?>css/main.css" media="screen" rel="stylesheet" type="text/css">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300&subset=latin,cyrillic" rel="stylesheet" type="text/css">
	<script src="<?=BASE_PATH ?>js/jquery-2.2.0.min.js"></script>
        <script src="<?=BASE_PATH ?>js/jquery.cookie.js"></script>
        <script src="<?=BASE_PATH ?>js/menu.js"></script>
        <title>Ошибка <?=$code?></title>
</head>
<body>
    <div class="wrapper">
        <div class="header">
            <div class="logo-wrap">
                <div class="logo"><a href="<?=BASE_PATH ?>" title="Главная страница ИК Знаток"></a></div>
                <div class="site-name"><h1>ОНЛАЙН ЗАНЯТИЯ</h1></div>
                <div class="site-description"><p>Ошибка <?=$code?></p></div>
            </div>
        </div>
        <div id="container-outer">
            <div id="sidebar" class="on" 
                <?php if(isset($_COOKIE['sidebar']) && 'off' == $_COOKIE['sidebar']):?>
                 style="width: 0px;"
                <?php endif; ?>
                 >
                <div id="menu">
                    <div id="sidebar_toggle"></div>
                    <div id="sidebar_inner"
                        <?php if(isset($_COOKIE['sidebar']) && 'off' == $_COOKIE['sidebar']):?>
                            style="margin-left: -200px;"
                        <?php endif; ?>
                         >
                        <ul>
                            <li><a href="#">Пункт 1</a></li>
                            <li><a href="#">Пункт 2</a></li>
                            <li><a href="#">Пункт 3</a></li>
                            <li><a href="#">Пункт 4</a></li>
                            <li><a href="#">Пункт 5</a></li>
                            <li><a href="#">Пункт 6</a></li>
                            <li><a href="#">Пункт 7</a></li>

                        </ul>
                    </div>
                </div>
            </div>
            <div id="content">
                <div class="articles">
                    <?=$error?>
                                    </div>
                </div>
            </div>
            <div class="clear"></div>
            <div id="footer">
                    <div class="logo-znatok"></div>
                    <div class="contacts">
                            <p>Интеллектуальный клуб "Знаток", Воскресенск<br />По всем вопросам обращайтесь:<br /><a href="tel:+79266587619">+7-926-658-76-19</a><br /><a href="mailto:ak.alz@mail.ru">ak.alz@mail.ru</a>
                            </p>
                    </div>
            </div>
	</div>
</body>
</html>