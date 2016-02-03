<form id="course" enctype="multipart/form-data" action="/?ctrl=Admin&act=Courses&task=add" method="post">
    <input type="text" name="course_name"><label for="course_name">Название</label><br />
    <select name="course_parent_id">
        <option value="0">Без категории</option>
        <?php foreach ($this->courses as $course):?>
        <option value="<?php echo $course->course_id ?>"><?php echo $course->course_name ?></option>
        <?php endforeach; ?>
    </select><label for="course_parent_id">Уровень</label><br />
    <textarea name="course_description"></textarea><label for="course_description">Описание курса</label><br />
   <input type="file" name="course_img" multiple accept="image/*"><label for="course_img">Изображение курса</label><br />
    <input type="submit" value="Добавить">
    
    
</form>

