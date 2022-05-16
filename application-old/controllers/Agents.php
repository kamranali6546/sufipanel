<?php
/* 
 * @author SHAHID Aslam
 */
class Agents extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('BaseModel');
        $this->load->helper('common_helper','common');
    }
    public function index()
    {
        $data['view']="agents_view";
        $data['page']='table';
        $data['pageTitle']='Agents List';
        $data['tab']='agents';
        $data['company']=$this->BaseModel->record('company');
       // $data['record']=$this->BaseModel->gettingJoin('admin','company','left','admin.company','company.id');
        $data['record']=$this->BaseModel->getQuery('select  admin.id as adminId,admin.first_name,admin.last_name,admin.cnic,admin.email,admin.cell,admin.login_name,admin.password,admin.pic,admin.flag,admin.profitTarget,admin.sales_target,admin.agent_status,company.id as companyId, company.company_name from admin LEFT JOIN company  ON  admin.company=company.id where first_name!="special" ');
        $this->load->view('dashboard',$data);
    }
    public function AddForm()
    {
        $data['view']="newUser_view";
        $data['company']=$this->BaseModel->record('company');
        $data['tab']='agents';
         $data['pageTitle']='New Agents Form';
        $this->load->view('dashboard',$data);
    }
    public function agentSave()
    {
        $this->form_validation->set_rules('first_name','First Name','required');
        $this->form_validation->set_rules('email','Email','required');
//        $this->form_validation->set_rules('cnic','CNIC','trim|required');
        $this->form_validation->set_rules('password','Password','required');
        $this->form_validation->set_rules('company','Company','required');
//        $this->form_validation->set_rules('access_Level','Access Level','required');
        $this->form_validation->set_rules('last_name','Last Name','required');
//        $this->form_validation->set_rules('phone','Phone','Required');
        $this->form_validation->set_rules('loginName','Login Name','required');
        if($this->form_validation->run()==false)
        {
            $data['view']="newUser_view";
            $data['tab']='agents';
            $data['company']=$this->BaseModel->record('company');
            $this->load->view('dashboard',$data);
        }
        else
        { 
            $first_name=$this->input->post('first_name');
            $email=$this->input->post('email');
            $cnic=$this->input->post('cnic');
            $password=$this->input->post('password');
            $company=$this->input->post('company');
            $last_name=$this->input->post('last_name');
            $phone=$this->input->post('phone');
            $login_name=$this->input->post('loginName');
            $shift_time_start=$this->input->post('shift_time_start');
            $shift_time_end=$this->input->post('shift_time_end');
            $accessLevel=$this->input->post('access_Level');
            $agent_status=$this->input->post('agentStatus');
            $sales_target=$this->input->post('salesTarget');
            $profit_target=$this->input->post('profitTarget');
            $dataArray=array(
                'first_name'=>$first_name,
                'last_name'=>$last_name,
                'full_name'=>$first_name.' '.$last_name,
                'cnic'=>$cnic,
                'email'=>$email,
                'cell'=>$phone,
                'login_name'=>$login_name,
                'password'=>$password,
//                'pic'=>$img_name,
                'agent_status'=>$agent_status,
                'flag'=>$accessLevel,
                'company'=>$company,
                'shift_time_start'=>$shift_time_start,
                'shift_time_end'=>$shift_time_end,
                'sales_target'=>$sales_target,
                'profitTarget'=>$profit_target
                );
            $resId=$this->BaseModel->save('admin',$dataArray);
            if($resId >0)
                {
                  redirect(site_url('User'));
                }
                else
               {
                     $data['view']="newUser_view";
                     $data['errorSave']="Data Not Saved Please Try Again !";
                     $data['company']=$this->BaseModel->record('company');
                     $this->load->view('dashboard',$data);
               }
//            $config['upload_path']   = 'upload/'; 
//            $config['allowed_types'] = 'gif|jpg|png|jpeg';
//            $this->load->library('upload', $config);
//             if(!empty($_FILES['profilepic_agent']['name']))
//              {		
//                if (!$this->upload->do_upload('profilepic_agent'))
//                    {
//                       $imgerror= $this->upload->display_errors(); 
//                       $data['view']='newUser_view';
//                       $data['company']=$this->BaseModel->record('company');
//                       $data['imgerror']=$imgerror;
//                       $this->load->view('dashboard',$data);                     
//                    }
//                else
//                    { 
//                       $imgdata =$this->upload->data();
//                       $img_name=$imgdata['file_name'];
//                       
//                    } 
//              }
//            else
//            {
//                $data['view']="newUser_view";
//                $data['tab']='agents';
//                $data['company']=$this->BaseModel->record('company');
//                $this->load->view('dashboard',$data);
//            }         
        }
    }
    function deleteAgent()
    {
        $agentId=$this->input->post('agentID');
        //$profile=idToName('admin','id',$agentId,'pic');
        $response=$this->BaseModel->del('admin',array('id'=>$agentId));
        if($response >0)
        {
            //unlink($profile);
            echo $agentId;
        }
        else
        {
           echo 0; 
        }
    }
    public function editAgent()
    {
        $data['view']="editUser";
        $term=$this->uri->segment(2);
        $id=iddecode($term);
        $data['pageTitle']='Agents Edit';
        $data['tab']='agents';
        $data['company']=$this->BaseModel->record('company');
        $data['agentData']=$this->BaseModel->getWhereM('admin',array('id'=>$id));
        $this->load->view('dashboard',$data);
    }
    public function updateUser()
    {
        $this->form_validation->set_rules('first_name','First Name','required');
        $this->form_validation->set_rules('email','Email','required');
//        $this->form_validation->set_rules('cnic','CNIC','trim|required');
        $this->form_validation->set_rules('password','Password','required');
        $this->form_validation->set_rules('company','Company','required');
//        $this->form_validation->set_rules('last_name','Last Name','required');
//        $this->form_validation->set_rules('phone','Phone','Required');
        $this->form_validation->set_rules('loginName','Login Name','required');
        $agendId=  $this->input->post('agentId');
        if($this->form_validation->run()==false)
        {
            $data['view']="editUser";
            $data['pageTitle']='Agents Edit';
            $data['tab']='agents';
            $id=$agendId;
            $data['company']=$this->BaseModel->record('company');
            $data['agentData']=$this->BaseModel->getWhereM('admin',array('id'=>$id));
            $this->load->view('dashboard',$data);  
        }
        else
        {
//            $config['upload_path']   = 'upload/'; 
//            $config['allowed_types'] = 'gif|jpg|png|jpeg';
//            $this->load->library('upload', $config);
//             if(!empty($_FILES['profilepic_agent']['name']))
//              {		
//                if (!$this->upload->do_upload('profilepic_agent'))
//                    {
//                       $imgerror= $this->upload->display_errors(); 
//                        $data['view']="editUser";
//                        $data['pageTitle']='Agents Edit';
//                        $data['tab']='agents';
//                        $id=$agendId;
//                        $data['company']=$this->BaseModel->record('company');
//                        $data['agentData']=$this->BaseModel->getWhereM('admin',array('id'=>$id));
//                        $data['imgerror']=$imgerror;
//                        $this->load->view('dashboard',$data);                     
//                    }
//                    else
//                    {
//                       $imgdata =$this->upload->data();
//                       $img_name=$imgdata['file_name'];
//                       
//                    }
//              }
//              else
//              {
                       $first_name=$this->input->post('first_name');
                       $email=$this->input->post('email');
                       $cnic=$this->input->post('cnic');
                       $password=$this->input->post('password');
                       $company=$this->input->post('company');
                       $last_name=$this->input->post('last_name');
                       $phone=$this->input->post('phone');
                       $login_name=$this->input->post('loginName');
                       $shift_time_start=$this->input->post('shift_time_start');
                       $shift_time_end=$this->input->post('shift_time_end');
                       $accessLevel=$this->input->post('access_Level');
                       $agent_status=$this->input->post('agentStatus');
                       $sales_target=$this->input->post('salesTarget');
                       $profit_target=$this->input->post('profitTarget');
                       $dataArray=array(
                           'first_name'=>$first_name,
                           'last_name'=>$last_name,
                           'full_name'=>$first_name.' '.$last_name,
                           'cnic'=>$cnic,
                           'email'=>$email,
                           'cell'=>$phone,
                           'login_name'=>$login_name,
                           'password'=>$password,
                           'company'=>$company,
                           'shift_time_start'=>$shift_time_start,
                           'shift_time_end'=>$shift_time_end,
                           'sales_target'=>$sales_target,
                           'profitTarget'=>$profit_target,
                           'agent_status'=>$agent_status
                       ); 
                       $result=$this->BaseModel->update('admin',$dataArray,array('id'=>$agendId));
                       if($result >0)
                       {
                           $loginPersonId=$this->session->userdata('userId');
                           if($loginPersonId==$agendId)
                           {
                            $this->session->set_userdata('loginName', $login_name);
                            $this->session->set_userdata('email', $email);
                           }
                           redirect(site_url('User'));
                       }
                       else
                       {
                            $data['view']="editUser";
                            $data['pageTitle']='Agents Edit';
                            $data['tab']='agents';
                            $id=$agendId;
                            $data['company']=$this->BaseModel->record('company');
                            $data['agentData']=$this->BaseModel->getWhereM('admin',array('id'=>$id));
                            $this->load->view('dashboard',$data);     
                       }
            //  }
            
        }
    }
    public function suspenseAccount()
    {
       $data['view']='account_suspense_view';
       $data['tab']='accounts';
        $qry=" Select * from payment where pay_to='Suspense Account'  AND pay_type='Cr' AND payment_nature='supplier' ";
       $result=$this->BaseModel->getQuery($qry);
       $data['supplierData']=$this->BaseModel->getWhereM('suppliers',array('flag'=>1));
       $data['BankData']=$this->BaseModel->getWhereM('bank',array('flag'=>1));
       $data['ExpenseData']=$this->BaseModel->getWhereM('expense_head',array('flag'=>1));
       $data['resultSuspense']=$result;
       $this->load->view('dashboard',$data); 
        
    }
    public function newAgentAdd()
    {
        print_r($_POST);
        print_r($_FILES);
    }
}
?>