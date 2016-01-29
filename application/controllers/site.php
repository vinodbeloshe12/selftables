<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Site extends CI_Controller 
{
	public function __construct( )
	{
		parent::__construct();
		
		$this->is_logged_in();
	}
	function is_logged_in( )
	{
		$is_logged_in = $this->session->userdata( 'logged_in' );
		if ( $is_logged_in !== 'true' || !isset( $is_logged_in ) ) {
			redirect( base_url() . 'index.php/login', 'refresh' );
		} //$is_logged_in !== 'true' || !isset( $is_logged_in )
	}
	function checkaccess($access)
	{
		$accesslevel=$this->session->userdata('accesslevel');
		if(!in_array($accesslevel,$access))
			redirect( base_url() . 'index.php/site?alerterror=You do not have access to this page. ', 'refresh' );
	}
    public function getOrderingDone()
    {
        $orderby=$this->input->get("orderby");
        $ids=$this->input->get("ids");
        $ids=explode(",",$ids);
        $tablename=$this->input->get("tablename");
        $where=$this->input->get("where");
        if($where == "" || $where=="undefined")
        {
            $where=1;
        }
        $access = array(
            '1',
        );
        $this->checkAccess($access);
        $i=1;
        foreach($ids as $id)
        {
            //echo "UPDATE `$tablename` SET `$orderby` = '$i' WHERE `id` = `$id` AND $where";
            $this->db->query("UPDATE `$tablename` SET `$orderby` = '$i' WHERE `id` = '$id' AND $where");
            $i++;
            //echo "/n";
        }
        $data["message"]=true;
        $this->load->view("json",$data);
        
    }
	public function index()
	{
		$access = array("1","2");
		$this->checkaccess($access);
		$data[ 'page' ] = 'dashboard';
		$data[ 'title' ] = 'Welcome';
		$this->load->view( 'template', $data );	
	}
	public function createuser()
	{
		$access = array("1");
		$this->checkaccess($access);
		$data['accesslevel']=$this->user_model->getaccesslevels();
		$data[ 'status' ] =$this->user_model->getstatusdropdown();
		$data[ 'logintype' ] =$this->user_model->getlogintypedropdown();
        $data['gender']=$this->user_model->getgenderdropdown();
//        $data['category']=$this->category_model->getcategorydropdown();
		$data[ 'page' ] = 'createuser';
		$data[ 'title' ] = 'Create User';
		$this->load->view( 'template', $data );	
	}
	function createusersubmit()
	{
		$access = array("1");
		$this->checkaccess($access);
		$this->form_validation->set_rules('name','Name','trim|required|max_length[30]');
		$this->form_validation->set_rules('email','Email','trim|required|valid_email|is_unique[user.email]');
		$this->form_validation->set_rules('password','Password','trim|required|min_length[6]|max_length[30]');
		$this->form_validation->set_rules('confirmpassword','Confirm Password','trim|required|matches[password]');
		$this->form_validation->set_rules('accessslevel','Accessslevel','trim');
		$this->form_validation->set_rules('status','status','trim|');
		$this->form_validation->set_rules('socialid','Socialid','trim');
		$this->form_validation->set_rules('logintype','logintype','trim');
		$this->form_validation->set_rules('json','json','trim');
		if($this->form_validation->run() == FALSE)	
		{
			$data['alerterror'] = validation_errors();
            $data['gender']=$this->user_model->getgenderdropdown();
			$data['accesslevel']=$this->user_model->getaccesslevels();
            $data[ 'status' ] =$this->user_model->getstatusdropdown();
            $data[ 'logintype' ] =$this->user_model->getlogintypedropdown();
            $data[ 'page' ] = 'createuser';
            $data[ 'title' ] = 'Create User';
            $this->load->view( 'template', $data );	
		}
		else
		{
            $name=$this->input->post('name');
            $email=$this->input->post('email');
            $password=$this->input->post('password');
            $accesslevel=$this->input->post('accesslevel');
            $status=$this->input->post('status');
            $socialid=$this->input->post('socialid');
            $logintype=$this->input->post('logintype');
            $json=$this->input->post('json');
            $firstname=$this->input->post('firstname');
            $lastname=$this->input->post('lastname');
            $phone=$this->input->post('phone');
            $billingaddress=$this->input->post('billingaddress');
            $billingcity=$this->input->post('billingcity');
            $billingstate=$this->input->post('billingstate');
            $billingcountry=$this->input->post('billingcountry');
            $billingpincode=$this->input->post('billingpincode');
            $billingcontact=$this->input->post('billingcontact');
            
            $shippingaddress=$this->input->post('shippingaddress');
            $shippingcity=$this->input->post('shippingcity');
            $shippingstate=$this->input->post('shippingstate');
            $shippingcountry=$this->input->post('shippingcountry');
            $shippingpincode=$this->input->post('shippingpincode');
            $shippingcontact=$this->input->post('shippingcontact');
            $shippingname=$this->input->post('shippingname');
            $currency=$this->input->post('currency');
            $credit=$this->input->post('credit');
            $companyname=$this->input->post('companyname');
            $registrationno=$this->input->post('registrationno');
            $vatnumber=$this->input->post('vatnumber');
            $country=$this->input->post('country');
            $fax=$this->input->post('fax');
            $gender=$this->input->post('gender');
            	
            $config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$this->load->library('upload', $config);
			$filename="image";
			$image="";
			if (  $this->upload->do_upload($filename))
			{
				$uploaddata = $this->upload->data();
				$image=$uploaddata['file_name'];
                
                $config_r['source_image']   = './uploads/' . $uploaddata['file_name'];
                $config_r['maintain_ratio'] = TRUE;
                $config_t['create_thumb'] = FALSE;///add this
                $config_r['width']   = 800;
                $config_r['height'] = 800;
                $config_r['quality']    = 100;
                //end of configs

                $this->load->library('image_lib', $config_r); 
                $this->image_lib->initialize($config_r);
                if(!$this->image_lib->resize())
                {
                    echo "Failed." . $this->image_lib->display_errors();
                    //return false;
                }  
                else
                {
                    //print_r($this->image_lib->dest_image);
                    //dest_image
                    $image=$this->image_lib->dest_image;
                    //return false;
                }
                
			}
            
			if($this->user_model->create($name,$email,$password,$accesslevel,$status,$socialid,$logintype,$image,$json,$firstname,$lastname,$phone,$billingaddress,$billingcity,$billingstate,$billingcountry,$billingpincode,$billingcontact,$shippingaddress,$shippingcity,$shippingstate,$shippingcountry,$shippingpincode,$shippingcontact,$shippingname,$currency,$credit,$companyname,$registrationno,$vatnumber,$country,$fax,$gender)==0)
			$data['alerterror']="New user could not be created.";
			else
			$data['alertsuccess']="User created Successfully.";
			$data['redirect']="site/viewusers";
			$this->load->view("redirect",$data);
		}
	}
    function viewusers()
	{
		$access = array("1");
		$this->checkaccess($access);
		$data['page']='viewusers';
        $data['base_url'] = site_url("site/viewusersjson");
        
		$data['title']='View Users';
		$this->load->view('template',$data);
	} 
    function viewusersjson()
	{
		$access = array("1");
		$this->checkaccess($access);
        
        
        $elements=array();
        $elements[0]=new stdClass();
        $elements[0]->field="`user`.`id`";
        $elements[0]->sort="1";
        $elements[0]->header="ID";
        $elements[0]->alias="id";
        
        
        $elements[1]=new stdClass();
        $elements[1]->field="`user`.`name`";
        $elements[1]->sort="1";
        $elements[1]->header="Name";
        $elements[1]->alias="name";
        
        $elements[2]=new stdClass();
        $elements[2]->field="`user`.`email`";
        $elements[2]->sort="1";
        $elements[2]->header="Email";
        $elements[2]->alias="email";
        
        $elements[3]=new stdClass();
        $elements[3]->field="`user`.`socialid`";
        $elements[3]->sort="1";
        $elements[3]->header="SocialId";
        $elements[3]->alias="socialid";
        
        $elements[4]=new stdClass();
        $elements[4]->field="`user`.`logintype`";
        $elements[4]->sort="1";
        $elements[4]->header="Logintype";
        $elements[4]->alias="logintype";
        
        $elements[5]=new stdClass();
        $elements[5]->field="`user`.`json`";
        $elements[5]->sort="1";
        $elements[5]->header="Json";
        $elements[5]->alias="json";
       
        $elements[6]=new stdClass();
        $elements[6]->field="`accesslevel`.`name`";
        $elements[6]->sort="1";
        $elements[6]->header="Accesslevel";
        $elements[6]->alias="accesslevelname";
       
        $elements[7]=new stdClass();
        $elements[7]->field="`statuses`.`name`";
        $elements[7]->sort="1";
        $elements[7]->header="Status";
        $elements[7]->alias="status";
       
        
        $search=$this->input->get_post("search");
        $pageno=$this->input->get_post("pageno");
        $orderby=$this->input->get_post("orderby");
        $orderorder=$this->input->get_post("orderorder");
        $maxrow=$this->input->get_post("maxrow");
        if($maxrow=="")
        {
            $maxrow=20;
        }
        
        if($orderby=="")
        {
            $orderby="id";
            $orderorder="ASC";
        }
       
        $data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `user` LEFT OUTER JOIN `logintype` ON `logintype`.`id`=`user`.`logintype` LEFT OUTER JOIN `accesslevel` ON `accesslevel`.`id`=`user`.`accesslevel` LEFT OUTER JOIN `statuses` ON `statuses`.`id`=`user`.`status`");
        
		$this->load->view("json",$data);
	} 
    
    
	function edituser()
	{
		$access = array("1");
		$this->checkaccess($access);
		$data[ 'status' ] =$this->user_model->getstatusdropdown();
        $data["before1"]=$this->input->get('id');
        $data["before2"]=$this->input->get('id');
        $data["before3"]=$this->input->get('id');
        $data["before4"]=$this->input->get('id');
        $data["before5"]=$this->input->get('id');
		$data['accesslevel']=$this->user_model->getaccesslevels();
		$data['gender']=$this->user_model->getgenderdropdown();
		$data[ 'logintype' ] =$this->user_model->getlogintypedropdown();
		$data['before']=$this->user_model->beforeedit($this->input->get('id'));
		$data['page']='edituser';
		$data['page2']='block/userblock';
		$data['title']='Edit User';
		$this->load->view('templatewith2',$data);
	}
	function editusersubmit()
	{
		$access = array("1");
		$this->checkaccess($access);
		
		$this->form_validation->set_rules('name','Name','trim|required|max_length[30]');
		$this->form_validation->set_rules('email','Email','trim|required|valid_email');
		$this->form_validation->set_rules('password','Password','trim|min_length[6]|max_length[30]');
		$this->form_validation->set_rules('confirmpassword','Confirm Password','trim|matches[password]');
		$this->form_validation->set_rules('accessslevel','Accessslevel','trim');
		$this->form_validation->set_rules('status','status','trim|');
		$this->form_validation->set_rules('socialid','Socialid','trim');
		$this->form_validation->set_rules('logintype','logintype','trim');
		$this->form_validation->set_rules('json','json','trim');
		if($this->form_validation->run() == FALSE)	
		{
			$data['alerterror'] = validation_errors();
			$data[ 'status' ] =$this->user_model->getstatusdropdown();
            $data['gender']=$this->user_model->getgenderdropdown();
			$data['accesslevel']=$this->user_model->getaccesslevels();
            $data[ 'logintype' ] =$this->user_model->getlogintypedropdown();
			$data['before']=$this->user_model->beforeedit($this->input->post('id'));
			$data['page']='edituser';
//			$data['page2']='block/userblock';
			$data['title']='Edit User';
			$this->load->view('template',$data);
		}
		else
		{
            
            $id=$this->input->get_post('id');
            $name=$this->input->get_post('name');
            $email=$this->input->get_post('email');
            $password=$this->input->get_post('password');
            $accesslevel=$this->input->get_post('accesslevel');
            $status=$this->input->get_post('status');
            $socialid=$this->input->get_post('socialid');
            $logintype=$this->input->get_post('logintype');
            $json=$this->input->get_post('json');
//            $category=$this->input->get_post('category');
            $firstname=$this->input->post('firstname');
            $lastname=$this->input->post('lastname');
            $phone=$this->input->post('phone');
            $billingaddress=$this->input->post('billingaddress');
            $billingcity=$this->input->post('billingcity');
            $billingstate=$this->input->post('billingstate');
            $billingcountry=$this->input->post('billingcountry');
            $billingpincode=$this->input->post('billingpincode');
            $billingcontact=$this->input->post('billingcontact');
            
            $shippingaddress=$this->input->post('shippingaddress');
            $shippingcity=$this->input->post('shippingcity');
            $shippingstate=$this->input->post('shippingstate');
            $shippingcountry=$this->input->post('shippingcountry');
            $shippingpincode=$this->input->post('shippingpincode');
            $shippingcontact=$this->input->post('shippingcontact');
            $shippingname=$this->input->post('shippingname');
            $currency=$this->input->post('currency');
            $credit=$this->input->post('credit');
            $companyname=$this->input->post('companyname');
            $registrationno=$this->input->post('registrationno');
            $vatnumber=$this->input->post('vatnumber');
            $country=$this->input->post('country');
            $fax=$this->input->post('fax');
            $gender=$this->input->post('gender');
            $config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$this->load->library('upload', $config);
			$filename="image";
			$image="";
			if (  $this->upload->do_upload($filename))
			{
				$uploaddata = $this->upload->data();
				$image=$uploaddata['file_name'];
                
                $config_r['source_image']   = './uploads/' . $uploaddata['file_name'];
                $config_r['maintain_ratio'] = TRUE;
                $config_t['create_thumb'] = FALSE;///add this
                $config_r['width']   = 800;
                $config_r['height'] = 800;
                $config_r['quality']    = 100;
                //end of configs

                $this->load->library('image_lib', $config_r); 
                $this->image_lib->initialize($config_r);
                if(!$this->image_lib->resize())
                {
                    echo "Failed." . $this->image_lib->display_errors();
                    //return false;
                }  
                else
                {
                    //print_r($this->image_lib->dest_image);
                    //dest_image
                    $image=$this->image_lib->dest_image;
                    //return false;
                }
                
			}
            
            if($image=="")
            {
            $image=$this->user_model->getuserimagebyid($id);
               // print_r($image);
                $image=$image->image;
            }
            
			if($this->user_model->edit($id,$name,$email,$password,$accesslevel,$status,$socialid,$logintype,$image,$json,$firstname,$lastname,$phone,$billingaddress,$billingcity,$billingstate,$billingcountry,$billingpincode,$billingcontact,$shippingaddress,$shippingcity,$shippingstate,$shippingcountry,$shippingpincode,$shippingcontact,$shippingname,$currency,$credit,$companyname,$registrationno,$vatnumber,$country,$fax,$gender)==0)
			$data['alerterror']="User Editing was unsuccesful";
			else
			$data['alertsuccess']="User edited Successfully.";
			
			$data['redirect']="site/viewusers";
			//$data['other']="template=$template";
			$this->load->view("redirect",$data);
			
		}
	}
	
	function deleteuser()
	{
		$access = array("1");
		$this->checkaccess($access);
		$this->user_model->deleteuser($this->input->get('id'));
//		$data['table']=$this->user_model->viewusers();
		$data['alertsuccess']="User Deleted Successfully";
		$data['redirect']="site/viewusers";
			//$data['other']="template=$template";
		$this->load->view("redirect",$data);
	}
	function changeuserstatus()
	{
		$access = array("1");
		$this->checkaccess($access);
		$this->user_model->changestatus($this->input->get('id'));
		$data['table']=$this->user_model->viewusers();
		$data['alertsuccess']="Status Changed Successfully";
		$data['redirect']="site/viewusers";
        $data['other']="template=$template";
        $this->load->view("redirect",$data);
	}
    public function viewcart()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="viewcart";
    $data["before1"]=$this->input->get('id');
        $data["before2"]=$this->input->get('id');
        $data["before3"]=$this->input->get('id');
        $data["before4"]=$this->input->get('id');
        $data["before5"]=$this->input->get('id');
$data['page2']='block/userblock';
$data["base_url"]=site_url("site/viewcartjson?id=").$this->input->get('id');
$data["title"]="View cart";
$this->load->view("templatewith2",$data);
}
function viewcartjson()
{
    $id=$this->input->get('id');
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`fynx_cart`.`id`";
$elements[0]->sort="1";
$elements[0]->header="ID";
$elements[0]->alias="id";
$elements[1]=new stdClass();
$elements[1]->field="`fynx_cart`.`user`";
$elements[1]->sort="1";
$elements[1]->header="User";
$elements[1]->alias="user";
$elements[2]=new stdClass();
$elements[2]->field="`fynx_cart`.`quantity`";
$elements[2]->sort="1";
$elements[2]->header="Quantity";
$elements[2]->alias="quantity";
$elements[3]=new stdClass();
$elements[3]->field="`fynx_cart`.`product`";
$elements[3]->sort="1";
$elements[3]->header="Product";
$elements[3]->alias="product";
$elements[4]=new stdClass();
$elements[4]->field="`fynx_cart`.`timestamp`";
$elements[4]->sort="1";
$elements[4]->header="Timestamp";
$elements[4]->alias="timestamp";
    
$elements[5]=new stdClass();
$elements[5]->field="`fynx_cart`.`size`";
$elements[5]->sort="1";
$elements[5]->header="Size";
$elements[5]->alias="size";

$elements[6]=new stdClass();
$elements[6]->field="`fynx_cart`.`color`";
$elements[6]->sort="1";
$elements[6]->header="Color";
$elements[6]->alias="color";
$search=$this->input->get_post("search");
$pageno=$this->input->get_post("pageno");
$orderby=$this->input->get_post("orderby");
$orderorder=$this->input->get_post("orderorder");
$maxrow=$this->input->get_post("maxrow");
if($maxrow=="")
{
$maxrow=20;
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `fynx_cart`","WHERE `fynx_cart`.`user`='$id'");
$this->load->view("json",$data);
}
    public function viewwishlist()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="viewwishlist";
    $data["before1"]=$this->input->get('id');
        $data["before2"]=$this->input->get('id');
        $data["before3"]=$this->input->get('id');
        $data["before4"]=$this->input->get('id');
        $data["before5"]=$this->input->get('id');
$data['page2']='block/userblock';
$data["base_url"]=site_url("site/viewwishlistjson?id=".$this->input->get('id'));
$data["title"]="View wishlist";
$this->load->view("templatewith2",$data);
}
function viewwishlistjson()
{
    $user=$this->input->get('id');
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`fynx_wishlist`.`id`";
$elements[0]->sort="1";
$elements[0]->header="ID";
$elements[0]->alias="id";
$elements[1]=new stdClass();
$elements[1]->field="`fynx_wishlist`.`user`";
$elements[1]->sort="1";
$elements[1]->header="User";
$elements[1]->alias="user";
$elements[2]=new stdClass();
$elements[2]->field="`fynx_wishlist`.`product`";
$elements[2]->sort="1";
$elements[2]->header="Product";
$elements[2]->alias="product";
$elements[3]=new stdClass();
$elements[3]->field="`fynx_wishlist`.`timestamp`";
$elements[3]->sort="1";
$elements[3]->header="Timestamp";
$elements[3]->alias="timestamp";
    
$elements[4]=new stdClass();
$elements[4]->field="`fynx_product`.`name`";
$elements[4]->sort="1";
$elements[4]->header="Product Name";
$elements[4]->alias="productname";
$search=$this->input->get_post("search");
$pageno=$this->input->get_post("pageno");
$orderby=$this->input->get_post("orderby");
$orderorder=$this->input->get_post("orderorder");
$maxrow=$this->input->get_post("maxrow");
if($maxrow=="")
{
$maxrow=20;
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `fynx_wishlist` LEFT OUTER JOIN `fynx_product` ON `fynx_product`.`id`=`fynx_wishlist`.`product`","WHERE `fynx_wishlist`.`user`='$user'");
$this->load->view("json",$data);
}
    
    
    
    
public function viewhealthpackages()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="viewhealthpackages";
$data["base_url"]=site_url("site/viewhealthpackagesjson");
$data["title"]="View healthpackages";
$this->load->view("template",$data);
}
function viewhealthpackagesjson()
{
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`selftables_healthpackages`.`id`";
$elements[0]->sort="1";
$elements[0]->header="id";
$elements[0]->alias="id";
$elements[1]=new stdClass();
$elements[1]->field="`selftables_healthpackages`.`type`";
$elements[1]->sort="1";
$elements[1]->header="type";
$elements[1]->alias="type";
$elements[2]=new stdClass();
$elements[2]->field="`selftables_healthpackages`.`months`";
$elements[2]->sort="1";
$elements[2]->header="months";
$elements[2]->alias="months";
$elements[3]=new stdClass();
$elements[3]->field="`selftables_healthpackages`.`visits`";
$elements[3]->sort="1";
$elements[3]->header="visits";
$elements[3]->alias="visits";
$elements[4]=new stdClass();
$elements[4]->field="`selftables_healthpackages`.`plan`";
$elements[4]->sort="1";
$elements[4]->header="plan";
$elements[4]->alias="plan";
$elements[5]=new stdClass();
$elements[5]->field="`selftables_healthpackages`.`price_in_INR`";
$elements[5]->sort="1";
$elements[5]->header="price_in_INR";
$elements[5]->alias="price_in_INR";
$elements[6]=new stdClass();
$elements[6]->field="`selftables_healthpackages`.`price_in_dollars`";
$elements[6]->sort="1";
$elements[6]->header="price_in_dollars";
$elements[6]->alias="price_in_dollars";
$elements[7]=new stdClass();
$elements[7]->field="`selftables_healthpackages`.`description`";
$elements[7]->sort="1";
$elements[7]->header="description";
$elements[7]->alias="description";
$elements[8]=new stdClass();
$elements[8]->field="`selftables_healthpackages`.`title`";
$elements[8]->sort="1";
$elements[8]->header="title";
$elements[8]->alias="title";
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
$maxrow=20;
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `selftables_healthpackages`");
$this->load->view("json",$data);
}

