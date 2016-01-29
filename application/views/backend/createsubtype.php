<div class="row">
<div class="col s12">
<h4 class="pad-left-15 capitalize">Create subtype</h4>
</div>
<form class='col s12' method='post' action='<?php echo site_url("site/createsubtypesubmit");?>' enctype= 'multipart/form-data'>
<div class="row">
<div class="input-field col s6">
<label for="name">name</label>
<input type="text" id="name" name="name" value='<?php echo set_value('name');?>'>
</div>
</div>
<div class="row">
<div class="input-field col s6">
<label for="image">image</label>
<input type="text" id="image" name="image" value='<?php echo set_value('image');?>'>
</div>
</div>
<div class="row">
<div class="input-field col s6">
<label for="order">order</label>
<input type="text" id="order" name="order" value='<?php echo set_value('order');?>'>
</div>
</div>
<div class="row">
<div class="input-field col s6">
<label for="status">status</label>
<input type="text" id="status" name="status" value='<?php echo set_value('status');?>'>
</div>
</div>
<div class="row">
<div class="col s12 m6">
<button type="submit" class="btn btn-primary waves-effect waves-light blue darken-4">Save</button>
<a href="<?php echo site_url("site/viewsubtype"); ?>" class="btn btn-secondary waves-effect waves-light red">Cancel</a>
</div>
</div>
</form>
</div>
