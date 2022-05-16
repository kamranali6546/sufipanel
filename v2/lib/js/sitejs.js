$('#bankModalData').click( function()
    {
        $('#addBank').unbind();
        showLoder();
        $.ajax({
        type:'post',
        url:ajaxUrl+'getBrandBoxArea',
        data:{},
        cache:false,
        async: false,
        success:function(message)
        {
            hideLoder();
            if(message)
            {
               
                $('#addBank #bankBrand').html(message);
               $('#addBank').modal('show');
            }
            else
            {
                hideLoder();
                alertify.error('Network Error Occer Please Try Agagin');
            }
        }
    });
        
    });
$('#supplierModalData').click( function()
    {
        $('#supplierModel').unbind();
        $.ajax({
            type:'POST',
            url:ajaxUrl+'BankAjaxData',
            cache:false,
            success:function(resp)
            {
                if(resp)
                {
                    $('#supplierModel #supplierBank').html(resp);
                    $('#supplierModel').modal('show');
                }
            }
        });
        
    });
    function markAttendance()
    {
        var AgentId=$('#agentId').val();
        var logFlg=$('#LogFlag').val();
        if(logFlg!='1')
        {
            $.ajax({
                type:'POST',
                url:ajaxUrl+'AttendanceBoxCheck',
                data:{agenId:AgentId},
                cache:false,
                success:function(res)
                {
                    if(res=='0')
                    {
                        alertify.alert("Your Attendance Already Mark "); 
                    }
                    else
                    {
                         alertify.alert("Your Attendance Mark Successfully");
                         location.reload();
                    }
                }
            });
        }
        else
        {
             alertify.alert("You Are Not Allowed For Attendance !"); 
        }
      
    }
    function markCheckOut()
    {
       var agent=$('#agentId').val();
       var logFlg=$('#LogFlag').val();
       if(logFlg!='1')
       {
            alertify.confirm("Are You Sure To CheckOut Time?",
            function(ev){
                if(ev){
                    showLoder();
                    $.ajax({
                      type:'POST',
                      url:ajaxUrl+'AttendanceTimeOutBox',
                      data:{agent:agent},
                      cache:false,
                      success:function(resp)
                      {
                          if(resp >0)
                          {
                              hideLoder();
                              alertify.alert('Checkout Time Mark Successfully !');
                              location.reload();

                          }
                          else
                          {
                              hideLoder();
                              alertify.error('Please First CheckIn Than Checkout');
                          }
                      }
                    });
                    }
                    else
                    {
                      hideLoder();
                      alertify.error('You Have Cancelled The Operation');
                    }
            },
              function(){
              hideLoder();
                alertify.error('You Have Cancelled The Operation');
              });
       }
       else
       {
           alertify.alert("You Are Not Allowed For Attendance !");  
       }
    }
    function attendanceModelOpen()
    {
        showLoder();
         $.ajax({
        type:'POST',
        url:ajaxUrl+'Inquery/AgentsBoxs',
        cache:false,
        success:function(response)
        {
          $('#attendanceExport #agentsAttB').html(response);
          //hideLoder();
        }
        });
        hideLoder();
        $('#attendanceExport').modal('show');
    }
    function exportAttConfirm()
    {
        var startDate=$('#attendanceStartDate').val();
        var endDate=$('#attendanceEndDate').val();
        if(startDate=='')
        {
            $('#attendanceStartDate').attr('style','border: 1px solid red');
            $('#attendanceStartDateError').attr('style','color: red');
            $('#attendanceStartDateError').text('Please Select the Start Date');
            return false;
           
        }
        if(endDate=='')
        {
            $('#attendanceEndDate').attr('style','border: 1px solid red');
            $('#attendanceEndDateError').attr('style','color: red');
            $('#attendanceEndDateError').text('Please Select the Start Date');
            return false;
        }
        $("#AttForm").attr('action','AttendanceExportBox');
        $("#AttForm").removeAttr('onsubmit');
        $("#AttForm").submit();
        $('#attendanceExport').modal('hide');
    }
    function marginSheetGet()
    {
//       $("#ReportForm").attr('action','SheetDownload');
       $("#ReportForm").attr('action','getmarginSheet');
       $("#ReportForm").removeAttr('onsubmit');
       $("#ReportForm").submit(); 
    }