public function createhealthpackages()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="createhealthpackages";
$data["title"]="Create healthpackages";
$this->load->view("template",$data);
}
public function createhealthpackagessubmit() 
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("type","type","trim");
$this->form_validation->set_rules("months","months","trim");
$this->form_validation->set_rules("visits","visits","trim");
$this->form_validation->set_rules("plan","plan","trim");
$this->form_validation->set_rules("price_in_INR","price_in_INR","trim");
$this->form_validation->set_rules("price_in_dollars","price_in_dollars","trim");
$this->form_validation->set_rules("description","description","trim");
$this->form_validation->set_rules("title","title","trim");
$this->form_validation->set_rules("subtype","subtype","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="createhealthpackages";
$data["title"]="Create healthpackages";
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$type=$this->input->get_post("type");
$months=$this->input->get_post("months");
$visits=$this->input->get_post("visits");
$plan=$this->input->get_post("plan");
$price_in_INR=$this->input->get_post("price_in_INR");
$price_in_dollars=$this->input->get_post("price_in_dollars");
$description=$this->input->get_post("description");
$title=$this->input->get_post("title");
$subtype=$this->input->get_post("subtype");
if($this->healthpackages_model->create($type,$months,$visits,$plan,$price_in_INR,$price_in_dollars,$description,$title,$subtype)==0)
$data["alerterror"]="New healthpackages could not be created.";
else
$data["alertsuccess"]="healthpackages created Successfully.";
$data["redirect"]="site/viewhealthpackages";
$this->load->view("redirect",$data);
}
}
public function edithealthpackages()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="edithealthpackages";
$data["title"]="Edit healthpackages";
$data["before"]=$this->healthpackages_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
public function edithealthpackagessubmit()
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("id","id","trim");
$this->form_validation->set_rules("type","type","trim");
$this->form_validation->set_rules("months","months","trim");
$this->form_validation->set_rules("visits","visits","trim");
$this->form_validation->set_rules("plan","plan","trim");
$this->form_validation->set_rules("price_in_INR","price_in_INR","trim");
$this->form_validation->set_rules("price_in_dollars","price_in_dollars","trim");
$this->form_validation->set_rules("description","description","trim");
$this->form_validation->set_rules("title","title","trim");
$this->form_validation->set_rules("subtype","subtype","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="edithealthpackages";
$data["title"]="Edit healthpackages";
$data["before"]=$this->healthpackages_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$type=$this->input->get_post("type");
$months=$this->input->get_post("months");
$visits=$this->input->get_post("visits");
$plan=$this->input->get_post("plan");
$price_in_INR=$this->input->get_post("price_in_INR");
$price_in_dollars=$this->input->get_post("price_in_dollars");
$description=$this->input->get_post("description");
$title=$this->input->get_post("title");
$subtype=$this->input->get_post("subtype");
if($this->healthpackages_model->edit($id,$type,$months,$visits,$plan,$price_in_INR,$price_in_dollars,$description,$title,$subtype)==0)
$data["alerterror"]="New healthpackages could not be Updated.";
else
$data["alertsuccess"]="healthpackages Updated Successfully.";
$data["redirect"]="site/viewhealthpackages";
$this->load->view("redirect",$data);
}
}
public function deletehealthpackages()
{
$access=array("1");
$this->checkaccess($access);
$this->healthpackages_model->delete($this->input->get("id"));
$data["redirect"]="site/viewhealthpackages";
$this->load->view("redirect",$data);
}
public function viewsubtype()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="viewsubtype";
$data["base_url"]=site_url("site/viewsubtypejson");
$data["title"]="View subtype";
$this->load->view("template",$data);
}
function viewsubtypejson()
{
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`selftables_subtype`.`id`";
$elements[0]->sort="1";
$elements[0]->header="id";
$elements[0]->alias="id";
$elements[1]=new stdClass();
$elements[1]->field="`selftables_subtype`.`name`";
$elements[1]->sort="1";
$elements[1]->header="name";
$elements[1]->alias="name";
$elements[2]=new stdClass();
$elements[2]->field="`selftables_subtype`.`image`";
$elements[2]->sort="1";
$elements[2]->header="image";
$elements[2]->alias="image";
$elements[3]=new stdClass();
$elements[3]->field="`selftables_subtype`.`order`";
$elements[3]->sort="1";
$elements[3]->header="order";
$elements[3]->alias="order";
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
$maxrow=20;
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `selftables_subtype`");
$this->load->view("json",$data);
}

