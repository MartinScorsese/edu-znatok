<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link href="css/reset.css" media="screen" rel="stylesheet" type="text/css">
	<link href="css/main.css" media="screen" rel="stylesheet" type="text/css">
	<link href='https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
	<title>Шаблон главной страницы</title>
</head>
<body>
	<div class="wrapper">
		<div class="header">
			<div class="logo-wrap">
				<div class="logo"><a href="/" title="Главная страница ИК Знаток"></a></div>
				<div class="site-name"><h1>ОНЛАЙН ЗАНЯТИЯ</h1></div>
				<div class="site-description"><p>
                                    <?php if(!$this->page_title): ?>
                                        для дошкольников и школьников
                                    <?php else: ?>
                                        <?php echo $this->page_title; ?>
                                    <?php endif; ?>
                                    </p></div>
			</div>
		</div>
		<div class="content">