$('#save').click(function()
{
    showLoder();
var msg=$('#msg').val();
var InqID=$('#inquiryID').val();
if(msg=='')
{
    hideLoder();
    $('#msg').css('border-color','red');
    alertify.error("Agent Comment Required");
    return false;
}
if(msg!='' && msg!=null)
{
    $.ajax({
        type:'POST',
        url:ajaxUrl+'Inquery/CommentBox',
        data:{InqID:InqID,msg:msg},
        cache:false,
        success:function(res)
        {
            hideLoder();
            if(res!='')
            {
                var IdsArray=res.split('%');
                if(IdsArray[0] > 0)
                {
                    $('#msg').val(''); 
                    var htmlpaste=IdsArray[1];
                    $('#commentsDiv').append(htmlpaste);
                    alertify.success("Your Comments Saved Successfully !");
                }
                else
                {
                    alertify.error("Network Error Please try again!");
                    return false;
                }
            }
        },
        error:function()
        {
            hideLoder();
             alertify.error("Network Error Please try again!");
             return false;
        }       
    });
}
});
function inquiryDelete(inqryId)
{
   alertify.confirm("Are you sure to delete the following Inquiry? Inquiry ID:"+inqryId+" ",
  function(ev){
      if(ev){
          showLoder();
          $.ajax({
            type:'POST',
            url:ajaxUrl+'Inquery/DeleteBox',
            data:{ids:inqryId},
            cache:false,
            success:function(resp)
            {
                if(resp >0)
                {
                    hideLoder();
                    $('#rowDel'+inqryId).remove();
                    location.reload();
                   //window.location='<?php echo site_url('picked'); ?>';
                    alertify.success('Operation Successful!');
                    
                }
                else
                {
                    hideLoder();
                    alertify.error('Network Error please try again');
                }
            }
          });
          }
          else
          {
          hideLoder();
          alertify.error('You Have Cancelled The Operation');
          }
  },
  function(){
  hideLoder();
    alertify.error('You Have Cancelled The Operation');
  });
}
function inquiryAssignModal(inquiryId)
{
    showLoder();
    $.ajax({
        type:'POST',
        url:ajaxUrl+'Inquery/AgentsBox',
        cache:false,
        success:function(response)
        {
          $('#inquiryAssign #agentsId').html(response);
          hideLoder();
        }
    });
    $('#inquiryAssign #inqId').val(inquiryId);
    $('#inquiryAssign').modal('show');
}
function inquiryAssignModalNew(inquiryId)
{
    
    $.ajax({
        type:'POST',
        url:ajaxUrl+'Inquery/AgentsBox',
        cache:false,
        success:function(response)
        {
          $('#inquiryAssignNew #agentsIdNew').html(response);
        }
    });
    $('#inquiryAssignNew #inqIdNew').val(inquiryId);
    $('#inquiryAssignNew').modal('show');
}
function inquiryAssign()
{
    //$('#assign').attr('disabled',true);
    var id=$('#inqId').val();
    var agentId=$('#agentsId option:selected').val();
    if(agentId=='')
    {
       // $('#assign').attr('disabled',false);
        alertify.error('Select The Agent Name');
        return false;
    }
    if(agentId!='' && agentId!=null)
    {
       $.ajax({
           type:'POST',
           url:ajaxUrl+'Inquery/AssignBox',
           data:{agentId:agentId,id:id},
           cache:false,
           success:function(resp)
           {
               if(resp!='')
               {
                  var ids=resp.split('%');
                  $('#inquiryAssign').modal('hide');
                   alertify.success('Operation Successful!');
                  location.reload();
                  $('#bsc #agnt').text(ids[1]);
                  
               }
               else
               {
                    alertify.error('Network Error please try again');
               }
           }
       });  
    }
    else
    {
         alertify.error('Network Error please try again');
    }
}
function inquiryAssignNew()
{
    //$('#assign').attr('disabled',true);
    var id=$('#inqIdNew').val();
    var agentId=$('#agentsIdNew option:selected').val();
    if(agentId=='')
    {
       // $('#assign').attr('disabled',false);
        alertify.error('Select The Agent Name');
        return false;
    }
    if(agentId!='' && agentId!=null)
    {
       $.ajax({
           type:'POST',
           url:ajaxUrl+'Inquery/AssignBox',
           data:{agentId:agentId,id:id},
           cache:false,
           success:function(resp)
           {
               if(resp!='')
               {
                  var ids=resp.split('%');
                  if(ids[0] >0)
                  {
//                  $('#next').find('tbody > tr').each(function(ev){
//                      if($(this).find('td').text()==id)
//                      {
//                          alert($(this));
//                         $(this).parent().remove(); 
//                      }
//                  });
                  $('#inquiryAssignNew').modal('hide');
                  location.reload();
                  alertify.success('Operation Successful!');
                  }
                   else
                   {
                        alertify.error('Network Error please try again');
                   }
               }
               else
               {
                    alertify.error('Network Error please try again');
               }
           }
       });  
    }
    else
    {
         alertify.error('Network Error please try again');
    }
}
function pickInquiry(inqId,AgentId)
{
    $.ajax({
           type:'POST',
           url:ajaxUrl+'Inquery/AssignBox',
           data:{agentId:AgentId,id:inqId},
           cache:false,
           success:function(resp)
           {
               if(resp!='')
               {
                  var ids=resp.split('%');
                  if(ids[0] >0)
                  {
                  location.reload();
                  alertify.success('Operation Successful!');
                  }
                   else
                   {
                        alertify.error('Network Error please try again');
                   }
               }
               else
               {
                    alertify.error('Network Error please try again');
               }
           }
       });  
}
function getAllInquiry()
{
    showLoder();
    var startDate=$('#startDate').val();
    var endDate=$('#endDate').val();
    if(startDate=='')
    {
         alertify.error('Please Select The Start Date');
         return false;
    }
    if(endDate=='')
    {
        hideLoder();
         alertify.error('Please Select The End Date');
         return false;
    }
    if(startDate!='' && endDate!='')
    {
        $.ajax({
            type:'POST',
            url:ajaxUrl+'Inquery/OtherDownloadBoxSheet',
            data:{startDate:startDate,endDate:endDate},
            cache:false,
            success:function()
            {
                hideLoder();
            }
        });
    }
}
function getinquiryForDelete()
{
    $('#delButton').attr('disabled',true);
    var startdate=$('#startDate').val();
    var endDate=$('#endDate').val();
    if(startdate=='')
    {
         alertify.error('Please Select The Start Date');
          $('#delButton').attr('disabled',false);
         $('#startDate').focus();
         return false;
    }
    if(endDate=="")
    {
        alertify.error('Please Select The End Date First');
         $('#delButton').attr('disabled',false);
         $('#endDate').focus();
         return false;
    }
    if(startdate!='' && endDate!='')
    {
        $.ajax({
            type:'Post',
            url:ajaxUrl+'OtherDeleteBoxGet',
            data:{startDate:startdate,endDate:endDate},
            cache:false,
            success:function(res)
            {
                if(res)
                {
                    $('#responsiveDiv').html(res);
                    $('#btnDeleteConfirm').show();
                    $('#delButton').attr('disabled',false); 
                }
            }
        });
    }
}
function checkAll(ele)
{
                var checkboxes = document.getElementsByTagName('input');
                if (ele.checked) {
                    for (var i = 0; i < checkboxes.length; i++) {
                        if (checkboxes[i].type == 'checkbox') {
                            checkboxes[i].checked = true;
                        }
                    }
                } else {
                    for (var i = 0; i < checkboxes.length; i++) {
                       // console.log(i)
                        if (checkboxes[i].type == 'checkbox') {
                            checkboxes[i].checked = false;
                        }
                    }
                }
 }
 function confirmDeleteinquiry()
 {
     $('#btnDeleteConfirm').attr('disabled','true');
     var chekTotal='';
    var myArr=[];
      var checkboxes = document.getElementsByTagName('input');
                    for (var i = 0; i < checkboxes.length; i++) {
                        if (checkboxes[i].type == 'checkbox' && checkboxes[i].checked == true) {
                           
                            chekTotal=parseInt(chekTotal+1);
                            myArr.push(checkboxes[i].value);
                        }
                    }
                    if(chekTotal!='' && chekTotal >0 )
                    {
                         
                         alertify.confirm("Are You Sure To Delete Inquiry And Related Data?",
                                function(ev){
                                    if(ev){
//                                        var form_data = new FormData();
//                                      
//                                        form_data.append('checkbos', checkboxes['del']);
//                                        console.log(myArr);
                                        //alert('shahid');
                                            $.ajax({
                                               type:"post",
                                               url:ajaxUrl+"DeleteInquiryBox",
                                               data:{ checkboxData:myArr },
                                               cache:false,
                                               success:function(res)
                                               {
                                                   var resdata=res.split(',');
                                                   for(var j=0; j< resdata.length;j++)
                                                   {
                                                       $('#deleteRow'+resdata[j]).remove();
                                                   }
                                                     $('#btnDeleteConfirm').removeAttr('disabled');
                                                   alertify.success('Operation Successfully Done !'); 
                                               }
                                               
                                            });
                                          }
                                        else
                                        {
                                           $('#btnDeleteConfirm').removeAttr('disabled');
                                            alertify.error('You Have Cancelled The Operation');
                                        }
                                },
                                function(){
                                  $('#btnDeleteConfirm').removeAttr('disabled');
                                  alertify.error('You Have Cancelled The Operation');
                                });
                    }
                    else
                    {
                        alertify.error('Please Select The Inquiry You Want to delete otherwise Cancel the operation');
                        $('#btnDeleteConfirm').removeAttr('disabled');
                    }
              
 }
 // Add More passanger
 function addMore()
 {
      showLoder();
      var counterPass=parseInt($('#countrPassenger').val());
      counterPass=counterPass+1;
      $('#countrPassenger').val(counterPass);
    var main_tr=document.getElementById('passangerMore');
    var tr = document.createElement("tr");
    tr.innerHTML='<td><select name="category[]" onchange="ChildIn(this.value)"  class="form-control" required="" ><option value="">-Select-</option><option value="Adult">Adult</option><option value="Youth">Youth</option><option value="Child">Child</option><option value="Infant">Infant</option></select></td><td>\n\
<select name="passangerTitle[]"  class="form-control" required="" ><option value="">-Select-</option><option value="Mr">Mr</option><option value="Mrs">Mrs</option><option value="Miss">Miss</option><option value="Ms">Ms</option><option value="Mstr">Mstr</option><option value="Lord">Lord</option><option value="Dr">Dr</option><option value="Rev">Rev</option></select></td><td>\n\
<input type="text" name="firstName[]" id="firstName'+counterPass+'" onkeypress="removeerror(\'firstNameError'+counterPass+'\',this.id)" onkeyup="onlyletterWithSpace(\'firstNameError'+counterPass+'\',this.id)" class="form-control" placeholder="First Name" /><span id="firstNameError'+counterPass+'"></span></td><td>\n\
<input type="text" name="middle_name[]"  class="form-control" placeholder="Middle Name"  /></td><td>\n\
<input type="text" name="sir_name[]" id="surName'+counterPass+'" class="form-control" placeholder="Sur Name"  /><span id="surNameError'+counterPass+'"></span></td><td>\n\
<input type="text" name="age[]" id="age" class="form-control"  placeholder="dd/mm/yy" /></td><td>\n\
<input type="text" name="salePrice[]" id="salePrice'+counterPass+'" class="form-control" onkeypress="removeerror(\'salePriceError'+counterPass+'\',this.id)" onkeyup="numberWithDeceimal(\'salePriceError'+counterPass+'\',this.id)" onchange="calcul_totao_c(this.value)"  value="0" placeholder="Sale Price" /><span id="salePriceError'+counterPass+'"></span></td><td>\n\
<input type="text" name="booking_fee[]" id="bookingFee'+counterPass+'" onkeypress="removeerror(\'bookingFeeError'+counterPass+'\',this.id)" onkeyup="numberWithDeceimal(\'bookingFeeError'+counterPass+'\',this.id)" class="form-control"  placeholder="Admin Fee" /><span id="bookingFeeError'+counterPass+'"></span></td><td>\n\
<input type="text" name="eticket[]"  class="form-control" readonly="" placeholder="Eticket Number"  /></td>';
    main_tr.appendChild(tr);
    hideLoder();
 }
 // Add More passanger on details View
 function addMore2()
 {
      showLoder();
      var counterPass=parseInt($('#countrPassenger').val());
      counterPass=counterPass+1;
      $('#countrPassenger').val(counterPass);
    //var main_tr=document.getElementById('passangerMore');
//    var tr = document.createElement("tr");
     var tr='<td><select name="category" onchange="ChildIn(this.value)" id="categoryP'+counterPass+'" class="form-control" required="" ><option value="">-Select-</option><option value="Adult">Adult</option><option value="Youth">Youth</option><option value="Child">Child</option><option value="Infant">Infant</option></select><span id="categoryPError'+counterPass+'"></span></td><td>\n\
<select name="passangerTitle[]" id="passTitle'+counterPass+'" class="form-control" required="" ><option value="">-Select-</option><option value="Mr">Mr</option><option value="Mrs">Mrs</option><option value="Miss">Miss</option><option value="Ms">Ms</option><option value="Mstr">Mstr</option><option value="Lord">Lord</option><option value="Dr">Dr</option><option value="Rev">Rev</option></select><span id="passTitleError'+counterPass+'"></span></td><td>\n\
<input type="text" name="firstName" id="firstName'+counterPass+'" onkeypress="removeerror(\'firstNameError'+counterPass+'\',this.id)" onkeyup="onlyletterWithSpace(\'firstNameError'+counterPass+'\',this.id)" class="form-control" placeholder="First Name" /><span id="firstNameError'+counterPass+'"></span></td><td>\n\
<input type="text" name="middle_name" id="middleNameP'+counterPass+'" class="form-control" placeholder="Middle Name" onkeypress="removeerror(\'middleNamePError'+counterPass+'\',this.id)" onkeyup="onlyletterWithSpace(\'middleNamePError'+counterPass+'\',this.id)" /><span id="middleNamePError'+counterPass+'"></span></td><td>\n\
<input type="text" name="sir_name" id="surName'+counterPass+'" class="form-control" placeholder="Sur Name" onkeypress="removeerror(\'surNameError'+counterPass+'\',this.id)" onkeyup="onlyletterWithSpace(\'surNameError'+counterPass+'\',this.id)"  /><span id="surNameError'+counterPass+'"></span></td><td>\n\
<input type="text" name="age" id="age'+counterPass+'" class="form-control"  placeholder="dd/mm/yy" /></td><td>\n\
<input type="text" name="salePrice" id="salePrice'+counterPass+'" class="form-control" onkeypress="removeerror(\'salePriceError'+counterPass+'\',this.id)" onkeyup="numberWithDeceimal(\'salePriceError'+counterPass+'\',this.id)" onchange="calcul_totao_c(this.value)"  value="0" placeholder="Sale Price" /><span id="salePriceError'+counterPass+'"></span></td><td>\n\
<input type="text" name="booking_fee" id="bookingFee'+counterPass+'" onkeypress="removeerror(\'bookingFeeError'+counterPass+'\',this.id)" onkeyup="numberWithDeceimal(\'bookingFeeError'+counterPass+'\',this.id)" class="form-control"  placeholder="Admin Fee" /><span id="bookingFeeError'+counterPass+'"></span></td><td>\n\
<input type="text" name="eticket" id="" class="form-control" readonly="" placeholder="Eticket Number"  /></td><td><button class="btn btn-primary btn-round" type="button" onclick="editPassangerAdd('+counterPass+')">Save</button><td>';
//    main_tr.appendChild(tr);
    $('#updatePassMore').html(tr);
    $('#updatePassMore').show();
    hideLoder();
 }
 //
 function payingMethodCheck(paymethod)
 {
     showLoder();
     if(paymethod=="Card")
     {
         $('#cardRow').show();
         $('#cardRow2').show();
         $('#cardRow3').show();
         $('#issuingBank').hide();
         $('#issuningBnakname').hide();
         $('#issuningBnakname').show();
         $('#cardBrandLabel').hide();
         $('#cardBrandInput').hide();
         $('#bookingChargeFor').attr('style','display:inline-flex');
         $('#amountConfirmOrCharge').text('New Booking Charge');
//         $('#cardRow4').show();
         $('#cardNumber').attr('required',true);
         $('#validFrom').attr('required',true);
         $('#cardHolderName').attr('required',true);
         $('#cardExpiry').attr('required',true);
         $('#receiptMode').attr('required',true);
         $('#securityCode').attr('required',true);
         $('#postalAddress').removeAttr('readonly');
         hideLoder();
     }
     else if(paymethod=="Bank")
     {
         $('#cardRow').hide();
         $('#cardRow2').hide();
         $('#cardRow3').hide();
         $('#cardRow4').hide();
         $('#issuingBank').hide();
         $('#issuningBnakname').hide();
         $('#issuningBnakname').hide();
         $('#cardBrandLabel').hide();
         $('#cardBrandInput').hide();
         $('#bookingChargeFor').attr('style','display:inline-flex');
         $('#amountConfirmOrCharge').text('New Booking Confirm');
//         $('#cardRow4').hide();
         $('#cardNumber').removeAttr('required');
         $('#validFrom').removeAttr('required');
         $('#cardHolderName').removeAttr('required');
         $('#cardExpiry').removeAttr('required');
//         $('#receiptMode').removeAttr('required');
         $('#securityCode').removeAttr('required');
         $('#postalAddress').attr('readonly',true);
         hideLoder();
     }
     else
     {
         $('#cardRow').hide();
         $('#cardRow2').hide();
         $('#issuningBnakname').hide();
         $('#cardRow3').hide();
         $('#cardRow4').hide();
         $('#cardBrandLabel').hide();
         $('#cardBrandInput').hide();
         $('#issuingBank').hide();
         $('#issuningBnakname').hide();
          $('#bookingChargeFor').hide();
         $('#amountConfirmOrCharge').text('New Booking Confirm');
//         $('#cardRow4').hide();
         $('#cardNumber').removeAttr('required');
         $('#validFrom').removeAttr('required');
         $('#cardHolderName').removeAttr('required');
         $('#cardExpiry').removeAttr('required');
//         $('#receiptMode').removeAttr('required');
         $('#securityCode').removeAttr('required');
         hideLoder();
     }
 }
 function cardValidCheck(cardNumber)
 {
     var cardNumer=$('#'+cardNumber).val();
     if(cardNumer!='')
     {
          showLoder();
         $.ajax({
            type:'POST',
            url:ajaxUrl+'CardCheckBox',
            data:{cardNumber:cardNumer},
            cache:false,
            success:function(resp)
            {
                if(resp)
                {
                    var respArray=resp.split('%');
                    $('#issuingBankNa').attr('style','display:table-cell');
                    $('#issuningBnakname').attr('style','display:table-cell');
                    $('#issuingBank').show();
                    $('#issuingBank').val(respArray[1]);
                    $('#cardType').val(respArray[0]);
                    $('#cardBrand').val(respArray[2]);
                    $('#cardRow4').show();
                    $('#cardBrandLabel').show();
                    $('#cardBrandInput').show();
                    hideLoder();
                }
            }
         });
     }
     else
     {
        hideLoder(); 
     }
 }
 
 function cardValidCheck2(cardNumer)
 {
     showLoder();
     var cardValue=$('#'+cardNumer).val();
     if(cardValue!='')
     {
         $.ajax({
            type:'POST',
            url:ajaxUrl+'CardCheckBox',
            data:{cardNumber:cardValue},
            cache:false,
            success:function(resp)
            {
                if(resp)
                {
                    var respArray=resp.split('%');
//                    $('#issuingBankNa').attr('style','display:table-cell');
//                    $('#issuningBnakname').attr('style','display:table-cell');
//                    $('#issuingBank').show();
                    $('#AddNewCard #cardIssueBank').val(respArray[1]);
                    $('#AddNewCard #cardTypeModal').val(respArray[0]);
                    $('#AddNewCard #cardBandModal').val(respArray[2]);
//                    $('#cardRow4').show();
//                    $('#cardBrandLabel').show();
//                    $('#cardBrandInput').show();
                    hideLoder();
                }
            }
         });
     }
     else
     {
        hideLoder(); 
     }
 }
 
 function cardValidCheck3(cardNumer)
 {
     showLoder();
     var cardValue=$('#'+cardNumer).val();
     if(cardValue!='')
     {
         $.ajax({
            type:'POST',
            url:ajaxUrl+'CardCheckBox',
            data:{cardNumber:cardValue},
            cache:false,
            success:function(resp)
            {
                if(resp)
                {
                    var respArray=resp.split('%');
//                    $('#issuingBankNa').attr('style','display:table-cell');
//                    $('#issuningBnakname').attr('style','display:table-cell');
//                    $('#issuingBank').show();
                    $('#AddNewCard #cardIssueBankEdit').val(respArray[1]);
                    $('#AddNewCard #cardTypeModalEdit').val(respArray[0]);
                    $('#AddNewCard #cardBandModalEdit').val(respArray[2]);
//                    $('#cardRow4').show();
//                    $('#cardBrandLabel').show();
//                    $('#cardBrandInput').show();
                    hideLoder();
                }
            }
         });
     }
     else
     {
        hideLoder(); 
     }
 }
 function saveNewCardData()
 {
     
     var cardNumber=$('#newCardNumber').val();
     var bookingNumberCard=$('#forCardBooking').val();
     var cardHolderName=$('#cardHolderNew').val();
     var cardValid=$('#validFromNew').val();
     var cardExpiryDate=$('#expiryDateNew').val();
     var cardCvv=$('#cvvNew').val();
     var cardIssingBank=$('#cardIssueBank').val();
     var cardBrand=$('#cardBandModal').val();
     var cardType=$('#cardTypeModal').val();
     var cardNewAddress=$('#cardAddressNew').val();
     var paymentDueDate=$('#paymentDueDate').val();
     var cardAddressType=$('#cardAddressNewType option:selected').val();
     if(cardNumber==''){ alertify.alert('Please Fill all Data Correctly '); return false; }
     if(cardHolderName==''){ alertify.alert('Please Fill all Data Correctly '); return false; }
     if(cardValid==''){ alertify.alert('Please Fill all Data Correctly '); return false; }
     if(cardExpiryDate==''){ alertify.alert('Please Fill all Data Correctly '); return false; }
     if(cardCvv==''){ alertify.alert('Please Fill all Data Correctly '); return false; }
     if(cardAddressType==''){ alertify.alert('Please Fill all Data Correctly '); return false; }
     if(cardAddressType!=''){ 
         if(cardAddressType=='different')
         {
             if(cardNewAddress=='')
             {
                 alertify.alert('Please Fill all Data Correctly '); return false;
             }
         }
          
     }
     showLoder();
     $.ajax({
         type:'POST',
         url:ajaxUrl+'NewCardBox',
         data:{
             cardNumber:cardNumber,bookingNumberCard:bookingNumberCard,cardHolderName:cardHolderName,cardValid:cardValid,
             cardExpiryDate:cardExpiryDate,cardCvv:cardCvv,cardIssingBank:cardIssingBank,cardBrand:cardBrand,cardType:cardType,
             cardNewAddress:cardNewAddress,cardAddressType:cardAddressType,paymentDueDate:paymentDueDate
                },
         cache:false,
         success:function(resp)
         {
             if(resp>0)
             {
               $('#AddNewCard #addCardForm')[0].reset();
               $('#AddNewCard').modal('hide');
                hideLoder();
               alertify.success('New Card Added Successfully !');
               location.reload();
               
             }
             else
             {
               $('#AddNewCard #addCardForm')[0].reset();
               $('#AddNewCard').modal('hide');
                hideLoder();
               alertify.error('Network Error Occer Please try Again or contact Developer !');
             }
         }
     });
     
 }
 function editOldCard(cardId)
 {
//     alert(cardId);
     if(cardId!='')
     {
     $.ajax({
         type:'POST',
         url:ajaxUrl+'GetCardBox',
         data:{cardId:cardId},
         cache:false,
         success:function(resp)
         {
             var objCard=JSON.parse(resp);
             if(objCard)
             {
                 
                 $('#EditOldCard #editCardNumber').val(objCard.card_number);
                 $('#EditOldCard #forCardBookingEdit').val(objCard.booking_id);
                 $('#EditOldCard #cardHolderEditName').val(objCard.cardHolderName);
                 $('#EditOldCard #vaildFromEdit').val(objCard.validFrom);
                 $('#EditOldCard #expiryDateEdit').val(objCard.expiryDate);
                 $('#EditOldCard #editCvv').val(objCard.cvv);
                 $('#EditOldCard #cardIssueBankEdit').val(objCard.cardIssuingBank);
                 $('#EditOldCard #cardBandModalEdit').val(objCard.cardBrand);
                 $('#EditOldCard #cardTypeModalEdit').val(objCard.cardType);
                 $('#EditOldCard #paymentDueDate').val(objCard.paymentDue_date+' '+objCard.paymentDueTime);
                 $('#EditOldCard #cardIdEdit').val(objCard.id);
                 $('#EditOldCard').modal('show');
             }
             else
             {
                 alertify.alert('Network error Please try Again !');
             }
         }
     });
 }
 else
 {
     alertify.alert('Network error Please try Again !');
 }
 }
 function updateCardData()
 {
     var cardNumber=$('#editCardNumber').val();
     var cardId=$('#cardIdEdit').val();
     var bookingNumberCard=$('#forCardBookingEdit').val();
     var cardHolderName=$('#cardHolderEditName').val();
     var cardValid=$('#vaildFromEdit').val();
     var cardExpiryDate=$('#expiryDateEdit').val();
     var cardCvv=$('#editCvv').val();
     var cardIssingBank=$('#cardIssueBankEdit').val();
     var cardBrand=$('#cardBandModalEdit').val();
     var cardType=$('#cardTypeModalEdit').val();
     var paymentDueDate=$('#paymentDueDate1').val();
//     var cardNewAddress=$('#cardAddressEdit').val();
//     var cardAddressType=$('#cardAddressNewType option:selected').val();
     if(cardNumber==''){ alertify.alert('Please Fill all Data Correctly '); return false; }
     if(cardHolderName==''){ alertify.alert('Please Fill all Data Correctly '); return false; }
     if(cardValid==''){ alertify.alert('Please Fill all Data Correctly '); return false; }
     if(cardExpiryDate==''){ alertify.alert('Please Fill all Data Correctly '); return false; }
     if(cardCvv==''){ alertify.alert('Please Fill all Data Correctly '); return false; }
//     if(cardAddressType==''){ alertify.alert('Please Fill all Data Correctly '); return false; }
//      if(cardNewAddress=='')
//             {
//                 alertify.alert('Please Fill all Data Correctly '); return false;
//             }
     showLoder();
     $.ajax({
         type:'POST',
         url:ajaxUrl+'CardBoxUpdate',
         data:{
             cardNumber:cardNumber,bookingNumberCard:bookingNumberCard,cardHolderName:cardHolderName,cardValid:cardValid,
             cardExpiryDate:cardExpiryDate,cardCvv:cardCvv,cardIssingBank:cardIssingBank,cardBrand:cardBrand,cardType:cardType,
             cardId:cardId,paymentDueDate:paymentDueDate
                },
         cache:false,
         success:function(resp)
         {
             if(resp>0)
             {
               
               $('#EditOldCard').modal('hide');
                hideLoder();
               alertify.success('Card Update Successfully !');
               location.reload();
               
             }
             else
             {
               
               $('#EditOldCard').modal('hide');
                hideLoder();
               alertify.error('Network Error Occer Please try Again or contact Developer !');
             }
         }
     });
     
 }
 function saveform(formID)
 {
//  $("#"+formID).submit(function(e){
//    e.preventDefault();
//  });
    var supplierAgent =$('#supplierAgent').val();
    var customerName=$('#customerName').val();
    var customerEmail=$('#customerEmail').val();
    if(supplierAgent=='')
    {
        $('#supplierAgent').attr('style','border: 1px solid red');
        $('#supplier_agentError').attr('style','color:red');
        $('#supplier_agentError').text('Please Fill the Supplier Agent Name!');
        return false;
    }
    if($('#booking_brand option:selected').val()=="")
    {
       $('#booking_brand').attr('style','border: 1px solid red');
       $('#bookingbrandError').attr('style','color:red');
       $('#bookingbrandError').text('Please Select the Booking Under Brand');
       return false; 
    }
    if(customerName=="")
    {
        $('#customerName').attr('style','border: 1px solid red');
        $('#customerNameError').attr('style','color: red');
        $('#customerNameError').text('Please Fill the Customer Full name');
        return false;  
    }
    if($('#lineNumber').val()=='')
    {
       $('#lineNumber').attr('style','border: 1px solid red');
        $('#lineError').attr('style','color: red');
        $('#lineError').text('Please Fill the Line Number');
        return false;   
    }
//    if($('#postalAddress').val()=='')
//    {
//        $('#postalAddress').attr('style','border: 1px solid red');
//        $('#postalError').attr('style','color: red');
//        $('#postalError').text('Please Fill the Postal Address');
//        return false;   
//    }
    if($('#mobileNumber').val()=='')
    {
        $('#mobileNumber').attr('style','border: 1px solid red');
        $('#mobileError').attr('style','color: red');
        $('#mobileError').text('Please Fill the Mobile Number');
        return false;   
    }
    if(customerEmail=='')
    {
        $('#customerEmail').attr('style','border: 1px solid red');
        $('#customerEmailError').attr('style','color: red');
        $('#customerEmailError').text('Please Fill the Customer Email');
        return false;  
    }
    if($('#sourceBooking option:selected').val()=='')
    {
        $('#sourceBooking').attr('style','border: 1px solid red');
        $('#sourceBookingError').attr('style','color: red');
        $('#sourceBookingError').text('Please Select The Source Of Booking');
        return false; 
    }
    if($('#payingMethod option:selected').val()=="")
    {
        $('#payingMethod').attr('style','border: 1px solid red');
        $('#payingError').attr('style','color: red');
        $('#payingError').text('Please Select The Paying Method');
        return false; 
    }
    if($('#payingMethod option:selected').val()=="Card")
    {
            if($('#postalAddress').val()=='')
            {
                $('#postalAddress').attr('style','border: 1px solid red');
                $('#postalError').attr('style','color: red');
                $('#postalError').text('Please Fill the Postal Address');
                return false;   
            }
        if($('#cardNumber').val()=='')
        {
            $('#cardNumber').attr('style','border: 1px solid red');
            $('#cardNumberError').attr('style','color: red');
            $('#cardNumberError').text('Please Enter the 16 Digit Card Number');
            return false; 
        }
        if($('#validFrom').val()=="")
        {
            $('#validFrom').attr('style','border: 1px solid red');
            $('#validFromError').attr('style','color: red');
            $('#validFromError').text('Please Enter the Valid From Date');
            return false; 
        }
        if($('#cardHolderName').val()=="")
        {
            $('#cardHolderName').attr('style','border: 1px solid red');
            $('#cardHolderError').attr('style','color: red');
            $('#cardHolderError').text('Please Enter the Card Holder Name');
            return false; 
        }
        if($('#cardExpiry').val()=="")
        {
            $('#cardExpiry').attr('style','border: 1px solid red');
            $('#expiryDateError').attr('style','color: red');
            $('#expiryDateError').text('Please Enter the Card Expiry Date');
            return false; 
        }
        if($('#securityCode').val()=="")
        {
            $('#securityCode').attr('style','border: 1px solid red');
            $('#securityCodeError').attr('style','color: red');
            $('#securityCodeError').text('Please Enter 3 Digit CVV');
            return false; 
        }
        var cardHolderName=$('#cardHolderName').val();
       for(var k=0;k<=passCount;k++)
        {
             var surName=$('#surName'+k).val();
             if(cardHolderName.includes(surName)==true)
           {
             // return true;
              break;
           }
           else
           {
               alertify.alert('Talk To Account Department ');
               return false; 
           }
        }
    }
    if($('#paymentDueDate').val()=="")
    {
        $('#paymentDueDate').attr('style','border: 1px solid red');
        $('#paymentDueDateError').attr('style','color: red');
        $('#paymentDueDateError').text('Please Select The Payment Due Date');
        return false; 
    }
    if($('#amountCharged').val()=="")
    {
        $('#amountCharged').attr('style','border: 1px solid red');
        $('#amountChargeError').attr('style','color: red');
        $('#amountChargeError').text('Please Enter Amount For New Booking');
        return false;  
    }
    if($('#bookingDeparture').val()=="")
    {
       $('#bookingDeparture').attr('style','border: 1px solid red');
       $('#departureAirportError').attr('style','color: red');
       $('#departureAirportError').text('Please Enter The Departure Airport');
       return false;   
    }
    if($('#bookingDestination').val()=="")
    {
      $('#bookingDestination').attr('style','border: 1px solid red');
      $('#destinationError').attr('style','color: red');
      $('#destinationError').text('Please Enter The Destination Airport');
      return false;
    }
    if($('#bookingVia').val()=="")
    {
      $('#bookingVia').attr('style','border: 1px solid red');
      $('#viaError').attr('style','color: red');
      $('#viaError').text('Please Enter the Via');
      return false;
    }
    if($('#flightType option:selected').val()=="")
    {
      $('#flightType').attr('style','border: 1px solid red');
      $('#flightTypeError').attr('style','color: red');
      $('#flightTypeError').text('Please Select the Flight Type');
      return false;
    }
    if($('#flightType option:selected').val()=='Return')
    {
        if($('#bookingVia').val()=='')
        {
            $('#bookingVia').attr('style','border: 1px solid red');
            $('#viaError').attr('style','color: red');
            $('#viaError').text('Please Enter the Going Via');
            return false;
        }
        if($('#bookingViaReturning').val()=='')
        {
            $('#bookingViaReturning').attr('style','border: 1px solid red');
            $('#viaErrorReturn').attr('style','color: red');
            $('#viaErrorReturn').text('Please Enter the Returing Via');
            return false;
        }
         if($('#returnBookingDate').val()=="")
        {
          $('#returnBookingDate').attr('style','border: 1px solid red');
          $('#returnDateError').attr('style','color: red');
          $('#returnDateError').text('Please Select the Returning Date');
          return false;
        }
    }
    if($('#flightType option:selected').val()=='One Way')
    {
        if($('#bookingVia').val()=='')
        {
            $('#bookingVia').attr('style','border: 1px solid red');
            $('#viaError').attr('style','color: red');
            $('#viaError').text('Please Enter the Going Via');
            return false;
        }
    }
    if($('#departureDate').val()=="")
    {
      $('#departureDate').attr('style','border: 1px solid red');
      $('#DepartureDateError').attr('style','color: red');
      $('#DepartureDateError').text('Please Select the Departure Date');
      return false;
    }
   
    if($('#bookingAirline').val()=="")
    {
      $('#bookingAirline').attr('style','border: 1px solid red');
      $('#airlineError').attr('style','color: red');
      $('#airlineError').text('Please Enter the Booking Airline');
      return false; 
    }
    if($('#flightNo').val()=="")
    {
      $('#flightNo').attr('style','border: 1px solid red');
      $('#flightNoError').attr('style','color: red');
      $('#flightNoError').text('Please Enter the Flight Number');
      return false; 
    }
    if($('#flightClass option:selected').val()=="")
    {
      $('#flightClass').attr('style','border: 1px solid red');
      $('#flightClassError').attr('style','color: red');
      $('#flightClassError').text('Please Select the Flight Class');
      return false; 
    }
//    if($('#noOfSegments').val()=="")
//    {
//      $('#noOfSegments').attr('style','border: 1px solid red');
//      $('#noOfSegmentsError').attr('style','color: red');
//      $('#noOfSegmentsError').text('Please Enter the Number Of Segments');
//      return false;  
//    }
    if($('#pnr').val()=='')
    {
      $('#pnr').attr('style','border: 1px solid red');
      $('#pnrError').attr('style','color: red');
      $('#pnrError').text('Please Enter the PNR');
      return false;   
    }
    if($('#pnrExpireDate').val()=="")
    {
      $('#pnrExpireDate').attr('style','border: 1px solid red');
      $('#pnrExpiryDateError').attr('style','color: red');
      $('#pnrExpiryDateError').text('Please Select The PNR Expiry Date');
      return false;  
    }
    if($('#gds').val()=="")
    {
      $('#gds').attr('style','border: 1px solid red');
      $('#gdsError').attr('style','color: red');
      $('#gdsError').text('Please Enter The GDS');
      return false;  
    }
    if($('#fareExpireDate').val()=="")
    {
      $('#fareExpireDate').attr('style','border: 1px solid red');
      $('#fareExpiryError').attr('style','color: red');
      $('#fareExpiryError').text('Please Enter The GDS');
      return false; 
    }
//    if($('#editor2').val()=='')
//    {
//         $('#editor2').attr('style','border: 1px solid red');
//         $('#systemFlightDetailsError').attr('style','color: red');
//         $('#systemFlightDetailsError').text('Please Paste The System Flight Details');
//         return false;
//    }
//    if($('#noOfSegments').val()==0)
//    {
//      $('#basicFare').attr('style','border: 1px solid red');
//      $('#basicFareError').attr('style','color: red');
//      $('#basicFareError').text('Your System Flight Details are not confirm .Please Conform Them');
//      return false;
//    }
    if($('#basicFare').val()=="" && $('#basicFare').val()=="0")
    {
      $('#basicFare').attr('style','border: 1px solid red');
      $('#basicFareError').attr('style','color: red');
      $('#basicFareError').text('Please Enter The Basic Fare');
      return false;
    }
    if($('#tax').val()=="" && $('#tax').val()=="0")
    {
      $('#tax').attr('style','border: 1px solid red');
      $('#taxError').attr('style','color: red');
      $('#taxError').text('Please Enter The Tax');
      return false; 
    }
    var passCount=parseInt($('#countrPassenger').val());
    for(var j=0;j<=passCount;j++)
    {
       if($('#firstName'+j).val()=="")
       {
           $('#firstName'+j).attr('style','border: 1px solid red');
           $('#firstNameError'+j).attr('style','color: red');
           $('#firstNameError'+j).text('please Enter the First Name');
           return false; 
       }
       if($('#salePrice'+j).val()==0 && $('#salePrice'+j).val()=="")
       {
          $('#salePrice'+j).attr('style','border: 1px solid red');
          $('#salePriceError'+j).attr('style','color: red');
          $('#salePriceError'+j).text('please Enter the Sale Price');
          return false;  
       }
       //var surName=$('#surName'+j).val();
       
    }
  // var datapost=$("#"+formID).serialize();
  // var hhh =JSON.stringify(datapost);
  showLoder();
 //var data= $("#"+formID).serialize();
 //console.log(data);
  $("#"+formID).attr('action','SaveBooking');
  $("#"+formID).removeAttr('onsubmit');
  $("#"+formID).submit();
  //hideLoder();
   //console.log(hhh);
//   $("#"+formID).serialize();
    //showLoder();
       //var datastring = JSON.stringify(data);
//    console.log(datastring);
//    $.ajax({
//        type:'POST',
//        url:'<?php echo base_url() ?>SaveBooking',
//        //dataType : 'json',
//        //contentType: 'application/json',
//        dataType : 'json', // data type
//        data : {dataForm:datastring},
//        //data:{formdata:datastring},
//        cache:false,
//        success:function(res)
//        {
//            if(res >0 )
//            {
//                //$("#"+formID).
//                alertify.alert('Booking Saved Successfully');
//               hideLoder(); 
//            }
//            else
//            {
//                alertify.alert('Network Error');
//                hideLoder();
//            }
//        }
//    });
    
    
 }
 
 function removeerror(spanId,fieldId)
 {
     $('#'+spanId).text(' ');
     $('#'+fieldId).attr('style','border:1px solid green');
 }
 function onlyLetter()
 {
     if(!frm.supplierAgent.value.match(/^[a-zA-Z]+$/) && frm.supplierAgent.value !=""){
        //alert('Only Letters Enter No special Character');
        $('#supplierAgent').attr('style','border: 1px solid red');
        $('#supplier_agentError').attr('style','color:red');
        $('#supplier_agentError').text('Only Letters  No Digits No Space ');
       // frm.supplier_agent.value='';
        return false;
    }
    else
    {
        $('#supplier_agentError').text('');
    }
 }
 function onlyletterWithSpace(errorId,fieldID)
 {
     var fieldvalue=$('#'+fieldID).val();
     if(!fieldvalue.match(/^[a-zA-Z\s]+$/) && fieldvalue !=""){
        //alert('Only Letters Enter No special Character');
        //$('#customerName').attr('style','border: 1px solid red');
        $('#'+errorId).attr('style','color:red');
        $('#'+errorId).text('No Digits No Special Character');
        //frm.name.value='';
        return false;
    }
    else
    {
        $('#'+errorId).text('');
    }
 }
 function onlyletterWithSpaceWithDash(errorId,fieldID)
 {
     var fieldvalue=$('#'+fieldID).val();
     if(!fieldvalue.match(/^[a-zA-Z\s-]+$/) && fieldvalue !=""){
        //alert('Only Letters Enter No special Character');
        //$('#customerName').attr('style','border: 1px solid red');
        $('#'+errorId).attr('style','color:red');
        $('#'+errorId).text('No Digits No Special Character');
        //frm.name.value='';
        return false;
    }
    else
    {
        $('#'+errorId).text('');
    }
 }
 function onlyDigits(errorId)
 {
      
     if(!frm.lineNumber.value.match(/^[0-9]+$/) && frm.lineNumber.value !=""){
        //alert('Only Letters Enter No special Character');
        $('#'+errorId).attr('style','color:red');
        $('#'+errorId).text('line Number Contain  Only 11 Digits');
        //frm.name.value='';
        return false;
    }
    else
    {
        $('#'+errorId).text('');
    }
 }
 function onlyDigits2(errorId)
 {
    
     if(!frm.mobileNumber.value.match(/^[0-9]+$/) && frm.mobileNumber.value !=""){
        //alert('Only Letters Enter No special Character');
        $('#'+errorId).attr('style','color:red');
        $('#'+errorId).text('Mobile Number Contain Only 11 Digits ');
        //frm.name.value='';
        return false;
    }
    else
    {
        $('#'+errorId).text('');
    }
 }
 function alphaNumeric(errorId,fieldId)
 {
      var fieldvalue=$('#'+fieldId).val();
     if(!fieldvalue.match(/^[a-zA-Z0-9]+$/) && fieldvalue !=""){
        //alert('Only Letters Enter No special Character');
        //$('#customerName').attr('style','border: 1px solid red');
        $('#'+errorId).attr('style','color:red');
        $('#'+errorId).text('No Special Character');
        //frm.name.value='';
        return false;
    }
    else
    {
        $('#'+errorId).text('');
    }
 }
 function alphaNumericWithDash(errorId,fieldId)
 {
      var fieldvalue=$('#'+fieldId).val();
     if(!fieldvalue.match(/^[a-zA-Z0-9\s-]+$/) && fieldvalue !=""){
        //alert('Only Letters Enter No special Character');
        //$('#customerName').attr('style','border: 1px solid red');
        $('#'+errorId).attr('style','color:red');
        $('#'+errorId).text('No Special Character');
        //frm.name.value='';
        return false;
    }
    else
    {
        $('#'+errorId).text('');
    }
 }
 function onlyNumber(errorId,fieldId)
 {
    // alert('SHAHID');
     var fieldvalue=$('#'+fieldId).val();
    // alert(fieldvalue);
     if(!fieldvalue.match(/^[0-9]+$/) && fieldvalue !=""){
        //alert('Only Letters Enter No special Character');
        //$('#customerName').attr('style','border: 1px solid red');
        $('#'+errorId).attr('style','color:red');
        $('#'+errorId).text('Only Digits No Special Character');
        //frm.name.value='';
        return false;
    }
    else
    {
        $('#'+errorId).text('');
    } 
 }
 function onlyAlphabet(errorId,fieldId)
 {
      var fieldvalue=$('#'+fieldId).val();
    if(!fieldvalue.match(/^[a-zA-Z]+$/) && fieldvalue !=""){
        $('#'+errorId).attr('style','color:red');
        $('#'+errorId).text('Only Alephabets No Special Character');
        return false;
    }
    else
    {
        $('#'+errorId).text('');
    } 
 }
 function numberWithDeceimal(errorId,fieldId)
 {
     var fieldvalue=$('#'+fieldId).val();
     if(!fieldvalue.match(/^[0-9.]+$/) && fieldvalue !=""){
        //alert('Only Letters Enter No special Character');
        //$('#customerName').attr('style','border: 1px solid red');
        $('#'+errorId).attr('style','color:red');
        $('#'+errorId).text('Only Digits No Special Character Except Deceimal');
        //frm.name.value='';
        return false;
    }
    else
    {
        $('#'+errorId).text('');
    }  
 }
 function removeCompany(removeId)
 {
    // alert(removeId);
     alertify.confirm("Are You Sure To Delete Company?",
            function(ev){
                if(ev){
                    showLoder();
                    $.ajax({
                      type:'POST',
                      url:ajaxUrl+'ComapanyDeleteBox',
                      data:{companyId:removeId},
                      cache:false,
                      success:function(resp)
                      {
                          if(resp >0)
                          {
                              hideLoder();
                              $('#removeRow'+resp).remove();
                              alertify.success('Company Deleted Successfully !');
//                              location.reload();
                          }
                          else
                          {
                              hideLoder();
                              alertify.error('Company Not Deleted Network Error Occur !');
                          }
                      }
                    });
                    }
                    else
                    {
                      hideLoder();
                      alertify.error('You Have Cancelled The Operation');
                    }
            },
              function(){
              hideLoder();
                alertify.error('You Have Cancelled The Operation');
              });
 }
 function agentRemove(agentId)
 {
     alertify.confirm("Are You Sure To Delete Agent",function(ev){
         if(ev)
         {
              showLoder();
              $.ajax({
                type:'POST',
                url:ajaxUrl+'AgentDeleteBox',
                data:{agentID:agentId},
                cache:false,
                success:function(resp)
                {
                    if(resp >0)
                    {
                        hideLoder();
                        $('#agentRemove'+resp).remove();
                        alertify.success('Agent Deleted Successfully !');
                    }
                    else
                    {
                        hideLoder();
                         alertify.error('Agent Not Deleted Network Error Occur !');
                    }
                }
              });
         }
         else
         {
            hideLoder();
            alertify.error('You Have Cancelled The Operation'); 
         }
     });
 }
 function bookingDetailsLoad(bookingId)
 {
     //alert(bookingId);
     $.ajax({
         type:'POST',
         url:ajaxUrl+'BookingDetailBox',
         data:{bookId:bookingId},
         cache:false,
         success:function(res)
        {
           
           
        }
     });
 }
 function passengerDelete(passengerId)
 {
     alertify.confirm('Do you want to delete passenger?',function(ev){
         if(ev)
         {
             showLoder();
             $.ajax({
                 type:'POST',
                 url:ajaxUrl+'PassengerDeleteBox',
                 data:{passengerId:passengerId},
                 cache:false,
                 success:function(res)
                {
                    if(res >0)
                    {
                      hideLoder();
                      $('#passRow'+passengerId).remove();
                      var oldpas=parseInt($('#countrPassenger').val());
                      var newpass=oldpas-1;
                      $('#countrPassenger').val(newpass);
                       alertify.success('Passenger Deleted Successfully !');
                    }
                    else
                    {
                        hideLoder();
                        alertify.error('Network Error Occer Please try Again');
                    }
                    
                }
                
             });
         }
         else
         {
             hideLoder();
             alertify.error('You Have Canceled The Operation');
         }
     });
 }
 $('#paymentRowAdd').click(function()
 {
     showLoder();
     $('#paymentNew').slideToggle('slow');
     hideLoder();
 });
 function cancelPayment()
 {
      showLoder();
      $('#paymentNew').hide(2000);
      hideLoder();
 }
 function passengerEditRowShow(passengerId)
 {
     showLoder();
     $('#passRow'+passengerId).hide();
     $('#passRowEdit'+passengerId).show(4000);
     hideLoder();
 }
 function cancelEditPassenger(passengerId)
 {
      showLoder();
     $('#passRowEdit'+passengerId).hide();
     $('#passRow'+passengerId).show(5000);
     hideLoder();
 }
 function passengerEidtForm(passengerId)
 {
     showLoder();
     var category=$('#category'+passengerId+' option:selected').val();
     var passengerTitle=$('#passangerTitle'+passengerId+' option:selected').val();
     var firstName=$('#firstName'+passengerId).val();
     var middleName=$('#middle_name'+passengerId).val();
     var sirName=$('#sir_name'+passengerId).val();
     var age=$('#age'+passengerId).val();
     var salePrice=$('#salePrice'+passengerId).val();
     var bookingFee=$('#bookingFee'+passengerId).val();
     var eticket=$('#eticlet'+passengerId).val();
     $.ajax({
         type:'POST',
         url:ajaxUrl+'PassengerUpdateBox',
         cache:false,
         data:{passengerId:passengerId,category:category,passengerTitle:passengerTitle,firstName:firstName,middleName:middleName,sirName:sirName,age:age,salePrice:salePrice,bookingFee:bookingFee,eticket:eticket},
         success:function(resp)
         {
             if(resp >0)
             {
                  hideLoder();
                  alertify.success('Requested Process Updated Successfully !');
                  location.reload();
             }
             else
             {
                  hideLoder();
                  alertify.error('Network Error Occer Please try Again');
                  location.reload();
             }
         }
     });
    
 }
 //Save Payment
 function savePayment(bookingId)
 {
     $('#paymentSaveBtn').attr('disabled',true);
    showLoder();
    var receiverName=$('#receiverName option:selected').val();
    var paymentDate=$('#paymentAddDate').val();
    var receiptVia=$('#receipt_via option:selected').val();
    var cardtype=$('#card_type option:selected').val();
    var authorized=$('#authorizedCode').val();
    var amount=$('#amount').val();
    var paymentReference=$('#paymentReference').val();
    if(receiptVia=='')
    {
       $('#receipt_via').attr('style','border: 1px solid red');
       $('#receipt_viaError').attr('style','color: red');
       $('#receipt_viaError').text('Please Select The payment Type');
       $('#paymentSaveBtn').removeAttr('disabled');
        hideLoder();
        return false; 
    }
    if(receiptVia=='1')
    {
        if(cardtype=='')
        {
            $('#card_type').attr('style','border: 1px solid red');
            $('#card_typeError').attr('style','color: red');
            $('#card_typeError').text('Please Select The Card Type');
            $('#paymentSaveBtn').removeAttr('disabled');
             hideLoder();
             return false;  
        }
    }
    if(amount=='' || amount=='0')
    {
        $('#amount').attr('style','border: 1px solid red');
        $('#amountError').attr('style','color: red');
        $('#amountError').text('Please Enter The Amount');
        $('#paymentSaveBtn').removeAttr('disabled');
         hideLoder();
        return false;
    }
    if(paymentDate=='')
    {
        $('#paymentAddDate').attr('style','border: 1px solid red');
        $('#paymentDateError').attr('style','color: red');
        $('#paymentDateError').text('Please Select The payment Date');
        $('#paymentSaveBtn').removeAttr('disabled');
         hideLoder();
        return false;
    }
    $.ajax({
        type:'POST',
        url:ajaxUrl+'PaymentBoxAdd',
        data:{bookingId:bookingId,receiverName:receiverName,paymentDate:paymentDate,receiptVia:receiptVia,cardType:cardtype,authorizedCode:authorized,amount:amount,paymentReference:paymentReference},
        cache:false,
        success:function(resp)
        {
            if(resp >0)
            {
                $('#paymentSaveBtn').removeAttr('disabled');
                hideLoder(); 
                alertify.success('Payment Add Successfully !');
                location.reload();
            }
            else
            {
                 hideLoder();
                 alertify.error('Network Error Occer Please try Again');
                 $('#paymentSaveBtn').removeAttr('disabled');
            }
        }
        
    });
 }
 //Payment Delete
 function paymentDelete(paymentId)
 {
//     alertify.alert('Under Development !');
     $.ajax({
         type:'POST',
         url:ajaxUrl+'PaymentBoxDelete',
         cache:false,
         data:{paymentId:paymentId},
         success:function(resp)
         {
             var obj=JSON.parse(resp);
//             console.log(obj);
             var drobj='';
             var crObj='';
             if(obj[0].pay_type=='Dr')
             {
                drobj=obj[0];
                crObj=obj[1];
                
             }
            else if(obj[0].pay_type=='Cr')
            {
                drobj=obj[1];
                crObj=obj[0]; 
            }
           $('#DeleteTransaction #transectiondate').text(drobj.pay_date);
           $('#DeleteTransaction #transectionNumberDelete').val(drobj.transectionId);
           $('#DeleteTransaction #drto').text(drobj.pay_to);
           $('#DeleteTransaction #dramount').text(drobj.amount);
           $('#DeleteTransaction #drtotal').text(drobj.amount);
           $('#DeleteTransaction #drbookingRef').text(drobj.booking_ref);
           $('#DeleteTransaction #crby').text(crObj.pay_to);
           $('#DeleteTransaction #cramount').text(crObj.amount);
           $('#DeleteTransaction #crtotal').text(crObj.amount);
           $('#DeleteTransaction #tranIdShow').text(crObj.transectionId);
           $('#DeleteTransaction #crbookingref').text(crObj.booking_ref);
           $('#DeleteTransaction #description').text(crObj.description);
           $('#DeleteTransaction #transectionCard').text(crObj.card_no);
           if(crObj.next_date!='' && crObj.next_date!='0000-00-00')
           {
           $('#DeleteTransaction #nextdatepay').text(crObj.next_date);
            }
           $('#DeleteTransaction').modal('show');
         }
     });
//     return true;
//     showLoder();
//     alertify.confirm('Are Yor Sure To Delete payment?',function(ev){
//         if(ev)
//         {
//             $.ajax({
//                 type:'POST',
//                 url:ajaxUrl+'PaymentBoxDelete',
//                 data:{paymentId:paymentId},
//                 cache:false,
//                 success:function(resp)
//                {
//                    if(resp >0 )
//                    {
//                       hideLoder(); 
//                       alertify.success('Payment Deleted Successfully !');
//                       location.reload(); 
//                    }
//                    else
//                    {
//                        hideLoder();
//                        alertify.error('Network Error Occer Please try Again');
//                    }
//                }
//             });
//         }
//         else
//         {
//             hideLoder();
//             alertify.error('You Have Cancel The operation');
//         }
//     });
 }
 //
 function deleteConfirmPayment()
 {
     alertify.confirm('Are you Sure to Delete This Payment ?',function(ev){
         if(ev)
         {
             showLoder();
             var transectionIdDel=$('#transectionNumberDelete').val();
             $.ajax({
                 type:'POST',
                 url:ajaxUrl+'ConfirmDeleteBoxTransection',
                 data:{transectionIdDel:transectionIdDel},
                 cache:false,
                 success:function(resp)
                 {
                     if(resp>0)
                     {
                         hideLoder();
                         alertify.success('Payement Deledted Successfully !');
                         location.reload();
                     }
                     else
                     {
                        hideLoder(); 
                        alertify.error('Network Error Occer Please try again or Contact to Developer');
                     }
                 }
             });
         }
         else
         {
           $('#DeleteTransaction').modal('hide');  
         }
     });
 }
 //payment Edit Show
 function paymentEditRowShow(paymentId)
 {
     showLoder();
     $('#paymentRecord'+paymentId).hide();
     $('#paymentEditRow'+paymentId).show(5000);
     hideLoder();
 }
 function paymentEditCancel(paymentId)
 {
     showLoder();
     $('#paymentEditRow'+paymentId).hide();
     $('#paymentRecord'+paymentId).show(5000);
     hideLoder();
 }
 function paymentUpdate(paymentId)
 {
     showLoder();
     var receiverName=$('#receiverName'+paymentId+' option:selected').val();
     var receiveVia=$('#receipt_via'+paymentId+' option:selected').val();
     var cardType=$('#card_type'+paymentId+' option:selected').val();
     var authorizedCode=$('#authorizedCode'+paymentId).val();
     var amount=$('#amount'+paymentId).val();
     var paymentReference=$('#paymentReference'+paymentId).val();
     $.ajax({
         type:'POST',
         url:ajaxUrl+'PaymentBoxUpdate',
         data:{paymentId:paymentId,receiverName:receiverName,receiveVia:receiveVia,cardType:cardType,authorizedCode:authorizedCode,amount:amount,paymentReference:paymentReference},
         cache:false,
         success:function(resp)
        {
            if(resp > 0)
            {
                 hideLoder();
                 alertify.success('Payment Updated Successfully !');
                 location.reload(); 
            }
            else
            {
                 hideLoder();
                 alertify.error('Payment Not Updated Successfully !');
                 location.reload(); 
            }
        }
     });
 }
 function editable()
 {
     $('#readonlyView').hide();
     $('#editable').show(500);
 }
 function cancelEditView()
 {
      $('#editable').hide();
      $('#readonlyView').show(500);
 }
 function fliterAttendance()
 {
     showLoder();
     var fliterStartDate=$('#attendanceFilterStartDate').val();
     var filterEndDate=$('#attendanceFilterEndDate').val();
     var agentListFilter=$('#agentListAttendance option:selected').val();
     if(fliterStartDate=='')
     {
        $('#attendanceFilterStartDate').attr('style','border: 1px solid red');
        $('#attendanceFilterStartDateError').attr('style','color: red');
        $('#attendanceFilterStartDateError').text('Please Select The Start Date');
        return false;
     }
     if(filterEndDate=='')
     {
        $('#attendanceFilterEndDate').attr('style','border: 1px solid red');
        $('#attendanceFilterEndDateError').attr('style','color: red');
        $('#attendanceFilterEndDateError').text('Please Select The End Date');
        return false;
     }
     $.ajax({
         type:'POST',
         url:ajaxUrl+'AttendanceFilterBox',
         data:{startDatefilter:fliterStartDate,endDateFilter:filterEndDate,agentList:agentListFilter},
         cache:false,
         success:function(resp)
         {
             if(resp!=0)
             {
                 hideLoder();
                 $('#filterResponse').html(resp);
             }
             else
             {
                  hideLoder();
                  $('#filterResponse').html(resp);
             }
         }
     });
 }
 function stopCountCheck(flightType)
 {
     if(flightType!='')
     {
         if(flightType=='One Way')
         {
              $('#bookingViaReturning').attr('disabled',true);
              $('#reDateOnOnyWey').hide();
         }
         else if(flightType=='Return')
         {
            $('#bookingViaReturning').removeAttr('disabled');
            $('#reDateOnOnyWey').show();
         }
     }
     else
     {
          $('#bookingViaReturning').removeAttr('disabled');
          $('#reDateOnOnyWey').show();
     }
 }

