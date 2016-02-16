<ul>
<?php foreach ($this->lessons as $lesson): ?>   
    <li><?php echo $lesson->id; ?> | <?php echo $lesson->name; ?> | <?php echo $lesson->parent_id; ?> | <?php echo $lesson->progress; ?>% | <?php echo $lesson->description; ?> | 
        <a href="<?=ADMIN_PATH?>?ctrl=lessons&act=del&id=<?php echo $lesson->id; ?>">Удалить</a> | 
        <a href="<?=ADMIN_PATH?>?ctrl=lessons&act=edit&id=<?php echo $lesson->id; ?>">Изменить</a>
    </li>
<?php endforeach; ?>
</ul>