<?php $course = $this->course; ?>
<form id="course" enctype="multipart/form-data" action="/?ctrl=admin&act=courses&task=edit&id=<?php echo $course->course_id; ?>" method="post">
    <input type="text" name="course_name" value="<?php echo $course->course_name; ?>"><label for="course_name">Название</label><br />
    <select name="course_parent_id">
        <option value="0">Корневая категория</option>
        <?php foreach ($this->courses as $course_list):?>
        <option value="<?php echo $course_list->course_id ?>" <?php if ($course->course_parent_id == $course_list->course_id) echo 'selected'; ?>><?php echo $course_list->course_name ?></option>
        <?php endforeach; ?>
    </select><label for="course_parent_id">Корень</label><br />
    <textarea name="course_description"><?php echo $course->course_description; ?></textarea><label for="course_description">Описание курса</label><br />
    <?php if($course->course_img): ?>
        <img src="<?php echo $course->course_img; ?>" width="200px">
        <input type="hidden" name="course_img" value="<?php echo $course->course_img; ?>">
    <?php endif;?>
    <?php if(!$course->course_img): ?>
        <input type="file" name="course_img" multiple accept="image/*"><label for="course_img">Изображение курса</label><br />
    <?php endif; ?>
    <input type="hidden" name="course_id" value="<?php echo $course->course_id; ?>">
    <input type="submit" value="Обновить">
    
    
</form>