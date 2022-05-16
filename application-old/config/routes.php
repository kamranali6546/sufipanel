<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'login';
$route['picked']='inquiry/picked';
$route['commentModal']='inquiry/getCommentModel';
$route['Receival-Summary']='inquiry/receicval_summary';

$route['new-customers-inquiries']='inquiry/index';

$route['UserBox']='home/profile';
$route['followup']='inquiry/followup';
//$route['followup/(:any)']='inquiry/followup/$1';
$route['closed']='inquiry/closed';
$route['emailBackup']='inquiry/emailBackup';
$route['converstion']='inquiry/converstion';
$route['NewFollowUP']='inquiry/newfollowup';
$route['FlowupUpdaeBox']='inquiry/flowupUpdate';
$route['FollowupSave']='inquiry/newFollowupSave';
$route['User']='Agents/index';
$route['UserSave']='Agents/agentSave';
$route['Newuser']='Agents/AddForm';
$route['Agencies']='Company/index';
$route['AgencyNew']='Company/companyNew';
$route['AgencySave']='Company/saveCompany';
$route['details/(:any)']='inquiry/followupdetails/$1';
$route['editBox/(:any)']='inquiry/flowupEditView/$1';
$route['pickedDetils/(:any)']='inquiry/pickedDetails/$1';
$route['AgentEditBox/(:any)']='Agents/editAgent/$1';
$route['AgentBoxUpdate']='Agents/updateUser';
$route['Inquery/CommentBox']='ajax/agentInqueryCommentSave';
$route['Inquery/CommentBox2']='ajax/agentInqueryCommentSave2';
$route['Inquery/DeleteBox']='ajax/deteleInquiry';
$route['Inquery/AgentsBox']='ajax/agentsData';
$route['Inquery/AgentsBoxs']='ajax/agentsData2';
$route['Inquery/AssignBox']='ajax/assignInquiry';
$route['Inquery/OtherDownloadBox']='inquiry/otherDownloadView';
$route['Inquery/OtherDownloadBoxSheet']='inquiry/otherDownloadSheet';
$route['OtherDeleteBox']='inquiry/DeleteinquiryOther';
$route['OtherDeleteBoxGet']='inquiry/DeleteinquiryOtherGet';
$route['DeleteInquiryBox']='inquiry/confirmDeleteinquiry';
$route['Booking']='NewBooking/index';
$route['SaveBooking']='NewBooking/saveBooking';
$route['CardCheckBox']='Ajax/cardCheck';
$route['Pending']='Pending/index';
$route['booking-follow-ups']='Pending/bookingFollowUp';
$route['search-result']='Pending/mega_search';
// pending-bookings
$route['pending-bookings']='Pending/index';
$route['pending-bookings/(:any)']='Pending/index';
$route['pending-bookings-red-flag']='Pending/redFlagBook';
$route['pending-bookings-fourty-percent-or-above']='Pending/fortyPer';

$route['Issued']='Issued/index';
$route['issued-bookings']='Issued/index';
$route['issued-cleared-bookings']='Issued/cleared';

$route['Canceled']='Canceled/index';
$route['PendingTask']='PendingTask/index';

$route['pending-task']='PendingTask/index';

$route['Attendance']='Attendance/index';
$route['AttendanceBoxCheck']='Attendance/attendanceCheckBox';
$route['AttendanceTimeOutBox']='Attendance/checkOutTime';
$route['AttendanceExportBox']='Attendance/exportAttendance';
$route['GeneralReportBox']='Reports/index';
$route['GrossReportBox']='Reports/grosProfitEarned';
$route['NetReportBox']='Reports/netProfitEarned';
$route['SupplierReportBox']='Reports/supplierDueBalance';
$route['CustomerReportBox']='Reports/customerDueBalanceReport';
$route['SheetDownload']='Reports/getmarginSheet';
$route['PaypalReportBox']='Reports/paypalReport';
$route['GlobalReportBox']='Reports/globalCardReport';
$route['GDSReportBox']='Reports/gdsReport';
$route['SearchBox']='Search/index';

$route['search-booking']='Search/index';

