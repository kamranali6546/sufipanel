<style>
table.dataTable.hover tbody tr:hover, table.dataTable.display tbody tr:hover {
    background-color: #F2E1FD !important;
}
table tbody th, table.dataTable tbody td {
    text-align: center !important;
}
table thead th, table.dataTable thead td {
    text-align: center !important;
}

.tablColor th {
    border-right: 1px solid;
    height: 30px;
    color: #fff;
    background: rgb(149,149,149);
    background: -moz-linear-gradient(top, rgba(149,149,149,1) 0%, rgba(13,13,13,1) 46%, rgba(1,1,1,1) 50%, rgba(10,10,10,1) 53%, rgba(78,78,78,1) 76%, rgba(56,56,56,1) 87%, rgba(27,27,27,1) 100%);
    background: -webkit-linear-gradient(top, rgba(149,149,149,1) 0%,rgba(13,13,13,1) 46%,rgba(1,1,1,1) 50%,rgba(10,10,10,1) 53%,rgba(78,78,78,1) 76%,rgba(56,56,56,1) 87%,rgba(27,27,27,1) 100%);
    background: linear-gradient(to bottom, rgba(149,149,149,1) 0%,rgba(13,13,13,1) 46%,rgba(1,1,1,1) 50%,rgba(10,10,10,1) 53%,rgba(78,78,78,1) 76%,rgba(56,56,56,1) 87%,rgba(27,27,27,1) 100%);
    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#959595', endColorstr='#1b1b1b',GradientType=0 );
}

    


    table.display tbody tr td, table.display tfoot tr td{
            border-bottom: 1px dashed #abafaf;
        padding: 5px;
    }
    table.display tfoot tr td {
        color: black;
    } 
    @media screen and (max-width: 425px) {
    body .container.body .right_col {
        padding: 10px 13px !important;
    }
    table.dataTable thead th, table.dataTable thead td {
        padding: 5px 2px !important;
    }
}
</style>
<script>
 $(function(){
        $("#checkAll").on("click", function () {
            if ($(this).is(':checked')) {
                for (i = 1; i <= '<?=count($records2)?>'; i++)
                    $('.checkMeNow').prop('checked', true);
            }

            if (!$(this).is(':checked')) {
                for (i = 1; i <= '<?=count($records2)?>'; i++)
                    $('.checkMeNow').prop('checked', false);
            }
        }); 
    });
</script>
<title>New Inquiries</title>
<meta http-equiv="refresh" content="20">
<!-- page content -->
            <div class="right_col" role="main">
                <div class="page-title">
                    <div class="title_left">
                      <h3>New Inquiries</h3>
                    </div>
                    <div class="title_right">
                        <!--<a class="btn btn-primary btn-round pull-right" href="<?php //echo site_url('NewFollowUP'); ?>">Add New</a>-->
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="row"> 
                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 formarea text-right">
                        <form action="" class="form-inline">
                            <label for="">Select Brand:</label>
                            <select class="form-control">
                                <option>Flights N Tours</option>
                            </select>      
                        </form>
                    </div>
                </div> <br>
                <div class="row">
                    <div class="col-md-12 table-responsive">
                        <table id="next" class="table tablColor display nowrap dataTable" width="100%" cellspacing="0">
                            <thead>
