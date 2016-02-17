<?php $lang = $this->lang;?>
<div id="auth">
    <form id="register-form" enctype="multipart/form-data" action="<?=BASE_PATH?>?ctrl=users&act=reg" method="post">
        <input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
        <ul>
             <li>
                <h2><?=$lang['register_form_header']?></h2>
                <span class="required_notification"><?=$lang['register_form_help']?> *</span>
           </li>
            <li>
                <label for="user_email"><?=$lang['form_email']?> *</label>
                <input type="email" name="user_email" value="" maxlength="64" required="required">
                <span class="messages">
                    <?php if(!empty($_SESSION['email_error'])):?>
                        <?=$lang[$_SESSION['email_error']]?>
                        <?php unset($_SESSION['email_error']);?>
                    <?php endif;?>
                </span>
            </li>
            <li>
                <label for="user_password"><?=$lang['form_password']?> *</label>
                <input type="password" name="user_password" maxlength="32" required="required">
                <span class="messages">
                    <?php if(!empty($_SESSION['pass_error'])):?>
                        <?=$lang[$_SESSION['pass_error']]?>
                        <?php unset($_SESSION['pass_error']);?>
                    <?php endif;?>
                </span>
            </li>
            <li>
                <label for="check_password"><?=$lang['form_check_password']?> *</label>
                <input type="password" name="check_password" maxlength="32" required="required">
                <span class="messages"></span>
            </li>
            <li>
                <label for="user_name"><?=$lang['form_name']?> *</label>
                <input type="text" name="user_name" value="" maxlength="64" required="required">
                <span class="messages">
                    <?php if(!empty($_SESSION['name_error'])):?>
                        <?=$lang[$_SESSION['name_error']]?>
                        <?php unset($_SESSION['name_error']);?>
                    <?php endif;?>
                </span>
            </li>
            <li>
                <label for="user_images"><?=$lang['form_images']?></label>
                <input type="file" name="user_images" accept="image/jpeg,image/png,image/gif">
                <span class="messages">
                    <?php if(!empty($_SESSION['patronymic_error'])):?>
                        <?=$lang[$_SESSION['patronymic_error']]?>
                        <?php unset($_SESSION['patronymic_error']);?>
                    <?php endif;?>
                </span>
            </li>
            <li><hr></li>
            <li>
                <label for="user_surname"><?=$lang['form_surname']?></label>
                <input type="text" name="user_surname" value="" maxlength="64">
                <span class="messages">
                    <?php if(!empty($_SESSION['surname_error'])):?>
                        <?=$lang[$_SESSION['surname_error']]?>
                        <?php unset($_SESSION['surname_error']);?>
                    <?php endif;?>
                </span>
            </li>
            <li>
                <label for="user_patronymic"><?=$lang['form_patronymic']?></label>
                <input type="text" name="user_patronymic" value="" maxlength="64">
                <span class="messages">
                    <?php if(!empty($_SESSION['patronymic_error'])):?>
                        <?=$lang[$_SESSION['patronymic_error']]?>
                        <?php unset($_SESSION['patronymic_error']);?>
                    <?php endif;?>
                </span>
            </li>
            <li>
                <label for="user_birthday"><?=$lang['form_birthday']?></label>
                <input type="date" name="user_birthday">
                <span class="messages"></span>
            </li>
            <li>
                <label for="user_location"><?=$lang['form_location']?></label>
                <input type="text" name="user_location" maxlength="128">
                <span class="messages"></span>
            </li>
            <li><hr></li>
            <li>
                <label for="user_family_status"><?=$lang['form_family_status']?></label>

                    <select name="user_family_status">
                        <?php foreach ($this->user->family_status as $status): ?>
                            <option value="<?=$lang[$status]?>"><?=$lang[$status]?></option>
                        <?php endforeach; ?>
                    </select>

                <span class="messages"></span>
            </li>
            <li>
                <label for="user_education"><?=$lang['form_education']?></label>

                    <select name="user_education">
                        <?php foreach ($this->user->edu_type as $edu_type): ?>
                            <option value="<?=$lang[$edu_type]?>"><?=$lang[$edu_type]?></option>
                        <?php endforeach; ?>
                    </select>

                <span class="messages"></span>
            </li>
            <li>
                <label for="user_experience"><?=$lang['form_experience']?></label>
                <textarea name="user_experience"></textarea>
                <span class="messages"></span>
            </li>
            <li>
                <label for="user_phone" ><?=$lang['form_phone']?></label>
                <input type="text" name="user_phone" maxlength="20">
                <span class="messages"></span>
            </li>
            <li>
                <label for="user_skype"><?=$lang['form_skype']?></label>
                <input type="text" name="user_skype" maxlength="64">
                <span class="messages"></span>
            </li>
            <li>
                <label for="user_additional"><?=$lang['form_additional']?></label>
                <textarea name="user_additional"></textarea>
                <span class="messages"></span>
            </li>
            <li>
                <button class="btn-submit"><?=$lang['btn_register']?></button>
            </li>
        </ul>
    </form>
</div>