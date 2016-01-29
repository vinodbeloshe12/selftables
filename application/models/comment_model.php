<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class comment_model extends CI_Model
{
public function create($name,$email,$website,$comment,$blog,$timestamp)
{
$data=array("name" => $name,"email" => $email,"website" => $website,"comment" => $comment,"blog" => $blog,"timestamp" => $timestamp);
$query=$this->db->insert( "selftables_comment", $data );
$id=$this->db->insert_id();
if(!$query)
return  0;
else
return  $id;
}
public function beforeedit($id)
{
$this->db->where("id",$id);
$query=$this->db->get("selftables_comment")->row();
return $query;
}
function getsinglecomment($id){
$this->db->where("id",$id);
$query=$this->db->get("selftables_comment")->row();
return $query;
}
public function edit($id,$name,$email,$website,$comment,$blog,$timestamp)
{
if($image=="")
{
$image=$this->comment_model->getimagebyid($id);
$image=$image->image;
}
$data=array("name" => $name,"email" => $email,"website" => $website,"comment" => $comment,"blog" => $blog,"timestamp" => $timestamp);
$this->db->where( "id", $id );
$query=$this->db->update( "selftables_comment", $data );
return 1;
}
public function delete($id)
{
$query=$this->db->query("DELETE FROM `selftables_comment` WHERE `id`='$id'");
return $query;
}
public function getimagebyid($id)
{
$query=$this->db->query("SELECT `image` FROM `selftables_comment` WHERE `id`='$id'")->row();
return $query;
}
public function getdropdown()
{
$query=$this->db->query("SELECT * FROM `selftables_comment` ORDER BY `id` 
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
