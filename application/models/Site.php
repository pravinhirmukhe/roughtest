<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Site
 *
 * @author Pravinkumar
 */
class Site extends MY_Model {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('Ion_auth_model', 'ion');
    }

   

    public function getCustCount() {
        $this->db->select('count(id) as c');
        return $this->db->get('register')->row()->c;
    }

    
    function getsite() {
        $this->db->select('*');
        $this->db->from('site');
        $query = $this->db->get();
        return $query->row();
    }

   


    public function getUserData() {
        $this->db->select('*')
                ->from('users u');
        if ($this->session->userdata('group_id') != 1) {
            $this->db->join('supplier s', 'u.supplier_id=s.supplier_id', 'left');
        }
        $this->db->where('u.id', $this->session->userdata('userid'));
        $this->db->or_where('u.id', $this->session->userdata('user_id'));
        return $this->db->get()->row();
    }

   

    public function setStatus($key, $id, $table) {
        $status1 = $this->db->select('status')->from($table)->where($key, $id)->get()->row()->status;
        $status = ($status1 == 'Active') ? 'Deactive' : 'Active';
        $r = $this->db->update($table, array('status' => $status), array($key => $id));
        return $r;
    }

    public function setVStatus($key, $id, $table) {
        $this->db->trans_start();
        $status1 = $this->db->select('status')->from($table)->where($key, $id)->get()->row()->status;
        $status = ($status1 == 'Active') ? 'Deactive' : 'Active';
        $active1 = $this->db->select('active')->from('users')->where('supplier_id', $id)->get()->row()->active;
        $active = ($active1 == '1') ? '0' : '1';
        $r = $this->db->update($table, array('status' => $status), array($key => $id));
        $r = $this->db->update('users', array('active' => $active), array('supplier_id' => $id));
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return FALSE;
        } else {
            $this->db->trans_commit();
            return TRUE;
        }
    }

    public function setOpenStatus($key, $id, $table) {
        $status1 = $this->db->select('open_status')->from($table)->where($key, $id)->get()->row()->open_status;
        $status = ($status1 == 'Open') ? 'Close' : 'Open';
        $r = $this->db->update($table, array('open_status' => $status), array($key => $id));
        return $r;
    }

    public function setUStatus($key, $id, $table) {
        $status1 = $this->db->select('active')->from($table)->where($key, $id)->get()->row()->active;
        $status = ($status1 == 1) ? 0 : 1;
        $r = $this->db->update($table, array('active' => $status), array($key => $id));
        return $r;
    }

    public function bulkDelete($key, $id, $table) {
        foreach ($id as $i) {
            $r = $this->db->delete($table, array($key => $i));
        }
        return $r;
    }

    public function getMenus() {
        $rss = array();
        $usz = array();
        if ($this->session->userdata('group_id') != 1) {
            $us = $this->db->select('menu_ids')->get_where('menu_alloc', array('admin_id' => $this->session->userdata('user_id')))->row();
            $usx = json_decode($us->menu_ids, true);
            foreach ($usx as $u) {
                $i = explode(":", $u);
                $usz[] = $i[1];
            }
        }
        $this->db->where('parent_id', 0);
        if (!empty($usz)) {
            $this->db->where_in('id', $usz);
        }
        $rs = $this->db->get('admin_menu')->result();
        $i = 0;
        foreach ($rs as $r) {
            $rss[$i] = $r;
            $this->db->where('parent_id', $r->id);
            if (!empty($usz)) {
                $this->db->where_in('id', $usz);
            }
            $rss[$i++]->nodes = $this->db->get('admin_menu')->result();
        }
        return $rss;
    }

    public function getAllocMenus($id) {
        $rss = $this->db->get_where('menu_alloc', array('admin_id' => $id))->row();
        return $rss;
    }