public function createsubtype()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="createsubtype";
$data["title"]="Create subtype";
$this->load->view("template",$data);
}
public function createsubtypesubmit() 
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("name","name","trim");
$this->form_validation->set_rules("image","image","trim");
$this->form_validation->set_rules("order","order","trim");
$this->form_validation->set_rules("status","status","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="createsubtype";
$data["title"]="Create subtype";
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$name=$this->input->get_post("name");
$image=$this->input->get_post("image");
$order=$this->input->get_post("order");
$status=$this->input->get_post("status");
if($this->subtype_model->create($name,$image,$order,$status)==0)
$data["alerterror"]="New subtype could not be created.";
else
$data["alertsuccess"]="subtype created Successfully.";
$data["redirect"]="site/viewsubtype";
$this->load->view("redirect",$data);
}
}
public function editsubtype()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="editsubtype";
$data["title"]="Edit subtype";
$data["before"]=$this->subtype_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
public function editsubtypesubmit()
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("id","id","trim");
$this->form_validation->set_rules("name","name","trim");
$this->form_validation->set_rules("image","image","trim");
$this->form_validation->set_rules("order","order","trim");
$this->form_validation->set_rules("status","status","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="editsubtype";
$data["title"]="Edit subtype";
$data["before"]=$this->subtype_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$name=$this->input->get_post("name");
$image=$this->input->get_post("image");
$order=$this->input->get_post("order");
$status=$this->input->get_post("status");
if($this->subtype_model->edit($id,$name,$image,$order,$status)==0)
$data["alerterror"]="New subtype could not be Updated.";
else
$data["alertsuccess"]="subtype Updated Successfully.";
$data["redirect"]="site/viewsubtype";
$this->load->view("redirect",$data);
}
}
public function deletesubtype()
{
$access=array("1");
$this->checkaccess($access);
$this->subtype_model->delete($this->input->get("id"));
$data["redirect"]="site/viewsubtype";
$this->load->view("redirect",$data);
}
public function viewblog()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="viewblog";
$data["base_url"]=site_url("site/viewblogjson");
$data["title"]="View blog";
$this->load->view("template",$data);
}
function viewblogjson()
{
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`selftables_blog`.`id`";
$elements[0]->sort="1";
$elements[0]->header="id";
$elements[0]->alias="id";
$elements[1]=new stdClass();
$elements[1]->field="`selftables_blog`.`name`";
$elements[1]->sort="1";
$elements[1]->header="name";
$elements[1]->alias="name";
$elements[2]=new stdClass();
$elements[2]->field="`selftables_blog`.`description`";
$elements[2]->sort="1";
$elements[2]->header="description";
$elements[2]->alias="description";
$elements[3]=new stdClass();
$elements[3]->field="`selftables_blog`.`posted_by`";
$elements[3]->sort="1";
$elements[3]->header="posted_by";
$elements[3]->alias="posted_by";
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
$maxrow=20;
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `selftables_blog`");
$this->load->view("json",$data);
}

