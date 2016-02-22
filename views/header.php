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
        <title>
            <?php if(!$this->page_title): ?>
                Онлайн занятия по программированию и математике для школьников и дошкольников.
            <?php else: ?>
                <?php echo $this->page_title; ?>
            <?php endif; ?>
        </title>
</head>
<body>
	<div class="wrapper">
            <div class="header">
                <div class="logo-wrap">
                        <div class="logo"><a href="<?=BASE_PATH ?>" title="Главная страница ИК Знаток"></a></div>
                        <div class="site-name"><h1>ОНЛАЙН ЗАНЯТИЯ</h1></div>
                        <div class="site-description"><p>
                                для дошкольников и школьников
                            </p></div>
                </div>
            </div>
            <input type="checkbox" id="hmt" class="hidden-menu-ticker">
<label class="btn-menu" for="hmt">
  <span class="first"></span>
  <span class="second"></span>
  <span class="third"></span>
</label>
<ul class="hidden-menu">
	<aside class="left">
		<div class="absolute">
		<div id="fixed">
	 	<div id="miProfile">
	 		<?php if(!$user): ?>
	    	<a href="<?=BASE_PATH?>auth/">Войти</a>
	        <?php else: ?>
                        <img src ="<?=BASE_PATH?><?=$user->img?>" width="35px"><br />
                        <a href="<?=BASE_PATH?>users/">Профиль</a> | <a href="<?=BASE_PATH?>auth/logout/">Выйти</a>
            <?php endif; ?>
            <br><hr />
	 </div>
	 <nav class="LMenu">
	 <a href="#" onClick="Page.Go(this.href); return false;">Пункт 2</a>
	 <a href="#" onClick="Page.Go(this.href); return false;">Пункт 3</a>
	 <a href="#" onClick="Page.Go(this.href); return false;">Пункт 4</a>
	 <a href="#" onClick="Page.Go(this.href); return false;">Пункт 5</a>
	 <a href="#" onClick="Page.Go(this.href); return false;">Пункт 6</a>
	 <a href="#" onClick="Page.Go(this.href); return false;">Пункт 7</a>
	 </nav>
	</div>
	 </div>
	</aside>
	</ul>
            <div id="container-outer">
                
                <div id="content">
                    <div class="articles">
                        <?php if($crumbs): ?>
                            <div id="breadcrumbs">
                                <ul>
                                    <li id="home"><a href="<?=BASE_PATH?>" title="Домой"></a></li>
                                    <li class="arrow"></li>
                                <?php foreach ($crumbs as $crumb): ?>
                                    <?php if(trim($this->page_title) != trim($crumb['name'])): ?>
                                        <li><a href="<?=BASE_PATH?><?=$crumb['path']?>"><?=$crumb['name']?></a></li>
                                        <li class="arrow"></li>
                                    <?php endif; ?>
                                    <?php if(trim($this->page_title) == trim($crumb['name'])): ?>    
                                        <li><p><?=$crumb['name']?></p></li>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                                </ul>
                            </div>
                        <?php endif; ?>
                        <?php if($this->page_title): ?>
                            <h1><?=$this->page_title?></h1>
                        <?php endif; ?>