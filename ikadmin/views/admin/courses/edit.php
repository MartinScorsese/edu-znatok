<?php $course = $this->course; ?>
<form id="course" enctype="multipart/form-data" action="<?=ADMIN_PATH?>?ctrl=courses&act=save" method="post">
    <input type="text" name="name" value="<?php echo $course->name; ?>"><label for="name">Название</label><br />
    <select name="parent_id">
        <option value="0">Корневая категория</option>
        <?php foreach ($this->courses as $list):?>
        <option value="<?php echo $list->id ?>" <?php if ($course->parent_id == $list->id) echo 'selected'; ?>><?php echo $list->name ?></option>
        <?php endforeach; ?>
    </select><label for="parent_id">Корень</label><br />
    <textarea name="description"><?php echo $course->description; ?></textarea><label for="description">Описание курса</label><br />
    <?php if($course->img): ?>
        <img src="<?=BASE_PATH?><?=$course->img; ?>" width="200px">
        <input type="hidden" name="img" value="<?php echo $course->img; ?>">
    <?php endif;?>
    <?php if(!$course->img): ?>
        <input type="file" name="img" multiple accept="image/*"><label for="img">Изображение курса</label><br />
    <?php endif; ?>
    <input type="hidden" name="id" value="<?php echo $course->id; ?>">
    <input type="submit" value="Обновить">
    
    
</form>