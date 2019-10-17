<?php  if (count($errors) > 0) : ?>
    <div class = "alert alert-danger">
        <?php foreach ($errors as $error) : ?>
            <p style="margin-bottom: 1px;"><?php echo $error ?></p>
        <?php endforeach ?>
    </div>
<?php  endif ?>
