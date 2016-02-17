<div id="profile">
    <div id="name"><h2><?=$user->surname;?> <?=$user->name?></h2> </div>
    <div id="wrap">
        <div id="left">
            <div id="photo">
                <img src="<?=BASE_PATH?><?=$user->photo?>">
                <p><a href="<?=BASE_PATH?>auth/logout/">Выйти</a></p>
            </div>
        </div>
        <div id="right">
            <div id="content">
                <ul>
                    <li><span class="intro">Имя: </span><span class="cont"><?=$user->surname?> <?=$user->name?> <?=$user->patronymic?></span></li>
                    <li><span class="intro">Возраст: </span><span class="cont"><?=$user->birthday?></span></li>
                    <li><span class="intro">Город: </span><span class="cont"><?=$user->city?></span></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="clear"></div>