function stopCountTotal(idOfElement)
{
   var noOfSegment=parseInt($('#noOfSegments').val()); 
   var elementArray=$('#'+idOfElement).val();
   var sizes=elementArray.length;
   console.log(elementArray);
   alert(sizes);
//   console.log('Shahid');
   
}
// function issuePop(bookingId)
// {
// $('#gerneralPop #popBody').html('<input type="hidden" value="'+bookingId+'" id="issueBooingId"><input type="text" class="form-control dateclass" id="issuedate">');
// $('#gerneralPop').modal('show');
// }
//
function markAsIssuedModalOpen(bookigId,BtnId)
{
    $('#issuedBokmodal #issuedBookingIdconfirm').val(bookigId);
    $('#issuedBokmodal #IssuedDate').val('');
    $('#issuedBokmodal').modal('show');
}
function markAsIssued()
{
    var bookingIdConfirm=$('#issuedBokmodal #issuedBookingIdconfirm').val();
    var dateIssueConfirm=$('#issuedBokmodal #IssuedDate').val();
    if(dateIssueConfirm=='')
    {
        $('#issuedBokmodal #IssuedDate').attr('style','border: 1px solid red');
        $('#IssuedDateError').attr('style','color: red');
        $('#IssuedDateError').text('Select The Date First');
        
        return false;
    }
    if(bookingIdConfirm!='' && dateIssueConfirm!=='')
    {
        showLoder();
        $.ajax({
            type:'POST',
            url:ajaxUrl+'MarkedAsIssuedBox',
            cache:false,
            data:{ bookingId:bookingIdConfirm,dateIssued:dateIssueConfirm },
            success:function(res)
            {
                if(res >0)
                {
                    hideLoder();
//                   $('#'+BtnId).removeAttr('disabled');
                   window.location=ajaxUrl+'Issued'; 
                }
                else
                {
                    hideLoder();
//                   $('#'+BtnId).removeAttr('disabled');
                   location.reload();
                }
            }
        });
    }
//    $('#'+BtnId).attr('disabled',true);
//    $('#issuedBokmodal').modal('show');
    // here we opeen model 
    // $('#gerneralPop #popBody').html('<input type="text" class="form-control dateclass" id="issuedate">');
    // $('#gerneralPop').modal('show');
//    alertify.confirm('Do You real Mark as Issued ?',function(ev){
//    if(ev)
//    {
//        showLoder();
//        $.ajax({
//            type:'POST',
//            url:ajaxUrl+'MarkedAsIssuedBox',
//            cache:false,
//            data:{ bookingId:bookigId },
//            success:function(res)
//            {
//                if(res >0)
//                {
//                    hideLoder();
//                   $('#'+BtnId).removeAttr('disabled');
//                   window.location=ajaxUrl+'Issued'; 
//                }
//                else
//                {
//                    hideLoder();
//                   $('#'+BtnId).removeAttr('disabled');
//                   location.reload();
//                }
//            }
//        });
//    }
//    else
//    {
//        $('#'+BtnId).removeAttr('disabled');
//        alertify.error('You Have Canceled The Operation');
//    }
//    });
}
function assignBookingTo(bookingId,BtnId)
{
    $('#'+BtnId).attr('disabled',true);
    $('#agentList').unbind();
    showLoder();
    $.ajax({
        type:'POST',
        url:ajaxUrl+'AgentListBox',
        cache:false,
        success:function(resp)
        {
            $('#bookingAssignModel #agentList').html(resp);
             $('#'+BtnId).removeAttr('disabled');
        }
    });
    hideLoder();
    $('#bookingAssignModel #assignBookingId').val(bookingId);
    $('#bookingAssignModel').modal('show');
    
}
function assignBookingDone(bookNowBtn)
{
    $('#'+bookNowBtn).attr('disabled',true);
    var bookingId=$('#assignBookingId').val();
    var agentId=$('#agentList option:selected').val();
    if(agentId=='')
    {
        alertify.error('Select The Agent');
        $('#agentList').focus();
        return false;
    }
    $.ajax({
        type:'POST',
        url:ajaxUrl+'BookAssignBox',
        cache:false,
        data:{bookingId:bookingId,agentId:agentId},
        success:function(respData)
        {
            $('#'+bookNowBtn).removeAttr('disabled');
            location.reload();
        }
    });
}
function markAspending(bookingId,BtnId)
{
//    $('#'+BtnId).attr('disabled',true);
    showLoder();
    alertify.confirm('Do You Really Want To Mark As Red Booking ?',function(ev){
        if(ev)
        {
           $.ajax({
               type:'POST',
               url:ajaxUrl+'PendingTaskBox',
               cache:false,
               data:{bookingId:bookingId},
               success:function(resp)
                {
                    if(resp>0)
                    {
                       window.location=ajaxUrl+'pending-bookings-red-flag'; 
                    }
                    else
                    {
                       hideLoder();
//                       $('#'+BtnId).removeAttr('disabled');
                       alertify.error('Network Error Occer Please Try Again !'); 
                    }
                }
           }); 
        }
        else
        {
            hideLoder();
            $('#'+BtnId).removeAttr('disabled');
            alertify.error('You Have Canceled The Operation');
        }
    });
}
function calculateSigment(systemFlight)
{
    if(systemFlight!='')
    {
        showLoder();
        $.ajax({
            type:'POST',
            url:ajaxUrl+'SegmentCountBox',
            cache:false,
            data:{flightDetails:systemFlight},
            success:function(resp)
            {
                hideLoder();
                if(resp >0)
                {
//               console.log(resp);
                 $('#noOfSegments').val(resp);
                }
                else
                {
                    $('#noOfSegments').val(resp);
                    alertify.alert('Your System Flight Details are not confirm .Please Conform Them');
                }
            }
        });
    }
}
function validateEmail(Email) {
    var pattern = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
    return $.trim(Email).match(pattern) ? true : false;
}
// Supplier Save
function supplierSave()
{
  $('#supplierBtn').attr('diaabled',true);
    showLoder();
    var supplierName=$.trim($('#supplierName').val());
    var supplierEmail=$('#supplierEmailTO').val();
    var supplierEmailcc=$('#supplierEmailcc').val();
    var banks=$('#supplierBank').val();
    var supplierType=$("input[name='supplierType']:checked").val();
    var supplierCountry=$('#supplierCountry option:selected').val();
//    $('#supplierBank :selected').each(function(){
////     banks[$(this).val()]=$(this).val();
//     banks.push($(this).val());
//    });
    if(supplierName=='')
    {
        alertify.error('Please Enter the Supplier Name');
        $('#supplierName').focus();
        $('#supplierBtn').removeAttr('diaabled');
        $('#supplierName').attr('style','border: 1px solid red');
        $('#supplierNameError').attr('style','color: red');
        $('#supplierNameError').text('Please Enter Supplier Name');
         hideLoder();
        return false;
    }
//    if(banks=='')
//    {
//        alertify.error('Please Select the Supplier Bank');
//        $('#supplierBank').focus();
//        $('#supplierBtn').removeAttr('diaabled');
//        $('#supplierBank').attr('style','border: 1px solid red');
//        $('#supplierBankError').attr('style','color: red');
//        $('#supplierBankError').text('Please Select the Supplier Bank');
//         hideLoder();
//        return false;
//    }
    if(supplierEmail!='')
    {
        if(validateEmail(supplierEmail)==true)
        {
            
        }
        else
        {
            alertify.error('Please Enter the valid Email');
            $('#supplierEmailTO').focus();
            $('#supplierBtn').removeAttr('diaabled');
            $('#supplierEmailTO').attr('style','border: 1px solid red');
            $('#supplierEmailTOError').attr('style','color: red');
            $('#supplierEmailTOError').text('Please Enter the valid Email');
            hideLoder();
            return false;
        }
    }
    if(supplierEmailcc!='')
    {
       if(validateEmail(supplierEmailcc)==true)
       {
           
       } 
       else
       {
            alertify.error('Please Enter the valid Email');
            $('#supplierEmailcc').focus();
            $('#supplierBtn').removeAttr('diaabled');
            $('#supplierEmailcc').attr('style','border: 1px solid red');
            $('#supplierEmailccError').attr('style','color: red');
            $('#supplierEmailccError').text('Please Enter the valid Email');
            hideLoder();
            return false;  
       }
    }
    if(supplierType=='')
    {
        alertify.error('Please Select the Supplier type');
         hideLoder();
            return false;  
    }
    if(supplierCountry=='')
    {
        alertify.error('Please Select the Supplier Country');
         hideLoder();
            return false; 
    }
//    console.log(banks);
//    hideLoder();
//    return true;
    $.ajax({
        type:'POST',
        url:ajaxUrl+'SupplierAdd',
        data:{supplierName:supplierName,supplierEmailTo:supplierEmail,supplierEmailcc:supplierEmailcc,supplierBanks:banks,supplierType:supplierType,supplierCountry:supplierCountry},
        cache:false,
        success:function(respSupplier)
        {
            if(respSupplier >0)
            {
               $('#supplierName').val(''); 
               $('#supplierForm')[0].reset();
               $('#supplierNameError').text('');
               $('#supplierModel').modal('hide');
               $('#supplierModel').unbind();
               hideLoder();
               alertify.success('Supplier Added Successfully !');
               location.reload();
            }
            else
            {
                hideLoder(); 
                $('#supplierNameError').text('Please provide The correct Information Than Save');
                alertify.error('Supplier Not Added Network Error Please Try again');
            }
        }
    });
}
// Supplier Delete
function sullpierDelete(sullpierId)
{
    alertify.confirm('Please consult with Director before deleting this head !',function(ev){
       if(ev)
       {
          $.ajax({
              type:'POST',
              url:ajaxUrl+'SupplierDeleteBox',
              data:{supplierId:sullpierId},
              cache:false,
              success:function(res)
              {
                  if(res >0)
                  {
                     hideLoder();
                     $('#supplierId'+sullpierId).remove();
                     alertify.success('Supplier Deleted Successfully !');  
                  }
                  else
                  {
                      hideLoder();
                      alertify.error('Netwok error occer Please try again !');
                  }
              }
          }); 
       } 
       else
       {
         hideLoder();
         alertify.error('You have Canceled the Operation !');  
       }
    });
}
// Supplier Edit 
function editRowSupplier(supplierId)
{
    $('#supplierId'+supplierId).hide();
    $('#supplierEditId'+supplierId).show(1000);
}
function cancelSupplierEdit(supplierId)
{
    $('#supplierEditId'+supplierId).hide();
    $('#supplierId'+supplierId).show(500);
}
//update Request Supplier
function updateSupplier()
{
//    alertify.alert('Sorry Under Development!');
//    return false;
    var supplierId=$('#supplierIdHi').val();
    var email_to=$('#supplierEmailTOEdit').val();
    var email_cc=$('#supplierEmailccEdit').val();
    var supplierBank=$('#supplierBankEdit').val();
    var supplierName=$.trim($('#supplierNameEdit').val());
    if(supplierName!='')
    {
        $.ajax({
           type:'POST',
           url:ajaxUrl+'SupplierEditBox',
           data:{supplierName:supplierName,supplierId:supplierId,email_to:email_to,email_cc:email_cc,supplierBank:supplierBank},
           cache:false,
           success:function(resp)
           {
               if(resp >0)
               {
                   alertify.success('Supplier Updated Successfully !');
                   location.reload();
               }
               else
               {
                  alertify.error('Network Error Occer Please Try Again !'); 
                  location.reload();
               }
           }
        });
    }
    else
    {
        alertify.error('Please Provide a valid Supplier Name!');
    }
}
function bankSave()
{
    $('#BankBtn').attr('diaabled',true);
    showLoder();
    var bankName=$.trim($('#bankName').val());
    var bankType=$('#bankType option:selected').val();
    var bankBrand=$('#bankBrand option:selected').val();
    if(bankName=='')
    {
        alertify.error('Please Enter the Bank Name');
        $('#bankName').focus();
        $('#BankBtn').removeAttr('diaabled');
        $('#bankName').attr('style','border: 1px solid red');
        $('#bankError').attr('style','color: red');
        $('#bankError').text('Please Enter Bank Name');
         hideLoder();
        return false;
    }
    if(bankType=='')
    {
        alertify.error('Please Select the Bank Type'); 
        $('#bankType').focus();
        $('#BankBtn').removeAttr('diaabled');
        $('#bankType').attr('style','border: 1px solid red');
        $('#bankTypeError').attr('style','color: red');
    }
    if(bankBrand=='')
    {
        alertify.error('Select Brand'); 
        $('#bankBrand').focus();
        $('#BankBtn').removeAttr('diaabled');
        $('#bankBrand').attr('style','border: 1px solid red');
        $('#bankAccountBrandError').attr('style','color: red'); 
    }
    $.ajax({
        type:'POST',
        url:ajaxUrl+'BankSaveBox',
        data:{bankName:bankName,bankType:bankType,bankBrand:bankBrand},
        cache:false,
        success:function(resp)
        {
           if(resp >0)
           {
               hideLoder();
               $('#addBank').modal('hide');
               location.reload();
           } 
           else
           {
             hideLoder();  
             alertify.error('Netwok error occer Please try again !');  
           }
        }
            });
}
//Bank Delete
function bankdelete(bankId)
{
    alertify.confirm('Please consult with Director before deleting this head !',function(ev){
        if(ev)
        {
            showLoder();
            $.ajax({
                type:'POST',
                url:ajaxUrl+'bankDeleteBox',
                cache:false,
                data:{bankId:bankId},
                success:function(resp)
                {
                   if(resp >0)
                   {
                       hideLoder();
                       $('#bankId'+bankId).remove();
                        alertify.success('bank Deleted Successfully !'); 
                   } 
                   else
                   {
                       hideLoder();
                       alertify.error('Netwok error occer Please try again !'); 
                   }
                }
            });
        }
        else
        {
            hideLoder();
            alertify.error('You have Canceled the Operation !');
        }
    });
}
function deleteExpenseHead(idExpense)
{
    alertify.confirm('Are You Sure To Delete Data ?',function(ev){
        if(ev)
        {
            showLoder();
            $.ajax({
                type:'POST',
                url:ajaxUrl+'ExpenseDeleteBox',
                data:{expenseId:idExpense},
                cache:false,
                success:function(resp)
                {
                    if(resp>0)
                    {
                       $('#exp'+idExpense).remove();
                       alertify.success('Operation Successfully Done !');
                       hideLoder();
                    }
                    else
                    {
                        alertify.error('Network Error Occer Please Try Again !');
                        hideLoder();
                    }
                }
            });
        }
        else
        {
            alertify.error('You Have Canceled The Operation !');
        }
    });
}
function bankBaxData()
{
    $.ajax({
        type:'POST',
        url:ajaxUrl+'bankBoxDataShow',
        cache:false,
        success:function(resp)
        {
            return resp;
        }
    });
}
function paymentsAndRequest(bookingId,btnId)
{
    showLoder();
   $.ajax({
        type:'POST',
        url:ajaxUrl+'TicketOrderBox2',
        cache:false,
        data:{bookingId:bookingId},
        success:function(resp)
        {
            if(resp!=''){
           var resArray=resp.split('%');
           var totalArr=resArray.length;
            if(totalArr >0)
            {
                alertify.error('Please Check the Errors List On Top Of The Page!');
                var html='';
                resArray.forEach(function(element) {
                    if(element=='Err-1')
                    {
                        html+="<i class='fa fa-times' aria-hidden='true'></i>&nbsp;Supplier always needs its own Supplier reference. So match them please. <br>";
                    }
                    if(element=='Err-2')
                    {
                        html+="<i class='fa fa-times' aria-hidden='true'></i>&nbsp;Supplier always needs its own Supplier reference. So match them please.<br>";
                    }
                    if(element=='Err-3')
                    {
                        html+="<i class='fa fa-times' aria-hidden='true'></i>&nbsp;Supplier always needs its own Supplier reference. So match them please.<br>";
                    }
                    if(element=='Err-4')
                    {
                        html+="<i class='fa fa-times' aria-hidden='true'></i>&nbsp;Supplier always needs its own Supplier reference. So match them please.<br>";
                    }
                    if(element=='Err-5')
                    {
                        html+="<i class='fa fa-times' aria-hidden='true'></i>&nbsp;Number of flight segments cannot be zero. So, please put Galileo coded Flight Details for system. <br>";
                    }
                    if(element=='Err-6')
                    {
                        html+="<i class='fa fa-times' aria-hidden='true'></i>&nbsp;Payable supplier cannot be zero or less than zero.<br>";
                    }
//                    if(element=='Err-7')
//                    {
//                        html+="<i class='fa fa-times' aria-hidden='true'></i>&nbsp;Remaining balance should be zero or less than zero. Otherwise popup message from agent is required. <br>";
//                        $('#remaingBalance').modal('show');
//                    }
                    if(element=='Err-8')
                    {
                        html+="<i class='fa fa-times' aria-hidden='true'></i>&nbsp;Profit cannot be negative. But in case of a negative profit a popup message from agent is required <br>";
                        $('#negativeModel').modal('show');
                    }
                    if(element=='Err-9')
                    {
                        html+="<i class='fa fa-times' aria-hidden='true'></i>&nbsp;Try to match departure airport code with departure airport code in Flight Details for system. <br>"; 
                    }
                    if(element=='Err-10')
                    {
                        html+="<i class='fa fa-times' aria-hidden='true'></i>&nbsp;Try to match returning airport code with returning airport code in Flight Details for system.<br>"; 
                    }
                    if(element=='Err-11')
                    {
                        html+="<i class='fa fa-times' aria-hidden='true'></i>&nbsp;Try to match panel departure date with departure date in Flight Details for system.<br>"; 
                    }
                    if(element=='Err-12')
                    {
                        html+="<i class='fa fa-times' aria-hidden='true'></i>&nbsp;Try to match panel return date with return date in Flight Details for system. <br>"; 
                    }
                    if(element=='Err-13')
                    {
                        html+="<i class='fa fa-times' aria-hidden='true'></i>&nbsp;Number of flight segments cannot be zero. So, please put Galileo coded Flight Details for system.<br>"; 
                    }
                    if(element=='Err-14')
                    {
                        html+="<i class='fa fa-times' aria-hidden='true'></i>&nbsp;PNRS in field of 'flight details for system' and in 'pnr' field should be matching. (For Single PNR) <br>"; 
                        html+="<i class='fa fa-times' aria-hidden='true'></i>&nbsp;More than one all PNRS will come on first line in 'flight details for system 'separating by commas, ending by slash and in 'pnr' field just separating by commas and ending by nothing.(For Multiple PNRS)<br>"; 
                    }
                    });
                $('#TicketOrderError').attr('style','display:block');
                $('#TicketOrderError #putMess').html(html);
                hideLoder();
                 return  false;
            }
        }
            else
            {
               
                  $.ajax({
                    type:'POST',
                    url:ajaxUrl+'bankBoxDataShow',
                    cache:false,
                    success:function(resp)
                    {
                        console.log(resp);
                        $('#sendPayment #bankList').html(resp);
                    }
                });
                $('#sendPayment #requestBooking').val(bookingId);
                $('#sendPayment').modal('show');
                hideLoder();

            }
        }
    });
   
    //$('#'+btnId).removeAttr('disabled');
} 
function makeRequest()
{
    showLoder();
    var bookingNumber=$('#requestBooking').val();
    var requestType=$('#resuestType option:selected').val();
    var bankName=$('#bankList option:selected').val();
    var requestReference=$('#requestReference').val();
    var requestAmount=$('#requestAmount').val();
    var requestDate=$('#paymentAndRequest').val();
    var agentIdR=$('#agentRequestId').val();
    var brand=$('#requestBrand').val();
    if(requestType=='')
    {
        alertify.alert('Please Select The Request Type');
        hideLoder();
        return false;
    }
    if(requestType!='' && requestType=='Bank Payment')
    {
       if(bankName=='')
        {
            alertify.alert('Please Select The Bank ');
            hideLoder();
            return false;
        } 
    }
    
//    if(requestAmount=='')
//    {
//        alertify.alert('Please Enter Amount ');
//        return false;
//    }
    if(requestDate=='')
    {
        alertify.alert('Please Select The Date');
        hideLoder();
        return false;
    }
    showLoder();
    $.ajax({
        type:'POST',
        url:ajaxUrl+'PaymentRequestCheckBox',
        cache:false,
        data:{ bookingId:bookingNumber,paymentref:requestReference,paymentAmount:requestAmount},
        success:function(respr)
        {
            if(respr >0)
            {
               hideLoder();
               $('#sendPayment').unbind();
               $('#sendPayment').modal('hide');
               alertify.alert('Your Request is Already Pending Please wait or Contact to admin');
            }
            else
            {
                 $.ajax({
                    type:'POST',
                    url:ajaxUrl+'RequestBox',
                    cache:false,
                    data:{ bookingNo:bookingNumber,requestType:requestType,bankName:bankName,requestReference:requestReference,requestAmount:requestAmount,requestDate:requestDate,agentIdR:agentIdR ,brand:brand},
                    success:function(resp)
                    {
                        if(resp >0)
                        {
                            $('#sendPayment').unbind();
                            $('#sendPayment').modal('hide');
                            hideLoder();
                            location.reload();
                            alertify.success('Request  Send Successfully ');
                        }
                        else
                        {
                            hideLoder();
                            alertify.alert('Request Not Send Please try Again');
                            location.reload();
                        }
                    }
                }); 
            }
        }
    });
    
//    hideLoder();
}
function markMessageRead(messageId)
{
//    alertify.alert('Under Development');
    showLoder();
    $.ajax({
        type:'POST',
        url:ajaxUrl+'MessageReadBox',
        cache:false,
        data:{messageIdDa:messageId},
        success:function(resp)
        {
           if(resp >0)
           {
               hideLoder();
               $('#requestId'+messageId).remove();
               alertify.success('Message Read Susseccfully !');
           } 
           else
           {
               hideLoder();
               alertify.error('Network Error Please Try Again !');
           }
        }
        
    });
}
function messageDelete(messageId)
{
    alertify.confirm('Do You Want To Delete This Message ?',function(ev)
    {
        if(ev)
        {
            showLoder();
            $.ajax({
                type:'POST',
                url:ajaxUrl+'MessageDeleteBox',
                cache:false,
                data:{messgId:messageId},
                success:function(resp)
                {
                    if(resp >0)
                    {
                        hideLoder();
                        $('#requestId'+messageId).remove();
                        alertify.success('Message Deleted Successfully !');
                    }
                    else
                    {
                       hideLoder(); 
                       alertify.error('Network Error Occess Please try Again !');
                    }
                }
            });
        }
        else
        {
            hideLoder();
            alertify.error('You Have Canceled The Operation');
        }
    });
}
function ticketOrder(bookinId)
{
    showLoder();
    $.ajax({
        type:'POST',
        url:ajaxUrl+'TicketOrderBox',
        cache:false,
        data:{bookingId:bookinId},
        success:function(resp)
        {
//            console.log(resp);
            if(resp!=''){
           var resArray=resp.split('%');
           var totalArr=resArray.length;
            if(totalArr >0)
            {
                alertify.error('Please Check the Errors List On Top Of The Page!');
                var html='';
                resArray.forEach(function(element) {
                    if(element=='Err-1')
                    {
                        html+="<i class='fa fa-times' aria-hidden='true'></i>&nbsp;Supplier always needs its own Supplier reference. So match them please. <br>";
                    }
                    if(element=='Err-2')
                    {
                        html+="<i class='fa fa-times' aria-hidden='true'></i>&nbsp;Supplier always needs its own Supplier reference. So match them please.<br>";
                    }
                    if(element=='Err-3')
                    {
                        html+="<i class='fa fa-times' aria-hidden='true'></i>&nbsp;Supplier always needs its own Supplier reference. So match them please.<br>";
                    }
                    if(element=='Err-4')
                    {
                        html+="<i class='fa fa-times' aria-hidden='true'></i>&nbsp;Supplier always needs its own Supplier reference. So match them please.<br>";
                    }
                    if(element=='Err-5')
                    {
                        html+="<i class='fa fa-times' aria-hidden='true'></i>&nbsp;Number of flight segments cannot be zero. So, please put Galileo coded Flight Details for system. <br>";
                    }
                    if(element=='Err-6')
                    {
                        html+="<i class='fa fa-times' aria-hidden='true'></i>&nbsp;Payable supplier cannot be zero or less than zero.<br>";
                    }
                    if(element=='Err-7')
                    {
                        html+="<i class='fa fa-times' aria-hidden='true'></i>&nbsp;Remaining balance should be zero or less than zero. Otherwise popup message from agent is required. <br>";
                        $('#remaingBalance').modal('show');
                    }
                    if(element=='Err-8')
                    {
                        html+="<i class='fa fa-times' aria-hidden='true'></i>&nbsp;Profit cannot be negative. But in case of a negative profit a popup message from agent is required <br>";
                        $('#negativeModel').modal('show');
                    }
                    if(element=='Err-9')
                    {
                        html+="<i class='fa fa-times' aria-hidden='true'></i>&nbsp;Try to match departure airport code with departure airport code in Flight Details for system. <br>"; 
                    }
                    if(element=='Err-10')
                    {
                        html+="<i class='fa fa-times' aria-hidden='true'></i>&nbsp;Try to match returning airport code with returning airport code in Flight Details for system.<br>"; 
                    }
                    if(element=='Err-11')
                    {
                        html+="<i class='fa fa-times' aria-hidden='true'></i>&nbsp;Try to match panel departure date with departure date in Flight Details for system.<br>"; 
                    }
                    if(element=='Err-12')
                    {
                        html+="<i class='fa fa-times' aria-hidden='true'></i>&nbsp;Try to match panel return date with return date in Flight Details for system. <br>"; 
                    }
                    if(element=='Err-13')
                    {
                        html+="<i class='fa fa-times' aria-hidden='true'></i>&nbsp;Number of flight segments cannot be zero. So, please put Galileo coded Flight Details for system.<br>"; 
                    }
                    if(element=='Err-14')
                    {
                        html+="<i class='fa fa-times' aria-hidden='true'></i>&nbsp;PNRS in field of 'flight details for system' and in 'pnr' field should be matching. (For Single PNR) <br>"; 
                        html+="<i class='fa fa-times' aria-hidden='true'></i>&nbsp;More than one all PNRS will come on first line in 'flight details for system 'separating by commas, ending by slash and in 'pnr' field just separating by commas and ending by nothing.(For Multiple PNRS)<br>"; 
                    }
//                    alert(element);
//                    $('#TicketOrderError #putMess').append(element);
                    });
//                alertify.alert('please Check the Errors List On Top Of The Page!');
                $('#TicketOrderError').attr('style','display:block');
                $('#TicketOrderError #putMess').html(html);
                hideLoder();
                 return  false;
            }
        }
            else
            {
                var dataPapolate='';
                $.ajax({
                    type:'POST',
                    url:ajaxUrl+'TicketOrderDataPoplateBox',
                    cache:false,
                    data:{bookingId:bookinId},
                    success:function(res)
                    {
                       dataPapolate=res.split('%');
                       var arrayDataPP=dataPapolate;
                       $('#ticketOrder #ticketOrderSupplierName').val(arrayDataPP[0]);
                        $('#ticketOrder #ticketOrderPnr').val(arrayDataPP[3]);
                        $('#ticketOrder #ticketOrderGDS').val(arrayDataPP[2]);
                        $('#ticketOrder #ticketOrderSupplierRef').val(arrayDataPP[1]);
                        $('#ticketOrder #ticketorderissueCost').val(arrayDataPP[4]);
                        $('#ticketOrder #ticketOrderSupplierEmail').val(arrayDataPP[5]);
                        $('#TicketOrderError').attr('style','display:none');
                        $('#ticketOrder').modal('show');
                        hideLoder();  
                    }
                });
//                console.log(dataPapolate);
                
                
            }
        }
    });
}
function editPassangerAdd(countId)
{
    if($('#categoryP'+countId+' option:selected').val()=='')
    {
        $('#categoryP'+countId).attr('style','border: 1px solid red');
        $('#categoryPError'+countId).attr('style','color:red');
        $('#categoryPError'+countId).text('Please Select The Category');
        return false;
    }
    if($('#passTitle'+countId+' option:selected').val()=='')
    {
       $('#passTitle'+countId).attr('style','border: 1px solid red');
       $('#passTitleError'+countId).attr('style','color:red');
       $('#passTitleError'+countId).text('Please Select The Title');
       return false;
    }
    if($('#firstName'+countId).val()=='')
    {
       $('#firstName'+countId).attr('style','border: 1px solid red');
       $('#firstNameError'+countId).attr('style','color:red');
       $('#firstNameError'+countId).text('Please Enter the First Name');
       return false;
    }
    if($('#salePrice').val()=='' || $('#salePrice').val()=='0')
    {
       $('#salePrice'+countId).attr('style','border: 1px solid red');
       $('#salePriceError'+countId).attr('style','color:red');
       $('#salePriceError'+countId).text('Please Enter the Sale Price');
       return false; 
    }
    showLoder();
    var category=$('#categoryP'+countId).val();
    var title=$('#passTitle'+countId).val();
    var firstname=$('#firstName'+countId).val();
    var surName=$('#surName'+countId).val();
    var middlename=$('#middleNameP'+countId).val();
    var agep=$('#age'+countId).val();
    var saleprice=$('#salePrice'+countId).val();
    var bookingfee=$('#bookingFee'+countId).val();
    var bookingId=$('#pIdBookingId').val();
    $.ajax({
        type:'POST',
        url:ajaxUrl+'PassangerBoxMore',
        data:{bookingId:bookingId,category:category,title:title,firstName:firstname,surname:surName,middlename:middlename,agep:agep,saleprice:saleprice,bookingfee:bookingfee},
        cache:false,
        success:function(resp)
        {
            if(resp >0)
            {
                hideLoder();
                alertify.success('Passanger Added Successfully !');
                location.reload();
            }
            else
            {
               alertify.error('Network error occer Please try again!');
               hideLoder() ; 
            }
        }
    });
    hideLoder() ;
}
function negativeMessageSave(btnID)
{
    $('#'+btnID).attr('disabled',true);
//    var datene=$('#positiveOnDate').val();
    var agentidN=$('#negativeAgentId').val();
    var bookingIdGeg=$('#negativeBookingId').val();
//    var remarkAgent=$('#agentRemarks').val();
    var isReply=$('#isreplyNeg option:selected').val();
    var comdateLeft=$('#datePositive').val();
//    if(datene=='')
//    {
//        $('#positiveOnDate').attr('style','border: 1px solid red');
//        $('#positiveOnDateError').attr('style','color:red');
//        $('#positiveOnDateError').text('Please Enter the Value');
//        $('#'+btnID).removeAttr('disabled');
//        return false;
//    }
//    if(remarkAgent=='')
//    {
//        $('#agentRemarks').attr('style','border: 1px solid red');
//        $('#agentRemarksError').attr('style','color:red');
//        $('#agentRemarksError').text('Please Enter Your Remarks');
//        $('#'+btnID).removeAttr('disabled');
//        return false;
//    }
    if(isReply=='')
    {
        $('#isreplyNeg').attr('style','border: 1px solid red');
        $('#isreplyNegError').attr('style','color:red');
        $('#isreplyNegError').text('Please Select This Field');
        $('#'+btnID).removeAttr('disabled');
        return false;
    }
    $.ajax({
        type:'POST',
        url:ajaxUrl+'NegativeBox',
        cache:false,
        data:{bookingId:bookingIdGeg,agentId:agentidN,isreplyN:isReply,leftAmopuntComeDate:comdateLeft},
        success:function(resp)
        {
           if(resp >0)
           {
              alertify.success('Requested Process Successfully !');
              $('#negativeModel').modal('hide'); 
           } 
           else
           {
                alertify.error('Network Error Occes Please Try Again !');
                $('#negativeModel').modal('hide'); 
           }
        }
    });
}
function remaingBalanceMsgSave(leftBtn)
{
    $('#'+leftBtn).unbind();
    $('#'+leftBtn).attr('disabled',true);
    var refundAbleTicket=$('#isRefundsAbleTicket option:selected').val();
    var customerEmailReply=$('#leftBalanceCustomerReply option:selected').val();
    var amountComeDate=$('#leftBalaceDateRemarks').val();
    var agentNoteAboutLeftbalance=$('#noteAboutLeftBalance').val();
    var leftBalancebookingId=$('#LeftBalanceBookingId').val();
    var leftBalanceAgentId=$('#leftBalanceAgentIdremarks').val();
    if(refundAbleTicket=='')
    {
        return false;
    }
    if(customerEmailReply=='')
    {
//        var html='<p style="color:red">Sorry agent !this file cannot be issued. Contact to Admin.</p>';
//        $('#leftRemaksSaveError').html(html);
//        $('#'+leftBtn).attr('disabled',true);
        return false;
    }
    $.ajax({
        type:'POST',
        url:ajaxUrl+'RemaingRemarksBox',
        cache:false,
        data:{refundAbleTicket:refundAbleTicket,customerEmailReply:customerEmailReply,amountComeDate:amountComeDate,agentNoteAboutLeftbalance:agentNoteAboutLeftbalance,leftBalancebookingId:leftBalancebookingId,leftBalanceAgentId:leftBalanceAgentId},
        success:function(resp)
        {
            if(resp >0)
            {
                alertify.success('Requested Process Successfully ');
                $('#remaingBalance').modal('hide');
                location.reload();
            }
            else
            {
                 alertify.error('Network Error Occer Please Try Again');
                 $('#remaingBalance').modal('hide');
            }
        }
    });
}
function isReplayDone(replyV)
{
   if(replyV !='')
   {
       if(replyV=='Yes')
       {
          $('#replayDivShow').show(); 
       }
       else
       {
          $('#replayDivShow').hide();  
       }
   } 
}
function leftEmailReply(leftEmailRe)
{
    if(leftEmailRe!='')
    {
        if(leftEmailRe=='Yes')
        {
//             $('#leftbalnceRe').removeAttr('disabled');
            $('#leftDateDiv').show();
            $('#latePaymentDiv').show();
        }
        else
        {
//            var html='<p style="color:red">Sorry agent !this file cannot be issued. Contact to Admin.</p>';
//            $('#leftRemaksSaveError').html(html);
//             $('#leftbalnceRe').attr('disabled',true);
            $('#leftDateDiv').hide();
            $('#latePaymentDiv').hide();
        }
    }
}
function sendTicketOrder(btnId)
{
//    alert('SHAHID');
    var bookingOfTickerOrder=$('#ticketorderBookingId').val();
    var ticketOrderpriorty=$('#ticketOrderPriorty option:selected').val();
    var ticketorderSupplierName=$('#ticketOrderSupplierName').val();
    var ticlketorderSupplierRef=$('#ticketOrderSupplierRef').val();
    var ticketOrderGDS=$('#ticketOrderGDS').val();
    var ticketOrderPnr=$('#ticketOrderPnr').val();
    var ticketOrderIssueCost=$('#ticketorderissueCost').val();
    var ticketOrderagentMassage=$('#ticketorderAgentmessage').val();
    var ticketOrderSupplierEmail=$('#ticketOrderSupplierEmail').val();
    var brand=$('#ticketorderBrand').val();
    $.ajax({
        type:'POST',
        url:ajaxUrl+'TicketOrderSendBox',
        cache:false,
        data:{bookingOfTickerOrder:bookingOfTickerOrder,ticketOrderpriorty:ticketOrderpriorty,ticketorderSupplierName:ticketorderSupplierName,ticlketorderSupplierRef:ticlketorderSupplierRef,ticketOrderGDS:ticketOrderGDS,ticketOrderPnr:ticketOrderPnr,ticketOrderIssueCost:ticketOrderIssueCost,ticketOrderagentMassage:ticketOrderagentMassage,ticketOrderSupplierEmail:ticketOrderSupplierEmail,brand:brand},
        success:function(resp)
        {
            if(resp)
            {
                alertify.success('Your Request Send Successfully !');
                 $('#ticketOrder').unbind();
                $('#ticketOrder').modal('hide');
                location.reload();
            }
            else
            {
                alertify.error('Network Error occer Please Try Again! ');
                $('#ticketOrder').unbind();
                $('#ticketOrder').modal('hide');
            }
        }
        
    });
}
function deleteTicketOrder(tickrOrderId)
{
    alertify.confirm('Are you Sure to delete This Ticket Order ?',function(ev){
        if(ev)
        {
            showLoder(); 
            $.ajax({
                type:'POST',
                url:ajaxUrl+'TicketOrderDel',
                data:{ticktOrderId:tickrOrderId},
                success:function(resp)
                {
                    if(resp >0)
                    {
                        hideLoder();
                        $('#ticketorderreq'+tickrOrderId).remove();
                        alertify.success('Ticket Order Deleted Successfully !');
                    }
                    else{
                        hideLoder();
                        alertify.error('Network Error please try Again! ');
                    }
                }
            });
        }
       else
        {
            alertify.error('You have Canceled the Operation !');
        }
    });
}
function ticketOrderRead(ticketOrderId)
{
    showLoder();
    $.ajax({
        type:'POST',
        url:ajaxUrl+'TicketOrderRead',
        cache:false,
        data:{ticketorderId:ticketOrderId},
        success:function(resp)
        {
            if(resp >0)
            {
                hideLoder();
               $('#ticketorderreq'+ticketOrderId).remove(); 
               alertify.success('Process Successfully Done !');
            }
          else
            {
                 hideLoder();
                 alertify.error('Network error Occess Please try Again');
            }
        }
    });
}
function deleteAgentNote(noteId)
{
    alertify.confirm('Are You Sure to Delete ?',function(ev){
        if(ev)
        {
            showLoder();
            $.ajax({
                type:'POST',
                url:ajaxUrl+'NoteDeleteBox',
                cache:false,
                data:{noteId:noteId},
                success:function(resp)
                {
                    if(resp >0)
                    {
                        hideLoder(); 
                        alertify.success('Operation Successfully Done !');
                        location.reload();
                    }
                    else
                    {
                        hideLoder(); 
                        alertify.error('Network Error Occess  Please try Again');
                        
                    }
                }
            });
        }
        else
        {
            hideLoder();
            alertify.error('You have Canceled The Operation ');
        }
    });
}
function markasPendingFile(fileId)
{
    showLoder();
    $.ajax({
        type:'POST',
        url:ajaxUrl+'PandingFileBox',
        cache:false,
        data:{bookingId:fileId},
        success:function(resp)
        {
            if(resp >0)
            {
                hideLoder();
                alertify.success('Requested process Successfully Done!');
                window.location=ajaxUrl+'Pending';
            }
            else
            {
                hideLoder();
                alertify.error('Network Error occer Please try Again');
            }
        }
    });
}
function markAsPendingBooking(bookingId)
{
    alertify.confirm('Are You sure To mark As Pending Booking?',function(ev){
        if(ev)
        {
           //MarkPendingTaskToPendingBooking 
           $.ajax({
                        type:'POST',
                        url:ajaxUrl+'MarkPendingTaskToPendingBooking',
                        cache:false,
                        data:{bookingId:bookingId},
                        success:function(resp)
                        {
                            if(resp >0)
                            {
                                alertify.success('Operation Successfully Completed');
                                window.location=ajaxUrl+'Pending';
                                hideLoder();
                            }
                            else
                            {
                                hideLoder();
                                alertify.error('Network Error Please try Again');
                            }
                        }
                    }); 
        }
        else
        {
            hideLoder();
            alertify.error('Canceled The Operation ');
        }
    });
}
function markCardCancellationModalOpen(bookingId)
{
    $('#cardCancellationModal #cardCancelBookingId').val(bookingId);
    $('#cardCancellationModal #cardCanDate').val('');
    $('#cardCancellationModal').modal('show');
}
function markAsCardCancellation()
{
    var cardcancellationDate=$('#cardCancellationModal #cardCanDate').val();
    var cardcancellationBookingId=$('#cardCancellationModal #cardCancelBookingId').val();
     if(cardcancellationDate=='')
    {
        $('#cardCancellationModal #cardCanDate').attr('style','border: 1px solid red');
        $('#cardCancellationModal #cardCanDateDateError').attr('style','color: red');
        $('#cardCancellationModal #cardCanDateDateError').text('Select The Date First');
        return false;
    }
    if(cardcancellationBookingId!='' && cardcancellationDate!=''){
        showLoder();
        $.ajax({
            type:'POST',
            url:ajaxUrl+'CardCancellactionCheckBox',
            cache:false,
            data:{bookingId:cardcancellationBookingId},
            success:function(rrp)
            {
                if(rrp >0)
                {
                   $.ajax({
                        type:'POST',
                        url:ajaxUrl+'CardCancelBox',
                        cache:false,
                        data:{bookingId:cardcancellationBookingId,cardcancellationDate:cardcancellationDate},
                        success:function(resp)
                        {
                            if(resp >0)
                            {
                                alertify.success('Operation Successfully Completed');
                                window.location=ajaxUrl+'Canceled';
                                hideLoder();
                            }
                            else
                            {
                                hideLoder();
                                alertify.error('Network Error Please try Again');
                            }
                        }
                    }); 
                }
                else
                {
                    hideLoder();
                    alertify.error('This can not be saved because Agent did not put reason of Card Cancellation.');

                }
            }
        });
    }
    else
    {
       hideLoder();
       alertify.error('Network Error Please try Again'); 
    }
}
function markAsCashCancellationModalOpen(bookingIdCashCancelled)
{
    $('#cashCancellationModal #cashCancelBookingId').val(bookingIdCashCancelled);
    $('#cashCancellationModal #cashCanDate').val('');
    $('#cashCancellationModal').modal('show');
}
function markAsCashCancellation()
{
    var cashCancelledBookingId=$('#cashCancellationModal #cashCancelBookingId').val();
    var cashCancelledDateConfirm=$('#cashCancellationModal #cashCanDate').val();
    if(cashCancelledDateConfirm=='')
    {
        $('#cashCancellationModal #cashCanDate').attr('style','border: 1px solid red');
        $('#cashCancellationModal #cashCanDateErrorModal').attr('style','color: red');
        $('#cashCancellationModal #cashCanDateErrorModal').text('Select The Date First');
        return false;
    }
    if(cashCancelledBookingId!='' && cashCancelledDateConfirm!='')
    {
        showLoder();
        $.ajax({
        type:'POST',
        url:ajaxUrl+'CheckCashCancelComment',
        data:{bookingId:cashCancelledBookingId},
        cache:false,
        success:function(resp)
        {
            if(resp >0)
            {
                $.ajax({
                    type:'POST',
                    url:ajaxUrl+'CashCancelBox',
                    cache:false,
                    data:{bookingIds:cashCancelledBookingId,cashcancelledDateConfirm:cashCancelledDateConfirm},
                    success:function(rspData)
                    {
                        if(rspData >0)
                        {
                            hideLoder();
                            alertify.success('Operation Successfully Done');
                            window.location=ajaxUrl+'Canceled';
//                            msg.delay(120);
                            
                        }
                        else
                        {
                            hideLoder();
                            alertify.error('Network Error Please try Again');
                        }
                    }
                            
                });
            }
            else
            {
                hideLoder();
                alertify.error('This can not be saved because Agent did not put reason of Cash Cancellation.');
            }
        }
    });
    }
    else
    {
        hideLoder();
        alertify.error('Network Error Please try Again');
    }
}
function cardCancellationRemarks(btnId)
{
    $('#'+btnId).attr('disabled',true);
    var agentId=$('#cardCancellationAgentId').val();
    var bookingId=$('#cardcancellationBookingId').val();
    var pnrExpir=$('#pnrCancelledForCardCancellation option:selected').val();
    var cardcanledremarks=$('#cardCancellationReason').val();
    if($('#pnrCancelledForCardCancellation option:selected').val()=='')
    {
        $('#pnrCancelledForCardCancellation').attr('style','border: 1px solid red');
        $('#pnrCancelledForCardCancellationError').attr('style','color:red');
        $('#pnrCancelledForCardCancellationError').text('Please Select This Field');
        $('#'+btnId).removeAttr('disabled');
        return false;
    }
    if($('#cardCancellationReason').val()=='')
    {
        
        $('#cardCancellationReason').attr('style','border: 1px solid red');
        $('#cardCancellationReasonError').attr('style','color:red');
        $('#cardCancellationReasonError').text('Please Enter the Value');
        $('#'+btnId).removeAttr('disabled');
        return false;
    }
    
    $.ajax({
        type:'POST',
        url:ajaxUrl+'CardCancelledRemarksBox',
        cache:false,
        data:{bookingId:bookingId,agentId:agentId,pnrExpir:pnrExpir,cardcanledremarks:cardcanledremarks},
        success:function(respDa)
        {
            if(respDa >0)
            {
                hideLoder();
                $('#cardCancellationModel').modal('hide');
                alertify.success('Operation Successfully Done');
                location.reload();
            }
          else
           {
               hideLoder();
               alertify.error('Network Error occer please Try Again');
                
           }
        }
    });
}
function cashCancellationRemarks(btnID)
{
    $('#'+btnID).attr('disabled',true);
    var agentId=$('#cashCancellationAgentId').val();
    var bookingId=$('#cashcancellationBookingId').val();
    var pnrExpir=$('#pnrCancelledForCashCancellation option:selected').val();
    var cardcanledremarks=$('#cashCancellationReason').val();
    if($('#pnrCancelledForCashCancellation option:selected').val()=='')
    {
        $('#pnrCancelledForCashCancellation').attr('style','border: 1px solid red');
        $('#pnrCancelledForCashCancellationError').attr('style','color:red');
        $('#pnrCancelledForCashCancellationError').text('Please Select This Field');
        $('#'+btnID).removeAttr('disabled');
        return false;
    }
    if($('#cashCancellationReason').val()=='')
    {
        
        $('#cashCancellationReason').attr('style','border: 1px solid red');
        $('#cashCancellationReasonError').attr('style','color:red');
        $('#cashCancellationReasonError').text('Please Enter the Value');
        $('#'+btnID).removeAttr('disabled');
        return false;
    }
    
    $.ajax({
        type:'POST',
        url:ajaxUrl+'CashCancelledRemarksBox',
        cache:false,
        data:{bookingId:bookingId,agentId:agentId,pnrExpir:pnrExpir,cardcanledremarks:cardcanledremarks},
        success:function(respDa)
        {
            if(respDa >0)
            {
                hideLoder();
                $('#cashCancellationModel').modal('hide');
                alertify.success('Operation Successfully Done');
                location.reload();
            }
          else
           {
               hideLoder();
               alertify.error('Network Error occer please Try Again');
                
           }
        }
    });
}
function refundRemarksAgent(btnid)
{
//    $('#'+btnid).attr('disabled',true);
    var agentId=$('#refundAgentId').val();
    var bookingId=$('#refundBookingId').val();
    var pnrExpir=$('#pnrCancelledForrefund option:selected').val();
    var cardcanledremarks=$('#refundReason').val();
    if($('#pnrCancelledForrefund option:selected').val()=='')
    {
        $('#pnrCancelledForrefund').attr('style','border: 1px solid red');
        $('#pnrCancelledForrefundError').attr('style','color:red');
        $('#pnrCancelledForrefundError').text('Please Select This Field');
//        $('#'+btnid).removeAttr('disabled');
        return false;
    }
    if($('#refundReason').val()=='')
    {
        
        $('#refundReason').attr('style','border: 1px solid red');
        $('#refundReasonError').attr('style','color:red');
        $('#refundReasonError').text('Please Enter the Value');
//        $('#'+btnid).removeAttr('disabled');
        return false;
    }
    
    $.ajax({
        type:'POST',
        url:ajaxUrl+'refundRenmarkBox',
        cache:false,
        data:{bookingId:bookingId,agentId:agentId,pnrExpir:pnrExpir,cardcanledremarks:cardcanledremarks},
        success:function(respDa)
        {
            if(respDa >0)
            {
                hideLoder();
                $('#refundModel').modal('hide');
                alertify.success('Operation Successfully Done');
                location.reload();
            }
          else
           {
               hideLoder();
               alertify.error('Network Error occer please Try Again');
                
           }
        }
    });
}
function agentsChargeBackRemarks(btnId)
{
    var agentId=$('#chargeBackAgentId').val();
    var bookingId=$('#chargeBackBookingId').val();
    var pnrExpir=$('#pnrCancelledForchargeBack option:selected').val();
    var chargeBackremarks=$('#chargeBackReason').val();
    if($('#pnrCancelledForchargeBack option:selected').val()=='')
    {
        $('#pnrCancelledForchargeBack').attr('style','border: 1px solid red');
        $('#pnrCancelledForchargeBackError').attr('style','color:red');
        $('#pnrCancelledForchargeBackError').text('Please Select This Field');
//        $('#'+btnid).removeAttr('disabled');
        return false;
    }
    if($('#chargeBackReason').val()=='')
    {
        
        $('#chargeBackReason').attr('style','border: 1px solid red');
        $('#chargeBackError').attr('style','color:red');
        $('#chargeBackError').text('Please Enter the Value');
//        $('#'+btnid).removeAttr('disabled');
        return false;
    }
    
    $.ajax({
        type:'POST',
        url:ajaxUrl+'ChargeBackBox',
        cache:false,
        data:{bookingId:bookingId,agentId:agentId,pnrExpir:pnrExpir,chargeBackremarks:chargeBackremarks},
        success:function(respDa)
        {
            if(respDa >0)
            {
                hideLoder();
                $('#chargeBackModel').modal('hide');
                alertify.success('Operation Successfully Done');
                location.reload();
            }
          else
           {
               hideLoder();
               alertify.error('Network Error occer please Try Again');
                
           }
        }
    });
}
function markAsRefundModalOpen(bookingIdRefund)
{
  $('#RefundModalS #refundBookingId').val(bookingIdRefund);
  $('#RefundModalS #refundDate').val('');
  $('#RefundModalS').modal('show');  
}
function marksAsRefundBooking()
{
    var refundBookingId=$('#RefundModalS #refundBookingId').val();
    var refundBookingDateConfirm=$('#RefundModalS #refundDate').val();
    if(refundBookingDateConfirm=='')
    {
        $('#RefundModalS #refundDate').attr('style','border: 1px solid red');
        $('#RefundModalS #refundDateErrorModal').attr('style','color:red');
        $('#RefundModalS #refundDateErrorModal').text('Please Select The Date First');
        return false;
    }
    if(refundBookingId!='' && refundBookingDateConfirm!='')
    {
        showLoder();
        $.ajax({
            type:'POST',
            url:ajaxUrl+'RefundRemarksCheckBox',
            data:{bookingId:refundBookingId},
            cache:false,
            success:function(resp)
            {
                if(resp >0)
                {
                    $.ajax({
                        type:'POST',
                        url:ajaxUrl+'RefundBoxs',
                        cache:false,
                        data:{bookingIds:refundBookingId,refundBookingDateConfirm:refundBookingDateConfirm},
                        success:function(rspData)
                        {
                            if(rspData >0)
                            {
                                hideLoder();
                                alertify.success('Operation Successfully Done');
                                window.location=ajaxUrl+'Canceled';
    //                            msg.delay(120);

                            }
                            else
                            {
                                hideLoder();
                                alertify.error('Network Error Please try Again');
                            }
                        }

                    });
                }
                else
                {
                    hideLoder();
                    alertify.error('This can not be saved because Agent did not put reason of Refund.');
                }
            }
        }); 
    }
    else
    {
       hideLoder();
       alertify.error('Network Error Please try Again'); 
    }
}
function markAsChargeBackModalOpen(bookingIdChargeBack)
{
    $('#ChargeBackDateModal #markChargeBackBookingId').val(bookingIdChargeBack);
    $('#ChargeBackDateModal #chargeBackDate').val('');
    $('#ChargeBackDateModal').modal('show');
}
function markAsChargeBack()
{
    //chargeBackDateError
    var chargeBackBookngId=$('#ChargeBackDateModal #markChargeBackBookingId').val();
    var chargeBackDateConfirm=$('#ChargeBackDateModal #chargeBackDate').val();
    if(chargeBackDateConfirm=='')
    {
        $('#ChargeBackDateModal #chargeBackDate').attr('style','border: 1px solid red');
        $('#ChargeBackDateModal #chargeBackDateError').attr('style','color:red');
        $('#ChargeBackDateModal #chargeBackDateError').text('Please Select The Date First');
        return false;
    }
    if(chargeBackBookngId!='' && chargeBackDateConfirm!='')
    {
        showLoder();
        $.ajax({
        type:'POST',
        url:ajaxUrl+'ChargeBackRemarksCheckBoxs',
        data:{bookingId:chargeBackBookngId},
        cache:false,
        success:function(resp)
        {
            if(resp >0)
            {
                $.ajax({
                    type:'POST',
                    url:ajaxUrl+'MarkChargeBackBox',
                    cache:false,
                    data:{bookingIds:chargeBackBookngId,chargeBackDateConfirm:chargeBackDateConfirm},
                    success:function(rspData)
                    {
                        if(rspData >0)
                        {
                            hideLoder();
                            alertify.success('Operation Successfully Done');
                            window.location=ajaxUrl+'Canceled';
//                            msg.delay(120);
                            
                        }
                        else
                        {
                            hideLoder();
                            alertify.error('Network Error Please try Again');
                        }
                    }
                            
                });
            }
            else
            {
                hideLoder();
                alertify.error('This can not be saved because Agent did not put reason of ChargeBack');
            }
        }
    });
    }
    else
    {
       hideLoder();
       alertify.error('Network Error Please try Again');  
    }
}

