<div class="list-group">
	<?php foreach ($categories as $category) { ?>
        <?php if ($category['category_id'] == $category_id) { ?>
            <a href="<?=$category['href']?>" class="list-group-item active curent"><span class="img-cat-name cat-name"><?=$category['name']?></span>&nbsp;<img src="<?=$category['image']?>" class="img-responsive" /></a>
        <?php } else { ?>
                <a href="<?=$category['href'] ?>" class="list-group-item active"><span class="img-cat-name cat-name"><?=$category['name']?></span>&nbsp;<img src="<?=$category['image']?>" class="img-responsive" /></a>
        <?php } ?>

        <?php if ($category['children']) { ?>
            <?php foreach ($category['children'] as $child) { ?>						
                <?php if ($child['category_id'] == $child_id) { ?>
                    <a href="<?=$child['href']?>" class="list-group-item child curent">&nbsp;&nbsp;&nbsp;&nbsp;<img src="<?=$child['image']?>" class="img-responsive" /> - <?=$child['name']?></a>
                <?php } else { ?>
                    <a href="<?=$child['href']?>" class="list-group-item child">&nbsp;&nbsp;&nbsp;&nbsp;<img src="<?=$child['image']?>" class="img-responsive" /> - <?=$child['name']?></a>
                <?php } ?>                               
            <?php } ?>
        <?php } ?>
    <?php }  ?>
</div>