$route['CardBoxBalance']='CardBalanceStatus/index';
$route['ComapanyDeleteBox']='Company/companyDelete';
$route['AgentDeleteBox']='Agents/deleteAgent';
$route['BookingDetailBox/(:any)/(:any)']='Pending/bookingDetails/$1/$1';
$route['PassengerDeleteBox']='Ajax/deletePassenger';
$route['PassengerUpdateBox']='Ajax/passengerUpdate';
$route['PaymentBoxAdd']='Ajax/addPayment';
$route['PaymentBoxDelete']='Ajax/paymentDelete';
$route['PaymentBoxUpdate']='Ajax/paymentUpdate';
$route['ProfitBox']='Reports/grossProfit';
$route['BalanceBox']='Reports/dueBalanceReport';
$route['AttendanceFilterBox']='Ajax/attendanceFilter';
$route['BookingUpdateBox']='Pending/bookingUpdate';
$route['MarkedAsIssuedBox']='Ajax/markIssued';
$route['AgentListBox']='Ajax/agentGetOnly';
$route['BookAssignBox']='Ajax/bookAssignDone';
$route['PendingTaskBox']='Ajax/markAsPendingTask';
$route['SegmentCountBox']='Ajax/calculateSegment';
$route['SullierEditBox']='Ajax/getSupplierData';
$route['BankBoxAll']='Bank/index';
$route['BankSaveBox']='Bank/saveBank';
$route['bankDeleteBox']='Bank/deleteBank';
$route['bankBoxDataShow']='Ajax/bankData';
$route['RequestBox']='Ajax/addRequest';
$route['MessageReadBox']='Ajax/messageread';
$route['MessageDeleteBox']='Ajax/deleteMessage';
$route['TicketOrderBox']='Ajax/ticketOrder';
$route['TicketOrderBox2']='Ajax/ticketOrder2';
$route['PassangerBoxMore']='Ajax/passangerAdd';
$route['NegativeBox']='Ajax/negativeRemarks';
$route['RemaingRemarksBox']='Ajax/remaingRemarks';
$route['TicketOrderSendBox']='Ajax/tOrderSend';
$route['TicketOrderDel']='Ajax/ticketOrderDelete';
$route['TicketOrderRead']='Ajax/ticketOrderRead';
$route['NoteDeleteBox']='Ajax/agentNoteDelete';
$route['PandingFileBox']='Ajax/markAsPendingB';
$route['CardCancelBox']='Ajax/cardCancelation';
$route['CashCancelBox']='Ajax/cashCancelation';
$route['CheckCashCancelComment']='Ajax/cashCancelCommentCheck';
$route['CardCancellactionCheckBox']='Ajax/CardCancelCommentCheck';
$route['CardCancelledRemarksBox']='Ajax/cardCancelledRemarks';
$route['CashCancelledRemarksBox']='Ajax/cashCancelledRemarks';
$route['refundRenmarkBox']='Ajax/refundRemarksAgent';
$route['ChargeBackBox']='Ajax/chargebackRemarksAgent';
$route['RefundRemarksCheckBox']='Ajax/refundCommentCheck';
$route['RefundBoxs']='Ajax/refundMarks';
$route['MarkChargeBackBox']='Ajax/markChargeBack';
$route['MarkPendingTaskToPendingBooking']='Ajax/markpendinfTaskTopendingBooking';
$route['ChargeBackRemarksCheckBoxs']='Ajax/ChargeBackCommentCheck';
$route['InvoiceBox/(:any)']='Invoice/index/$1';
$route['InvoiceBox2/(:any)']='Invoice/index2/$1';
$route['Invoice']='Invoice/finalInvoice';
$route['SupplierBox']='Supplier/index';
$route['SupplierAdd']='Supplier/SaveSupplier';
$route['SupplierDeleteBox']='Supplier/deleteSupplier';
$route['SupplierEditBox']='Supplier/updateSupplier';
$route['CardReceivedBoxEnter']='Ajax/cardreceived';
$route['CardReceivedBoxRecord']='Ajax/cardRecordReceived';
$route['PaymentRequestCheckBox']='Ajax/paymentCheckRequest';
$route['TicketOrderDataPoplateBox']='Ajax/ticketOrderDataPoplate';
$route['DeleteBoxes']='DeleteFiles/index';
$route['TransectionBox']='Transection/index';
$route['TransectionBoxPk']='Transection/pk_transection';
$route['BankAjaxData']='Ajax/getBanksData';

$route['current-progress']='Home/index';
$route['bank-cash-book']='CardBalanceStatus/cashBookBank';
$route['uk-Expenditures']='Expenditure/index';
$route['pk-office-expenditures']='Expenditure/officeExpensePk';
$route['suplier-ledgers-accounts']='Ledger/index';
$route['suspense-account']='Agents/suspenseAccount';
$route['trial-balance']='TrialBalance/index';
$route['pk-trial-balance']='TrialBalance/trialBalancePakistan';
$route['final-accounts']='TrialBalance/accountsFinal';
$route['pk-bank-book']='BookBank/index';
$route['customer-activities']='Customers/activities';
$route['customer-update']='Customers/customerInform';
$route['logs']='Home/logHistory';