<!--                                <tr>
                                    <th>Sr No.</th>
                                    <th>Inquiry Date</th>
                                    <th>Inquiry ID</th>
                                    <th>Inquiry Title</th>
                                    <th>Brand</th>
                                    <th>Status</th>
                                    <th>Picked By</th>
                                    <th class="text-center" style="width: 120px;">Actions</th>
                                </tr>-->
                                <tr>
                                    <th>Sr Nob.</th>
                                    <th>Inquiry Date</th>
                                    <th>Inquiry ID</th>
                                    <th>Inquiry Title</th>
                                    <th>Customer's Email</th>
                                    <th>Phone</th>
                                    <th>Brand</th>
                                    <th>Class</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($records)){ $i=1; foreach($records as $obj){
                                   
                                    if($this->session->userdata('flag')==1){ ?>
                                        <tr id="rowDel<?php echo $obj->id; ?>">
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $obj->enquiry_date; ?></td>
                                    <td><?php echo $obj->id; ?></td>
                                    <td><?php  $destion=  explode('-',$obj->destination); echo $obj->name.'-'.$destion[0] ?></td>
                                    <td><?php echo $obj->customer_email; ?></td>
                                    <td><?php echo substr($obj->customer_phone,0,3).'------'.substr($obj->customer_phone,8,3); ?></td>
                                    <td><?php echo $obj->brand; ?></td>
                                    <td><?php echo $obj->ticket_class; ?></td>
                                    <td class="text-center">
                                        <?php if($this->session->userdata('flag')==1){ ?>
                                        <button type="button" class="btn btn-danger btn-xs btn-round" onclick="inquiryView(<?php echo $obj->id ?>)"  data-toggle="tooltip" title="View"><i class="fa fa-eye"></i></button>
                                         <?php } ?>
                                        <?php if($this->session->userdata('flag')==1){ ?>
                                        <button type="button" class="btn btn-danger btn-xs btn-round" title="Delete" onclick=" inquiryDelete(<?php echo $obj->id ?>)"><i class="fa fa-trash"></i></button>
                                       
                                        <?php } ?>
                                        
                                        <button type="button" class="btn btn-primary btn-xs btn-round" title="Pick" onclick="pickInquiry(<?php echo $obj->id ?>,<?php echo $this->session->userdata('userId') ?>)"><i class="fa fa-hand-lizard-o" aria-hidden="true"></i></button>
                                        <?php if($this->session->userdata('flag')==1){ ?>
                                        <button type="button" class="btn btn-primary btn-xs btn-round" onclick="inquiryAssignModalNew(<?php echo $obj->id ?>)" title="Assign To" data-toggle="tooltip"><i class="fa fa-user-plus" aria-hidden="true"></i></button>
                                        <!--<button type="button" title="View Inquiry" onclick="inquiryView(<?php echo $obj->id ?>)" data-toggle="tooltip" class="btn btn-primary btn-xs btn-round">View Inquiry</button>-->
                                        <?php } ?>
                                    </td>
                                </tr>
                                        
                                   <?php }
                                   if($this->session->userdata('flag')!=1){ ?>
                                   <!--if(($this->session->userdata('flag')!=1)&&($this->session->userdata('brand_code')==$obj->brand))-->
                                <tr id="rowDel<?php echo $obj->id; ?>">
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $obj->enquiry_date; ?></td>
                                    <td><?php echo $obj->id; ?></td>
                                    <td><?php  $destion=  explode('-',$obj->destination); echo $obj->name.'-'.$destion[0] ?></td>
                                    <td><?php echo $obj->customer_email; ?></td>
                                    <td><?php echo substr($obj->customer_phone,0,3).'------'.substr($obj->customer_phone,8,3); ?></td>
                                    <td><?php echo $obj->brand_code; ?></td>
                                    <td><?php echo $obj->ticket_class; ?></td>
                                    <td class="text-center">
                                        <?php if($this->session->userdata('flag')==1){ ?>
                                        <button type="button" class="btn btn-danger btn-xs btn-round" onclick="inquiryView(<?php echo $obj->id ?>)"  data-toggle="tooltip" title="View"><i class="fa fa-eye"></i></button>
                                         <?php } ?>
                                        <?php if($this->session->userdata('flag')==1){ ?>
                                        <button type="button" class="btn btn-danger btn-xs btn-round" title="Delete" onclick="inquiryDelete(<?php echo $obj->id ?>)"><i class="fa fa-trash"></i></button>
                                        <?php } ?>
                                        
                                        <!-- pickup inquiry-button-->
                                        <!-- Hide by Umair -->
                                        <?php if(($obj->brand_code!="SC")||($this->session->userdata('flag')==4)){ ?>
                                        <button type="button" class="btn btn-primary btn-xs btn-round" title="Pick" onclick="pickInquiry(<?php echo $obj->id ?>,<?php echo $this->session->userdata('userId') ?>)"><i class="fa fa-hand-lizard-o" aria-hidden="true"></i></button>
                                         <?php } ?>
                                        <!--END- pickup inquiry-button-->
                                        <?php if($this->session->userdata('flag')==1){ ?>
                                        <button type="button" class="btn btn-primary btn-xs btn-round" onclick="inquiryAssignModalNew(<?php echo $obj->id ?>)" title="Assign To" data-toggle="tooltip"><i class="fa fa-user-plus" aria-hidden="true"></i></button>
                                        <!--<button type="button" title="View Inquiry" onclick="inquiryView(<?php echo $obj->id ?>)" data-toggle="tooltip" class="btn btn-primary btn-xs btn-round">View Inquiry</button>-->
                                        <?php } ?>
                                    </td>
                                </tr>  
                                <?php $i++;  } } }
                                else
                                    {
                                    ?>
                                     <tr>
                                         <td colspan="8" style="text-align: center;color:#ff0000;font-size: 18px;letter-spacing: 5px;"><b>No Data..............</b></td>
                                     </tr> 
                                    <?php 
                                    }
                                ?>
