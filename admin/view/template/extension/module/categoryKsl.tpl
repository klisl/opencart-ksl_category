<?php echo $header; ?>
<?php echo $column_left; ?>
<div id="content">
	<div class="page-header">
		<div class="container-fluid">
			<div class="pull-right">
				<button type="submit" form="form-category" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
				<a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a></div>
			<h1><?php echo $heading_title; ?></h1>
			<ul class="breadcrumb">
				<?php foreach ($breadcrumbs as $breadcrumb) { ?>
				<li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
				<?php } ?>
			</ul>
		</div>
	</div>
	<div class="container-fluid">
		<?php if ($error_warning) { ?>
		<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
			<button type="button" class="close" data-dismiss="alert">&times;</button>
		</div>
		<?php } ?>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_edit; ?></h3>
			</div>
			<div class="panel-body">
				<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-category" class="form-horizontal">
					<button name="ksl_save" type="submit" data-toggle="tooltip" title="<?php echo 'Применить без перезагрузки'; ?>" class="btn-sm btn-info" value="true">Применить</button>  
					<div class="form-group">
						<label class="col-sm-2 control-label" for="input-status"><?php echo $entry_status; ?></label>
						<div class="col-sm-10">
							<select name="categoryKsl_status" id="input-status" class="form-control">
								<?php if ($categoryKsl_status) { ?>
								<option value="1" selected="selected"><?php echo $text_enabled; ?></option>
								<option value="0"><?php echo $text_disabled; ?></option>
								<?php } else { ?>
								<option value="1"><?php echo $text_enabled; ?></option>
								<option value="0" selected="selected"><?php echo $text_disabled; ?></option>
								<?php } ?>
							</select>             
						</div>
					</div>

					<div class="form-group">
						<h4 class="panel-heading"><?=$ksl_main_categories?></h4>
						<label class="col-sm-2 control-label" for="input-images"><?=$ksl_images; ?></label>
						<div class="col-sm-10">
							<select name="categoryKsl_images" id="input-images" class="form-control">
								<?php if ($categoryKsl_images) { ?>
								<option value="1" selected="selected"><?php echo $text_enabled; ?></option>
								<option value="0"><?php echo $text_disabled; ?></option>
								<?php } else { ?>
								<option value="1"><?php echo $text_enabled; ?></option>
								<option value="0" selected="selected"><?php echo $text_disabled; ?></option>
								<?php } ?>
							</select>
						</div>	
						<br><br><br>
						<label class="col-xs-2 control-label" for="input-img-weight"><?=$ksl_weight; ?></label>
						<div class="col-xs-4">
							<input name="categoryKsl_img_weight" type="number" class="form-control" id="input-img-weight" placeholder="px" value="<?=$categoryKsl_img_weight?>">
						</div>	
						<label class="col-xs-2 control-label" for="input-img-height"><?=$ksl_height; ?></label>			
						<div class="col-xs-4">
							<input name="categoryKsl_img_height" type="number" class="form-control" id="input-img-height" placeholder="px" value="<?=$categoryKsl_img_height?>">
						</div>								
					</div>

					<div class="form-group">
						<h4 class="panel-heading"><?=$ksl_child_categories?></h4>
						<label class="col-sm-2 control-label" for="input-children"><?php echo $entry_children; ?></label>
						<div class="col-sm-10">
							<select name="categoryKsl_children" id="input-children" class="form-control">
								<?php if ($categoryKsl_children) { ?>
								<option value="1" selected="selected"><?php echo $text_enabled; ?></option>
								<option value="0"><?php echo $text_disabled; ?></option>
								<?php } else { ?>
								<option value="1"><?php echo $text_enabled; ?></option>
								<option value="0" selected="selected"><?php echo $text_disabled; ?></option>
								<?php } ?>
							</select>
						</div>
						<br><br><br>
						<label class="col-sm-2 control-label" for="input-images"><?=$ksl_images; ?></label>
						<div class="col-sm-10">
							<select name="categoryKsl_child_images" id="input-images" class="form-control">
								<?php if ($categoryKsl_child_images) { ?>
								<option value="1" selected="selected"><?php echo $text_enabled; ?></option>
								<option value="0"><?php echo $text_disabled; ?></option>
								<?php } else { ?>
								<option value="1"><?php echo $text_enabled; ?></option>
								<option value="0" selected="selected"><?php echo $text_disabled; ?></option>
								<?php } ?>
							</select>
						</div>	
						<br><br><br>
						<label class="col-xs-2 control-label" for="input-img-weight"><?=$ksl_weight; ?></label>
						<div class="col-xs-4">
							<input name="categoryKsl_child_img_weight" type="number" class="form-control" id="input-img-weight" placeholder="px" value="<?=$categoryKsl_child_img_weight?>">
						</div>	
						<label class="col-xs-2 control-label" for="input-img-height"><?=$ksl_height; ?></label>			
						<div class="col-xs-4">
							<input name="categoryKsl_child_img_height" type="number" class="form-control" id="input-img-height" placeholder="px" value="<?=$categoryKsl_child_img_height?>">
						</div>	
					</div>

					<div class="form-group">
						<h4 class="panel-heading">&nbsp;<?=$ksl_cat_label; ?></h4>
						<p>&nbsp;<?=$ksl_cat_p; ?></p>
						<div class="list-group">
							<?php foreach ($categories as $category) { ?>
								<div class="list-group-item">
									<input name="categoryKsl_checkbox[<?=$category['category_id']?>]" type="checkbox" <?php if (isset($categoryKsl_checkbox[$category['category_id']])){ echo 'checked'; } ?>>	
									<a class="">&nbsp;<span class="img-cat-name cat-name"><?=$category['name']?>&nbsp;&nbsp;&nbsp;(id-<?=$category['category_id']?>)</span></a>
								</div>
								<?php if ($category['children']) { ?>
									<?php foreach ($category['children'] as $child) { ?>
										<div class="list-group-item">
											&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
											<input name="categoryKsl_checkbox[<?=$child['category_id']?>]" type="checkbox" <?php if (isset($categoryKsl_checkbox[$child['category_id']])){ echo 'checked'; } ?>>	
											<a class="">&nbsp;- <?=$child['name']?>&nbsp;&nbsp;&nbsp;(id-<?=$child['category_id']?>)</a>
										</div>
									<?php } ?>
								<?php } ?>
							<?php } ?>
						</div>	               
					</div>						
				</form>
				<button id="checkbox_check"><?=$ksl_check?></button>
				<button id="checkbox_cancel"><?=$ksl_cancel?></button>
				<div class="text-center">
					<label><a href="http://klisl.com">@KSL - создание сайтов, модулей, php-программирование</a></label>
				</div>
			</div>
		</div>
	</div>  
</div>
<?php echo $footer; ?>