function grossProfitFormSubmit()
{
    $('#reportForm').attr('action',ajaxUrl+'Reports/generateGrosprofit');
    $("#reportForm").submit();
}
function customerleftBanlanceForm()
{
    $('#reportForm').attr('action',ajaxUrl+'Reports/leftBalanceReport');
    $("#reportForm").submit();
}
function showCardAmountReceiveRow()
{
    $('#transectionRow').hide();
    $('#CardAmountReceiveRow').show();
}
function cancelCardTransectionRow()
{
    $('#CardAmountReceiveRow').hide();
    $('#transectionRow').show();
}
function showCardEditRow(idro)
{
    $('#cardRowNonEdit'+idro).hide();
    $('#cardRowEditAble'+idro).show();
}
function cancelEditRow(idrow)
{
   $('#cardRowEditAble'+idrow).hide(); 
   $('#cardRowNonEdit'+idrow).show();
}
function filesaveAsCardAmountRecaived(bookingId)
{
    var statusCard=$('#receiveStatus'+bookingId+' option:selected').val();
    if(statusCard=='')
    {
        alertify.alert('please Select the option than Save');
        return false;
    }
    showLoder();
    $.ajax({
        type:'POST',
        url:ajaxUrl+'CardReceivedBoxEnter',
        cache:false,
        data:{bookingId:bookingId,Cardstatus:statusCard},
        success:function(res)
        {
            if(res >0)
            {
                hideLoder();
                alertify.success('Operation Successfully Done!');
                location.reload();
            }
            else
            {
                hideLoder();
                 alertify.error('Network Error Occess please Try Again !');
            }
        }
    });
}
function ReceivedAmountCardRecord()
{
   var cardRecivedDate=$('#cardAmountReceived').val();
   var file_comment=$('#file_comment').val();
   var cardAmount=$('#amount_card').val();
   var receivedFor=$('#cardReceivedFor option:selected').val();
   var leftAmount=$('#leftAmountTo').val();
   var calaimaAbleAmount=$('#claimAbAmount').val();
   if(cardRecivedDate=='')
   {
       $('#cardAmountReceived').attr('style','border: 1px solid red');
       $('#cardAmountReceivedError').attr('style','color:red');
       $('#cardAmountReceivedError').text('Please Select The Date');
    return false;    
   }
   if(file_comment=='')
   {
       $('#file_comment').attr('style','border: 1px solid red');
       $('#file_commentError').attr('style','color:red');
       $('#file_commentError').text('Please Enter the File Number Or Note');
       return false;
   }
   if(cardAmount=='')
   {
       $('#amount_card').attr('style','border: 1px solid red');
       $('#Amount_card_Error').attr('style','color:red');
       $('#Amount_card_Error').text('Please Enter the Amount');
        return false;
   }
   
    showLoder();
    $.ajax({
        type:'POST',
        url:ajaxUrl+'CardReceivedBoxRecord',
        cache:false,
        data:{cardRecivedDate:cardRecivedDate,file_comment:file_comment,cardAmount:cardAmount,receivedFor:receivedFor,leftAmount:leftAmount,calaimaAbleAmount:calaimaAbleAmount},
        success:function(resp)
        {
            if(resp>0)
            {
                hideLoder();
                alertify.success('Operation Successfully Completed');
                location.reload();
            }
            else
            {
                hideLoder();
                alertify.error('Network Error Occerr Please try again');
            }
        }
    });
}
function referenceFieldCondition(paymentType)
{
    showLoder();
    if(paymentType!='')
    {
        if(paymentType=='Bank Payment')
        {
            $('#onlyBankPay').show();
        } 
        else
        {
           $('#onlyBankPay').hide(); 
        }
        if(paymentType=='Refund To Customer')
        {
            
            $('#paymetRequestLabel').text('What is the reason to refund to Customer?');
        }
        else
        {
            $('#paymetRequestLabel').text('Request Description (Or Payment Reference)');
        }
//        else if(paymentType=='Online')
//        {
//            $('#refDiv').show();
//        }
//        else if(paymentType=='Cash')
//        {
//            $('#refDiv').show();
//        }
//        else if(paymentType=='Cheque')
//        {
//            $('#refDiv').show();
//        }
//        else if(paymentType=='Other')
//        {
//            $('#refDiv').show();
//        } 
    }
    
    hideLoder();
}
function bookingQuote(quoteId)
{
    var quoteNoteText=$('#label'+quoteId).text();
    var note=$('#bookingNote').text();
    var noteData=note.split('\n');
//    console.log(noteData);
    $('#quote_value').val(quoteNoteText);
    var lengNo=noteData.length;
    if(lengNo==0)
    {
      $('#bookingNote').text(quoteNoteText+'\n');   
    }
    else if(lengNo==1)
    {
        if(note=='')
        {
           $('#bookingNote').text(quoteNoteText+'\n'); 
        }
        else
        {
           $('#bookingNote').text(quoteNoteText+'\n');  
        }
    }
    else if(lengNo==2)
    {
         $('#bookingNote').text(quoteNoteText+'\n'+noteData[1]); 
    }
//    alert(quoteNoteText);
}
function paymentNote(paymentNoteId)
{
    var paymentNoteQuote=$('#label'+paymentNoteId).text();
    var note=$('#bookingNote').text();
    var noteData=note.split('\n');
    $('#paymentNoteValue').val(paymentNoteQuote);
//    console.log(noteData);
    var lengNo=noteData.length;
    if(lengNo==0)
    {
        $('#bookingNote').text('\n'+paymentNoteQuote);
    }
    else if(lengNo==1)
    {
        $('#bookingNote').text('\n'+paymentNoteQuote);
    }
    else if(lengNo==2)
    {
        $('#bookingNote').text(noteData[0]+'\n'+paymentNoteQuote);
    }
}
function formReset(forId)
{
    $('#'+forId)[0].reset();
}
function editAgentModalShow(agentId)
{
    showLoder();
    $.ajax({
       type:'POST',
       url:ajaxUrl+'Ajax/agentModalDataGet',
       data:{agentId:agentId},
       cache:false,
       success:function(resp)
       {
           if(resp!=0)
           {
            var obj=JSON.parse(resp);
            $('#agentEditId').val(obj.id);
            $('#first_nameEdit').val(obj.first_name);
            $('#emailEdit').val(obj.email);
            $('#cnicEdit').val(obj.cnic);
            $('#passwordEdit').val(obj.password);
            $('#agentShiftTimeStartEdit').val(obj.shift_time_start);
            $('#agentShiftTimeEndEdit').val(obj.shift_time_end);
            $('#agentRoleEdit option[value='+obj.flag+']').attr('selected','selected');
            $('#targetSaleEdit').val(obj.sales_target);
            $('#targetProfitEdit').val(obj.profitTarget);
            $('#last_nameEdit').val(obj.last_name);
            $('#phoneEdit').val(obj.cell);
            $('#loginNameEdit').val(obj.login_name);
            $('#companyEdit option[value='+obj.company+']').attr('selected','selected');
            $('#agentStatusEdit option[value='+obj.agent_status+']').attr('selected','selected');
            if(obj.flag==1 || obj.flag==2)
            {
                $('#adminLevelsFlag').val(1);
                $('#shiftBoxDiv').hide();
                $('#accessLevelDiv').hide();
                $('#salesAndProfitTrgetDiv').hide();
                $('#companyDiv').hide();
            }
            $('#prewAgentEdit').attr('src',ajaxUrl+'upload/'+obj.pic);
            hideLoder();
            $('#editAgent').modal('show');
             }  
       }
    });
}
function loadModalSupplierEdit(supplierId)
{
    showLoder();
     $.ajax({
            type:'POST',
            url:ajaxUrl+'BankAjaxData',
            cache:false,
            success:function(resp)
            {
                if(resp)
                {
//                    $('#EditsupplierModel #supplierBankEdit').html(resp);
                    $.ajax({
                        type:'Post',
                        url:ajaxUrl+'SullierEditBox',
                        data:{supplierId:supplierId},
                        success:function(resp)
                        {
                            if(resp!=0)
                           {
                                var obj=JSON.parse(resp);
                                $('#supplierNameEdit').val(obj.supplier_name);
//                                $('#supplierBankEdit').val(obj.BankId);
                                $('#supplierEmailTOEdit').val(obj.to_email);
                                $('#supplierIdHi').val(obj.id);
                                $('#supplierEmailccEdit').val(obj.cc_email);
                                hideLoder();
                                $('#EditsupplierModel').modal('show');
                           }
                           else
                           {
                               hideLoder();
                               alertify.alert('Network Error Please try again');
                           }
                        }
                    });
                }
            }
        });
       
    
}
function payToSupplierModal(bookingId)
{
    $.ajax({
        type:'POST',
        url:ajaxUrl+'SupplierCostBox',
        data:{bookingId:bookingId},
        cache:false,
        success:function(resp)
        {
            $('#transectionSupplierForm')[0].reset();
            $('#supplierPatModal #supplierDrAmount').val(resp);
            $('#supplierPatModal #supplierRefDr').val(bookingId);
            $('#supplierPatModal #supplierRefCr').val(bookingId);
            $('#supplierPatModal #supplierCrAmount').val(resp);
            $('#supplierPatModal #supTrsDrSum').text(resp);
            $('#supplierPatModal #supTrsCrSum').text(resp);
            $('#supplierPatModal').modal('show');
        }
    });
}
function addSupplierTransection()
{
    
}
 $("#transectionSupplierForm").on('submit',(function(e) {
         e.preventDefault();
         $.ajax({
        	url: ajaxUrl+'Transection/generalTransectionAdd',
                type: "POST",
		data:  new FormData(this),
		contentType: false,
                processData:false,
		success: function(data)
		    {
                        if(data>0)
                        {
                          alertify.success('Payment Added Successfully');
                          hideLoder();
                            location.reload();
                            setInterval(function() {$("#body-overlay").hide(); },500);
                             }
                             else
                             {
                                 alertify.error('Network Error Occer Please Try again!');
                                 hideLoder();
                                 $('#supplierPatModal').modal('hide');
                             }
			},
		  	error: function() 
                        {
                            hideLoder();
                        } 	        
	   });
     }));
