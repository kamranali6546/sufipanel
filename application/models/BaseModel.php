<?php
 /* @author Shahid Aslam
 */
class BaseModel extends CI_Model 
{
    public function save($tablename,$data)
    {
        $this->db->insert($tablename,$data);
        return  $this->db->insert_id();
    }
    public function del($tablename,$data)
    {
        $res=$this->db->delete($tablename,$data);
       return $this->db->affected_rows();
    }
    public function update($tablename,$data,$condition)
    {
        $this->db->update($tablename,$data,$condition);
        return $this->db->affected_rows();
    }
    public function getWhere($tableName,$array)
    {
       $res= $this->db->get_where($tableName,$array);
       return $res;
    }
    public function getWhereM($tableName,$array)
    {
        $res= $this->db->get_where($tableName,$array);
       return $res->result();
    }
    public function getWhereMOrder($tablename,$array,$orderbyField,$orderBy,$groupBy='')
    {
      
       $this->db->where($array);
       if(!empty($groupBy))
           {
                $this->db->group_by($groupBy);
            }
            if(!empty($orderbyField) && !empty($orderBy))
                {
                    $this->db->order_by($orderbyField,$orderBy);
                }
       $this->db->select('*');
       $this->db->from($tablename);
       $res=$this->db->get();
       return $res->result();
    }
    public function getQuery($qry)
    {
        $res=$this->db->query($qry);
       return $res->result();
    }
    public function getQueryCount($qry)
    {
        $res=$this->db->query($qry);
       return $res->num_rows();
    }
    public function counDataRecord($tablename,$condation)
    {
        $res=$this->db->get_where($tablename,$condation);
//       echo $this->db->last_query();
//       exit();
        return $res->num_rows();
    }
    public function record($tablename)
    {
        $result=$this->db->get($tablename);
        return $recor=$result->result();
    }
    public function gettingJoin($tablename,$joinTable,$joinType,$condition1,$condition2)
    {
        $this->db->select('*');
        $this->db->from($tablename);
        $this->db->join($joinTable, $condition1.' = '.$condition2,$joinType);
        $query = $this->db->get();
        return  $res=$query->result();
    }
    public function count($tablename,$data)
    {
        $this->db->where($data);
        $this->db->from($tablename);
        return $return=$this->db->count_all_results();
                
    }
    public function getSheet($select,$tablename,$joinTable,$joinType,$condition1,$condition2,$startdate,$enddate,$loginFlag='')
    {
        $this->db->where('enqdate >=', $startdate);
        $this->db->where('enqdate <=', $enddate);
        if(!empty($loginFlag))
        {
           $this->db->where('picked_by', $loginFlag);  
        }
        $this->db->select($select);
        $this->db->from($tablename);
        $this->db->join($joinTable, $condition1.' = '.$condition2,$joinType);
//        $this->db->where_between('enqdate',$startdate,$enddate);
       
        $query = $this->db->get();
        return  $query;
        
    }
    public function gettinginquiry()
    {
        
    }
    public function processData($data)
    {
        if(!empty($data))
        {
            
        }
    }
    public function qryArray($qry)
    {
        return $res=$this->db->query($qry);
    }
    public function sum($field,$table,$condition)
    {
        $this->db->select_sum($field);
        $this->db->where($condition);
        $query = $this->db->get($table);
        return $query->result();
    }
    public function getSelectedFieldQry($field,$tablename)
    {
        $this->db->select($field);
        $this->db->from($tablename);
        $qry=$this->db->get();
        return $qry->result();
    }
} 