public function createblog()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="createblog";
$data["title"]="Create blog";
$this->load->view("template",$data);
}
public function createblogsubmit() 
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("name","name","trim");
$this->form_validation->set_rules("description","description","trim");
$this->form_validation->set_rules("posted_by","posted_by","trim");
$this->form_validation->set_rules("dateofposting","dateofposting","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="createblog";
$data["title"]="Create blog";
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$name=$this->input->get_post("name");
$description=$this->input->get_post("description");
$posted_by=$this->input->get_post("posted_by");
$dateofposting=$this->input->get_post("dateofposting");
if($this->blog_model->create($name,$description,$posted_by,$dateofposting)==0)
$data["alerterror"]="New blog could not be created.";
else
$data["alertsuccess"]="blog created Successfully.";
$data["redirect"]="site/viewblog";
$this->load->view("redirect",$data);
}
}
public function editblog()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="editblog";
$data["title"]="Edit blog";
$data["before"]=$this->blog_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
public function editblogsubmit()
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("id","id","trim");
$this->form_validation->set_rules("name","name","trim");
$this->form_validation->set_rules("description","description","trim");
$this->form_validation->set_rules("posted_by","posted_by","trim");
$this->form_validation->set_rules("dateofposting","dateofposting","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="editblog";
$data["title"]="Edit blog";
$data["before"]=$this->blog_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$name=$this->input->get_post("name");
$description=$this->input->get_post("description");
$posted_by=$this->input->get_post("posted_by");
$dateofposting=$this->input->get_post("dateofposting");
if($this->blog_model->edit($id,$name,$description,$posted_by,$dateofposting)==0)
$data["alerterror"]="New blog could not be Updated.";
else
$data["alertsuccess"]="blog Updated Successfully.";
$data["redirect"]="site/viewblog";
$this->load->view("redirect",$data);
}
}
public function deleteblog()
{
$access=array("1");
$this->checkaccess($access);
$this->blog_model->delete($this->input->get("id"));
$data["redirect"]="site/viewblog";
$this->load->view("redirect",$data);
}
public function viewcomment()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="viewcomment";
$data["base_url"]=site_url("site/viewcommentjson");
$data["title"]="View comment";
$this->load->view("template",$data);
}
function viewcommentjson()
{
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`selftables_comment`.`id`";
$elements[0]->sort="1";
$elements[0]->header="id";
$elements[0]->alias="id";
$elements[1]=new stdClass();
$elements[1]->field="`selftables_comment`.`name`";
$elements[1]->sort="1";
$elements[1]->header="name";
$elements[1]->alias="name";
$elements[2]=new stdClass();
$elements[2]->field="`selftables_comment`.`email`";
$elements[2]->sort="1";
$elements[2]->header="email";
$elements[2]->alias="email";
$elements[3]=new stdClass();
$elements[3]->field="`selftables_comment`.`website`";
$elements[3]->sort="1";
$elements[3]->header="website";
$elements[3]->alias="website";
$elements[4]=new stdClass();
$elements[4]->field="`selftables_comment`.`comment`";
$elements[4]->sort="1";
$elements[4]->header="comment";
$elements[4]->alias="comment";
$elements[5]=new stdClass();
$elements[5]->field="`selftables_comment`.`blog`";
$elements[5]->sort="1";
$elements[5]->header="blog";
$elements[5]->alias="blog";
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
$maxrow=20;
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `selftables_comment`");
$this->load->view("json",$data);
}