function supplierPaymentDelete(supplierTransection)
{
 alertify.alert('Under Development');       
}

// Customer Payment Add
$("#transectionCustomerForm").on('submit',(function(e) {
         e.preventDefault();
         showLoder();
         var reDataVal=$('#transectionCustomerForm #reloadField').val();
         var reconfirmId=$('#transectionCustomerForm #requestConfirmData').val();
         var notify=$('#transectionCustomerForm #notifyType').val();
         var booking=$('#transectionCustomerForm #customerCrRef').val();
         var refundAmount=$('#transectionCustomerForm #drAmountPopCus').val();
         
//         alert(reDataVal);
//         return false;
         $.ajax({
        	url: ajaxUrl+'Transection/customerPayementAdd',
                type: "POST",
		data:  new FormData(this),
		contentType: false,
                processData:false,
		success: function(data)
		    {
                        if(data>0)
                        {
                         
                          if(reDataVal && reconfirmId!='')
                          {
                              $.ajax({
                                  type:'POST',
                                  url:ajaxUrl+'RequestConfirmBoxD',
                                  data:{reconfirmId:reconfirmId},
                                  cache:false,
                                  success:function(respda)
                                  {
                                      if(respda>0)
                                      {
                                          if(notify!='' && notify=='refund')
                                          {
                                              $.ajax({
                                                  type:'POST',
                                                  url:ajaxUrl+"RefundBoxActivity",
                                                  data:{bookingId:booking,notify:notify,refundAmount:refundAmount},
                                                  cache:false,
                                                  success:function(resp)
                                                  {
                                                      if(resp>0)
                                                      {
                                                          hideLoder();
                                                          $('#transectionCustomerForm').modal('hide');
                                                          alertify.success('Refund Done Successfully !');
                                                          location.reload();
                                                          return false;
                                                      }
                                                      else
                                                      {
                                                           hideLoder();
                                                           alertify.error('Network Error Occer Please Try again!');
                                                           $('#transectionCustomerForm').modal('hide');
                                                           return false;
                                                      }
                                                  }
                                              });
                                          }
                                          
                                          else if(notify!='' && (notify=='Card Payment' || notify=='Bank Payment'))
                                          {
                                              $.ajax({
                                                  type:'POST',
                                                  url:ajaxUrl+"RefundBoxActivity",
                                                  data:{bookingId:booking,notify:notify},
                                                  cache:false,
                                                  success:function(resp)
                                                  {
                                                      if(resp>0)
                                                      {
                                                          hideLoder();
                                                            $('#transectionCustomerForm').modal('hide');
                                                             alertify.success('Payment Confirm Successfully');
                                                            location.reload(); 
                                                            return false;
                                                      }
                                                      else
                                                      {
                                                           hideLoder();
                                                           alertify.error('Network Error Occer Please Try again!');
                                                           $('#transectionCustomerForm').modal('hide');
                                                           return false;
                                                      }
                                                  }
                                              });
                                            
                                          }
//                                          hideLoder();
//                                          $('#transectionCustomerForm').modal('hide');
//                                           alertify.success('Payment Confirm Successfully');
//                                          location.reload();
                                      }
                                      else
                                      {
                                          hideLoder();
                                           alertify.error('Network Error Occer Please Try again!');
                                          $('#transectionCustomerForm').modal('hide');
                                      }
                                  }
                              });
                          }
                          else
                          {
                              alertify.success('Payment Added Successfully');
                               hideLoder();
                              location.reload();
                              setInterval(function() {$("#body-overlay").hide(); },500);
                          }
                            
                             }
                             else
                             {
                                 alertify.error('Network Error Occer Please Try again!');
                                 hideLoder();
//                                 $('#supplierPatModal').modal('hide');
                             }
			},
		  	error: function() 
                        {
                            hideLoder();
                        } 	        
	   });
     }));
     function addPaymentModelFromPendingTask(id,reloadParam,requestId,amount,requestType)
     {
         customerTransectionModalShow(id,reloadParam,requestId,amount,requestType);
         
     }
     
