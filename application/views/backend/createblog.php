<div class="row">
<div class="col s12">
<h4 class="pad-left-15 capitalize">Create blog</h4>
</div>
<form class='col s12' method='post' action='<?php echo site_url("site/createblogsubmit");?>' enctype= 'multipart/form-data'>
<div class="row">
<div class="input-field col s6">
<label for="name">name</label>
<input type="text" id="name" name="name" value='<?php echo set_value('name');?>'>
</div>
</div>
<div class="row">
<div class="input-field col s12">
<textarea name="description" class="materialize-textarea" length="400"><?php echo set_value( 'description');?></textarea>
<label>description</label>
</div>
</div>
<div class="row">
<div class="input-field col s6">
<label for="posted_by">posted_by</label>
<input type="text" id="posted_by" name="posted_by" value='<?php echo set_value('posted_by');?>'>
</div>
</div>
<div class="row">
<div class="col s12 m6">
<button type="submit" class="btn btn-primary waves-effect waves-light blue darken-4">Save</button>
<a href="<?php echo site_url("site/viewblog"); ?>" class="btn btn-secondary waves-effect waves-light red">Cancel</a>
</div>
</div>
</form>
</div>
