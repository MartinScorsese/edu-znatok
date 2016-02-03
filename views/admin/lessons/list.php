<ul>
<?php foreach ($this->lessons as $lesson): ?>   
    <li><?php echo $lesson->lesson_id; ?> | <?php echo $lesson->lesson_name; ?> | <?php echo $lesson->lesson_course_id; ?> | <?php echo $lesson->lesson_progress; ?>% | <?php echo $lesson->lesson_description; ?> | 
        <a href="/?ctrl=Admin&act=Lessons&task=del&id=<?php echo $lesson->lesson_id; ?>">Удалить</a> | 
        <a href="/?ctrl=Admin&act=Lessons&task=edit&id=<?php echo $lesson->lesson_id; ?>">Изменить</a>
    </li>
<?php endforeach; ?>
</ul>