<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of System_user_controller
 *
 * @author Pravinkumar
 */
class System_user_controller extends MY_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('admin/System_user_model', 'sysuser');
        //$this->load->model('site');
        $this->load->model('Ion_auth_model', 'ion');
        $this->load->library('form_validation');
        $this->load->helper(array('form', 'url'));
        $this->load->helper('message');
        $this->load->library('session');
    }

    //<---------System Users Start----------------->
    public function system_users() {
        $this->data['template'] = "Users/users";
        $this->data['bc'] = array(array('link' => site_url('admin'), 'page' => "Home"), array('link' => '#', 'page' => "System Users"));
        $this->admin_layout($this->data);
    }

    public function users_menu_alloc($id) {
        $this->data['menus'] = $this->site_model->getMenus();
        $this->data['user'] = $this->site_model->getAllocMenus($id);
        $this->data['template'] = "Users/menu_alloc";
        $this->data['id'] = $id;
        $this->data['bc'] = array(array('link' => site_url('admin'), 'page' => "Home"), array('link' => '#', 'page' => "System Users Menu Allocation"));
        $this->admin_layout($this->data);
    }

    public function system_user_add() {
        $this->data['groups'] = $this->sysuser->getGroups();
        //$this->data['gender'] = $this->sysuser->getGender();
        //$this->data['supplier'] = $this->sysuser->getSupplier();
        $this->data['template'] = "Users/user_add";
        $this->data['bc'] = array(array('link' => site_url('admin'), 'page' => "Home"), array('link' => '#', 'page' => "System User Add"));
        $this->admin_layout($this->data);
    }

    public function system_user_save() {
       
        $this->form_validation->set_rules('first_name', 'First Name', 'required');
        $this->form_validation->set_rules('last_name', 'Last Name', 'required');
        $this->form_validation->set_rules('email', 'Email_Id', 'required|valid_email|is_unique[system_users.email]');
        $this->form_validation->set_rules('company', 'Company Name', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[8]|callback_regx');
        $this->form_validation->set_rules('repassword', 'Re type Password', 'required|matches[password]');
        $this->form_validation->set_rules('phone', 'Phone', 'required|exact_length[10]');
        $this->form_validation->set_rules('group_id', 'Group', 'required');
        $this->form_validation->set_rules('active', 'Active', 'required');
        
        if(isset($_POST['group_id'])){
            if($_POST['group_id'] == 2){
                $this->form_validation->set_rules('website', 'Website', 'required');
                $this->form_validation->set_rules('location', 'Location', 'required');
                $this->form_validation->set_rules('no_of_employee', 'No Of Employee', 'required');
            }
        }
        
        if ($this->form_validation->run() == FALSE) {
            $this->system_user_add();
        } else {
            unset($_POST['repassword']);
            $ip_address = $this->input->ip_address();
            $salt = $this->ion->store_salt ? $this->salt() : FALSE;
            $password = $this->ion->hash_password($_POST['password'], $salt);
            $_POST['password'] = $password;
            $_POST['ip_address'] = $ip_address;
            $_POST['created_on'] = time();
            $_POST['active'] = 1;
            
                
            
            $result = $this->sysuser->saveSystemUser($_POST);
            if ($result == true) {
                $this->session->set_flashdata('message', array('title' => 'Success.', 'content' => 'System User Added Successfully.', 'type' => 's'));
                redirect(site_url() . 'admin/Users');
            } else {
                $this->session->set_flashdata('message', array('title' => 'Error.', 'content' => 'System User Adding Failed.', 'type' => 'e'));
                redirect(site_url() . 'admin/Users');
            }
        }
    }

    public function user_menu_alloc_save($id) {
        $result = $this->sysuser->saveSystemUserMenuAlloc($_POST);
        if ($result == true) {
            $this->session->set_flashdata('message', array('title' => 'Success.', 'content' => 'System User Menu Allocation Successfully.', 'type' => 's'));
            redirect(site_url() . 'admin/Users');
        } else {
            $this->session->set_flashdata('message', array('title' => 'Error.', 'content' => 'System User Menu Allocation Failed.', 'type' => 'e'));
            redirect(site_url() . 'admin/Users');
        }
    }

    public function system_user_update($id) {
        $this->form_validation->set_rules('first_name', 'First Name', 'required');
        $this->form_validation->set_rules('last_name', 'Last Name', 'required');
        $this->form_validation->set_rules('email', 'Email_Id', 'required|valid_email|callback_updateEmail');
        $this->form_validation->set_rules('company', 'Company Name', 'required');
        $this->form_validation->set_rules('password', 'Re type Password', 'min_length[8]');
        $this->form_validation->set_rules('repassword', 'Password', 'matches[password]');
        $this->form_validation->set_rules('phone', 'Phone', 'required|exact_length[10]');
        $this->form_validation->set_rules('group_id', 'Group', 'required');
        //$this->form_validation->set_rules('gender', 'Gender', 'required');
        //$this->form_validation->set_rules('supplier_id', 'Supplier', "");
        $this->form_validation->set_rules('active', 'Active', 'required');
        if ($this->form_validation->run() == FALSE) {
            
            $this->system_user_edit($id);
        } else {
            
            unset($_POST['repassword']);
            unset($_POST['id']);
            $ip_address = $this->input->ip_address();
            $salt = $this->ion->store_salt ? $this->salt() : FALSE;
            if (isset($_POST['password']) && $_POST['password'] != "") {
                $password = $this->ion->hash_password($_POST['password'], $salt);
                $_POST['password'] = $password;
            } else {
                unset($_POST['password']);
            }
            $_POST['ip_address'] = $ip_address;
            $result = $this->sysuser->updateSystemUser($_POST, $id);
            if ($result == true) {
                $this->session->set_flashdata('message', array('title' => 'Success.', 'content' => 'System User Updated Successfully.', 'type' => 's'));
                redirect(site_url() . 'admin/Users');
            } else {
                $this->session->set_flashdata('message', array('title' => 'Error.', 'content' => 'System User Updating Failed.', 'type' => 'e'));
                redirect(site_url() . 'admin/Users');
            }
        }
    }

    public function regx($str) {
        
        if ($str) {
            if (preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,12}$/', $str)) {
                return TRUE;
            }
            $this->form_validation->set_message('regx', 'Password must contain at least 1 uppercase character, atleast 1 digit, atleast one special character.');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function updateEmail($str) {
       if ($str) {
            if ($this->db->select('email')->get_where('system_users', array('email' => $str))->num_rows()) {
                return TRUE;
            } else {
                $this->form_validation->set_message('regx', 'Password must contain at least 1 uppercase character, atleast 1 digit, atleast one special character.');
                return FALSE;
            }
        } else {
            return TRUE;
        }
    }

    public function getSysUsersData() {
        $detail_link = anchor('admin/user_view/$1', '<i class="fa fa-file-text-o"></i> ' . 'System User Details');
        $edit_link = anchor('admin/Users-edit/$1', '<i class="fa fa-file-text-o"></i> ' . 'System User edit');
        $alloc_link = anchor('admin/Users-menu-alloc/$1', '<i class="fa fa-file-text-o"></i> ' . 'Menu Allocation');
        $delete_link = anchor('admin/System_user_controller/system_user_edit/$1', '<i class="fa fa-trash"></i> ' . 'System User Delete');
        $action = '<div class="text-center"><div class="btn-group text-left">'
                . '<button type="button" class="btn btn-default btn-xs btn-primary dropdown-toggle" data-toggle="dropdown">'
                . 'Actions' . ' <i style="color:#fff" class="fa fa-caret-down"></i></button>
		<ul class="dropdown-menu pull-right" role="menu">
			<li>' . $detail_link . '</li>
			<li>' . $edit_link . '</li>
			<li>' . $alloc_link . '</li>
			<!--<li>' . $delete_link . '</li>-->
			</ul>
		</div></div>';
        $this->load->library('datatables');
        $this->datatables
                ->select($this->db->dbprefix('system_users') . ".id as id, first_name, last_name, email, company, " . $this->db->dbprefix('groups') . ".name, active")
                ->from("system_users")
                ->join('groups', 'system_users.group_id=groups.id', 'left')
                ->group_by('system_users.id')
                ->add_column("Actions", "<center><a href='" . site_url('auth/profile/$1') . "' class='tip' title='" . lang("edit_user") . "'><i class=\"fa fa-edit\"></i></a></center>", "id");
        $this->datatables->add_column("Actions", $action, "id");
        echo $this->datatables->generate();
    }
    
    public function getGroupsData() {
        $detail_link = anchor('admin/Groups_view/$1', '<i class="fa fa-file-text-o"></i> ' . 'User Group Details');
        $edit_link = anchor('admin/Groups-edit/$1', '<i class="fa fa-file-text-o"></i> ' . 'User Group edit');
        $alloc_link = anchor('admin/Groups-menu-alloc/$1', '<i class="fa fa-file-text-o"></i> ' . 'Menu Allocation');
        //$delete_link = anchor('admin/System_user_controller/system_user_edit/$1', '<i class="fa fa-trash"></i> ' . 'System User Delete');
        $action = '<div class="text-center"><div class="btn-group text-left">'
                . '<button type="button" class="btn btn-default btn-xs btn-primary dropdown-toggle" data-toggle="dropdown">'
                . 'Actions' . ' <i style="color:#fff" class="fa fa-caret-down"></i></button>
		<ul class="dropdown-menu pull-right" role="menu">
			<li>' . $detail_link . '</li>
			<li>' . $edit_link . '</li>
			<li>' . $alloc_link . '</li>

			</ul>
		</div></div>';
        $this->load->library('datatables');
        $this->datatables
                ->select($this->db->dbprefix('groups') . ".id as id, name, description")
                ->from("groups")
                ->group_by('groups.id');
                $this->datatables->add_column("Actions", $action, "id");
        echo $this->datatables->generate();
    }
    
    public function group_menu_alloc($id){
        $this->data['menus'] = $this->site_model->getMenus();
        $this->data['group'] = $this->sysuser->getAllocMenus($id);
        $this->data['template'] = "Groups/menu_alloc";
        $this->data['id'] = $id;
        $this->data['bc'] = array(array('link' => site_url('admin'), 'page' => "Home"), array('link' => '#', 'page' => "System Group Menu Allocation"));
        $this->admin_layout($this->data);
    }

    public function delete_system_user($id) {
        $result = $this->Setting_model->delete_airport($id);
        $this->airports();

        if ($result == true) {
            $this->session->set_flashdata('message', array('title' => 'Error.', 'content' => 'Stock Record Not Deleted .', 'type' => 's'));
            redirect(base_url() . 'admin/Airport/airports');
        } else {
            $this->session->set_flashdata('message', array('title' => 'Error.', 'content' => 'Stock Record delete Succesfully .', 'type' => 'e'));
            redirect(base_url() . 'admin/Airport/airports');
        }
    }

    public function system_user_edit($id) {
        $this->data['groups'] = $this->sysuser->getGroups();
        $this->data['user'] = $this->sysuser->getUser($id);
        $this->data['id'] = $id;
        $this->data['template'] = "Users/user_edit";
        $this->data['bc'] = array(array('link' => site_url('admin'), 'page' => "Home"), array('link' => '#', 'page' => "User Edit"));
        $this->admin_layout($this->data);
    }
    // created by neeta 8-10-2016
     public function groups(){
        $this->data['template'] = "Groups/groups";
        $this->data['bc'] = array(array('link' => site_url('admin'), 'page' => "Home"), array('link' => '#', 'page' => "Groups"));
        $this->admin_layout($this->data);
    }
    
    public function group_save() {
        $this->form_validation->set_rules('name', 'Name', 'required|is_unique[groups.name]');
        
        if ($this->form_validation->run() == FALSE) {
            $this->group_add();
        } else {
           $result = $this->sysuser->saveUserGroup($_POST);
            if ($result == true) {
                $this->session->set_flashdata('message', array('title' => 'Success.', 'content' => 'User Group Added Successfully.', 'type' => 's'));
                redirect(site_url() . 'admin/Groups');
            } else {
                $this->session->set_flashdata('message', array('title' => 'Error.', 'content' => 'User Group Adding Failed.', 'type' => 'e'));
                redirect(site_url() . 'admin/Groups');
            }
        }
    }
    public function group_add() {
        $this->data['parent'] = $this->sysuser->getAdminMenus();
        $this->data['template'] = "Groups/group_add";
        $this->data['bc'] = array(array('link' => site_url('admin'), 'page' => "Home"), array('link' => '#', 'page' => "Group Add"));
        $this->admin_layout($this->data);
    }
    public function group_view($id) {
        $i=array('id'=>$id);
        $this->data['data_update'] = $this->sysuser->view($i, 'groups');
        $this->data['template'] = "Groups/view";
        $this->data['bc'] = array(array('link' => site_url('admin'), 'page' => "Home"), array('link' => '#', 'page' => "Group_view"));
        $this->admin_layout($this->data);
    }
    public function group_edit($id) {
        $this->data['groups'] = $this->sysuser->getGroupsAllDetails($id);
        $this->data['user'] = $this->sysuser->getUser($id);
        $this->data['id'] = $id;
        $this->data['template'] = "Groups/group_edit";
        $this->data['bc'] = array(array('link' => site_url('admin'), 'page' => "Home"), array('link' => '#', 'page' => "Group_Edit"));
        $this->admin_layout($this->data);
    }
     public function group_update($id) {
        $this->form_validation->set_rules('name', 'Name', 'required');
       if ($this->form_validation->run() == FALSE) {
            
            $this->group_edit($id);
        } else {
            
            unset($_POST['id']);
            $result = $this->sysuser->updateUserGroup($_POST, $id);
            if ($result == true) {
                $this->session->set_flashdata('message', array('title' => 'Success.', 'content' => 'User Group Updated Successfully.', 'type' => 's'));
                redirect(site_url() . 'admin/Groups');
            } else {
                $this->session->set_flashdata('message', array('title' => 'Error.', 'content' => 'User Group Updating Failed.', 'type' => 'e'));
                redirect(site_url() . 'admin/Groups');
            }
        }
    }

//<-------------System User start-------------------------------------->
//<-------------Menu start-------------------------------------->
    public function menus() {
        $this->data['template'] = "Menus/menus";
        $this->data['bc'] = array(array('link' => site_url('admin'), 'page' => "Home"), array('link' => '#', 'page' => "Menus"));
        $this->admin_layout($this->data);
    }

    public function menus_add() {
        $this->data['parent'] = $this->sysuser->getAdminMenus();
        $this->data['template'] = "Menus/menus_add";
        $this->data['bc'] = array(array('link' => site_url('admin'), 'page' => "Home"), array('link' => '#', 'page' => "Menus Add"));
        $this->admin_layout($this->data);
    }

    public function menus_save() {
        $this->form_validation->set_rules('name', 'Name', 'required|is_unique[admin_menu.name]');
        $this->form_validation->set_rules('url', 'URL', 'required');
        $this->form_validation->set_rules('icon', 'Icon', 'required');
        $this->form_validation->set_rules('parent_id', 'Parent Menu', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->menus_add();
        } else {
            $_POST['create_date'] = date('Y-m-d h:i:s');
            $_POST['created_by'] = $this->session->userdata('user_id');
            $result = $this->sysuser->saveMenu($_POST);
            if ($result == true) {
                $this->session->set_flashdata('message', array('title' => 'Success.', 'content' => 'Menu Added Successfully.', 'type' => 's'));
                redirect(site_url() . 'admin/Menus');
            } else {
                $this->session->set_flashdata('message', array('title' => 'Error.', 'content' => 'Menu Adding Failed.', 'type' => 'e'));
                redirect(site_url() . 'admin/Menus');
            }
        }
    }

    public function menus_update($id) {
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('url', 'URL', 'required');
        $this->form_validation->set_rules('icon', 'Icon', 'required');
        $this->form_validation->set_rules('parent_id', 'Parent Menu', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->menus_edit($id);
        } else {
            unset($_POST['id']);
            $result = $this->sysuser->updateAdminMenu($_POST, $id);
            if ($result == true) {
                $this->session->set_flashdata('message', array('title' => 'Success.', 'content' => 'Menu Updated Successfully.', 'type' => 's'));
                redirect(site_url() . 'admin/Menus');
            } else {
                $this->session->set_flashdata('message', array('title' => 'Error.', 'content' => 'Menu Updating Failed.', 'type' => 'e'));
                redirect(site_url() . 'admin/Menus');
            }
        }
    }

    public function getMenusData() {
       
        $detail_link = anchor('forms/view/$1', '<i class="fa fa-file-text-o"></i> ' . 'Menu Details');
        $edit_link = anchor('admin/Menus-edit/$1', '<i class="fa fa-file-text-o"></i> ' . 'Menu edit');
        $delete_link = anchor('admin/System_user_controller/system_user_edit/$1', '<i class="fa fa-trash"></i> ' . 'Menu Delete');
        $action = '<div class="text-center"><div class="btn-group text-left">'
                . '<button type="button" class="btn btn-default btn-xs btn-primary dropdown-toggle" data-toggle="dropdown">'
                . 'Actions' . ' <i style="color:#fff" class="fa fa-caret-down"></i></button>
		<ul class="dropdown-menu pull-right" role="menu">
			<!--<li>' . $detail_link . '</li>-->
			<li>' . $edit_link . '</li>
			<!--<li>' . $delete_link . '</li>-->
			</ul>
		</div></div>';
       
        $this->load->library('datatables');
        $a = $this->db->dbprefix('admin_menu');
        $this->datatables
                ->select("$a.id,$a.name,$a.url,$a.icon,p.name as parent_name,$a.status", false)
                ->from("admin_menu")
                ->join("admin_menu p", "admin_menu.parent_id=p.id", "left");
        $this->datatables->add_column("Actions", $action, "$a.id");
        echo $this->datatables->generate();
    }

    public function delete_menus($id) {
        $result = $this->Setting_model->delete_airport($id);
        $this->airports();

        if ($result == true) {
            $this->session->set_flashdata('message', array('title' => 'Error.', 'content' => 'Stock Record Not Deleted .', 'type' => 's'));
            redirect(base_url() . 'admin/Airport/airports');
        } else {
            $this->session->set_flashdata('message', array('title' => 'Error.', 'content' => 'Stock Record delete Succesfully .', 'type' => 'e'));
            redirect(base_url() . 'admin/Airport/airports');
        }
    }

    public function menus_edit($id) {
        $this->data['parent'] = $this->sysuser->getAdminMenus();
        $this->data['menu'] = $this->sysuser->getAdminMenu($id);
        $this->data['id'] = $id;
        $this->data['template'] = "Menus/menus_edit";
        $this->data['bc'] = array(array('link' => site_url('admin'), 'page' => "Home"), array('link' => '#', 'page' => "Menu Edit"));
        $this->admin_layout($this->data);
    }
    
//<-------------Menu start-------------------------------------->
    
    //puja 28-09 1.57
    
        public function user_view($id) {
        $i=array('id'=>$id);
        $this->data['data_update'] = $this->sysuser->view($i, 'system_users');
        $this->data['template'] = "Users/view";
        $this->data['bc'] = array(array('link' => site_url('admin'), 'page' => "Home"), array('link' => '#', 'page' => "User_view"));
        $this->admin_layout($this->data);
    }
    
    public function company_details(){
        $user_id = $this->session->userdata('user_id');
        $this->data['recruiterData'] = $this->sysuser->getUser($user_id);
        
        $this->data['template'] = "Company/company_details";
        $this->data['bc'] = array(array('link' => site_url('admin'), 'page' => "Home"), array('link' => '#', 'page' => "Company Details"));
        $this->admin_layout($this->data);
    }
     public function company(){
        $this->data['template'] = "Company/company";
        $this->data['bc'] = array(array('link' => site_url('admin'), 'page' => "Home"), array('link' => '#', 'page' => "Company Details"));
        $this->admin_layout($this->data);
    }
    public function getCompanyData(){
        $user_id = $this->session->userdata('user_id');
        $detail_link = anchor('admin/Company-view/$1', '<i class="fa fa-file-text-o"></i> ' . 'Company Details');
        $edit_link = anchor('admin/Company-edit/$1', '<i class="fa fa-file-text-o"></i> ' . 'Company edit');
        $action = '<div class="text-center"><div class="btn-group text-left">'
                . '<button type="button" class="btn btn-default btn-xs btn-primary dropdown-toggle" data-toggle="dropdown">'
                . 'Actions' . ' <i style="color:#fff" class="fa fa-caret-down"></i></button>
		<ul class="dropdown-menu pull-right" role="menu">
			<li>' . $detail_link . '</li>
                        <li>' . $edit_link . '</li>
			
			</ul>
		</div></div>';
        $this->load->library('datatables');
        $this->datatables
                ->select($this->db->dbprefix('system_users') . ".id as id,company, website, location, email ,no_of_employee, active")
                ->from("system_users")
                ->where("system_users.id =".$user_id)
                ->where("system_users.group_id =2")
                ->group_by('system_users.id')
                ->add_column("Actions", "<center><a href='" . site_url('auth/profile/$1') . "' class='tip' title='" . lang("edit_user") . "'><i class=\"fa fa-edit\"></i></a></center>", "id");
        $this->datatables->add_column("Actions", $action, "id");
        echo $this->datatables->generate();
        
    }
    public function company_edit($id){
        $this->data['id'] = $id;
        $user_id = $this->session->userdata('user_id');
        $this->data['companyData'] = $this->sysuser->getUser($user_id);
        $this->data['template'] = "Company/company_edit";
        $this->data['bc'] = array(array('link' => site_url('admin'), 'page' => "Home"), array('link' => '#', 'page' => "Menu Edit"));
        $this->admin_layout($this->data);
    }
    
    
    public function company_update($id){
        $this->form_validation->set_rules('first_name', 'First Name', 'required');
        $this->form_validation->set_rules('last_name', 'Last Name', 'required');
        $this->form_validation->set_rules('email', 'Email_Id', 'required|valid_email|callback_updateEmail');
        $this->form_validation->set_rules('company', 'Company Name', 'required');
        $this->form_validation->set_rules('phone', 'Phone', 'required|exact_length[10]');
        $this->form_validation->set_rules('no_of_employee', 'No of Employee', 'required');
        $this->form_validation->set_rules('website', 'Website', 'required');
        $this->form_validation->set_rules('location', 'Location', 'required');
        
        if ($this->form_validation->run() == FALSE) {
            $this->company_edit($id);
        } else {
            unset($_POST['id']);
            $result = $this->sysuser->updateSystemUser($_POST, $id);
            if ($result == true) {
                $this->session->set_flashdata('message', array('title' => 'Success.', 'content' => 'Company Details Updated Successfully.', 'type' => 's'));
                redirect(site_url() . 'admin/Company');
            } else {
                $this->session->set_flashdata('message', array('title' => 'Error.', 'content' => 'Company Details Updating Failed.', 'type' => 'e'));
                redirect(site_url() . 'admin/Company');
            }
        }
    }
    public function create_job(){
        $this->data['template'] = "Job/create_job";
        $this->data['bc'] = array(array('link' => site_url('admin'), 'page' => "Home"), array('link' => '#', 'page' => "Create Job"));
        $this->admin_layout($this->data);
    }
    public function job(){
        $this->data['template'] = "Job/job";
        $this->data['bc'] = array(array('link' => site_url('admin'), 'page' => "Home"), array('link' => '#', 'page' => "Create Job"));
        $this->admin_layout($this->data);
    }
    
     public function job_save() {
        
        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('location', 'Location', 'required');
        $this->form_validation->set_rules('work_description', 'work description', 'required');
        $this->form_validation->set_rules('graduation_year', 'Graduation Year of Student', 'required');
        //$this->form_validation->set_rules('branch', 'Graduation Branch of Student', 'required');
        $this->form_validation->set_rules('college_CGPA', 'College CGPA', 'required');
        $this->form_validation->set_rules('twelth_percentage', '12th Percentage', 'required');
        $this->form_validation->set_rules('tenth_percentage', '10th Percentage', 'required');
        $this->form_validation->set_rules('cost_to_company', 'Cost to Company', 'required');
        $this->form_validation->set_rules('bond', 'Bond', 'required');
        $this->form_validation->set_rules('expected_doj', 'Expected DOJ', 'required');
        $this->form_validation->set_rules('active', 'Status', 'required');
        $_POST['bond'] = (isset($_POST['bond'])) ? 1 : 0;
        
        
        if($_POST['bond'] == 1){
            $this->form_validation->set_rules('bond_lengh', 'bond lengh', 'required');
            $this->form_validation->set_rules('bond_value', 'bond value', 'required');
        }
        
        if ($this->form_validation->run() == FALSE) {
            $this->create_job();
        } else {
            $_POST['graduation_branch'] = implode(", ",$_POST['branch']);
             unset($_POST['branch']);
            $_POST['create_date'] = date('Y-m-d h:i:s');
            $_POST['created_by'] = $this->session->userdata('user_id');
            $result = $this->sysuser->saveJob($_POST);
            if ($result == true) {
                $this->session->set_flashdata('message', array('title' => 'Success.', 'content' => 'Job Added Successfully.', 'type' => 's'));
                redirect(site_url() . 'admin/Job/job');
            } else {
                $this->session->set_flashdata('message', array('title' => 'Error.', 'content' => 'Job Adding Failed.', 'type' => 'e'));
                redirect(site_url() . 'admin/Job/job');
            }
        }
    }
    
    public function group_menu_alloc_save($id) {
        $result = $this->sysuser->saveSystemGroupMenuAlloc($_POST);
        if ($result == true) {
            $this->session->set_flashdata('message', array('title' => 'Success.', 'content' => 'System Group Menu Allocation Successfully.', 'type' => 's'));
            redirect(site_url() . 'admin/Groups');
        } else {
            $this->session->set_flashdata('message', array('title' => 'Error.', 'content' => 'System Group Menu Allocation Failed.', 'type' => 'e'));
            redirect(site_url() . 'admin/Groups');
        }
    }
    
    public function getJobs(){
        $user_id = $this->session->userdata('user_id');
        $detail_link = anchor('admin/Job/Job-view/$1', '<i class="fa fa-file-text-o"></i> ' . 'Job Details');
        $edit_link = anchor('admin/Job/Job-edit/$1', '<i class="fa fa-file-text-o"></i> ' . 'Job edit');
        $action = '<div class="text-center"><div class="btn-group text-left">'
                . '<button type="button" class="btn btn-default btn-xs btn-primary dropdown-toggle" data-toggle="dropdown">'
                . 'Actions' . ' <i style="color:#fff" class="fa fa-caret-down"></i></button>
		<ul class="dropdown-menu pull-right" role="menu">
			<li>' . $detail_link . '</li>
                        <li>' . $edit_link . '</li>
			
			</ul>
		</div></div>';
        $this->load->library('datatables');
        $this->datatables
                ->select($this->db->dbprefix('rs_job') . ".id as id,title,location, expected_doj, active")
                ->from("rs_job")
                ->where("rs_job.created_by =".$user_id)
                ->group_by('rs_job.id')
                ->add_column("Actions", "<center><a href='" . site_url('auth/profile/$1') . "' class='tip' title='" . lang("edit_user") . "'><i class=\"fa fa-edit\"></i></a></center>", "id");
        $this->datatables->add_column("Actions", $action, "id");
        echo $this->datatables->generate();
        
    }
    public function job_edit($id){
        $this->data['id'] = $id;
        $user_id = $this->session->userdata('user_id');
        $this->data['jobData'] = $this->sysuser->getJobDetails($id);
        
        $this->data['template'] = "Job/job_edit";
        $this->data['bc'] = array(array('link' => site_url('admin'), 'page' => "Home"), array('link' => '#', 'page' => "Job Deails Edit"));
        $this->admin_layout($this->data);
    }
    public function job_update($id){
        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('location', 'Location', 'required');
        $this->form_validation->set_rules('work_description', 'work description', 'required');
        $this->form_validation->set_rules('graduation_year', 'Graduation Year of Student', 'required');
        $this->form_validation->set_rules('college_CGPA', 'College CGPA', 'required');
        $this->form_validation->set_rules('twelth_percentage', '12th Percentage', 'required');
        $this->form_validation->set_rules('tenth_percentage', '10th Percentage', 'required');
        $this->form_validation->set_rules('cost_to_company', 'Cost to Company', 'required');
        $this->form_validation->set_rules('bond', 'Bond', 'required');
        $this->form_validation->set_rules('expected_doj', 'Expected DOJ', 'required');
        $this->form_validation->set_rules('active', 'Status', 'required');
        $_POST['bond'] = (isset($_POST['bond'])) ? 1 : 0;
        
        
        if($_POST['bond'] == 1){
            $this->form_validation->set_rules('bond_lengh', 'bond lengh', 'required');
            $this->form_validation->set_rules('bond_value', 'bond value', 'required');
        }
        
        if ($this->form_validation->run() == FALSE) {
            $this->job_edit($id);
        } else {
            $_POST['graduation_branch'] = implode(", ",$_POST['branch']);
            unset($_POST['branch']);
            unset($_POST['id']);
            $result = $this->sysuser->updateJob($_POST, $id);
            if ($result == true) {
                $this->session->set_flashdata('message', array('title' => 'Success.', 'content' => 'Job Details Updated Successfully.', 'type' => 's'));
                redirect(site_url() . 'admin/Job/job');
            } else {
                $this->session->set_flashdata('message', array('title' => 'Error.', 'content' => 'Job Details Updating Failed.', 'type' => 'e'));
                redirect(site_url() . 'admin/Job/job');
            }
        }
    }
    
    public function job_details($id){
        $user_id = $this->session->userdata('user_id');
        $this->data['jobData'] = $this->sysuser->getJobDetails($id);
        
        $this->data['template'] = "job/job_details";
        $this->data['bc'] = array(array('link' => site_url('admin'), 'page' => "Home"), array('link' => '#', 'page' => "Job Details"));
        $this->admin_layout($this->data);
    }
    
    public function question_type(){
        $this->data['template'] = "QuestionType/qtype_list";
        $this->data['bc'] = array(array('link' => site_url('admin'), 'page' => "Home"), array('link' => '#', 'page' => "Add Question Type"));
        $this->admin_layout($this->data);
    }
    
    public function getQuestionType(){
        $detail_link = anchor('admin/Qtype-view/$1', '<i class="fa fa-file-text-o"></i> ' . 'Question Type Details');
        $edit_link = anchor('admin/Qtype-edit/$1', '<i class="fa fa-file-text-o"></i> ' . 'Question Type edit');
        $action = '<div class="text-center"><div class="btn-group text-left">'
                . '<button type="button" class="btn btn-default btn-xs btn-primary dropdown-toggle" data-toggle="dropdown">'
                . 'Actions' . ' <i style="color:#fff" class="fa fa-caret-down"></i></button>
		<ul class="dropdown-menu pull-right" role="menu">
			<li>' . $detail_link . '</li>
                        <li>' . $edit_link . '</li>
			
			</ul>
		</div></div>';
        $this->load->library('datatables');
        $this->datatables
                ->select($this->db->dbprefix('rs_qtype_31052015') . ".id as id,type")
                ->from("rs_qtype_31052015")
                ->group_by('rs_qtype_31052015.id')
                ->add_column("Actions", "<center><a href='" . site_url('auth/profile/$1') . "' class='tip' title='" . lang("edit_user") . "'><i class=\"fa fa-edit\"></i></a></center>", "id");
        $this->datatables->add_column("Actions", $action, "id");
        echo $this->datatables->generate();
        
    }
    
    public function questionType_add(){
        $this->data['template'] = "QuestionType/qtype_add";
        $this->data['bc'] = array(array('link' => site_url('admin'), 'page' => "Home"), array('link' => '#', 'page' => "Add Question Type"));
        $this->admin_layout($this->data);
    }
    
    public function questionType_save() {
        $this->form_validation->set_rules('type', 'Type', 'required|is_unique[rs_qtype_31052015.type]');
        if ($this->form_validation->run() == FALSE) {
            $this->questionType_add();
        } else {
            $result = $this->sysuser->saveQuestionType($_POST);
            if ($result == true) {
                $this->session->set_flashdata('message', array('title' => 'Success.', 'content' => 'Question Type Added Successfully.', 'type' => 's'));
                redirect(site_url() . 'admin/Qtype');
            } else {
                $this->session->set_flashdata('message', array('title' => 'Error.', 'content' => 'Question Type Failed.', 'type' => 'e'));
                redirect(site_url() . 'admin/Qtype');
            }
        }
    }
    
    public function questionType_edit($id){
        $this->data['id'] = $id;
        $this->data['qtype'] = $this->sysuser->getQuestionTypeDetails($id);
        
        $this->data['template'] = "QuestionType/qtype_edit";
        $this->data['bc'] = array(array('link' => site_url('admin'), 'page' => "Home"), array('link' => '#', 'page' => "Question Type Edit"));
        $this->admin_layout($this->data);
    }
    
    public function questionType_update($id){
        $this->form_validation->set_rules('type', 'Type', 'required');
        
        
        if ($this->form_validation->run() == FALSE) {
            $this->questionType_edit($id);
        } else {
            
            unset($_POST['id']);
            $result = $this->sysuser->updateQuestionType($_POST, $id);
            if ($result == true) {
                $this->session->set_flashdata('message', array('title' => 'Success.', 'content' => 'Question Type Updated Successfully.', 'type' => 's'));
                redirect(site_url() . 'admin/Qtype');
            } else {
                $this->session->set_flashdata('message', array('title' => 'Error.', 'content' => 'Question Type Updating Failed.', 'type' => 'e'));
                redirect(site_url() . 'admin/Qtype');
            }
        }
    }
    
    public function questionType_details($id){
        $this->data['qtype'] = $this->sysuser->getQuestionTypeDetails($id);
        
        $this->data['template'] = "QuestionType/qtype_view";
        $this->data['bc'] = array(array('link' => site_url('admin'), 'page' => "Home"), array('link' => '#', 'page' => "Job Details"));
        $this->admin_layout($this->data);
    }
    
    public function rank(){
        $this->data['template'] = "Rank/stud_rank";
         $this->data['subject'] = $this->sysuser->getSubject();
        $this->data['bc'] = array(array('link' => site_url('admin'), 'page' => "Home"), array('link' => '#', 'page' => "Student Rank"));
        $this->admin_layout($this->data);
    }
    public function show_rank(){
        
        if ($_REQUEST['domain'] == 'global') {
            $uid_data = $this->site->getAllUID();
        } else {
            $friends_data_arr = $this->site->getFriendsAndRequests();
            $uid_data = json_decode($friends_data_arr['F_UID']);
        }
        $std_obj_marks = (array) $this->site->getRespectiveMarksArr($_REQUEST['type']);

        $marks = array();
        foreach ($std_obj_marks as $key1 => $val1) {
            $marks[$key1] = (array) $val1;
        }
        
        $subid = $_REQUEST['subid'];
        $filtered_uid_arr = array();
        $data2sort = array();
        foreach ($marks as $temp_uid => $data) {
            //echo $temp_uid;
           $temp_data = null;
            $temp_data = (array) $data;
            foreach ($temp_data as $key => $val) {
                if ($key == $subid) {
                    $data2sort[$temp_uid] = $temp_data[$subid];
                    $filtered_uid_arr[] = $temp_uid; //fileterd for the particular subject
                }
            }
        }
        array_multisort($data2sort, SORT_DESC, $filtered_uid_arr);
        $rank_limit = 10; //ranks to dispaly
        $current_rank = 1; //rank start from 1
        $arr_count = count($filtered_uid_arr);
        $last_marks = -100; //just a start
        
        
        //new 
        if ($arr_count != 0) {
            for ($i = 0; $i < $arr_count; $i++) {
                //get student name from id
                $userName[] = $this->sysuser->getUserNameById($filtered_uid_arr[$i]);
                //get 10 and 12 th marks
                $acadamicsjsonArr[] = $this->sysuser->getAcadamicsInfo($filtered_uid_arr[$i]);
            }
        }
       
        $acadamicsArr =array();
        if(isset($acadamicsjsonArr) && !empty($acadamicsjsonArr)){
            foreach($acadamicsjsonArr as $value){
                $acadamicsArr[] = (array)json_decode($value[0]->academics);
            }
        }
       
        //get 10 th and 12th marks
        $marks = array();
        if(isset($acadamicsArr) && !empty($acadamicsArr)){
            foreach($acadamicsArr as $key=>$value){

                $marks['twelth'][] = $value[14];
                $marks['tenth'][] = $value[16];
            }
        }
        //get subject name
        $subjectName= $this->sysuser->getSubNameById($subid);
        
       
        $this->data['template'] = "Rank/rank_table";
        $this->data['subjectName'] = $subjectName;
        $this->data['marks'] = $marks;
        $this->data['userName'] = $userName;
        $this->data['filtered_uid_arr'] = $filtered_uid_arr;
        
        $this->data['data2sort'] = $data2sort;
        $this->data['rank_limit'] = $rank_limit;
        $this->data['current_rank'] = $current_rank;
        $this->data['arr_count'] = $arr_count;
        $this->data['last_marks'] = $last_marks;
        //echo json_encode($this->data);
        //$this->data['dataArray'] = array("subjectName"=>$subjectName,"marks"=>$marks,"userName"=>$userName);
        /*$this->data['bc'] = array(array('link' => site_url('admin'), 'page' => "Home"), array('link' => '#', 'page' => "Student Rank"));
        $this->admin_layout($this->data);*/
        $html = '';
        if ($arr_count != 0) {
            for ($i = 0; $i < $arr_count; $i++) {
                if ($current_rank > $rank_limit) {
                    break;
                } else {
                    $current_user = $filtered_uid_arr[$i];
                    $f_d_fetch = $this->site->getUserInfo($current_user);

                    //for the rowspan value we can check in data2sort array that how many of such marks entries are present for that subject 
                    if ($last_marks != $data2sort[$current_user]) {
                        $last_marks = $data2sort[$current_user];

                            $html ='<tr>';
                            $html = $html.'<td style="text-align: center;"><input name="select" value="1" type="checkbox"/></td>';
                            $html = $html.'<td style="text-align: center;">'.$current_rank.'</td>';
                            $html = $html.'<td>'.$userName[$i][0]->UID_FirstName. ' '.$userName[$i][0]->UID_LastName.' </td>';
                            $html = $html.'<td>'.$marks['tenth'][$i].'</td>';
                            $html = $html.'<td>'.$marks['twelth'][$i].'</td>';
                            $html = $html.'<td>'.$subjectName[0]->sub_name.'</td>';
                            $html = $html.'<td><button type="button" class="btn btn-default">View Profile</button></td></tr>';
                            
                                           
                    $current_rank++;
                } else {
                   
                        $html ='<tr>';
                        $html = $html.'<td style="text-align: center;"><input name="select" value="1" type="checkbox"/></td>';
                        $html = $html.'<td style="text-align: center;">'.$current_rank.'</td>';
                        $html = $html.'<td>'.$userName[$i][0]->UID_FirstName.' '.$userName[$i][0]->UID_LastName.'</td>';
                        $html = $html.'<td>'.$marks['tenth'][$i].'</td>';
                        $html = $html.'<td>'.$marks['twelth'][$i].'</td>';
                        $html = $html.'<td>'.$subjectName[0]->sub_name.'</td>';
                        $html = $html.'<td><button type="button" class="btn btn-default">View Profile</button></td> </tr>';
                       
                                            
                }
            }
        }
    } else {
       
        $html = $html.'<tr><td colspan="7">Ranks not calculated yet.</td></tr>';
       
    }
    echo $html;
        //end
    }
    
}
