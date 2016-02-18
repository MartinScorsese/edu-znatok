<div id="profile">
    <div id="wrap">
        <form id="register-form" enctype="multipart/form-data" action="<?=BASE_PATH?>users/save" method="post">
            <ul>
                <li>
                    <h2><?=$user->surname;?> <?=$user->name?></h2>
                </li>
                <li>
                    <label for="name">Имя</label>
                    <input type="text" name="name" value="<?=$user->name?>" maxlength="64">
                    <span class="messages">
                    </span>
                </li>
                <li>
                    <label for="surname">Фамилия</label>
                    <input type="text" name="surname" value="<?=$user->surname?>" maxlength="64">
                    <span class="messages">
                    </span>
                </li>
                <li>
                    <label for="patronymic">Отчество</label>
                    <input type="text" name="patronymic" value="<?=$user->patronymic?>" maxlength="64">
                    <span class="messages">
                    </span>
                </li>
                <li>
                    <label for="birthday">День рождения</label>
                    <input type="date" name="birthday" value="<?=$user->birthday?>">
                    <span class="messages"></span>
                </li>
                <li>
                    <label for="img">Фотография</label>
                    <input type="file" name="img" accept="image/jpeg,image/png,image/gif">
                    <span class="messages"></span>
                </li>
                <li>
                    <label for="city">Город</label>
                    <input type="text" name="city" value="<?=$user->city?>" maxlength="128">
                    <span class="messages"></span>
                </li>
                <li>
                    <button class="btn-submit">Сохранить</button>
                </li>
            </ul>
            
        </form>
    </div>
</div>
<div class="clear"></div>