<script> 
    $('#bankModalData').click( function()
    {
        $('#addBank').unbind();
        $('#addBank').modal('show');
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
   alertify.confirm("Are You Sure To Delete Inquiry And Related Data?",
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
                  $('#bsc #agnt').text(ids[1]);
                   alertify.success('Operation Successful!');
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
    tr.innerHTML='<td><select name="category[]" onchange="ChildIn(this.value)" id="" class="form-control" required="" ><option value="">--Select One</option><option value="Adult">Adult</option><option value="Youth">Youth</option><option value="Child">Child</option><option value="Infant">Infant</option></select></td><td>\n\
<select name="passangerTitle[]" id="" class="form-control" required="" ><option value="">--Select one--</option><option value="Mr">Mr</option><option value="Mrs">Mrs</option><option value="Miss">Miss</option><option value="Ms">Ms</option><option value="Mstr">Mstr</option><option value="Lord">Lord</option><option value="Dr">Dr</option><option value="Rev">Rev</option></select></td><td>\n\
<input type="text" name="firstName[]" id="firstName'+counterPass+'" onkeypress="removeerror(\'firstNameError'+counterPass+'\',this.id)" onkeyup="onlyletterWithSpace(\'firstNameError'+counterPass+'\',this.id)" class="form-control" placeholder="First Name" /><span id="firstNameError'+counterPass+'"></span></td><td>\n\
<input type="text" name="middle_name[]" id="" class="form-control" placeholder="Middle Name"  /></td><td>\n\
<input type="text" name="sir_name[]" id="surName'+counterPass+'" class="form-control" placeholder="Sur Name"  /><span id="surNameError'+counterPass+'"></span></td><td>\n\
<input type="text" name="age[]" id="age" class="form-control"  placeholder="dd/mm/yy" /></td><td>\n\
<input type="text" name="salePrice[]" id="salePrice'+counterPass+'" class="form-control" onkeypress="removeerror(\'salePriceError'+counterPass+'\',this.id)" onkeyup="numberWithDeceimal(\'salePriceError'+counterPass+'\',this.id)" onchange="calcul_totao_c(this.value)"  value="0" placeholder="Sale Price" /><span id="salePriceError'+counterPass+'"></span></td><td>\n\
<input type="text" name="booking_fee[]" id="bookingFee'+counterPass+'" onkeypress="removeerror(\'bookingFeeError'+counterPass+'\',this.id)" onkeyup="numberWithDeceimal(\'bookingFeeError'+counterPass+'\',this.id)" class="form-control"  placeholder="Admin Fee" /><span id="bookingFeeError'+counterPass+'"></span></td><td>\n\
<input type="text" name="eticket[]" id="" class="form-control" readonly="" placeholder="Eticket Number"  /></td>';
    main_tr.appendChild(tr);
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
 function cardValidCheck(cardNumer)
 {
     showLoder();
     if(cardNumer!='')
     {
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
    if($('#postalAddress').val()=='')
    {
        $('#postalAddress').attr('style','border: 1px solid red');
        $('#postalError').attr('style','color: red');
        $('#postalError').text('Please Fill the Postal Address');
        return false;   
    }
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
    if($('#departureDate').val()=="")
    {
      $('#departureDate').attr('style','border: 1px solid red');
      $('#DepartureDateError').attr('style','color: red');
      $('#DepartureDateError').text('Please Select the Departure Date');
      return false;
    }
    if($('#returnBookingDate').val()=="")
    {
      $('#returnBookingDate').attr('style','border: 1px solid red');
      $('#returnDateError').attr('style','color: red');
      $('#returnDateError').text('Please Select the Returning Date');
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
      $('#taxError').text('Please Enter The Basic Fare');
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
 function onlyNumber(errorId,fieldId)
 {
     var fieldvalue=$('#'+fieldId).val();
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
     alertify.confirm('Are You Sure To Delete Pannenger ?',function(ev){
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
                  alertify.success('Passenger Updated Successfully !');
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
    var receiverName=$('#receiverName').val();
    var paymentDate=$('#paymentAddDate').val();
    var receiptVia=$('#receipt_via option:selected').val();
    var cardtype=$('#card_type option:selected').val();
    var authorized=$('#authorizedCode').val();
    var amount=$('#amount').val();
    var paymentReference=$('#paymentReference').val();
    if(amount=='' || amount=='0')
    {
        $('#amount').attr('style','border: 1px solid red');
        $('#amountError').attr('style','color: red');
        $('#amountError').text('Please Enter The Amount');
        $('#paymentSaveBtn').removeAttr('disabled');
        return false;
    }
    if(paymentDate=='')
    {
        $('#paymentAddDate').attr('style','border: 1px solid red');
        $('#paymentDateError').attr('style','color: red');
        $('#paymentDateError').text('Please Select The payment Date');
        $('#paymentSaveBtn').removeAttr('disabled');
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
     showLoder();
     alertify.confirm('Are Yor Sure To Delete payment?',function(ev){
         if(ev)
         {
             $.ajax({
                 type:'POST',
                 url:ajaxUrl+'PaymentBoxDelete',
                 data:{paymentId:paymentId},
                 cache:false,
                 success:function(resp)
                {
                    if(resp >0 )
                    {
                       hideLoder(); 
                       alertify.success('Payment Deleted Successfully !');
                       location.reload(); 
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
             alertify.error('You Have Cancel The operation');
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
     var receiverName=$('#receiverName'+paymentId).val();
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
     var agentListFilter=$('#agentList option:selected').val();
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
         }
         else if(flightType=='Return')
         {
            $('#bookingViaReturning').removeAttr('disabled');
         }
     }
     else
     {
          $('#bookingViaReturning').removeAttr('disabled');
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
function myFunction()
{
    alert('SHAHID');
}
//document.getElementById("bookingVia").addEventListener("focusout", stopCountTotal);
function markAsIssued(bookigId,BtnId)
{
    $('#'+BtnId).attr('disabled',true);
    alertify.confirm('Do You real Mark as Issued ?',function(ev){
    if(ev)
    {
        showLoder();
        $.ajax({
            type:'POST',
            url:ajaxUrl+'MarkedAsIssuedBox',
            cache:false,
            data:{ bookingId:bookigId },
            success:function(res)
            {
                if(res >0)
                {
                    hideLoder();
                   $('#'+BtnId).removeAttr('disabled');
                   window.location=ajaxUrl+'Issued'; 
                }
                else
                {
                    hideLoder();
                   $('#'+BtnId).removeAttr('disabled');
                   location.reload();
                }
            }
        });
    }
    else
    {
        $('#'+BtnId).removeAttr('disabled');
        alertify.error('You Have Canceled The Operation');
    }
    });
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
    $('#'+BtnId).attr('disabled',true);
    showLoder();
    alertify.confirm('Do You Really Want To Mark As Pending Task ?',function(ev){
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
                       window.location=ajaxUrl+'PendingTask'; 
                    }
                    else
                    {
                       hideLoder();
                       $('#'+BtnId).removeAttr('disabled');
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
//                else
//                {
//                    alertify.alert('Your System Flight Details are not confirm .Please Conform Them');
//                }
            }
        });
    }
}
function bankSave()
{
    $('#BankBtn').attr('diaabled',true);
    showLoder();
    var bankName=$('#bankName').val();
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
    $.ajax({
        type:'POST',
        url:ajaxUrl+'BankSaveBox',
        data:{bankName:bankName},
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
    alertify.confirm('Are You sure To Delete this Bank ?',function(ev){
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
    //$('#'+btnId).attr('disabled',true);
    $.ajax({
        type:'POST',
        url:ajaxUrl+'bankBoxDataShow',
        cache:false,
        success:function(resp)
        {
            console.log(resp);
            $('#sendPayment #bankList').html(resp);
        }
    });;
   // console.log(htmlData);
    $('#sendPayment #requestBooking').val(bookingId);
    $('#sendPayment').modal('show');
    hideLoder();
    //$('#'+btnId).removeAttr('disabled');
} 
function makeRequest()
{
    var bookingNumber=$('#requestBooking').val();
    var requestType=$('#resuestType option:selected').val();
    var bankName=$('#bankList option:selected').val();
    var requestReference=$('#requestReference').val();
    var requestAmount=$('#requestAmount').val();
    var requestDate=$('#paymentAndRequest').val();
    var agentIdR=$('#agentRequestId').val();
    if(requestType=='')
    {
        //alertify.alert('')
        return false;
    }
    if(bankName=='')
    {
        return false;
    }
    if(requestReference=='')
    {
        return false;
    }
    if(requestAmount=='')
    {
        return false;
    }
    if(requestDate=='')
    {
        return false;
    }
    $.ajax({
        type:'POST',
        url:ajaxUrl+'RequestBox',
        cache:false,
        data:{ bookingNo:bookingNumber,requestType:requestType,bankName:bankName,requestReference:requestReference,requestAmount:requestAmount,requestDate:requestDate,agentIdR:agentIdR },
        success:function(resp)
        {
            if(resp >0)
            {
                $('#sendPayment').unbind();
                $('#sendPayment').modal('hide');
                alertify.alert('Request  Send Successfully ');
            }
            else
            {
                alertify.alert('Request Not Send');
            }
        }
    });
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
</script>
