<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 *
 * @Shahid
 */
class Dashboard extends MY_Controller
{
    public function index()
    {
        $data['view']='module';
//        $data['view']='progress_sheet_view';
        $data['tab']=''; 
        $this->load->view('dashboard',$data);
    }
    public function logout()
    {
        $this->session->sess_destroy();
        redirect(site_url('login'));
    }
}
