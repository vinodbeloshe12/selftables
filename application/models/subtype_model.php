<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class subtype_model extends CI_Model
{
public function create($name,$image,$order,$status)
{
$data=array("name" => $name,"image" => $image,"order" => $order,"status" => $status);
$query=$this->db->insert( "selftables_subtype", $data );
$id=$this->db->insert_id();
if(!$query)
return  0;
else
return  $id;
}
public function beforeedit($id)
{
$this->db->where("id",$id);
$query=$this->db->get("selftables_subtype")->row();
return $query;
}
function getsinglesubtype($id){
$this->db->where("id",$id);
$query=$this->db->get("selftables_subtype")->row();
return $query;
}
public function edit($id,$name,$image,$order,$status)
{
if($image=="")
{
$image=$this->subtype_model->getimagebyid($id);
$image=$image->image;
}
$data=array("name" => $name,"image" => $image,"order" => $order,"status" => $status);
$this->db->where( "id", $id );
$query=$this->db->update( "selftables_subtype", $data );
return 1;
}
public function delete($id)
{
$query=$this->db->query("DELETE FROM `selftables_subtype` WHERE `id`='$id'");
return $query;
}
public function getimagebyid($id)
{
$query=$this->db->query("SELECT `image` FROM `selftables_subtype` WHERE `id`='$id'")->row();
return $query;
}
public function getdropdown()
{
$query=$this->db->query("SELECT * FROM `selftables_subtype` ORDER BY `id` 
                    ASC")->row();
$return=array(
"" => "Select Option"
);
foreach($query as $row)
{
$return[$row->id]=$row->name;
}
return $return;
}
}
?>