<!--                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-primary" title="Edit"><i class="fa fa-edit"></i></button>
                                        <button type="button" class="btn btn-danger" title="Delete"><i class="fa fa-trash"></i></button>
                                    </td> 
                                </tr>-->
                                  
                            </tbody>
                        </table>
                    </div>
                </div> 
                <?php if($this->session->userdata('flag')==1 || $this->session->userdata('flag')==2){ ?>
                 <div class="page-title">
                    <div class="title_left">
                      <h3>Delete  Inquiries</h3>
                    </div>
                    <div class="title_right">
                        <button type="button" id="MultiDeleteGroups" data-container="<?php echo htmlentities(json_encode(array('table'=>'inquiry','primaryKey'=>'id'))); ?>" onclick="multiDel('next2',this.id)" class="btn btn-danger pull-right">Delete All</button>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="row">
                    <div class="col-md-12 table-responsive">
                        <table id="next2" class="table tablColor display nowrap dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th><input type="checkbox" value="0" name="checkAllInquiry" id="checkAll">Sr No.</th>
                                    <th>Inquiry Date</th>
                                    <th>Inquiry ID</th>
                                    <th>Inquiry Title</th>
                                    <th>Customer's Email</th>
                                    <th>Phone</th>
                                    <th>Brand</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($records2)){ $i=1; foreach($records2 as $obj){ ?>
                                <tr id="rowDel<?php echo $obj->id; ?>">
                                    <td><input type="checkbox" value="<?php echo $obj->id; ?>" id="checkI-<?php echo $i; ?>" class="checkMeNow" name="checkedInquiry[]"><?php echo $i; ?></td>
                                    <td><?php echo $obj->enquiry_date; ?></td>
                                    <td><?php echo $obj->id; ?></td>
                                    <td><?php  $destion=  explode('-',$obj->destination); echo $obj->name.'-'.$destion[0] ?></td>
                                    <td><?php echo $obj->customer_email; ?></td>
                                    <td><?php echo substr($obj->customer_phone,0,3).'------'.substr($obj->customer_phone,8,3); ?></td>
                                    <td><?php echo $obj->brand; ?></td>
                                    <td class="text-center">
                                        <?php if($this->session->userdata('flag')==1 || $this->session->userdata('flag')==2){ ?>
                                        <button type="button" class="btn btn-danger btn-xs btn-round" onclick="inquiryRestore(<?php echo $obj->id ?>)"  data-toggle="tooltip" title="Restore"><i class="fa fa-undo"></i></button>
                                         <?php } ?>
                                        
                                       
                                    </td>
                                </tr>  
                                <?php $i++; } }
                                else
                                    {
                                    ?>
                                     <tr>
                                         <td colspan="8" style="text-align: center;color:#ff0000;font-size: 18px;letter-spacing: 5px;"><b>No Data..............</b></td>
                                     </tr> 
                                    <?php 
                                    }
                                ?>
                                  
                            </tbody>
                        </table>
                    </div>
                </div>   
                <?php } ?>
            </div>
<!-- /page content -->
<script>
   
function multiDel(deleteCall,btnId)
{
    var post_arr = [];
    var reqestedBtnData=$('#'+btnId).attr('data-container');
     $('#'+deleteCall+' input[type=checkbox]').each(function() {
      if (jQuery(this).is(":checked")) {
        var id = this.id;
        var nodArr=[];
        var valueData=this.value;
        nodArr.push(id)
        nodArr.push(valueData)
        post_arr.push(nodArr);
        
      }
    });
    var totalDeleteReq=post_arr.length;
    if(totalDeleteReq >0)
    {
        if(confirm('Are you Sure you want to delete ?'))
        {
            $.ajax({
                type:'POST',
                url:"<?php echo base_url() ?>Ajax/multiDelete",
                data:{dataArray:reqestedBtnData,fieldData:post_arr},
                cache:false,
                success:function(res)
                {
                    if(res!=0)
                    {     
				
				         


                            location.reload();
                           
//                        var respArr=$.parseJSON(res);
//                        $.each(respArr,function(inde,d){
//                            var nod=d;
//                            $('#'+nod).parent().parent().remove();
//                        });
                     }
                     else
                     {
                         alert('Sorry No record Deleted !');
                         return false;
                     }
                    
                }
            });
        }
        else
        {
           // alert('You are cancel');
            return false;
        }
        
    }
    else
    {
        alert('Please Select The item You Want to Delete First ');
        return false;
    }
}
</script>
