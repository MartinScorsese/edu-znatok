<form id="course" enctype="multipart/form-data" action="<?=ADMIN_PATH?>?ctrl=courses&act=save" method="post">
    <input type="text" name="name"><label for="name">Название</label><br />
    <select name="parent_id">
        <option value="0">Без категории</option>
        <?php foreach ($this->courses as $course):?>
        <option value="<?php echo $course->id ?>"><?php echo $course->name ?></option>
        <?php endforeach; ?>
    </select><label for="parent_id">Уровень</label><br />
    <textarea name="description"></textarea><label for="description">Описание курса</label><br />
   <input type="file" name="img" multiple accept="image/*"><label for="img">Изображение курса</label><br />
    <input type="submit" value="Добавить">
    
    
</form>

