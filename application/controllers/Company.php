<?php
/* 
 * @author SHAHID Aslam
 */
class Company extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('BaseModel');
    }
    public function index()
    {
        $data['view']="company_view";
        $data['page']='table';
        $data['tab']='company';
        $data['pageTitle']="Brand's Area";
        $data['company']=$this->BaseModel->record('company');
        $this->load->view('dashboard',$data);
    }
    public function companyNew()
    {
        $data['view']='company_form';
        $data['tab']='company';
        $this->load->view('dashboard',$data);
    }
    public function saveCompany()
    {
        $this->form_validation->set_rules('company_name','Company Name','trim|required');
//        $this->form_validation->set_rules('company_pass','Password','trim|required');
//        $this->form_validation->set_rules('company_login','Login Name','trim|required');
        $this->form_validation->set_rules('phone','Contact Number','trim|required|numeric');
        $this->form_validation->set_rules('companyCode','Company Code Is Required','trim|required');
//        $this->form_validation->set_rules('brandHeadType','Account Type ','trim|required');
        if($this->form_validation->run()==false)
        {
             $data['view']='company_form';
             $data['tab']='company';
             $this->load->view('dashboard',$data);   
        }
        else
        {
            $company_name=$this->input->post('company_name');
            $accountType=  $this->input->post('brandHeadType');
//            $cmpany_pass=$this->input->post('company_pass');
//            $company_login=$this->input->post('company_login');
            $contact_number=$this->input->post('phone');
            $config['upload_path']   = 'upload/'; 
            $config['allowed_types'] = 'gif|jpg|png|jpeg'; 
            $created_date=date('Y-m-d');
            $this->load->library('upload', $config);
            if(!empty($_FILES['companylogo']['name']))
              {		
            if (!$this->upload->do_upload('companylogo'))
                {
                   $imgerror= $this->upload->display_errors(); 
                   $data['view']='company_form';
                   $data['tab']='company';
                   $data['imgerror']=$imgerror;
                    $this->load->view('dashboard',$data);                     
                }
            else
                { 
                   $imgdata =$this->upload->data();
                   $img_name=$imgdata['file_name'];
                   $dataArray=array(
                       'company_name'=>$company_name,
                       'company_Code'=>$this->input->post('companyCode'),
//                       'login_name'=>$company_login,
//                       'password'=>$cmpany_pass,
                       'company_logo'=>$img_name,
                       'phone'=>$contact_number,
                       'status'=>1,
                       'flag'=>1,
                       'created_date'=>$created_date,
                       'created_by'=> $this->session->userdata('userId')
//                       'head_type'=>$accountType
                   );
                   $res=$this->BaseModel->save('company',$dataArray);
                   if($res >0)
                       {
                       redirect(site_url('Agencies'));
                       }
                       else
                           {
                               $data['tab']='company';
                               $data['view']='company_form';
                               $data['error']='Data Not Save Successfully Network Error Please Try Again';
                               $this->load->view('dashboard',$data);   
                           }
                   
               } 
            }
            else
                {
                    $dataArray=array(
                       'company_name'=>$company_name,
                       'company_Code'=>$this->input->post('companyCode'),
//                       'login_name'=>$company_login,
//                       'password'=>$cmpany_pass,
                       'company_logo'=>'',
                       'phone'=>$contact_number,
                       'status'=>1,
                       'flag'=>1,
                       'created_date'=>$created_date,
                       'created_by'=> $this->session->userdata('userId')
//                        'head_type'=>$accountType
                   );
                   $res=$this->BaseModel->save('company',$dataArray);
                   if($res >0)
                       {
                        redirect(site_url('Agencies'));
                       }
                       else
                           {
                               $data['view']='company_form';
                               $data['tab']='company';
                               $data['error']='Data Not Save Successfully Network Error Please Try Again';
                               $this->load->view('dashboard',$data);   
                           }
                }           
        }
    }
    public function companyDelete()
    {
        $companyId=$this->input->post('companyId');
        $response=$this->BaseModel->del('company',array('id'=>$companyId));
        if($response >0)
        {
            echo $companyId;
        }
        else
        {
           echo 0; 
        }
    }
    
}
?>