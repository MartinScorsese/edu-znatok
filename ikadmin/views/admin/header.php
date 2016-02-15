<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link href="<?=BASE_PATH ?>css/reset.css" media="screen" rel="stylesheet" type="text/css">
	<link href="<?=BASE_PATH ?>css/ik-admin.css" media="screen" rel="stylesheet" type="text/css">
	<link href='https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
	<title>Административная панель</title>
</head>
<body>
    <center>
        <table width="960px">
            <tr valign="center">
                <td colspan="2" height="75px" align="center"><a href="<?=ADMIN_PATH?>?ctrl=courses">Курсы</a> | <a href="#">Пользователи</a> | <a href="#">Публикации</a></td>
            </tr>
            <tr>
                <td width="200px">
                    <ul>
                        <li><a href="<?=ADMIN_PATH?>?ctrl=courses">Курсы</a>
                            <ul>
                                <li><a href="<?=ADMIN_PATH?>?ctrl=courses&act=add">Добавить курс</a></li>
                            </ul>
                        </li>
                         <li><a href="<?=ADMIN_PATH?>?ctrl=lessons">Уроки</a>
                            <ul>
                                <li><a href="<?=ADMIN_PATH?>?ctrl=lessons&act=add">Добавить урок</a></li>
                            </ul>
                        </li>
                        <li><a href="#">Пользователи</a></li>
                        <li><a href="#">Публикации</a></li>
                    </ul>    
                </td>
                <td width="760px">