function customerTransectionModalShow(bookingId,reloadset,requestId,amount,requestType)
{
    $('#transectionCustomerForm')[0].reset();
    $('#transectionModalForCustomer #customerDrRef').val(bookingId);
    $('#transectionModalForCustomer #customerCrRef').val(bookingId);
    if(reloadset!='')
    {
         $('#transectionModalForCustomer #reloadField').val(reloadset);
         $('#transectionModalForCustomer #requestConfirmData').val(requestId);
         $('#transectionModalForCustomer #drAmountPopCus').val(amount);
         $('#transectionModalForCustomer #crAmountPopCus').val(amount);
         $('#transectionModalForCustomer #crSum').text(amount);
         $('#transectionModalForCustomer #drSum').text(amount);
         $('#transectionModalForCustomer #notifyType').val(requestType);
    }
    $('#transectionModalForCustomer').modal('show');
}
function expenseModalShow()
{
    $('#expenseHeadForm')[0].reset();
    showLoder();
    $.ajax({
        type:'post',
        url:ajaxUrl+'getBrandBoxArea',
        data:{},
        cache:false,
        async: false,
        success:function(message)
        {
            hideLoder();
            if(message)
            {
               
                $('#expenseModal #expenseBrand').html(message);
                $('#expenseModal').modal('show');
            }
            else
            {
                hideLoder();
                alertify.error('Network Error Occer Please Try Agagin');
            }
        }
    });
   
}
function expenseHeadSave()
{
   var expenseHead=$.trim($('#expenseHeadName').val());
   var expenseType=$('#expenseType option:selected').val();
   var expenseBrand=$('#expenseBrand option:selected').val();
   if(expenseHead=='')
   {
       $('#expenseHeadName').attr('style','border: 1px solid red');
       $('#expenseHeadNameError').attr('style','color:red');
       $('#expenseHeadNameError').text('Please Enter Expense Name');
       return false;
       
   }
   if(expenseType=='')
   {
      $('#expenseHeadName').attr('style','border: 1px solid red');
      $('#expenseTypeError').attr('style','color:red');
      $('#expenseTypeError').text('Please Select The Expense Type');
       return false; 
   }
   if(expenseBrand=='')
   {
      $('#expenseBrand').attr('style','border: 1px solid red');
      $('#expenseBrandError').attr('style','color:red');
      $('#expenseBrandError').text('Please Select The Brand');
       return false; 
   }
    showLoder();
    $.ajax({
        type:'POST',
        url:ajaxUrl+'ExpenseData',
        data:{headName:expenseHead,expenseType:expenseType,expenseBrand:expenseBrand},
        cache:false,
        success:function(resp)
        {
            if(resp>0)
            {
                hideLoder();
                alertify.success('Operation Successfull !');
                location.reload();
            }
            else
            {
                hideLoder();
                alertify.error('Network Error Occer Please Try Agagin');
                $('#expenseModal').modal('hide');
                
            }
        }
    });
}
function deleteExpenseHead(idExpense)
{
    alertify.confirm('Please consult with Director before deleting this head !',function(ev){
        if(ev)
        {
            showLoder();
            $.ajax({
                type:'POST',
                url:ajaxUrl+'ExpenseDeleteBox',
                data:{expenseId:idExpense},
                cache:false,
                success:function(resp)
                {
                    if(resp>0)
                    {
                       $('#exp'+idExpense).remove();
                       alertify.success('Operation Successfully Done !');
                       hideLoder();
                    }
                    else
                    {
                        alertify.error('Network Error Occer Please Try Again !');
                        hideLoder();
                    }
                }
            });
        }
        else
        {
            alertify.error('You Have Canceled The Operation !');
        }
    });
}
function deleteIncomeHead(idIncome)
{
    alertify.confirm('Please consult with Director before deleting this head !',function(ev){
        if(ev)
        {
            showLoder();
            $.ajax({
                type:'POST',
                url:ajaxUrl+'IncomeDeleteBox',
                data:{idIncome:idIncome},
                cache:false,
                success:function(resp)
                {
                    if(resp>0)
                    {
                       $('#exp'+idIncome).remove();
                       alertify.success('Operation Successfully Done !');
                       hideLoder();
                    }
                    else
                    {
                        alertify.error('Network Error Occer Please Try Again !');
                        hideLoder();
                    }
                }
            });
        }
        else
        {
            alertify.error('You Have Canceled The Operation !');
        }
    });
}
function editExpenseHead(idEdit)
{
    showLoder();
    $.ajax({
        type:'POST',
        url:ajaxUrl+'ExpenseEditBox',
        cache:false,
        data:{id:idEdit},
        success:function(resp)
        {
            if(resp!=0)
            {
                var obj=JSON.parse(resp);
                $('#expenseHeadEditName').val(obj.expense_name);
                $('#expenseUpdateId').val(obj.id);
                $('#expenseEditModal').modal('show');
                hideLoder();
            }
            else
            {
                alertify.error('Network Error Occer Please try Agagin');
                hideLoder();
            }
        }
        
    });
}
function expenseHeadUpdate()
{
    showLoder();
 var expensehead=$('#expenseHeadEditName').val();  
 var idUpdate=$('#expenseUpdateId').val();
 $.ajax({
     type:'POST',
     url:ajaxUrl+'ExpenseUpdateBox',
     data:{expensehead:expensehead,idUpdate:idUpdate},
     cache:false,
     success:function(rep)
     {
         if(rep>0)
         {
             alertify.success('Operation successfull !');
                hideLoder();
                location.reload();
         }
         else
         {
                hideLoder();
                alertify.error('Network Error Occer Please Try Again !');
                $('#expenseEditModal').modal('hide');
         }
     }
 });
}
function editTransectionModalPrepare(transectionId)
{
    showLoder();
    $.ajax({
        type:'POST',
        url:ajaxUrl+'ShowEditBoxTransection',
        data:{transectionId:transectionId},
        cache:false,
        success:function(respData)
        {
            var obj=JSON.parse(respData);
            var drobj='';
             var crObj='';
             if(obj[0].pay_type=='Dr')
             {
                drobj=obj[0];
                crObj=obj[1];
                
             }
            else if(obj[0].pay_type=='Cr')
            {
                drobj=obj[1];
                crObj=obj[0]; 
            }
            $('#EditTransaction #TransactionDateEdit').val(drobj.pay_date);
            $('#EditTransaction #transectionEditId').val(transectionId);
            $('#EditTransaction #drAmountEdit').val(drobj.amount);
            $('#EditTransaction #drBookingRefEdit').val(drobj.booking_ref);
            $('#EditTransaction #trasectionEditDescription').val(crObj.description);
            $('#EditTransaction #crAmountEdit').val(crObj.amount);
            $('#EditTransaction #edittrsDrSum').text(drobj.amount);
            $('#EditTransaction #tranIdShow').text(drobj.transectionId);
            $('#EditTransaction #editTrsCrSum').text(crObj.amount);
            $('#EditTransaction #bookingRefCrEdit').val(crObj.booking_ref);
            $('#EditTransaction #TransactionDateEditPopUp').val(crObj.pay_date);
            var drpay="\'"+drobj.pay_to+"\%"+drobj.payment_nature+"\'"; 
            var crpay='';
            if(crObj.pay_to=='Customer')
            {
               crpay="\'"+crObj.pay_to+"\%supplier'";  
            }
            else
            {
                 crpay="\'"+crObj.pay_to+"\%"+crObj.payment_nature+"\'";
            }
             
//            $('#EditTransaction #dr_pay_to_Edit option[value='+drobj.pay_to+']').attr('selected','selected');
//            $('#EditTransaction #dr_pay_to_Edit option[value='+drobj.pay_to+']').attr('selected','selected');
//            $('#EditTransaction #dr_pay_to_Edit option[value="Reliance Barclays-bank"').attr('selected','selected');
            $('#EditTransaction #dr_pay_to_Edit option[value='+drpay).attr('selected','selected');
            $('#EditTransaction #cr_pay_to_Edit option[value='+crpay).attr('selected','selected');
            hideLoder(); 
            $('#EditTransaction').unbind();
            $('#EditTransaction').modal('show');
        }
    });
}