//------rajkumar code start--------------

    /**
     * Author: rajkumar 
     * registerUser 
     * @param type $data
     * @return boolean
     */
    public function registerUser($data) {
        $this->db->trans_start();
        $data = array(
            'fname' => $this->input->post('fname'),
            'lname' => $this->input->post('lname'),
            'mobile' => $this->input->post('mobile'),
            'email' => $this->input->post('email'),
            'username' => $this->input->post('email'),
            'pass' => $this->input->post('pass'),
            'ip_address' => $this->input->ip_address(),
            'create_date' => date('Y-m-d h:i:s', now()),
            'status' => 'Active',
        );

        $this->db->insert('register', $data);
        $id = $this->db->insert_id();
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
//            return FALSE;
            return array('s' => 0, 'res' => "");
        } else {
            $this->db->trans_commit();
//            return TRUE;
            return array('s' => 1, 'res' => $this->db->get_where('register', array('id' => $id))->row());
        }
    }

    public function validatelogin() {
        $this->db->select('*');
        $this->db->from('register');
        $this->db->where('email', $this->input->post('emailid'));
        $this->db->where('pass', $this->input->post('passwd'));
        $this->db->where('status', 'Active');
        $rs = $this->db->get();


        if ($rs->num_rows() > 0) {
            foreach ($rs->result() as $r) :
                $this->session->set_userdata(array('logged_in' => true));
                $this->session->set_userdata(array('userid' => $r->id));
                $this->session->set_userdata(array('fname' => $r->fname));
                $this->session->set_userdata(array('lname' => $r->lname));
                $this->session->set_userdata(array('email' => $r->email));
            endforeach;
            return true;
        }
        else {
            return false;
        }
    }

    function getCountry() {

        $this->db->select('id,name');
        $this->db->from('country');
        $query = $this->db->get();
        return $query->result();
    }

    function getGender() {
        $this->db->select('id,name');
        $this->db->from('gender');
        $query = $this->db->get();
        return $query->result();
    }

    function getCity($id) {
        $this->db->select('id,name');
        $this->db->from('city');
        $this->db->where('state_id', $id);
        $query = $this->db->get();
        return $query->result();
    }

    function getProfile() {
        $this->db->select('*');
        $this->db->from('register');
//        $this->db->where('id', 1);
        $this->db->where('id', $this->session->userdata('userid'));
        $query = $this->db->get()->row();
        return $query;
    }

    function forgetPassword($data) {
        $this->db->select('*');
        $this->db->from('register');
        $this->db->where('email', $data);
        $this->db->where('status', 'Active');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function resetPassword($data) {
        $this->db->trans_start();
        $this->load->helper('string');
        $password = random_string('alnum', 8);
        $this->db->where('email', $data);
        $this->db->update('register', array('pass' => $password));
        $this->load->library('email');
        $this->email->from('flybue@gmail.com', 'Flybuy');
        $this->email->to($data);
        $this->email->subject('Password reset');
        $this->email->message('You have requested the new password, Here is your new password:' . $password);
        $this->email->send();
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return FALSE;
        } else {
            $this->db->trans_commit();
            return TRUE;
        }
    }

    function getAddress() {
//        $this->db->select('a.address_id,a.fname, a.lname, a.company_name, a.address,ct.name as city,s.name as state,c.name as country,a.zipcode,a.default_address')
        $this->db->select('*')
                ->from('address a')
                ->join('country c', 'c.id = a.country_id')
                ->join('state s', 's.country_id = c.id')
                ->join('city ct', 'ct.state_id = s.id');
//        $this->db->where('a.cust_id', 1);
        $this->db->where('a.cust_id', $this->session->userdata('userid'));
        $this->db->where('a.status', 'Active');
        $rs = $this->db->get()->result();
        return $rs;
//        echo $this->db->last_query(); exit;
    }

    function SetDefault_Address($id) {
        $dataNo = array(
            'default_address' => 'No',
        );
        $this->db->where('cust_id', $this->session->userdata('userid'));
        $this->db->update('address', $dataNo);
        $data = array(
            'default_address' => 'Yes',
        );
        $this->db->where('address_id', $id);
        $this->db->where('cust_id', $this->session->userdata('userid'));
        $this->db->update('address', $data);
    }

    function checkpassword($pass) {
        $this->db->select('pass');
        $this->db->from('register');
        $this->db->where('pass', $pass['oldpass']);
        $this->db->where('id', $this->session->userdata('userid'));
        $query = $this->db->get()->row();
        return $query;
    }

    public function savepassword($data) {
        $this->db->trans_start();
        $data = array(
            'pass' => $this->input->post('pass'),
            'create_date' => date('Y-m-d h:i:s', now()),
        );
        $this->db->where('id', $this->session->userdata('userid'));
        $this->db->update('register', $data);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return FALSE;
        } else {
            $this->db->trans_commit();
            return TRUE;
        }
    }

    public function saveprofile($data) {
        $this->db->trans_start();
        $config['upload_path'] = './assets/images/Profile';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size'] = 5000;
        $config['max_width'] = 3000;
        $config['max_height'] = 2000;
        $this->load->library('upload');
        $this->upload->initialize($config);
        $this->upload->do_upload($data['profile_pic']);
        $upload_data = $this->upload->data();
        $file_name = $upload_data['file_name'];
        $data['create_date'] = date('Y-m-d h:i:s', now());
        if ($file_name != '') {
            $data['profile_pic'] = $file_name;
        }
        $this->db->where('id', $this->session->userdata('userid'));
        $this->db->update('register', $data);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return FALSE;
        } else {
            $this->db->trans_commit();
            return TRUE;
        }
    }

    public function vendorRegistration($data) {
        $this->db->trans_start();
        $config['upload_path'] = './assets/admin/images/Supplierlogo';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size'] = 5000;
        $config['max_width'] = 3000;
        $config['max_height'] = 2000;
        $this->load->library('upload');
        $this->upload->initialize($config);
        $this->upload->do_upload('logo');
        $error = array('error' => $this->upload->display_errors());
        $upload_data = $this->upload->data();
        $file_name = $upload_data['file_name'];
        $data['create_date'] = date('Y-m-d h:i:s', now());
        if ($file_name != '') {
            $data['logo'] = $file_name;
        }
        
        $data['status'] = 'Deactive';
        unset($data['password']);
        $this->db->insert('supplier', $data);
        $sup_Id = $this->db->insert_id();
//        $this->load->helper('string');
//        $passwod = random_string('alnum', 8);
        $salt = $this->ion->store_salt ? $this->salt() : FALSE;
        $password = $this->ion->hash_password($_POST['password'], $salt);
        $user_data = array(
            'company' => $this->input->post('company_name'),
            'first_name' => $this->input->post('fname'),
            'last_name' => $this->input->post('lname'),
            'username' => $this->input->post('email'),
            'password' => $password,
            'activation_code' => $_POST['password'],
            'email' => $this->input->post('email'),
            'phone' => $this->input->post('mobile'),
            'group_id' => '2',
            'active' => 0,
            'supplier_id' => $sup_Id,
            'ip_address' => $this->input->ip_address(),
            'created_on' => date('Y-m-d h:i:s', now()),
        );

        $this->db->insert('users', $user_data);
        $ship = $this->db->insert_id();

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
//            return FALSE;
            return array('s' => 0, 'res' => "");
        } else {
            $this->db->trans_commit();
//            return TRUE;
            return array('s' => 1, 'res' => $this->db->get_where('users', array('id' => $ship))->row());
        }
    }

    public function saveaddress($data) {
        $this->db->trans_start();
        $dataNo = array(
            'default_address' => 'No',
        );
        $this->db->where('cust_id', $this->session->userdata('userid'));
        $this->db->update('address', $dataNo);

        $data['create_date'] = date('Y-m-d h:i:s', now());
        $data['cust_id'] = $this->session->userdata('userid');
        $data['status'] = 'Active';
        $data['default_address'] = 'Yes';
        $this->db->insert('address', $data);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return FALSE;
        } else {
            $this->db->trans_commit();
            return TRUE;
        }
    }

    public function wishList($id) {
        $this->db->trans_start();
        $data = array(
            'product_id' => $id,
            'cust_id' => $this->session->userdata('userid'),
            'create_date' => date('Y-m-d h:i:s', now()),
        );
        $this->db->insert('wishlist', $data);
        $wishId=$this->db->insert_id();
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return FALSE;
        } else {
            $this->db->trans_commit();
            return $wishId;
        }
    }

    public function deletewishList($id) {
        $this->db->trans_start();
        $this->db->where('product_id', $id);
        $this->db->where('cust_id', $this->session->userdata('userid'));
        $this->db->delete('wishlist');
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return FALSE;
        } else {
            $this->db->trans_commit();
            return TRUE;
        }
    }

    function getlistwish($id) {
        $this->db->select('*');
        $this->db->from('wishlist');
        $this->db->where('cust_id', $this->session->userdata('userid'));
        $this->db->where('product_id', $id);
        $query = $this->db->get();
        return $query->row();
    }

    function ordernow($data) {
        $this->db->trans_start();
        $ord_no = $this->setOrder();
        if ($this->session->userdata('userid') != null) {
            if ($data['shipfname'] != null) {
                $Shipngadd = array(
                    'cust_id' => $this->session->userdata('userid'),
                    'fname' => $this->input->post('shipfname'),
                    'lname' => $this->input->post('shiplname'),
                    'email' => $this->input->post('shipemail'),
                    'mobile' => $this->input->post('shipmobile'),
                    'address' => $this->input->post('shipaddress'),
                    'country_id' => $this->input->post('shiparea_id'),
                    'state_id' => $this->input->post('shipstate_id'),
                    'city_id' => $this->input->post('shipcity_id'),
                    'zipcode' => $this->input->post('shipzip'),
                    'default_address' => 'Yes',
                    'address_type' => 'Shipping',
                );
                $this->db->insert('address', $Shipngadd);
                $Add = $this->db->insert_id();
            }
            if ($data['fname'] != null) {
                $Billngadd = array(
                    'cust_id' => $this->session->userdata('userid'),
                    'fname' => $this->input->post('fname'),
                    'lname' => $this->input->post('lname'),
                    'email' => $this->input->post('email'),
                    'mobile' => $this->input->post('mobile'),
                    'address' => $this->input->post('address'),
                    'area_id' => $this->input->post('area_id'),
                    'state_id' => $this->input->post('state_id'),
                    'city_id' => $this->input->post('city_id'),
                    'zipcode' => $this->input->post('zip'),
                    'default_address' => 'Yes',
                    'address_type' => 'Billing',
                );
                $this->db->insert('address', $Billngadd);
                $ship = $this->db->insert_id();
            }
            $this->db->select('*');
            $this->db->from('address');
            $this->db->where('cust_id', $this->session->userdata('userid'));
            $this->db->where('default_address', 'Yes');
            $this->db->where('status', 'Active');
            $this->db->where('address_type', 'Billing');
            $Add_id = $this->db->get()->result();
            $this->load->helper('string');
            $OrderNo = random_string('alnum', 8);
            $order = array(
                'user_id' => $this->session->userdata('userid'),
                'order_number' => $this->setOrder(),
                'order_date' => date('Y-m-d h:i:s', now()),
                'ship_date' => date('Y-m-d', strtotime('+7 days')),
                'requierd_date' => date('Y-m-d', strtotime('+7 days')),
                'order_track_no' => $this->setOrder(),
                'total_amount' => $this->cart->total(),
                'address_id' => $ship,
                'create_date' => date('Y-m-d h:i:s', now())
            );
          
            $this->db->insert('orders', $order);
            $ord_id = $this->db->insert_id();

            if ($cart = $this->cart->contents()):
//                $supplier_id = 0;
                foreach ($cart as $item):
                    $supplier_id = $this->db->get_where('products', array('id' => $item['id']))->row()->supplier1;
                    $order_detail = array(
                        'product_id' => $item['id'],
                        'product_name' => $item['name'],
                        'price' => $item['price'],
                        'qty' => $item['qty'],
                        'sub_total' => $item['price'] * $item['qty'],
                        'total' => $this->cart->total(),
                        'order_id' => $ord_id,
                        'supplier_id' => $supplier_id,
                        'create_date' => date('Y-m-d h:i:s', now())
                    );
//                    echo $this->db->last_query(); exit;
                    $this->db->insert('order_detail', $order_detail);
                    $ordd_id = $this->db->insert_id();

//                    $this->db->select('*');
//                    $this->db->from('products');
//                    $this->db->where('id', $item['id']);
//                    $this->db->where('status', 'Active');
//                    $prod = $this->db->get()->result();
//
//                    $ProductSell = array(
//                        'quantity' => ($prod[0]->quantity) - ($item['qty'])
////                        'create_date' => date('Y-m-d h:i:s', now())
//                    );
//
//                    $this->db->where('id', $item['id']);
//                    $up = $this->db->update('products', $ProductSell);
//                    echo $this->db->last_query();
                endforeach;
                $ord_det = $this->db->get_where('order_detail', array('order_detail_id' => $ordd_id))->row();
                $order_status = array(
                    'order_status_id' => $ord_det->order_id,
                    'status_name' => 'ordered',
                    'created_by' => $this->session->userdata('userid'),
                    'created_date' => date('Y-m-d h:i:s', now())
                );
                $this->db->insert('order_status', $order_status);
                $ordsts_id = $this->db->insert_id();
            endif;
        }
        else {
            $Billngadd = array(
                'name' => $this->input->post('fname') . ' ' . $this->input->post('lname'),
                'email' => $this->input->post('email'),
                'phone' => $this->input->post('mobile'),
                'address' => $this->input->post('address'),
                'country' => $this->input->post('area_id'),
                'state' => $this->input->post('state_id'),
                'city' => $this->input->post('city_id'),
                'postal_code' => $this->input->post('zip'),
//                'default_address' => 'Yes',
//                'address_type' => 'Billing',
            );
            $this->db->insert('customer', $Billngadd);
            $Cust_id = $this->db->insert_id();

            $Shipngadd = array(
                'guest_id' => $Cust_id,
                'fname' => $this->input->post('shipfname'),
                'lname' => $this->input->post('shiplname'),
                'email' => $this->input->post('shipemail'),
                'mobile' => $this->input->post('shipmobile'),
                'address' => $this->input->post('shipaddress'),
                'country_id' => $this->input->post('shiparea_id'),
                'state_id' => $this->input->post('shipstate_id'),
                'city_id' => $this->input->post('shipcity_id'),
                'zipcode' => $this->input->post('shipzip'),
                'create_date' => date('Y-m-d h:i:s', now()),
                'default_address' => 'Yes',
                'address_type' => 'Shipping',
            );
            $this->db->insert('address', $Shipngadd);
            $Addss_id = $this->db->insert_id();

            $this->load->helper('string');
            $OrderNo = random_string('alnum', 8);
            $order = array(
                'guest_id' => $Cust_id,
                'order_number' => $this->setOrder(),
                'order_date' => date('Y-m-d h:i:s', now()),
                'ship_date' => date('Y-m-d', strtotime('+7 days')),
                'requierd_date' => date('Y-m-d', strtotime('+7 days')),
                'order_track_no' => $this->setOrder(),
                'total_amount' => $this->cart->total(),
                'address_id' => $Addss_id,
                'create_date' => date('Y-m-d h:i:s', now())
            );

            $this->db->insert('orders', $order);
            $ord_id = $this->db->insert_id();

            if ($cart = $this->cart->contents()):
//                $supplier_id = 0;
                foreach ($cart as $item):
                    $supplier_id = $this->db->get_where('products', array('id' => $item['id']))->row()->supplier1;
                    $order_detail = array(
                        'product_id' => $item['id'],
                        'product_name' => $item['name'],
                        'price' => $item['price'],
                        'qty' => $item['qty'],
                        'sub_total' => $item['price'] * $item['qty'],
                        'total' => $this->cart->total(),
                        'order_id' => $ord_id,
                        'supplier_id' => $supplier_id,
                        'create_date' => date('Y-m-d h:i:s', now())
                    );
//                    echo $this->db->last_query(); exit;
                    $this->db->insert('order_detail', $order_detail);
                    $orddr_id = $this->db->insert_id();

//                    $this->db->select('*');
//                    $this->db->from('products');
//                    $this->db->where('id', $item['id']);
//                    $this->db->where('status', 'Active');
//                    $Add_id = $this->db->get()->result();
//
//                    $ProductSell = array(
//                        'quantity' => ($Add_id[0]->quantity) - ($item['qty']),
////                        'create_date' => date('Y-m-d h:i:s', now())
//                    );
//
//                    $this->db->where('id', $item['id']);
//                    $this->db->update('products', $ProductSell);

                endforeach;
                $ord_det = $this->db->get_where('order_detail', array('order_detail_id' => $orddr_id))->row();

                $order_status = array(
                    'order_status_id' => $ord_det->order_id,
                    'status_name' => 'ordered',
                    'created_by' => $this->session->userdata('userid'),
                    'created_date' => date('Y-m-d h:i:s', now())
                );
                $this->db->insert('order_status', $order_status);
                $ordsts_id = $this->db->insert_id();
            endif;
        }
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return array('s' => 0, 'res' => "");
//            return FALSE;
        } else {
            $this->db->trans_commit();
            if ($this->session->userdata('userid') == null) {

                $this->db->select('c.name,c.email,o.order_number,o.order_id,o.total_amount,od.product_name,od.price,od.qty,od.total')
                        ->from('customer c')
                        ->join('orders o', 'o.guest_id = c.id')
                        ->join('order_detail od', 'od.order_id = o.order_id');
                $this->db->where('c.id', $Cust_id);
//        $this->db->where('a.status', 'Active');
                $rs = $this->db->get()->result();
                return array('s' => 1, 'res' => $rs);
            } else {

                $this->db->select('concat(c.fname, c.lname) as name,c.email,o.order_number,o.order_id,o.total_amount,od.product_name,od.price,od.qty,od.total')
                        ->from('register c')
                        ->join('orders o', 'o.user_id = c.id')
                        ->join('order_detail od', 'od.order_id = o.order_id');
                $this->db->where('o.order_id', $ord_id);
//                $this->db->where('o.create_date',date('Y-m-d', now()) );
//        $this->db->where('a.status', 'Active');
                $rs = $this->db->get()->result();
                return array('s' => 1, 'res' => $rs);
            }
//            return $ord_id;
        }
    }

    function get_Supplier() {
        $this->db->select('product_id');
        $this->db->from('order_detail');
        $this->db->where('order_id', $this->session->userdata('ord_id'));
        $Proid = $this->db->get()->result();

        foreach ($Proid as $id) {
            $this->db->select('supplier1');
            $this->db->from('products');
            $this->db->where('id', $id->product_id);
            $Suplrid[] = $this->db->get()->result();
        }
        foreach ($Suplrid as $supid) {
            $this->db->select('company_name,email,fname,lname');

            $this->db->from('supplier');
            $this->db->group_by('company_name');
//            $this->db->limit($limit, $offset);
            $this->db->where('supplier_id', $supid[0]->supplier1);

            $Suplr[] = $this->db->get()->result();
        }
        $sup = $Suplr;
        return $sup;
    }

