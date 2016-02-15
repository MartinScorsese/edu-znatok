<ul>
<?php foreach ($this->courses as $course): ?>   
    <li><?php echo $course->id; ?> | <?php echo $course->name; ?> | <?php echo $course->parent_id; ?> | <?php echo $course->img; ?> | <?php echo $course->description; ?> | 
        <a href="<?=ADMIN_PATH?>?ctrl=courses&act=del&id=<?php echo $course->id; ?>">Удалить</a> | 
        <a href="<?=ADMIN_PATH?>?ctrl=courses&act=edit&id=<?php echo $course->id; ?>">Изменить</a>
    </li>
<?php endforeach; ?>
</ul>