// transection Update 
$("#transectionFormEdit").on('submit',(function(e) {
         e.preventDefault();
         var crAmount=$('#crAmountEdit').val();
         var drAmount=$('#drAmountEdit').val();
         if(crAmount==drAmount){
         $.ajax({
        	url: ajaxUrl+'Transection/paymentUpdatedDo',
                type: "POST",
		data:  new FormData(this),
		contentType: false,
                processData:false,
		success: function(data)
		    {
                        if(data>0)
                        {
                          alertify.success('Payment Updated Successfully');
                          hideLoder();
                          $('#EditTransaction').modal('hide');
                            location.reload();
                            setInterval(function() {$("#body-overlay").hide(); },500);
                             }
                             else
                             {
                                 alertify.error('Network Error Occer Please Try again!');
                                 hideLoder();
                                 
//                                 $('#supplierPatModal').modal('hide');
                             }
			},
		  	error: function() 
                        {
                            hideLoder();
                        } 	        
	   });
       }
       else
       {
           alertify.alert('Both Amount Should be Same ');
           hideLoder();
       }
     }));
     
function drTotalCount(valueDr,TrgetDrtotal)
{
    var oldVal=$('#'+TrgetDrtotal).text();
    var newVal=parseFloat(oldVal) + parseFloat(valueDr);
    $('#'+TrgetDrtotal).text(newVal);
}
function crTotalCount(valueCr,targetCrTotal)
{
    var oldVal=$('#'+targetCrTotal).text();
    var newVal=parseFloat(oldVal) + parseFloat(valueCr);
    $('#'+targetCrTotal).text(newVal);
}
function resendDetails(booking)
{
    showLoder();
    $.ajax({
        type:'POST',
        url:ajaxUrl+'ResendBox',
        data:{bookingId:booking},
        cache:false,
        success:function(resp)
        {
            if(resp)
            {
                var obj=JSON.parse(resp);
                $('#resendSchedule #resendTo').val(obj.customerEmail);
                $('#resendSchedule #resendFrom').val(obj.agentEmail);
                $('#resendSchedule #hiddenBookin').val(obj.bookingNum);
                $('#resendSchedule #resendMessage').val(obj.detailsData);
                $('#resendSchedule #resendScheduleSubject').val(obj.subjectEmail);
                $('#resendSchedule #richText-lkys15').html(obj.detailsData);
                $('#resendSchedule #preMessage').text(obj.detailsData);
                hideLoder();
                $('#resendSchedule').modal('show');
            }
            else
            {
                 hideLoder();
                 alertify.error('Network Error Please Try Again');
            }
        }
    });
}


//resend Submit

$("#resendDataBooking").on('submit',(function(e) {
         e.preventDefault();
         $.ajax({
        	url: ajaxUrl+'ResendDoneBox',
                type: "POST",
		data:  new FormData(this),
		contentType: false,
                processData:false,
		success: function(data)
		    {
                        if(data==1)
                        {
                            alertify.success('Schedule Sent successfully !');
                            location.reload();
                        }
                    }
                         	        
	   });
//       }
      
     }));
     // Send Receipt 
$("#receiptSendForm").on('submit',(function(e) {
         e.preventDefault();
         $.ajax({
        	url: ajaxUrl+'ReceiptSendBox',
                type: "POST",
		data:  new FormData(this),
		contentType: false,
                processData:false,
		success: function(data)
		    {
                        if(data==1)
                        {
                            alertify.success('Receipt Sent successfully !');
                            location.reload();
                        }
                    }
                         	        
	   });
//       }
      
     }));
     // Send notification
$("#SendNotificationForm").on('submit',(function(e) {
         e.preventDefault();
         $.ajax({
        	url: ajaxUrl+'NotificationSendBox',
                type: "POST",
		data:  new FormData(this),
		contentType: false,
                processData:false,
		success: function(data)
		    {
                        if(data==1)
                        {
                            alertify.success('Notification Sent successfully !');
                            location.reload();
                        }
                    }
                         	        
	   });
//       }
      
     }));
function requestToDeletePaymentRequest(requestId)
{
    showLoder();
    $.ajax({
        type:'POST',
        url:ajaxUrl+'PrepareDataRequestDeleteBox',
        data:{ requestId:requestId },
        cache:false,
        success:function(resp)
        {
//            console.log(resp);
            if(resp)
            {
                var obj=JSON.parse(resp);
                $('#TicketOrderRemoveModal #requestType').val(obj.requestType);
                $('#TicketOrderRemoveModal #requtsBookingIdDelete').val(obj.booking_id);
                $('#TicketOrderRemoveModal #reqstIdDeletReqst').val(obj.id);
                $('#TicketOrderRemoveModal #reqstAgentId').val(obj.requestFrom);
                hideLoder();
                $('#TicketOrderRemoveModal').modal('show');
            }
            else
            {
              hideLoder(); 
              alertify.error("Network Error Occer Please Try Agagin Or Contact To Developer !");
            }
           
        }
    });
}
function doDeleteRequstDone()
{
    showLoder();
    var requestType=$('#TicketOrderRemoveModal #requestType').val();
    var requestbookingId=$('#TicketOrderRemoveModal #requtsBookingIdDelete').val();
    var requestId=$('#TicketOrderRemoveModal #reqstIdDeletReqst').val();
    var resaneDelete=$.trim($('#TicketOrderRemoveModal #whyRequestRemove').val());
    var agentId=$.trim($('#TicketOrderRemoveModal #reqstAgentId').val());
    if(resaneDelete=='')
    {
        return false;
    }
    $.ajax({
        type:'POST',
        url:ajaxUrl+'RequestDeleteBoxDone',
        data:{requestType:requestType,requestbookingId:requestbookingId,requestId:requestId,resaneDelete:resaneDelete,agentId:agentId},
        cache:false,
        success:function(resp)
        {
            var datares=resp.split('-');
            if(datares[0]!=0 && datares[1]!=0)
            {
                hideLoder();
                $('#TicketOrderRemoveModal').modal('show');
                $('#RequestDeleteFormId')[0].reset();
                location.reload();
            }
            else
            {
                hideLoder();
                 $('#TicketOrderRemoveModal').modal('show');
                 $('#RequestDeleteFormId')[0].reset();
                 alertify.alert('Network Error Occer Please Try Agagin Or Contact To Developer !');
            }
        }
    });
    
}

function doDeleteRequstDone2()
{
    showLoder();
//    var requestType=$('#TicketOrderRemoveModalTwo #requestType').val();
    var requestbookingId=$('#TicketOrderRemoveModalTwo #requtsBookingIdDelete2').val();
    var requestId=$('#TicketOrderRemoveModalTwo #reqstIdDeletReqst2').val();
    var resaneDelete=$.trim($('#TicketOrderRemoveModalTwo #whyRequestRemove2').val());
    var agentId=$.trim($('#TicketOrderRemoveModalTwo #reqstAgentId2').val());
    if(resaneDelete=='')
    {
        return false;
    }
    $.ajax({
        type:'POST',
        url:ajaxUrl+'RequestDeleteBoxDoneTicket',
        data:{requestbookingId:requestbookingId,requestId:requestId,resaneDelete:resaneDelete,agentId:agentId},
        cache:false,
        success:function(resp)
        {
            var datares=resp.split('-');
            if(datares[0]!=0 && datares[1]!=0)
            {
                hideLoder();
                $('#TicketOrderRemoveModalTwo').modal('hide');
                $('#RequestDeleteFormId')[0].reset();
                location.reload();
            }
            else
            {
                hideLoder();
                 $('#TicketOrderRemoveModalTwo').modal('hide');
                 $('#RequestDeleteFormId2')[0].reset();
                 alertify.alert('Network Error Occer Please Try Agagin Or Contact To Developer !');
            }
        }
    });
    
}

function requestToDeleteTicketOrder(ticketRequestId,BookingId,agentId)
{
//    alertify.alert('Under Development');
    $('#TicketOrderRemoveModalTwo #requtsBookingIdDelete2').val(BookingId);
    $('#TicketOrderRemoveModalTwo #reqstAgentId2').val(agentId);
    $('#TicketOrderRemoveModalTwo #reqstIdDeletReqst2').val(ticketRequestId);
    $('#TicketOrderRemoveModalTwo').modal('show');
}
 $(document).ready(function() {  
//         if(CKEDITOR.instances['ticket_details'])
//         {
//            CKEDITOR.instances['ticket_details'].destroy();
//            
//         }
////         if(CKEDITOR.instances['ticket_details'])
////         {
////            CKEDITOR.instances['ticket_details'].destroy();
////            
////         }
//         if (CKEDITOR.instances['sendReceipt'])
//         {
//            CKEDITOR.instances['sendReceipt'].destroy();
//         }
//    initSample();
    }); 
function openModalSendReceipt(bookingId)
{
//    alert(bookingId);
//if (CKEDITOR.instances['sendReceipt']) {
//CKEDITOR.instances['sendReceipt'].destroy();
//initSample();
//}
    
    $.ajax({
        type:'POST',
        url:ajaxUrl+'SendReceiptBoxGet',
        cache:false,
        data:{bookingId:bookingId},
        success:function(resp)
        {
            //console.log(resp);
            var obj=JSON.parse(resp);
            console.log(obj);
            $('#SendReceipt #sendReceiptFrom').val(obj.from);
            $('#SendReceipt #sendReceiptTo').val(obj.to);
            $('#SendReceipt #sendReceiptSubject').val(obj.subject);
            $('#SendReceipt #sendReceiptCc').val(obj.cc);
            $('#SendReceipt #receiptSendMessage').val(obj.detailsData);
            $('#SendReceipt #bookingIdhidenSendReceipt').val(obj.bookingNum);
            $('#SendReceipt #richText-moowvw').val(obj.detailsData);
            $('.content2').richText();
            $('#SendReceipt #richText-moowvw').text(obj.detailsData);
            $('#SendReceipt').modal('show');
        }
    });
   
    
}
function saveNewLogBooking(bookingId,userId)
{
   
    var noteData =$.trim($('#bookingLogNote').val());
    if(noteData=='')
    {
       $('#bookingLogNote').attr('style','border: 1px solid red');
       $('#bookinLogErrorDiv').attr('style','color:red');
       $('#bookinLogErrorDiv').text('Please Enter Your Note');
        return false;
       
    }
    showLoder();
    $.ajax({
        type:'POST',
        url:ajaxUrl+'BookingLogBox',
        data:{bookingId:bookingId,userId:userId,noteData:noteData},
        cache:false,
        success:function(resp)
        {
            if(resp >0)
            {
                alertify.success('Your Message Saved Successfully !');
                hideLoder();
                location.reload();
            }
            else
            {
                alertify.error('Network error Occer Please Try Again');
                hideLoder();
            }
        }
    });
}
function cardDataView(bookingId)
{
 if(bookingId!='')
 {
        showLoder();
     $.ajax({
         type:'POST',
         url:ajaxUrl+'GetCardBoxRequest',
         data:{bookingId:bookingId},
         cache:false,
         success:function(resp)
         {
             if(resp!=0)
             {
                 var objCardData=JSON.parse(resp);
                 var html=''; 
                 html="<td>"+objCardData.cardHolder+"</td><td>"+objCardData.cardNumber+"</td><td>"+objCardData.cardType+"</td><td>"+objCardData.expiry+"</td><td>"+objCardData.cvv+"</td><td>"+objCardData.address+"</td><td>"+objCardData.email+"</td><td>"+objCardData.phone+"</td>";
                 $('#ViewPaymentType #cardDataAddInView').html(html);
                    hideLoder();
                 $('#ViewPaymentType').modal('show');
             }
             else
             {
                 alertify.alert('Network error Occer please try again! ');
             }
         }
     });
 }   
 else
 {
     alertify.alert('Network error Occer please try again! ');
 }
}
function addressVaid(address)
{
    if(address!='' && address!=='same')
    {
        $('#cardAddressNew').show();
    }
    else
    {
        
        $('#cardAddressNew').hide();
    }
}
function confirmRefundModal(bookingId,requestAmount,requestId,reloadset)
{
//    alertify.alert('under Development');
    if(bookingId!='')
    {
        $.ajax({
            type:'POST',
            url:ajaxUrl+'RefundRequestDataBox',
            data:{bookingId:bookingId},
            cache:false,
            success:function(resp)
            {
                
                var RefunObj=JSON.parse(resp);
//                console.log(RefunObj);
                var drObj='';
                var crObj='';
                if(RefunObj!=''){
                if(RefunObj[0].pay_type=='Dr')
                {
                    drObj=RefunObj[0];
                    crObj=RefunObj[1];
                }
                else
                {
                    drObj=RefunObj[1];
                    crObj=RefunObj[0];
                }
                $('#transectionModalForCustomer #requestConfirmData').val(requestId);
                $('#transectionModalForCustomer #drAmountPopCus').val(requestAmount);
                $('#transectionModalForCustomer #crAmountPopCus').val(requestAmount);
                $('#transectionModalForCustomer #crSum').text(requestAmount);
                $('#transectionModalForCustomer #drSum').text(requestAmount);
                $('#transectionModalForCustomer #reloadField').val(reloadset);
                
                var drpay="\'"+drObj.pay_to+"\-"+drObj.payment_nature+"\'"; 
                    var crpay='';
                    if(crObj.pay_to=='Customer')
                    {
                       crpay="\'"+crObj.pay_to+"\-supplier'";  
                    }
                    else
                    {
                         crpay="\'"+crObj.pay_to+"\-"+crObj.payment_nature+"\'";
                    }
                    $('#transectionModalForCustomer #drDropDownId option[value='+crpay).attr('selected','selected');
                    $('#transectionModalForCustomer #crDropDownId option[value='+drpay).attr('selected','selected');	
                    $('#transectionModalForCustomer #customerDrRef').val(bookingId);
                    $('#transectionModalForCustomer #customerCrRef').val(bookingId);
                    $('#transectionModalForCustomer #notifyType').val('refund');
                   $('#transectionModalForCustomer').modal('show');
                
            }
            else
            {
                alertify.alert('There is no payment Received from customer Contact admin !');
                return false;
            }
        }
        });
    }
}
function issueBookingLoad(bookingId)
{
    
   if(bookingId)
   {
        showLoder();
       $.ajax({
           type:'POST',
           url:ajaxUrl+'IssueModelPrepare',
           data:{bookingId:bookingId},
           cache:false,
           success:function($resp)
           {
               
               var objIssue=JSON.parse($resp);
               
               $('#TicketIssuanceDetail #ticketIsssenceTitle').text(objIssue.bookingTitle);
               $('#TicketIssuanceDetail #ticketSuplier').val(objIssue.bookingDetails.supplier_name);
               $('#TicketIssuanceDetail #issueBookingId').val(objIssue.bookingDetails.id);
               $('#TicketIssuanceDetail #supplierRefIssue').val(objIssue.bookingDetails.supplier_ref);
               $('#TicketIssuanceDetail #gdsIssue').val(objIssue.flightDetails.gds);
               $('#TicketIssuanceDetail #issuePnr').val(objIssue.flightDetails.pnr);
               $('#TicketIssuanceDetail #issueBrand').val(objIssue.brandName);
               var htmlNew='';
               var totalIssueP=0;
               $.each(objIssue.passenger,function(index,item){
                   var tr='<tr><td>'+item.title+'</td><td>'+item.firstName+'</td><td>'+item.midle_name+'</td><td>'+item.sur_name+'</td><td>'+item.age+'</td><td>'+item.category+'</td><td><input type="text" id="eticketIssue'+index+'" name="eticketIssue[]" value="'+item.eticket+'" class="form-control" placeholder="E-ticket"><input type="hidden"  name="passerIds[]" value="'+item.passenger_Id+'" ></td></tr>';
                   htmlNew=htmlNew+tr;
                   totalIssueP++;
               });
               $('#TicketIssuanceDetail #totalPassanerIssue').val(totalIssueP);
               $('#TicketIssuanceDetail #passenderIssue').html(htmlNew);
                hideLoder();
               $('#TicketIssuanceDetail').modal('show');
               
           }
       });
   }
}
$("#issueTicketForm").on('submit',(function(e) {
         e.preventDefault();
         var issueDate=$('#IssuanceDate').val();
         var totalIssueP=$('#totalPassanerIssue').val();
         if(issueDate=='')
         {
             alertify.alert('Please Select the Date Issue');
             return false;
         }
         for(var i=totalIssueP;i >0;i--)
         {
             var j=i-1;
             var eticket=$('#eticketIssue'+j).val();
             if(eticket=='')
             {
                alertify.alert('Please enter the E-ticket of passenger '+i);     
                return false;
             }
         }
         $.ajax({
        	url: ajaxUrl+'IssueRequestSend',
                type: "POST",
		data:  new FormData(this),
		contentType: false,
                processData:false,
		success: function(data)
		    {
                        if(data>0)
                        {
                            hideLoder();
                            $('#TicketIssuanceDetail').modal('hide');
                            window.location=ajaxUrl+'issued-bookings';
                        }
                        else
                        {
                            hideLoder();
                            $('#TicketIssuanceDetail').modal('hide');
                            alertify.error('Network Error occer please try again!');
                        }
                    },
		  	error: function() 
                        {
                            hideLoder();
                            $('#TicketIssuanceDetail').modal('hide');
                            alertify.error('Network Error occer please try again!');
                            
                        } 	        
	   });
     }));