//------rajkumar code End--------------
    //------faq code start added by puja 19 sept 3.11--------------
    public function get_faq() {
        $this->db->select('*')
                ->where('status', "Active");
        $rs = $this->db->get('faq')->result();
        return $rs;
    }

    public function get_Compare() {
        $a = $this->session->userdata('Compare');
        foreach ($a as $comp) {
            $this->db->select('*')
                    ->where('id', $comp);
            $rs[] = $this->db->get('products')->result();
        }
        $rss = $rs;
        return $rss;
    }

    public function get_products($data) {
        $rss = $this->db->select('id,cat_name')
                        ->like('cat_name', $data['name'])
                        ->get('category')->row();
        if (!$rss) {

            $rs = $this->db->select('id,image,details,cost,name,arrival')
                            ->from('products p')
                            ->join('supplier s', 's.supplier_id =p.supplier1')
//                    ->where('p.category_id', $rss->id)
                            ->where('p.terminal_id', $data['terminal_id'])
                            ->where('p.airport_id', $data['airport_id'])
                            ->like('name', $data['name'])
                            ->where('p.status', "Active")
                            ->where('s.status', "Active")
                            ->where('s.open_status', "Open")->get()->result();

//            $rs = $this->db->get()->result();
//            $rs = $this->db->select('id,image,details,cost,name,arrival')
//                            ->where('airport_id', $data['airport_id'])
//                            ->where('terminal_id', $data['terminal_id'])
////                        ->where('category_id', $rss->id)
//                            ->like('name', $data['name'])
//                            ->get('products')->result();
        } else {
            $rs = $this->db->select('p.id,p.image,p.details,p.cost,p.name,p.arrival')
                            ->from('products p')
                            ->join('supplier s', 's.supplier_id =p.supplier1')
                            ->where('p.category_id', $rss->id)
                            ->where('p.terminal_id', $data['terminal_id'])
                            ->where('p.airport_id', $data['airport_id'])
                            ->or_like('p.name', $data['name'])
                            ->where('p.status', "Active")
                            ->where('s.status', "Active")
                            ->where('s.open_status', "Open")->get()->result();

//            $rs = $this->db->select('id,image,details,cost,name,arrival')
//                            ->where('airport_id', $data['airport_id'])
//                            ->where('terminal_id', $data['terminal_id'])
//                            ->where('category_id', $rss->id)
//                            ->or_like('name', $data['name'])
//                            ->get('products')->result();
        }
        return $rs;
    }

    public function get_relproduct($data) {
        $rss = $this->db->select('id,cat_name')
                        ->like('cat_name', $data['name'])
                        ->get('category')->row();
        if (!$rss) {
//<<<<<<< .mine
//            $this->db->select('p.id,p.category_id')
//                    ->from('products p')
//                    ->join('supplier s', 's.supplier_id =p.supplier1')
////                    ->where('p.category_id', $rss->id)
////                    ->where('p.terminal_id', $data['terminal_id'])
//                    ->where('p.airport_id', $data['airport_id'])
//                    ->like('p.name', $data['name'])
//                    ->where('p.status', "Active")
//                    ->where('s.open_status', "Open");
//            $r = $this->db->get()->result();
//
//=======
//>>>>>>> .r123

            $r = $this->db->select('id,category_id')
                            ->where('airport_id', $data['airport_id'])
//                        ->where('terminal_id', $data['terminal_id'])
//                        ->where('category_id', $rss->id)
                            ->like('name', $data['name'])
                            ->get('products')->row();
            $cat_id = $r->category_id;
        } else {
            $cat_id = $rss->id;
        }
//        echo $cat_id;
        $rs = $this->db->select('id,image,details,cost,name,arrival')
                        ->from('products p')
                        ->join('supplier s', 's.supplier_id =p.supplier1')
                        ->where('p.category_id', $cat_id)
//                    ->where('p.terminal_id', $data['terminal_id'])
                        ->where('p.airport_id', $data['airport_id'])
//                    ->like('p.name', $data['name'])
                        ->where('p.status', "Active")
                        ->where('s.status', "Active")
                        ->where('s.open_status', "Open")->get()->result();
//        $rs = $this->db->get()->result();
//        $rs = $this->db->select('id,image,details,cost,name,arrival')
//                        ->where('airport_id', $data['airport_id'])
////                        ->where('terminal_id', $data['terminal_id'])
//                        ->where('category_id', $cat_id)
////                        ->or_like('name', $data['name'])
//                        ->get('products')->result();
//        $rs['category']=$rss->cat_name;

        return $rs;
    }

    public function getrelproduct() {
        $filters = $this->session->userdata('filters');

        $rs = $this->db->select('p.id,p.image,p.details,p.cost,p.name,p.arrival')
                        ->from('products p')
                        ->join('supplier s', 's.supplier_id =p.supplier1')
                        ->where('p.category_id', $filters['category'])
//                    ->where('p.terminal_id', $data['terminal_id'])
                        ->where('p.airport_id', $filters['airport'])
//                    ->like('p.name', $data['name'])
                        ->where('p.status', "Active")
                        ->where('s.open_status', "Open")->get()->result();
//        $rs = $this->db->get()->result();
//        $rs = $this->db->select('id,image,details,cost,name,arrival')
//                        ->where('category_id', $filters['category'])
////                ->where('terminal_id', $filters['terminal'])
//                        ->where('airport_id', $filters['airport'])
//                        ->get('products')->result();
        return $rs;
    }

    public function getfeatured() {
        $rs = $this->db->select('p.id,p.image,p.details,p.cost,p.name,p.arrival')
                        ->from('products p')
                        ->join('supplier s', 's.supplier_id =p.supplier1')
                        ->where('p.featured', '1')
                        ->where('p.status', "Active")
                        ->where('s.status', "Active")
                        ->where('s.open_status', "Open")->get()->result();


//        $rs = $this->db->select('id,image,details,cost,name,arrival')
//                        ->where('featured', '1')
//                        ->get('products')->result();
        return $rs;
    }

    public function getnewproduct() {
        $rs = $this->db->select('p.id,p.image,p.details,p.cost,p.name,p.arrival')
                        ->from('products p')
                        ->join('supplier s', 's.supplier_id =p.supplier1')
                        ->where('p.arrival', 'new')
                        ->where('p.status', "Active")
                        ->where('s.open_status', "Open")
                        ->order_by('p.create_date', 'desc')->get()->result();

//        $rs = $this->db->select('id,image,details,cost,name,arrival')
//                        ->where('arrival', 'new')
//                        ->order_by('create_date', 'desc')
//                        ->get('products')->result();
        return $rs;
    }

    public function get_terms() {
        $this->db->select('*');
        $this->db->from('terms');
        $query = $this->db->get()->result();
        return $query;
    }

    function getcategory_add() {
        $this->db->select('*');
        $this->db->from('category');
        $this->db->where('parent_id', '0');
        $query = $this->db->get()->result();
        return $query;
    }

    function get_category($id) {
        $this->db->select('*');
        $this->db->from('category');
        $this->db->where('parent_id', $id);
        $query = $this->db->get();
        return $query->result();
    }

    function getsubcategory($id) {
        $this->db->select('*');
        $this->db->from('category');
        $this->db->where('parent_id', $id);
        $query = $this->db->get();
        return $query->result();
    }

    function get_catproduct($id) {
        $this->db->select('*');
        $this->db->from('products');
        $this->db->where('category_id', $id);
        $query = $this->db->get();
        return $query->result();
    }

    function get_oneproduct($id) {
        $this->db->select('*');
        $this->db->from('products');
        $this->db->where('category_id', $id);
        $query = $this->db->get();
        return $query->row();
    }

    function getcatproduct($id) {
        $this->db->select('*');
        $this->db->from('products');
        $this->db->where('category_id', $id);
        $query = $this->db->get();
        return $query->result();
    }

    public function getOrderCount() {
        $this->db->select('count(order_id) as c');
        return $this->db->get('orders')->row()->c;
    }

    public function get_menu() {
        $this->db->select('*');
        $this->db->from('category');
        $this->db->where('parent_id', '0');
        $cat = $this->db->get()->result();
        $this->db->select('*');
        $this->db->from('category');
        $this->db->where('parent_id!=', '0');
        $sub = $this->db->get()->result();
        $this->db->select('id,name,category_id');
        $this->db->from('products');
//        $this->db->where('parent_id!=', '0');
        $prod = $this->db->get()->result();
        $rss['cat'] = $cat;
        $rss['sub'] = $sub;
        $rss['prod'] = $prod;
//        echo '<pre>';
//        print_r($rss);
//        echo '</pre>';
//        die();
        return $rss;
    }

    public function get_vendor() {
        $res = $this->db->where('status', 'Deactive')
                        ->order_by('create_date', 'desc')
                        ->limit(5)
                        ->get('supplier')->result();
        return $res;
    }

    public function get_userlist() {
        $res = $this->db->where('status', 'Active')
                        ->order_by('create_date', 'desc')
                        ->limit(5)
                        ->get('register')->result();
        return $res;
    }

    //------puja code end--------------
    function get_Admin() {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('company', 'ADMIN');
        $query = $this->db->get();
        return $query->row();
    }

    function getSiteInfo() {
        $this->db->select('*');
        $this->db->from('site');
//        $this->db->where('company', 'ADMIN');
        $query = $this->db->get();
        return $query->row();
    }

    function save_Contactus($data) {
        $this->db->trans_start();
        $this->db->insert('contact', $data);
        $Cont_id = $this->db->insert_id();
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
//            return FALSE;
            return array('s' => 0, 'res' => "");
        } else {
            $this->db->trans_commit();
//            return TRUE;
            return array('s' => 1, 'res' => $this->db->get_where('contact', array('id' => $Cont_id))->row());
        }
    }

    function get_subcategory() {
        $this->db->select('*');
        $this->db->from('category');
        $this->db->where('parent_id!=', '0');
        $query = $this->db->get()->result();
        return $query;
    }

    public function setOrder() {
        $ord_id = $this->db->select('order_id')->order_by('order_id', 'desc')->limit('1')->get('orders');
        $id = "";
        if ($ord_id->num_rows()) {
            $id = $ord_id->row()->order_id;
//            $id = explode("-", $id);
        } else {
            $id = 'ORD01-000000';
//            $id = explode("-", $id);
        }
        $oid = "ORD01-" . sprintf("%06d", (int) $id + 1);
        return $oid;
    }

}
