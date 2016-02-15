<form id="course" enctype="multipart/form-data" action="/?ctrl=admin&act=lessons&task=add" method="post">
    <input type="text" name="lesson_name"><label for="lesson_name">Название</label><br />
    <select name="lesson_course_id">
        <option value="0">Без категории</option>
        <?php foreach ($this->courses as $course):?>
        <option value="<?php echo $course->course_id ?>"><?php echo $course->course_name ?></option>
        <?php endforeach; ?>
    </select><label for="lesson_course_id">Курс</label><br />
    <textarea name="lesson_description"></textarea><label for="lesson_description">Содержание для урока</label><br />
    <textarea name="lesson_text"></textarea><label for="lesson_text">Текст урока</label><br />
    <input type="submit" value="Добавить">
    
    
</form>

