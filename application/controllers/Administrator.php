<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Administrator extends CI_Controller{
    public function __construct(){
        parent:: __construct();
        $this->load->model('mlogin');
        $this->load->library('form_validation');
    }
    public function index(){
        $x['judul']="Silahkan Masuk..!";
        $this->load->view('admin/v_login',$x);
    }
    public function cekuser(){
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $valid = $this->form_validation->set_error_delimiters('', '');
        $valid->set_rules('username','Username','required|trim|min_length[6]|max_length[32]',array('required'    =>  '%s harus diisi','min_length'  =>  '%s minimal 6 karakter','max_length'  =>  '%s maximal 32 karakter'));
        $valid->set_rules('password','Password','required|trim|min_length[6]',array('required'    =>  '%s harus diisi','min_length'  =>  '%s minimal 6 karakter'));
        $check_login=$this->mlogin->cekadmin($username,$password);
        if($valid->run() == FALSE){
            echo $this->session->set_flashdata('msg','Username dan Password tidak valid');
            $this->load->view('admin/v_login');
        }else{
            if(count((array)$check_login)){
             $this->session->set_userdata('masuk',true);
             $this->session->set_userdata('user',$username);
                 if($check_login->user_level==1){
                    $this->session->set_userdata('akses','1');
                    $idadmin=$check_login->user_id;
                    $user_nama=$check_login->user_nama;
                    $bgwarna=$check_login->bgwarna;
                    $this->session->set_userdata('bgwarna',$bgwarna);
                    $this->session->set_userdata('idadmin',$idadmin);
                    $this->session->set_userdata('nama',$user_nama);
                    redirect(base_url('welcome'));
                 }elseif($check_login->user_level==2){
                     $this->session->set_userdata('akses','2');
                     $idadmin=$check_login->user_id;
                     $user_nama=$check_login->user_nama;
                     $bgwarna=$check_login->bgwarna;
                    $this->session->set_userdata('bgwarna',$bgwarna);
                     $this->session->set_userdata('idadmin',$idadmin);
                     $this->session->set_userdata('nama',$user_nama);
                     redirect(base_url('welcome'));
                 }elseif($check_login->user_level==3 && $check_login->user_status==1){
                     $this->session->set_userdata('akses','3');
                     $idadmin=$check_login->user_id;
                     $user_nama=$check_login->user_nama;
                     $bgwarna=$check_login->bgwarna;
                    $this->session->set_userdata('bgwarna',$bgwarna);
                     $this->session->set_userdata('idadmin',$idadmin);
                     $this->session->set_userdata('nama',$user_nama);
                     redirect(base_url('welcome'));
                 }elseif($check_login->user_level==4 && $check_login->user_status==1){
                     $this->session->set_userdata('akses','4');
                     $idadmin=$check_login->user_id;
                     $user_nama=$check_login->user_nama;
                     $bgwarna=$check_login->bgwarna;
                    $this->session->set_userdata('bgwarna',$bgwarna);
                     $this->session->set_userdata('idadmin',$idadmin);
                     $this->session->set_userdata('nama',$user_nama);
                     redirect(base_url('welcome'));
                 }elseif($check_login->user_level==5 && $check_login->user_status==1){
                     $this->session->set_userdata('akses','5');
                     $idadmin=$check_login->user_id;
                     $user_nama=$check_login->user_nama;
                     $bgwarna=$check_login->bgwarna;
                    $this->session->set_userdata('bgwarna',$bgwarna);
                     $this->session->set_userdata('idadmin',$idadmin);
                     $this->session->set_userdata('nama',$user_nama);
                     redirect(base_url('welcome'));
                 }elseif($check_login->user_status==0){
                     $url=base_url('administrator');
                     echo $this->session->set_flashdata('msg','Username anda tidak Aktif');
                     redirect($url);
                 } 
                  //Front Office
            }else{
                $url=base_url('administrator');
                echo $this->session->set_flashdata('msg','Username Atau Password Salah ya');
                redirect($url);
            }
        }
    }
    public function calculator(){
        $this->load->view('admin/v_calculator');
    }
    public function logout(){
        $this->session->sess_destroy();
        $url=base_url('administrator');
        redirect($url);
    }
}
