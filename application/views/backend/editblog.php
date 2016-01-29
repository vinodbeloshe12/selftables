<div class="row">
<div class="col s12">
<h4 class="pad-left-15 capitalize">Edit blog</h4>
</div>
</div>
<div class="row">
<form class='col s12' method='post' action='<?php echo site_url("site/editblogsubmit");?>' enctype= 'multipart/form-data'>
<input type="hidden" id="normal-field" class="form-control" name="id" value="<?php echo set_value('id',$before->id);?>" style="display:none;">
<div class="row">
<div class="input-field col s6">
<label for="name">name</label>
<input type="text" id="name" name="name" value='<?php echo set_value('name',$before->name);?>'>
</div>
</div>
<div class="row">
<div class="col s12 m6">
<label>description</label>
<textarea name="description" placeholder="Enter text ..."><?php echo set_value( 'description',$before->description);?></textarea>
</div>
</div>
<div class="row">
<div class="input-field col s6">
<label for="posted_by">posted_by</label>
<input type="text" id="posted_by" name="posted_by" value='<?php echo set_value('posted_by',$before->posted_by);?>'>
</div>
</div>
<div class="row">
<div class="input-field col s6">
<label for="dateofposting">dateofposting</label>
<input type="text" id="dateofposting" name="dateofposting" value='<?php echo set_value('dateofposting',$before->dateofposting);?>'>
</div>
</div>
<div class="row">
<div class="col s6">
<button type="submit" class="btn btn-primary waves-effect waves-light  blue darken-4">Save</button>
<a href='<?php echo site_url("site/viewblog"); ?>' class='btn btn-secondary waves-effect waves-light red'>Cancel</a>
</div>
</div>
</form>
</div>
