<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class blog_model extends CI_Model
{
public function create($name,$description,$posted_by,$dateofposting)
{
$data=array("name" => $name,"description" => $description,"posted_by" => $posted_by,"dateofposting" => $dateofposting);
$query=$this->db->insert( "selftables_blog", $data );
$id=$this->db->insert_id();
if(!$query)
return  0;
else
return  $id;
}
public function beforeedit($id)
{
$this->db->where("id",$id);
$query=$this->db->get("selftables_blog")->row();
return $query;
}
function getsingleblog($id){
$this->db->where("id",$id);
$query=$this->db->get("selftables_blog")->row();
return $query;
}
public function edit($id,$name,$description,$posted_by,$dateofposting)
{
if($image=="")
{
$image=$this->blog_model->getimagebyid($id);
$image=$image->image;
}
$data=array("name" => $name,"description" => $description,"posted_by" => $posted_by,"dateofposting" => $dateofposting);
$this->db->where( "id", $id );
$query=$this->db->update( "selftables_blog", $data );
return 1;
}
public function delete($id)
{
$query=$this->db->query("DELETE FROM `selftables_blog` WHERE `id`='$id'");
return $query;
}
public function getimagebyid($id)
{
$query=$this->db->query("SELECT `image` FROM `selftables_blog` WHERE `id`='$id'")->row();
return $query;
}
public function getdropdown()
{
$query=$this->db->query("SELECT * FROM `selftables_blog` ORDER BY `id` 
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
