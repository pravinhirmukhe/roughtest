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
        //$alloc_link = anchor('admin/Users-menu-alloc/$1', '<i class="fa fa-file-text-o"></i> ' . 'Menu Allocation');
        //$delete_link = anchor('admin/System_user_controller/system_user_edit/$1', '<i class="fa fa-trash"></i> ' . 'System User Delete');
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
                ->select($this->db->dbprefix('groups') . ".id as id, name, description")
                ->from("groups")
                ->group_by('groups.id');
                $this->datatables->add_column("Actions", $action, "id");
        echo $this->datatables->generate();
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
}