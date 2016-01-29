<div class="row">
<div class="col s12">
<h4 class="pad-left-15 capitalize">Edit healthpackages</h4>
</div>
</div>
<div class="row">
<form class='col s12' method='post' action='<?php echo site_url("site/edithealthpackagessubmit");?>' enctype= 'multipart/form-data'>
<input type="hidden" id="normal-field" class="form-control" name="id" value="<?php echo set_value('id',$before->id);?>" style="display:none;">
<div class="row">
<div class="input-field col s6">
<label for="type">type</label>
<input type="text" id="type" name="type" value='<?php echo set_value('type',$before->type);?>'>
</div>
</div>
<div class=" row">
<div class=" input-field col s12 m6">
<?php //echo form_dropdown("months",$months,set_value('months',$before->months));?>
<label for="months">months</label>
<input type="text" id="months" name="months" value='<?php echo set_value('months',$before->months);?>'>

</div>
</div>
<div class="row">
<div class="input-field col s6">
<label for="visits">visits</label>
<input type="text" id="visits" name="visits" value='<?php echo set_value('visits',$before->visits);?>'>
</div>
</div>
<div class=" row">
<div class=" input-field col s12 m6">
<?php echo form_dropdown("plan",$plan,set_value('plan',$before->plan));?>
<label for="plan">plan</label>
</div>
</div>
<div class="row">
<div class="input-field col s6">
<label for="price_in_INR">price_in_INR</label>
<input type="text" id="price_in_INR" name="price_in_INR" value='<?php echo set_value('price_in_INR',$before->price_in_INR);?>'>
</div>
</div>
<div class="row">
<div class="input-field col s6">
<label for="price_in_dollars">price_in_dollars</label>
<input type="text" id="price_in_dollars" name="price_in_dollars" value='<?php echo set_value('price_in_dollars',$before->price_in_dollars);?>'>
</div>
</div>
<div class="row">
<div class="col s12 m6">
<label>description</label>
<textarea id="some-textarea" name="description" placeholder="Enter text ...">
    <?php echo set_value( 'description',$before->description);?>
</textarea>
</div>
</div>
<div class="row">
<div class="input-field col s6">
<label for="title">title</label>
<input type="text" id="title" name="title" value='<?php echo set_value('title',$before->title);?>'>
</div>
</div>
<div class="row">
<div class="col s6">
<button type="submit" class="btn btn-primary waves-effect waves-light  blue darken-4">Save</button>
<a href='<?php echo site_url("site/viewhealthpackages"); ?>' class='btn btn-secondary waves-effect waves-light red'>Cancel</a>
</div>
</div>
</form>
</div>
