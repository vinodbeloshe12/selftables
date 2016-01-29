<div class="row">
<div class="col s12">
<h4 class="pad-left-15 capitalize">Edit comment</h4>
</div>
</div>
<div class="row">
<form class='col s12' method='post' action='<?php echo site_url("site/editcommentsubmit");?>' enctype= 'multipart/form-data'>
<input type="hidden" id="normal-field" class="form-control" name="id" value="<?php echo set_value('id',$before->id);?>" style="display:none;">
<div class="row">
<div class="input-field col s6">
<label for="name">name</label>
<input type="text" id="name" name="name" value='<?php echo set_value('name',$before->name);?>'>
</div>
</div>
<div class="row">
<div class="input-field col s6">
<label for="email">email</label>
<input type="email" id="email" name="email" value='<?php echo set_value('email',$before->email);?>'>
</div>
</div>
<div class="row">
<div class="input-field col s6">
<label for="website">website</label>
<input type="text" id="website" name="website" value='<?php echo set_value('website',$before->website);?>'>
</div>
</div>
<div class="row">
<div class="col s12 m6">
<label>comment</label>
<textarea name="comment" placeholder="Enter text ..."><?php echo set_value( 'comment',$before->comment);?></textarea>
</div>
</div>
<div class="row">
<div class="input-field col s6">
<label for="blog">blog</label>
<input type="text" id="blog" name="blog" value='<?php echo set_value('blog',$before->blog);?>'>
</div>
</div>
<div class="row">
<div class="input-field col s6">
<label for="timestamp">timestamp</label>
<input type="text" id="timestamp" name="timestamp" value='<?php echo set_value('timestamp',$before->timestamp);?>'>
</div>
</div>
<div class="row">
<div class="col s6">
<button type="submit" class="btn btn-primary waves-effect waves-light  blue darken-4">Save</button>
<a href='<?php echo site_url("site/viewcomment"); ?>' class='btn btn-secondary waves-effect waves-light red'>Cancel</a>
</div>
</div>
</form>
</div>
