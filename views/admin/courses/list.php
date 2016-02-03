<ul>
<?php foreach ($this->courses as $course): ?>   
    <li><?php echo $course->course_id; ?> | <?php echo $course->course_name; ?> | <?php echo $course->course_parent_id; ?> | <?php echo $course->course_img; ?> | <?php echo $course->course_description; ?> | 
        <a href="/?ctrl=Admin&act=Courses&task=del&id=<?php echo $course->course_id; ?>">Удалить</a> | 
        <a href="/?ctrl=Admin&act=Courses&task=edit&id=<?php echo $course->course_id; ?>">Изменить</a>
    </li>
<?php endforeach; ?>
</ul>