public function createcomment()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="createcomment";
$data["title"]="Create comment";
$this->load->view("template",$data);
}
public function createcommentsubmit() 
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("name","name","trim");
$this->form_validation->set_rules("email","email","trim");
$this->form_validation->set_rules("website","website","trim");
$this->form_validation->set_rules("comment","comment","trim");
$this->form_validation->set_rules("blog","blog","trim");
$this->form_validation->set_rules("timestamp","timestamp","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="createcomment";
$data["title"]="Create comment";
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$name=$this->input->get_post("name");
$email=$this->input->get_post("email");
$website=$this->input->get_post("website");
$comment=$this->input->get_post("comment");
$blog=$this->input->get_post("blog");
if($this->comment_model->create($name,$email,$website,$comment,$blog,$timestamp)==0)
$data["alerterror"]="New comment could not be created.";
else
$data["alertsuccess"]="comment created Successfully.";
$data["redirect"]="site/viewcomment";
$this->load->view("redirect",$data);
}
}
public function editcomment()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="editcomment";
$data["title"]="Edit comment";
$data["before"]=$this->comment_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
public function editcommentsubmit()
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("id","id","trim");
$this->form_validation->set_rules("name","name","trim");
$this->form_validation->set_rules("email","email","trim");
$this->form_validation->set_rules("website","website","trim");
$this->form_validation->set_rules("comment","comment","trim");
$this->form_validation->set_rules("blog","blog","trim");
$this->form_validation->set_rules("timestamp","timestamp","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="editcomment";
$data["title"]="Edit comment";
$data["before"]=$this->comment_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$name=$this->input->get_post("name");
$email=$this->input->get_post("email");
$website=$this->input->get_post("website");
$comment=$this->input->get_post("comment");
$blog=$this->input->get_post("blog");
$timestamp=$this->input->get_post("timestamp");
if($this->comment_model->edit($id,$name,$email,$website,$comment,$blog,$timestamp)==0)
$data["alerterror"]="New comment could not be Updated.";
else
$data["alertsuccess"]="comment Updated Successfully.";
$data["redirect"]="site/viewcomment";
$this->load->view("redirect",$data);
}
}
public function deletecomment()
{
$access=array("1");
$this->checkaccess($access);
$this->comment_model->delete($this->input->get("id"));
$data["redirect"]="site/viewcomment";
$this->load->view("redirect",$data);
}
public function viewrealtedblog()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="viewrealtedblog";
$data["base_url"]=site_url("site/viewrealtedblogjson");
$data["title"]="View realtedblog";
$this->load->view("template",$data);
}
function viewrealtedblogjson()
{
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`selftables_realtedblog`.`id`";
$elements[0]->sort="1";
$elements[0]->header="id";
$elements[0]->alias="id";
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
$maxrow=20;
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `selftables_realtedblog`");
$this->load->view("json",$data);
}