$route['SupplierCostBox']='Ajax/supplierCostGet';
$route['ExpenseBox']='Expense/getExpense';
$route['ExpenseData']='Expense/saveExpenseHead';
$route['ExpenseDeleteBox']='Expense/delete';
$route['IncomeDeleteBox']='Income/delete';
$route['ExpenseEditBox']='Expense/editSearch';
$route['ExpenseUpdateBox']='Expense/doUpdate';
$route['ConfirmDeleteBoxTransection']='Transection/doDelete';
$route['ShowEditBoxTransection']='Ajax/getTrasectionEdit';
$route['ResendBox']='Ajax/resendDeailsGet';
$route['ResendDoneBox']='Ajax/doResendDone';
$route['ReceiptSendBox']='Ajax/doSendReceipt';
$route['ReceiptSendBox2']='Ajax/doSendReceipt2';
$route['NotificationSendBox']='Ajax/doSendNotification';
$route['NotificationBox']='Ajax/getNotificationData';
$route['PrepareDataRequestDeleteBox']='Ajax/getRequestDeleteData';
$route['RequestDeleteBoxDone']='Ajax/doRequestDelete';
$route['RequestDeleteBoxDoneTicket']='Ajax/doRequestDelete2';
$route['RequestConfirmBoxD']='Ajax/PaymentRequestConfirmDone';
$route['SendReceiptBoxGet']='Ajax/getSendReceiptInfo';
$route['SendReceiptBoxGet2']='Ajax/getSendReceiptInfo2';
$route['BookingLogBox']='Ajax/doSaveBookLog';
$route['NewCardBox']='Ajax/CardAddNew';
$route['CardBoxUpdate']='Ajax/doUpdateCard';
$route['GetCardBox']='Ajax/cardDataGet';
$route['GetCardBoxRequest']='Ajax/getCardDataForRequest';
$route['RefundRequestDataBox']='Ajax/getRefundPayment';
$route['RefundBoxActivity']='Ajax/addBookingLogAction';
$route['IssueModelPrepare']='Ajax/issueRelatedData';
$route['IssueRequestSend']='Ajax/doIssue';
$route['IssuedEditBox']='Ajax/doEditIssue';
$route['DoCancelBox']='Ajax/makeCancel';
$route['MakeReadyTicketOrderSendBox']='Ajax/makeReadyTicketOrder';
$route['TicketOrderSendBoxEmail']='Ajax/sendTicketOrderEmail';
$route['FlightDetailsCustomerCheck']='Ajax/checkItenery';
$route['cancelToPendingBox']='Ajax/returnToPending';
$route['issuedToPendingBox']='Ajax/returnFromIssued';
$route['makeFileClone']='Ajax/doClone';
$route['report-gross-profit-earned']='Reports/generateGrosprofit';
$route['report-gross-profit-earned-sheet']='Reports/generateGrosprofitSheet';
$route['report-net-profit-earned']='Reports/getNetProfitReport';
$route['report-net-profit-earned-sheet']='Reports/getNetProfitReportGetSheet';
$route['report-supplier-due-balance']='Reports/getSupplierLeftBalance';
$route['report-supplier-due-balance-sheet']='Reports/getSupplierLeftBalanceSheet';
$route['report-customer-due-balance']='Reports/leftBalanceReport';
$route['report-customer-due-balance-sheet']='Reports/leftBalanceReportSheet';
$route['report-global-card-charges']='Reports/getGlobalCardReport';
$route['report-global-card-charges-sheet']='Reports/getGlobalCardReportSheet';
$route['report-gds']='Reports/getGdsReport';
$route['report-gds-sheet']='Reports/getGdsReportSheet';
$route['agent-progress-graphs/(:any)']='Home/agentBaseGraph/$1';
$route['markClearedBox']='Ajax/markedClear';
$route['supplierOnOffBox']='Ajax/changeFlagSupplier';
$route['bankOnOffBox']='Ajax/changeFlagBank';
$route['expenseOnOffBox']='Ajax/changeFlagExpense';
$route['incomeOnOffBox']='Ajax/changeFlagIncome';
$route['companyOnOffBox']='Ajax/changeFlagCompany';
$route['viewInquiryDetails']='Ajax/getViewInquiryDetails';
$route['viewAllCommentsBookingModel']='Ajax/getBookingCommentModel';
$route['bookingCommentAddBox']='Ajax/addBookingComment';
$route['bookingCancelCommentAdded']='Ajax/addCustomComments';
$route['bookingFollowCommentAdded']='Ajax/addFolloCustomComments';
$route['dr-more-transection-html']='Ajax/getDrAddMoreHtml';
$route['dr-model-more-transection-html']='Ajax/getDrModelAddMoreHtml';
$route['cr-model-more-transection-html']='Ajax/getCrModelAddMoreHtml';
$route['cr-more-transection-html']='Ajax/getCrAddMoreHtml';
$route['dr-more-pk-transection-html']='Ajax/getDrAddMorePkHtml';
$route['cr-more-pk-transection-html']='Ajax/getCrAddMorePkHtml';

$route['dr-edit-model-more-transection-html']='Ajax/getDrEditModelAddMoreHtml';
$route['cr-edit-model-more-transection-html']='Ajax/getCrEditModelAddMoreHtml';

$route['getBrandBoxArea']='Ajax/getBrand';
$route['IncomeBox']='Expenditure/getIncome';
$route['IncomeBoxSave']='Income/saveIncome';
$route['uk-other-income']='Income/ukOtherIncome';
$route['pk-other-income']='Income/pkOtherIncome';





$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
