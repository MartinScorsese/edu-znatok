<?php $lesson = $this->lesson; ?>
<form id="lesson" enctype="multipart/form-data" action="/?ctrl=Admin&act=Lessons&task=edit&id=<?php echo $lesson->lesson_id; ?>" method="post">
    <input type="text" name="lesson_name" value="<?php echo $lesson->lesson_name; ?>"><label for="lesson_name">Название</label><br />
    <select name="lesson_course_id">
        <option value="0">Корневая категория</option>
        <?php foreach ($this->courses as $course):?>
        <option value="<?php echo $course->course_id ?>" <?php if ($lesson->lesson_course_id == $course->course_id) echo 'selected'; ?>><?php echo $course->course_name ?></option>
        <?php endforeach; ?>
    </select><label for="lesson_course_id">Курс</label><br />
    <textarea name="lesson_description"><?php echo $lesson->lesson_description; ?></textarea><label for="lesson_description">Содержание урока</label><br />
    <textarea name="lesson_text"><?php echo $lesson->lesson_text; ?></textarea><label for="lesson_text">Собственно текст урока</label><br />
    <input type="text" value="<?php echo $lesson->lesson_progress; ?>" name="lesson_progress">
    <input type="hidden" name="lesson_id" value="<?php echo $lesson->lesson_id; ?>">
    <input type="submit" value="Обновить">
    
    
</form>