public function createrealtedblog()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="createrealtedblog";
$data["title"]="Create realtedblog";
$this->load->view("template",$data);
}
public function createrealtedblogsubmit() 
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("blog","blog","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="createrealtedblog";
$data["title"]="Create realtedblog";
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$blog=$this->input->get_post("blog");
if($this->realtedblog_model->create($blog)==0)
$data["alerterror"]="New realtedblog could not be created.";
else
$data["alertsuccess"]="realtedblog created Successfully.";
$data["redirect"]="site/viewrealtedblog";
$this->load->view("redirect",$data);
}
}
public function editrealtedblog()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="editrealtedblog";
$data["title"]="Edit realtedblog";
$data["before"]=$this->realtedblog_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
public function editrealtedblogsubmit()
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("id","id","trim");
$this->form_validation->set_rules("blog","blog","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="editrealtedblog";
$data["title"]="Edit realtedblog";
$data["before"]=$this->realtedblog_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$blog=$this->input->get_post("blog");
if($this->realtedblog_model->edit($id,$blog)==0)
$data["alerterror"]="New realtedblog could not be Updated.";
else
$data["alertsuccess"]="realtedblog Updated Successfully.";
$data["redirect"]="site/viewrealtedblog";
$this->load->view("redirect",$data);
}
}
public function deleterealtedblog()
{
$access=array("1");
$this->checkaccess($access);
$this->realtedblog_model->delete($this->input->get("id"));
$data["redirect"]="site/viewrealtedblog";
$this->load->view("redirect",$data);
}

}
?>
