<?php
/**
 * @author Shahid Aslam
 */
class Expense extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('BaseModel');
    }
    public function expense()
    {
        $data['view']='expenseview';
        $data['page']='table';
        $this->load->view('dashboard',$data);
    }
    public function getExpense()
    {
        $data['view']='expenseView';
        $data['page']='table';
        $data['tab']='expenditure';
        $qry=" Select * from expense_head ";
        $data['allExpenseHead']=  $this->BaseModel->getQuery($qry);
        $this->load->view('dashboard',$data);
    }
    public function saveExpenseHead()
    {
       $headName=$this->input->post('headName');  
       $typeExpe=$this->input->post('expenseType');
       //$expenseHeadType=  $this->input->post('expanseHeadType');
       $brand   =  $this->input->post('expenseBrand');
       $result=$this->BaseModel->save('expense_head',array('expense_name'=>$headName,'flag'=>1,'expense_type'=>$typeExpe,'created_on'=>date('Y-m-d'),'brand'=>$brand));
       if($result>0)
       {
           echo $result;
       }
       else
        {
           echo 0;
        }
    }
    public function delete()
    {
        $id=  $this->input->post('expenseId');
        $resp=$this->BaseModel->del('expense_head',array('id'=>$id));
        if($resp>0)
        {
            echo $resp;
        }
        else { echo 0; }
        
    }
    public function editSearch()
    {
        $id=  $this->input->post('id');
        $result=$this->BaseModel->getQuery('Select * from expense_head where id="'.$id.'" ');
         if(count($result)>0)
        {
            $array=$result[0];
            echo json_encode($array);
        }
        else
        {
            echo 0;
        }
    }
    public function doUpdate()
    {
        $expense=$this->input->post('expensehead');
        $id=$this->input->post('idUpdate');
        $response=$this->BaseModel->update('expense_head',array('expense_name'=>$expense),array('id'=>$id));
        if($response>0){ echo $response; } else{ echo 0; }
    }
}