function cancakBookingModalOpen(bookingId)
{
   if(bookingId){ 
       showLoder();
       $.ajax({
        type:'POST',
        url:ajaxUrl+'Ajax/getBookingNumber',
        data:{bookingId:bookingId},
        cache:false,
        success:function(resp)
        {
            if(resp)
            {
                $('#cancelBooking #cancelMarkHeding').text(resp);
                $('#cancelBooking #cacelBookId').val(bookingId);
                hideLoder();
                $('#cancelBooking').modal('show');
                
            }
        }
    });
   }
   else
   {
       hideLoder();
       alertify.error('Network Error Please Try Again!');
   }
}
function doCancelBooking()
{
    var bookigId=$('#cacelBookId').val();
    var cancelDate=$('#cancelationDate').val();
    var reasone=$('#reasonCancel').val();
    if(cancelDate=='')
    {
        alertify.alert('Cancel Date Required');
        return false;
    }
    if(reasone=='')
    {
        alertify.alert('Reason of Cancellation?');
        return false;
    }
    showLoder();
    $.ajax({
        type:'POST',
        url:ajaxUrl+'DoCancelBox',
        data:{bookigId:bookigId,cancelDate:cancelDate,reasone:reasone},
        cache:false,
        success:function(resp)
        {
            if(resp >0)
            {
                hideLoder();
                $('#cancelBooking').modal('hide');
                window.location=ajaxUrl+'Canceled';
                
            }
            else
            {
                hideLoder();
                alertify.error('Network Error Please try again!');
                $('#cancelBooking').modal('hide');
                
            }
        }
    });
}
function checkPnrAndAirlineLoctor()
{
    var pnrvalidation=$('#pnr').val();
    var airlineLoctor=$('#airlineLocatore').val();
    if(pnrvalidation==airlineLoctor)
    {
        $('#airlineLocatoreError')
        $('#pnrError')
       $('#airlineLocatore').attr('style','border: 1px solid red');
       $('#airlineLocatoreError').attr('style','color: red');
       $('#airlineLocatoreError').text('PNR and Airline Locator cannot be same!');
       $('#pnr').attr('style','border: 1px solid red');
       $('#pnrError').attr('style','color: red');
       $('#pnrError').text('PNR and Airline Locator cannot be same!');
        return false;
    }
}
function sendTicketOrderEmailReady(bookingId)
{
    if(bookingId)
    {
        showLoder();
        $.ajax({
            type:'POST',
            url:ajaxUrl+'MakeReadyTicketOrderSendBox',
            data:{bookingId:bookingId},
            cache:false,
            success:function(resp)
            {
                if(resp)
                {
                    hideLoder();
                    var objData=JSON.parse(resp);
                    console.log(objData);
                    $('#TicketOrderEmail #richText-rpmdya').html(objData.innterlMessage);
                    $('#TicketOrderEmail #messageInn').val(objData.innterlMessage);
                    $('#TicketOrderEmail #ticketOrderEmailFrom').val(objData.fromEmail[0].email);
                    $('#TicketOrderEmail #ticketOrderEmailTo').val(objData.supplierDetails[0].to_email);
                    $('#TicketOrderEmail #ticketOrderEmailCc').val(objData.supplierDetails[0].cc_email);
                    $('#TicketOrderEmail #ticketOrderEmailSubject').val(objData.subject);
                    $('#TicketOrderEmail #ticketOrderEmailBookingId').val(objData.bookingId);
                    $('#TicketOrderEmail').modal('show');
                }else
                {
                    hideLoder();
                    alertify.alert('Network Error Occess Please try Again');
                }
                
            }
        });
    }
    else
    {
        hideLoder();
        alertify.alert('Network Error Occess Please try Again');
    }
}
$("#ticketOderEmailSendForm").on('submit',(function(e) {
         e.preventDefault();
        var fromEmail=$('#ticketOrderEmailFrom').val();
        var mshHtml=$('#richText-rpmdya').html();
        $('#messageInn').val(mshHtml);
        var toEmail=$('#ticketOrderEmailTo').val();
        var ccEmail=$('#ticketOrderEmailCc').val();
        var subjectEmail=$('#ticketOrderEmailSubject').val();
        var messageEmail=$('#messageInn').val();
        if(fromEmail=='')
        {
            alertify.alert('Email From Is Required');
            return false;
        }
        if(toEmail=='')
        {
            alertify.alert('Email To Is Required');
            return false;
        }
        if(subjectEmail=='')
        {
            alertify.alert('Email Subject Is Required');
            return false;
        }
        if(messageEmail=='')
        {
            alertify.alert('Email Message Is Required');
            return false;
        }
         $.ajax({
        	url: ajaxUrl+'TicketOrderSendBoxEmail',
                type: "POST",
		data:  new FormData(this),
		contentType: false,
                processData:false,
		success: function(data)
                {
                    //console.log(data);
                    if(data)
                    {
                       $('#TicketOrderEmail').modal('hide'); 
                       location.reload();
                    }
                },
                error: function() 
                {
                    hideLoder();
                    alertify.error('Network Error occer please try again!');

                } 	        
	   });
     }));
  function makeCancelToPendingRequest(bookingId)
  {
      if(bookingId >0)
      {
         alertify.confirm('Are you sure ?',function(ev){
             if(ev)
             {
                showLoder();
                $.ajax({
                    type:'POST',
                    url:ajaxUrl+'cancelToPendingBox',
                    cache:false,
                    async: false,
                    data:{bookingId:bookingId},
                    success:function(resp)
                    {
                        if(resp>0)
                        {
                            hideLoder();
                            alertify.success('Operation Successfully Completed !');
                            location.reload();
                        }
                        else
                        {
                            hideLoder();
                            alertify.error('Network Error Occer Please try again or contact to developer !');
                        }
                    }
                });
             }
             else
             {
                 alertify.error('You had canceled the operation !');
             }
         });
      }
      else
      {
          alertify.error('Network Error Occer Please try again or contact to developer !');
      }
  }
  function issueToPendingRequest(bookingId)
  {
      if(bookingId>0)
      {
          alertify.confirm('Are you sure ?',function(e){
              if(e)
              {
                 showLoder();
                 $.ajax({
                     type:"POST",
                     url:ajaxUrl+'issuedToPendingBox',
                     cache:false,
                     async: false,
                     data:{bookingId:bookingId},
                     success:function(resp)
                     {
                         if(resp>0)
                         {
                            hideLoder();
                            alertify.success('Operation Successfully Completed !');
                            location.reload();
                         }
                         else
                         {
                            hideLoder();
                            alertify.error('Network Error Occer Please try again or contact to developer !');
                         }
                     }
                 });
              }
              else
              {
                  alertify.error('You had canceled the operation !');
              }
          });
      }
      else
      {
         alertify.error('Network Error Occer Please try again or contact to developer !'); 
      }
  }
  function cloneFile(baseFileId)
  {
      if(baseFileId >0)
      {
          alertify.confirm('Are you sure ?',function(ev){
              if(ev)
              {
                  $.ajax({
                      type:"POST",
                      url:ajaxUrl+'makeFileClone',
                      cache:false,
                      async: false,
                      data:{baseFileId:baseFileId},
                      success:function(resp)
                      {
                          if(resp>0)
                          {
                            hideLoder();
                            alertify.success('Operation Successfully Completed !');
                            location.reload();
                              
                          }
                          else
                          {
                              hideLoder();
                              alertify.error('Network Error Occer Please try again or contact to developer !');
                          }
                      }
                      
                  });
              }
              else
              {
                alertify.error('You had canceled the operation !');  
              }
          });
      }
      else
      {
        alertify.error('Network Error Occer Please try again or contact to developer !');
      }
  }
  function sendNotification(bookingId)
  {
      if(bookingId >0)
      {
          $.ajax({
              type:'POST',
              url:ajaxUrl+'NotificationBox',
              data:{bookingId:bookingId},
              cache:false,
              async: false,
              success:function(ev)
              {
                  if(ev)
                  {
                      var Obj=JSON.parse(ev);
                      $('#SendNotification #richText-7a0q7h').html(Obj.detailsData);
                      $('#SendNotification #hideNotification').val(Obj.detailsData);
                      $('#SendNotification #bookingSendNotificationId').val(Obj.bookingNum);
                      $('#SendNotification #notificationFrom').val(Obj.emailFrom);
                      $('#SendNotification #notificationTo').val(Obj.customerEmail);
                      $('#SendNotification #notificationSubject').val(Obj.subjectEmail);
                      
                      $('#SendNotification').modal('show');
                  }
              }
          });
          
      }
      else
      {
           alertify.error('Network Error Occer Please try again or contact to developer !');
      }
      
  }
  
  
  
  
  //
  $(document).on('click', '#saveAgetComment', function(ev){
      showLoder();
    var msg=$('#msgComment').val();
   
    
    var InqID=$('#inquiryIDFlowwUp').val();
    if(msg=='')
    {
        hideLoder();
        $('#msg').css('border-color','red');
        alertify.error("Agent Comment Required");
        return false;
    }
    if(msg!='' && msg!=null)
    {
        $.ajax({
            type:'POST',
            url:ajaxUrl+'Inquery/CommentBox2',
            data:{InqID:InqID,msg:msg},
            cache:false,
            success:function(res)
            {
                hideLoder();
                if(res!='')
                {
                    var IdsArray=res.split('%');
                    if(IdsArray[0] > 0) 
                    {
                        $('#msg').val('');  
                        var htmlpaste=IdsArray[1];
                        $('#inquiryModelAndComments #commentsDiv').append(htmlpaste);
                        alertify.success("Your Comments Saved Successfully !");
                        location.reload();
                    }
                    else
                    {
                        alertify.error("Network Error Please try again!");
                        return false;
                    }
                }
            },
            error:function()
            {
                hideLoder();
                 alertify.error("Network Error Please try again!");
                 return false;
            }       
        });
    }
      
  } );
  
  function markAsClearedBooking(bookingId,companyCode)
  {
      alert(bookingId);
      if(bookingId!='' && bookingId>0)
      {
         alertify.confirm('Are you sure to '+companyCode+'-'+bookingId+' mark  as cleared ?',function(ev){
            if(ev)
            {
                showLoder();
                $.ajax({
                    type:'post',
                    url:ajaxUrl+'markClearedBox',
                    data:{bookingId:bookingId},
                    cache:false,
                    success:function(res)
                    {
                        if(res >0)
                        {
                            hideLoder();
                            alertify.success('Operation Successfully Completed');
                            location.reload();
                        }
                        else
                        {
                            hideLoder();
                           alertify.error('Network Error Occer Please try again or contact to developer !'); 
                           return false;   
                        }
                    }
                });
            } 
            else
            {
                hideLoder();
                alertify.error('You had canceled the operation !');  
                return false; 
            }
          });
      }
      else
      {
          alertify.error('Network Error Occer Please try again or contact to developer !'); 
           return false; 
      }
  }
  function getIssuanceModal(bookingId)
  {
      
       if(bookingId)
        {
             showLoder();
            $.ajax({
                type:'POST',
                url:ajaxUrl+'IssueModelPrepare',
                data:{bookingId:bookingId},
                cache:false,
                success:function($resp)
                {

                    var objIssue=JSON.parse($resp);

                    $('#editTicketIssuanceDetail #ticketIsssenceTitleEdit').text(objIssue.bookingTitle);
                    $('#editTicketIssuanceDetail #ticketSuplierEdit').val(objIssue.bookingDetails.supplier_name);
                    $('#editTicketIssuanceDetail #issueBookingIdEdit').val(objIssue.bookingDetails.id);
                    $('#editTicketIssuanceDetail #IssuanceDateEdit').val(objIssue.bookingDetails.	issue_date);
                    $('#editTicketIssuanceDetail #supplierRefIssueEdit').val(objIssue.bookingDetails.supplier_ref);
                    $('#editTicketIssuanceDetail #gdsIssueEdit').val(objIssue.flightDetails.gds);
                    $('#editTicketIssuanceDetail #issuePnrEdit').val(objIssue.flightDetails.pnr);
                    $('#editTicketIssuanceDetail #issueBrandEdit').val(objIssue.brandName);
                    var htmlNew='';
                    var totalIssueP=0;
                    $.each(objIssue.passenger,function(index,item){
                        var tr='<tr><td>'+item.title+'</td><td>'+item.firstName+'</td><td>'+item.midle_name+'</td><td>'+item.sur_name+'</td><td>'+item.age+'</td><td>'+item.category+'</td><td><input type="text" id="eticketIssueEdit'+index+'" name="eticketIssueEdit[]" value="'+item.eticket+'" class="form-control" placeholder="E-ticket"><input type="hidden"  name="passerIdsEdit[]" value="'+item.passenger_Id+'" ></td></tr>';
                        htmlNew=htmlNew+tr;
                        totalIssueP++;
                    });
                    $('#editTicketIssuanceDetail #totalPassanerIssueEdit').val(totalIssueP);
                    $('#editTicketIssuanceDetail #passenderIssueEdit').html(htmlNew);
                     hideLoder();
                    $('#editTicketIssuanceDetail').modal('show');

                }
            });
        }
  }
  
  $("#issueTicketFormEdit").on('submit',(function(e) {
         e.preventDefault();
         var issueDate=$('#IssuanceDateEdit').val();
         var totalIssueP=$('#totalPassanerIssueEdit').val();
         if(issueDate=='')
         {
             alertify.alert('Please Select the Date Issue');
             return false;
         }
         for(var i=totalIssueP;i >0;i--)
         {
             var j=i-1;
             var eticket=$('#eticketIssueEdit'+j).val();
             if(eticket=='')
             {
                alertify.alert('Please enter the E-ticket of passenger '+i);     
                return false;
             }
         }
         $.ajax({
        	url: ajaxUrl+'IssuedEditBox',
                type: "POST",
		data:  new FormData(this),
		contentType: false,
                processData:false,
		success: function(data)
		    {
                        if(data>0)
                        {
                            hideLoder();
                            $('#editTicketIssuanceDetail').modal('hide');
                           location.reload();
                        }
                        else
                        {
                            hideLoder();
                            $('#editTicketIssuanceDetail').modal('hide');
                            alertify.error('Network Error occer please try again!');
                        }
                    },
		  	error: function() 
                        {
                            hideLoder();
                            $('#editTicketIssuanceDetail').modal('hide');
                            alertify.error('Network Error occer please try again!');
                            
                        } 	        
	   });
     }));
function getSendInvoiceModel(bookingId)
{
   
    $.ajax({
        type:'POST',
        url:ajaxUrl+'SendReceiptBoxGet2',
        cache:false,
        data:{bookingId:bookingId},
        success:function(resp)
        {
            //console.log(resp);
            var obj=JSON.parse(resp);
          // console.log(obj);
            $('#SendReceiptAgentSide #sendReceiptFromAgent').val(obj.from);
            $('#SendReceiptAgentSide #sendReceiptToAgent').val(obj.to);
            $('#SendReceiptAgentSide #sendReceiptSubjectAgent').val(obj.subject);
            //$('#SendReceiptAgentSide #sendReceiptCcAgent').val(obj.cc);
            $('#SendReceiptAgentSide #receiptSendMessageAgent').val(obj.detailsData);
            $('#SendReceiptAgentSide #bookingIdhidenSendReceiptAgent').val(obj.bookingNum);
            $('#SendReceiptAgentSide #richText-moowvw-Agent').html(obj.detailsData);
            $('#SendReceiptAgentSide').modal('show');
        }
    });
}
// Send Invoice
$("#receiptSendFormAgent").on('submit',(function(e) {
         e.preventDefault();
         $.ajax({
        	url: ajaxUrl+'ReceiptSendBox2',
                type: "POST",
		data:  new FormData(this),
		contentType: false,
                processData:false,
		success: function(data)
		    {
                        if(data==1)
                        {
                            alertify.success('Invoice Sent successfully !');
                            location.reload();
                        }
                    }
                         	        
	   });
//       }
      
     }));
     
function onOffSupplier(supplierId,supplierName,supplierFlag,flag)
{
   
 if(supplierId>0)
 {
     alertify.confirm("Are you sure to "+supplierFlag+" "+supplierName,function(ev){
         if(ev)
         {
                showLoder();
                $.ajax({
                    type:'post',
                    url:ajaxUrl+'supplierOnOffBox',
                    data:{supplierId:supplierId,flag:flag},
                    cache:false,
                    success:function(resp)
                    {
                        if(resp >0)
                        {
                            hideLoder();
                            alertify.success("Operation Succesfully Completed !");
                            location.reload();
                        }
                    }
                });
         }
         else
         {
            hideLoder();
            alertify.error('You had canceled the operation !');  
            return false;
         }
     });
 }   
 else
 {
     alertify.error('Network Error Occer Please try again or contact to developer !'); 
     return false; 
 }
}

function onOffBank(bankId,bankName,bankFlag,flag)
{
    
 if(bankId>0)
 {
     alertify.confirm("Are you sure to "+bankFlag+" "+bankName,function(ev){
         if(ev)
         {
                showLoder();
                $.ajax({
                    type:'post',
                    url:ajaxUrl+'bankOnOffBox',
                    data:{bankId:bankId,flag:flag},
                    cache:false,
                    success:function(resp)
                    {
                        if(resp >0)
                        {
                            hideLoder();
                            alertify.success("Operation Succesfully Completed !");
                            location.reload();
                        }
                    }
                });
         }
         else
         {
            hideLoder();
            alertify.error('You had canceled the operation !');  
            return false;
         }
     });
 }   
 else
 {
     alertify.error('Network Error Occer Please try again or contact to developer !'); 
     return false; 
 }
}
function onOffExpense(expenseId,expenseName,expenseFlag,flag)
{
    
 if(expenseId>0)
 {
     alertify.confirm("Are you sure to "+expenseFlag+" "+expenseName,function(ev){
         if(ev)
         {
                showLoder();
                $.ajax({
                    type:'post',
                    url:ajaxUrl+'expenseOnOffBox',
                    data:{expenseId:expenseId,flag:flag},
                    cache:false,
                    success:function(resp)
                    {
                        if(resp >0)
                        {
                            hideLoder();
                            alertify.success("Operation Succesfully Completed !");
                            location.reload();
                        }
                    }
                });
         }
         else
         {
            hideLoder();
            alertify.error('You had canceled the operation !');  
            return false;
         }
     });
 }   
 else
 {
     alertify.error('Network Error Occer Please try again or contact to developer !'); 
     return false; 
 }
}
function onOffIncome(incomeId,incomeName,incomeFlag,flag)
{
    
 if(incomeId>0)
 {
     alertify.confirm("Are you sure to "+incomeFlag+" "+incomeName,function(ev){
         if(ev)
         {
                showLoder();
                $.ajax({
                    type:'post',
                    url:ajaxUrl+'incomeOnOffBox',
                    data:{incomeId:incomeId,flag:flag},
                    cache:false,
                    success:function(resp)
                    {
                        if(resp >0)
                        {
                            hideLoder();
                            alertify.success("Operation Succesfully Completed !");
                            location.reload();
                        }
                    }
                });
         }
         else
         {
            hideLoder();
            alertify.error('You had canceled the operation !');  
            return false;
         }
     });
 }   
 else
 {
     alertify.error('Network Error Occer Please try again or contact to developer !'); 
     return false; 
 }
}

function onOffCompany(companyId,companyName,companyFlag,flag)
{
//    alertify.alert('Test');
//    return ;
 if(companyId>0)
 {
     alertify.confirm("Are you sure to "+companyFlag+" "+companyName,function(ev){
         if(ev)
         {
                showLoder();
                $.ajax({
                    type:'post',
                    url:ajaxUrl+'companyOnOffBox',
                    data:{companyId:companyId,flag:flag},
                    cache:false,
                    success:function(resp)
                    {
                        if(resp >0)
                        {
                            hideLoder();
                            alertify.success("Operation Succesfully Completed !");
                            location.reload();
                        }
                    }
                });
         }
         else
         {
            hideLoder();
            alertify.error('You had canceled the operation !');  
            return false;
         }
     });
 }   
 else
 {
     alertify.error('Network Error Occer Please try again or contact to developer !'); 
     return false; 
 }
}
function inquiryView(inquiryId)
{
   if(inquiryId >0)
   {
        showLoder();
        $.ajax({
            type:'post',
            url:ajaxUrl+'viewInquiryDetails',
            data:{inquiryId:inquiryId},
            cache:false,
            success:function(resp)
            {
                hideLoder();
               $('#inquiryViewModel .modal-body').html(resp); 
               $('#inquiryViewModel').modal('show'); 
            }
        });
   }
}
function getBookingCommentModel(bookingId)
{
    if(bookingId>0)
    {
        $.ajax({
            type:'post',
            url:ajaxUrl+'viewAllCommentsBookingModel',
            data:{bookingId:bookingId},
            cache:false,
            success:function(response)
            {
                $('#commentall .modal-body').html(response);
                $('#commentall').modal('show');
            }
        });
        //alertify.alert('test here '+bookingId);
    }
}

$(document).on('click', '#customeLogAddBtn', function(ev){
    ev.preventDefault();
    showLoder();
    var comment=$('#customLogAdd').val();
    var agentId=$('#commetPersonId').val();
    var agentFlag=$('#commetPersonFlg').val();
    var bookingId=$('#commetAgainstBooking').val();
    
    if(comment=='')
    {
        alertify.alert(" Enter Comment first ");
        hideLoder();
        return false;
    }
    
    if(comment!='')
    {
        showLoder();
        $.ajax({
            type:'post',
            url:ajaxUrl+'bookingCommentAddBox',
            data:{comment:comment,agentId:agentId,agentFlag:agentFlag,bookingId:bookingId},
            cache:false,
            success:function(response)
            {
                var obj=JSON.parse(response);
                if(obj.code >0)
                {
                    $('#bookingnotes').prepend(obj.data);
                    $('#customeLogAddForm')[0].reset();
                    $('#commentall').modal('hide');
                    hideLoder();
                    alertify.success("Operation Successfully completed");
                    location.reload();
                }
                else
                {
                    hideLoder();
                    alertify.error('Network Error Occer Please try again or contact to developer !'); 
                    return false; 
                }
            }
        });
        
    }
});

function saveCancelComment()
{
//    alert(" here is ");
    var commentCan=$('#remarksAddBy').val();
    var commentAgentId=$('#cancelCommentByAgentId').val();
    var commentBookingId=$('#CancelCommentBookinId').val();
    if(commentCan=='')
    {
        alertify.alert("Please Enter Comment ");
        return false;
    }
    showLoder();
    $.ajax({
        type:'post',
        url:ajaxUrl+'bookingCancelCommentAdded',
        data:{commentCan:commentCan,commentAgentId:commentAgentId,commentBookingId:commentBookingId},
        cache:false,
        success:function(resp)
        {
            if(resp>0)
            {
                hideLoder();
                $('#cancellationstatus').modal('hide');
                alertify.success("Operation Successfully Completed ");
                location.reload();
            }
            else
            {
                hideLoder();
                alertify.error('Network Error Occer Please try again or contact to developer !'); 
                return false; 
            }
        }
    });
    
}
function saveBookFollowComment()
{
    var commentCan=$('#folloewRemarksAddBy').val();
    var commentAgentId=$('#followCommentByAgentId').val();
    var commentBookingId=$('#followCommentBookinId').val();
    if(commentCan=='')
    {
        alertify.alert("Please Enter Comment ");
        return false;
    }
    showLoder();
    $.ajax({
        type:'post',
        url:ajaxUrl+'bookingFollowCommentAdded',
        data:{commentCan:commentCan,commentAgentId:commentAgentId,commentBookingId:commentBookingId},
        cache:false,
        success:function(resp)
        {
            if(resp>0)
            {
                hideLoder();
                $('#followup').modal('hide');
                $('#followModelFormId')[0].reset();
                alertify.success("Operation Successfully Completed ");
                location.reload();
            }
            else
            {
                hideLoder();
                alertify.error('Network Error Occer Please try again or contact to developer !'); 
                return false; 
            }
        }
    });
    
}

function addDebitModel()
    {
        
        var countDr =parseInt($('#drCountModel').val());
        countDr=countDr+1;
        showLoder();
        $.ajax({
            type:'post',
            url:ajaxUrl+'dr-model-more-transection-html',
            data:{countDr:countDr},
            cache:false,
            async: false,
            success:function(response)
            {
                 hideLoder();
                 $('#debitEntryModel').append(response);
                $('#drCountModel').val(countDr);
            }
        });
       
    }
    function decrementDebitModel()
    {
        var countDr=parseInt($('#drCountModel').val()); 
        if(parseInt(countDr)==1)
        {
            
        }
        else
        {
            $('#drModel'+countDr).remove();
            countDr=parseInt(countDr)-1;
            $('#drCountModel').val(countDr);
        }
    }
    function  addCreditModel()
    {
        var countCr =parseInt($('#crCountModel').val());
        countCr=countCr+1;
        showLoder();
        $.ajax({
            type:'post',
            url:ajaxUrl+'cr-model-more-transection-html',
            data:{countCr:countCr},
            cache:false,
            async: false,
            success:function(responseCr)
            {
                 hideLoder();
                 $('#crEntryModel').append(responseCr);
                 $('#crCountModel').val(countCr);
            }
        });
       
    }
    function decrementCreditModel()
    {
        var countCr=parseInt($('#crCountModel').val()); 
        if(parseInt(countCr)==1)
        {
            
        }
        else
        {
            $('#crModel'+countCr).remove();
            countCr=parseInt(countCr)-1;
            $('#crCountModel').val(countCr);
        }
    }
    
    function addDebitEditModel()
    {
        
        var countDr =parseInt($('#drCountEditModel').val());
        countDr=countDr+1;
        showLoder();
        $.ajax({
            type:'post',
            url:ajaxUrl+'dr-edit-model-more-transection-html',
            data:{countDr:countDr},
            cache:false,
            async: false,
            success:function(response)
            { 
                 hideLoder();
                 $('#drEntryModelEdit').append(response);
                $('#drCountEditModel').val(countDr);
            }
        });
       
    }
    function decrementDebitEditModel()
    {
        var countDr=parseInt($('#drCountEditModel').val()); 
        if(parseInt(countDr)==1)
        {
            
        }
        else
        {
            $('#drModel'+countDr).remove();
            countDr=parseInt(countDr)-1;
            $('#drCountEditModel').val(countDr);
        }
    }
    
     function  addCreditEditModel()
    {
        var countCr =parseInt($('#crCountEditModel').val());
        countCr=countCr+1;
        showLoder();
        $.ajax({
            type:'post',
            url:ajaxUrl+'cr-edit-model-more-transection-html',
            data:{countCr:countCr},
            cache:false,
            async: false,
            success:function(responseCr)
            {
                 hideLoder();
                 $('#crEntryEditModel').append(responseCr);
                 $('#crCountEditModel').val(countCr);
            }
        });
       
    }
    function decrementCreditEditModel()
    {
        var countCr=parseInt($('#crCountEditModel').val()); 
        if(parseInt(countCr)==1)
        {
            
        }
        else
        {
            $('#crEditModel'+countCr).remove();
            countCr=parseInt(countCr)-1;
            $('#crCountEditModel').val(countCr);
        }
    }
    function showIncomeModel()
    {
      showLoder();
        $.ajax({
        type:'post',
        url:ajaxUrl+'getBrandBoxArea',
        data:{},
        cache:false,
        async: false,
        success:function(message)
        {
            hideLoder();
            if(message)
            {
               
                $('#incomeModel #incomeBrand').html(message);
               $('#incomeModel').modal('show');
            }
            else
            {
                hideLoder();
                alertify.error('Network Error Occer Please Try Agagin');
            }
        }
    });  
    }
    function saveIncome()
    {
        var incomeHead=$.trim($('#incomeHead').val());
        var incomeType=$('#incomeCountry').val();
        var incomeBrand=$('#incomeBrand').val();
        showLoder();
        if(incomeHead=='')
        {
            alertify.error('Please enter Income head name '); 
            $('#incomeHead').focus();
            $('#incomeHead').attr('style','border: 1px solid red');
            hideLoder();
            return false;
        }
        if(incomeType=='')
        {
            alertify.error('Please Select Income type '); 
            $('#incomeCountry').focus();
            $('#incomeCountry').attr('style','border: 1px solid red');
            hideLoder();
            return false; 
        }
        if(incomeBrand=='')
        {
            alertify.error('Please Select Brand'); 
            $('#incomeBrand').focus();
            $('#incomeBrand').attr('style','border: 1px solid red');
            hideLoder();
            return false; 
        }
        $.ajax({
            type:'post',
            url:ajaxUrl+'IncomeBoxSave',
            cache:false,
            data:{incomeHead:incomeHead,incomeType:incomeType,incomeBrand:incomeBrand},
            success:function(response)
            {
                if(response>0)
                {
                     hideLoder();
                    alertify.success('Operation completed Successfully !');
                    $('#incomeModel').modal('hide');
                   window.location=reload(); 
                }
                else
                {
                hideLoder();
                alertify.error('Network Error Occer Please Try Agagin');
                }
            }                    
        });
    }