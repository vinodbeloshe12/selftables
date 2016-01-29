<div class="row">
<div class="col s12">
<div class="row">
<div class="col s12 drawchintantable">
<?php $this->chintantable->createsearch(" List of healthpackages");?>
<table class="highlight responsive-table">
<thead>
<tr>
<th data-field="id">id</th>
<th data-field="type">type</th>
<th data-field="months">months</th>
<th data-field="visits">visits</th>
<th data-field="plan">plan</th>
<th data-field="price_in_INR">price_in_INR</th>
<th data-field="price_in_dollars">price_in_dollars</th>
<th data-field="subtype">subtype</th>
</tr>
</thead>
<tbody>
</tbody>
</table>
</div>
</div>
<?php $this->chintantable->createpagination();?>
<div class="createbuttonplacement"><a class="btn-floating btn-large waves-effect waves-light blue darken-4 tooltipped" href="<?php echo site_url("site/createhealthpackages"); ?>"data-position="top" data-delay="50" data-tooltip="Create"><i class="material-icons">add</i></a></div>
</div>
</div>
<script>
function drawtable(resultrow) {
return "<tr><td>" + resultrow.id + "</td><td>" + resultrow.type + "</td><td>" + resultrow.months + "</td><td>" + resultrow.visits + "</td><td>" + resultrow.plan + "</td><td>" + resultrow.price_in_INR + "</td><td>" + resultrow.price_in_dollars + "</td><td>" + resultrow.subtype + "</td><td><a class='btn btn-primary btn-xs waves-effect waves-light blue darken-4 z-depth-0 less-pad' href='<?php echo site_url('site/edithealthpackages?id=');?>"+resultrow.id+"'><i class='fa fa-pencil propericon'></i></a><a class='btn btn-danger btn-xs waves-effect waves-light red pad10 z-depth-0 less-pad' onclick=\"return confirm('Are you sure you want to delete?');\"  href='<?php echo site_url('site/deletehealthpackages?id='); ?>"+resultrow.id+"'><i class='material-icons propericon'>delete</i></a></td></tr>";
}
generatejquery("<?php echo $base_url;?>");
</script>
