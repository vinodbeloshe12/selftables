<?php if ( ! defined("BASEPATH")) exit("No direct script access allowed");
class Json extends CI_Controller 
{function getallhealthpackages()
{
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`selftables_healthpackages`.`id`";
$elements[0]->sort="1";
$elements[0]->header="id";
$elements[0]->alias="id";

$elements=array();
$elements[1]=new stdClass();
$elements[1]->field="`selftables_healthpackages`.`type`";
$elements[1]->sort="1";
$elements[1]->header="type";
$elements[1]->alias="type";

$elements=array();
$elements[2]=new stdClass();
$elements[2]->field="`selftables_healthpackages`.`months`";
$elements[2]->sort="1";
$elements[2]->header="months";
$elements[2]->alias="months";

$elements=array();
$elements[3]=new stdClass();
$elements[3]->field="`selftables_healthpackages`.`visits`";
$elements[3]->sort="1";
$elements[3]->header="visits";
$elements[3]->alias="visits";

$elements=array();
$elements[4]=new stdClass();
$elements[4]->field="`selftables_healthpackages`.`plan`";
$elements[4]->sort="1";
$elements[4]->header="plan";
$elements[4]->alias="plan";

$elements=array();
$elements[5]=new stdClass();
$elements[5]->field="`selftables_healthpackages`.`price_in_INR`";
$elements[5]->sort="1";
$elements[5]->header="price_in_INR";
$elements[5]->alias="price_in_INR";

$elements=array();
$elements[6]=new stdClass();
$elements[6]->field="`selftables_healthpackages`.`price_in_dollars`";
$elements[6]->sort="1";
$elements[6]->header="price_in_dollars";
$elements[6]->alias="price_in_dollars";

$elements=array();
$elements[7]=new stdClass();
$elements[7]->field="`selftables_healthpackages`.`description`";
$elements[7]->sort="1";
$elements[7]->header="description";
$elements[7]->alias="description";

$elements=array();
$elements[8]=new stdClass();
$elements[8]->field="`selftables_healthpackages`.`title`";
$elements[8]->sort="1";
$elements[8]->header="title";
$elements[8]->alias="title";

$elements=array();
$elements[9]=new stdClass();
$elements[9]->field="`selftables_healthpackages`.`subtype`";
$elements[9]->sort="1";
$elements[9]->header="subtype";
$elements[9]->alias="subtype";

$search=$this->input->get_post("search");
$pageno=$this->input->get_post("pageno");
$orderby=$this->input->get_post("orderby");
$orderorder=$this->input->get_post("orderorder");
$maxrow=$this->input->get_post("maxrow");
if($maxrow=="")
{
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `selftables_healthpackages`");
$this->load->view("json",$data);
}
public function getsinglehealthpackages()
{
$id=$this->input->get_post("id");
$data["message"]=$this->healthpackages_model->getsinglehealthpackages($id);
$this->load->view("json",$data);
}
function getallsubtype()
{
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`selftables_subtype`.`id`";
$elements[0]->sort="1";
$elements[0]->header="id";
$elements[0]->alias="id";

$elements=array();
$elements[1]=new stdClass();
$elements[1]->field="`selftables_subtype`.`name`";
$elements[1]->sort="1";
$elements[1]->header="name";
$elements[1]->alias="name";

$elements=array();
$elements[2]=new stdClass();
$elements[2]->field="`selftables_subtype`.`image`";
$elements[2]->sort="1";
$elements[2]->header="image";
$elements[2]->alias="image";

$elements=array();
$elements[3]=new stdClass();
$elements[3]->field="`selftables_subtype`.`order`";
$elements[3]->sort="1";
$elements[3]->header="order";
$elements[3]->alias="order";

$elements=array();
$elements[4]=new stdClass();
$elements[4]->field="`selftables_subtype`.`status`";
$elements[4]->sort="1";
$elements[4]->header="status";
$elements[4]->alias="status";

$search=$this->input->get_post("search");
$pageno=$this->input->get_post("pageno");
$orderby=$this->input->get_post("orderby");
$orderorder=$this->input->get_post("orderorder");
$maxrow=$this->input->get_post("maxrow");
if($maxrow=="")
{
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `selftables_subtype`");
$this->load->view("json",$data);
}
public function getsinglesubtype()
{
$id=$this->input->get_post("id");
$data["message"]=$this->subtype_model->getsinglesubtype($id);
$this->load->view("json",$data);
}
function getallblog()
{
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`selftables_blog`.`id`";
$elements[0]->sort="1";
$elements[0]->header="id";
$elements[0]->alias="id";

$elements=array();
$elements[1]=new stdClass();
$elements[1]->field="`selftables_blog`.`name`";
$elements[1]->sort="1";
$elements[1]->header="name";
$elements[1]->alias="name";

$elements=array();
$elements[2]=new stdClass();
$elements[2]->field="`selftables_blog`.`description`";
$elements[2]->sort="1";
$elements[2]->header="description";
$elements[2]->alias="description";

$elements=array();
$elements[3]=new stdClass();
$elements[3]->field="`selftables_blog`.`posted_by`";
$elements[3]->sort="1";
$elements[3]->header="posted_by";
$elements[3]->alias="posted_by";

$elements=array();
$elements[4]=new stdClass();
$elements[4]->field="`selftables_blog`.`dateofposting`";
$elements[4]->sort="1";
$elements[4]->header="dateofposting";
$elements[4]->alias="dateofposting";

$search=$this->input->get_post("search");
$pageno=$this->input->get_post("pageno");
$orderby=$this->input->get_post("orderby");
$orderorder=$this->input->get_post("orderorder");
$maxrow=$this->input->get_post("maxrow");
if($maxrow=="")
{
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `selftables_blog`");
$this->load->view("json",$data);
}
public function getsingleblog()
{
$id=$this->input->get_post("id");
$data["message"]=$this->blog_model->getsingleblog($id);
$this->load->view("json",$data);
}
function getallcomment()
{
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`selftables_comment`.`id`";
$elements[0]->sort="1";
$elements[0]->header="id";
$elements[0]->alias="id";

$elements=array();
$elements[1]=new stdClass();
$elements[1]->field="`selftables_comment`.`name`";
$elements[1]->sort="1";
$elements[1]->header="name";
$elements[1]->alias="name";

$elements=array();
$elements[2]=new stdClass();
$elements[2]->field="`selftables_comment`.`email`";
$elements[2]->sort="1";
$elements[2]->header="email";
$elements[2]->alias="email";

$elements=array();
$elements[3]=new stdClass();
$elements[3]->field="`selftables_comment`.`website`";
$elements[3]->sort="1";
$elements[3]->header="website";
$elements[3]->alias="website";

$elements=array();
$elements[4]=new stdClass();
$elements[4]->field="`selftables_comment`.`comment`";
$elements[4]->sort="1";
$elements[4]->header="comment";
$elements[4]->alias="comment";

$elements=array();
$elements[5]=new stdClass();
$elements[5]->field="`selftables_comment`.`blog`";
$elements[5]->sort="1";
$elements[5]->header="blog";
$elements[5]->alias="blog";

$elements=array();
$elements[6]=new stdClass();
$elements[6]->field="`selftables_comment`.`timestamp`";
$elements[6]->sort="1";
$elements[6]->header="timestamp";
$elements[6]->alias="timestamp";

$search=$this->input->get_post("search");
$pageno=$this->input->get_post("pageno");
$orderby=$this->input->get_post("orderby");
$orderorder=$this->input->get_post("orderorder");
$maxrow=$this->input->get_post("maxrow");
if($maxrow=="")
{
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `selftables_comment`");
$this->load->view("json",$data);
}
public function getsinglecomment()
{
$id=$this->input->get_post("id");
$data["message"]=$this->comment_model->getsinglecomment($id);
$this->load->view("json",$data);
}
function getallrealtedblog()
{
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`selftables_realtedblog`.`id`";
$elements[0]->sort="1";
$elements[0]->header="id";
$elements[0]->alias="id";

$elements=array();
$elements[1]=new stdClass();
$elements[1]->field="`selftables_realtedblog`.`blog`";
$elements[1]->sort="1";
$elements[1]->header="blog";
$elements[1]->alias="blog";

$search=$this->input->get_post("search");
$pageno=$this->input->get_post("pageno");
$orderby=$this->input->get_post("orderby");
$orderorder=$this->input->get_post("orderorder");
$maxrow=$this->input->get_post("maxrow");
if($maxrow=="")
{
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `selftables_realtedblog`");
$this->load->view("json",$data);
}
public function getsinglerealtedblog()
{
$id=$this->input->get_post("id");
$data["message"]=$this->realtedblog_model->getsinglerealtedblog($id);
$this->load->view("json",$data);
}
} ?>