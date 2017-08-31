<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
get('/', 'Auth\AuthController@getLogin');
get('/documentation',function(){
	return view('documentation.detail');
});
get('/apply', 'JobController@apply');
post('/saveApplication',array('as' => 'job.saveApplication','uses' => 'JobController@saveApplication'));

Route::group(['middleware' => 'guest'], function () {
	get('/login', 'Auth\AuthController@getLogin');
	post('/login', 'Auth\AuthController@postLogin');
	get('password/email', 'Auth\PasswordController@getEmail');
	post('password/email', 'Auth\PasswordController@postEmail');
	get('password/reset/{token}', 'Auth\PasswordController@getReset');
	post('password/reset', 'Auth\PasswordController@postReset');
});

Route::group(['middleware' => 'auth'], function () {
	get('dashboard','DashboardController@index');
	get('/logout', 'Auth\AuthController@getLogout');

	resource('language', 'LanguageController'); 
	get('setLanguage/{locale}','LanguageController@setLanguage');
	post('language/addWords',array('as'=>'language.addWords','uses'=>'LanguageController@addWords'));
	patch('language/updateTranslation/{id}', ['as' => 'language.updateTranslation','uses' => 'LanguageController@updateTranslation']);
	
	Route::model('client','\App\Client');
	resource('client', 'ClientController'); 

	Route::post('/getlocations', 'LocationController@getlocations'); 
	Route::get('/getlocations', 'LocationController@getlocations'); 
	
	Route::model('location','\App\Location');
	resource('location', 'LocationController'); 

	get('/reporting', 'LocationController@reporting');
	
	get('employee/create', 'Auth\AuthController@getRegister');
	post('auth/register', 'Auth\AuthController@postRegister');
	Route::model('employee','\App\User');
	Route::resource('employee', 'EmployeeController',['except' => ['create', 'store']]);
	patch('users/profile/{id}', ['as' => 'employee.profileUpdate', 'uses' => 'EmployeeController@profileUpdate']);
	patch('users/sms/{id}', ['as' => 'employee.sendEmployeeSMS', 'uses' => 'SMSController@sendEmployeeSMS']);

	Route::model('bank_account','\App\BankAccount');
	resource('bank_account', 'BankAccountController',['only' => ['store', 'destroy']]); 
	Route::model('document','\App\Document');
	resource('document', 'DocumentController',['only' => ['store', 'destroy']]); 
	Route::model('salary','\App\Salary');
	resource('salary', 'SalaryController',['only' => ['store', 'destroy']]); 
	get('/employee/welcomeEmail/{user_id}/{token}','TemplateController@welcomeEmail');	
	
	Route::model('job','\App\Job');
	resource('job', 'JobController'); 

	Route::model('expense','\App\Expense');
	resource('expense', 'ExpenseController'); 

	Route::model('todo','\App\Todo');
	resource('todo', 'TodoController'); 

	Route::model('leave','\App\Leave');
	resource('leave', 'LeaveController'); 
	post('leaveUpdateStatus', ['as' => 'leave.updateStatus', 'uses' => 'LeaveController@updateStatus']);
	
	Route::model('holiday','\App\Holiday');
	resource('holiday', 'HolidayController'); 

	get('clock/in/{token}', array('as' => 'clock.in', 'uses' => 'ClockController@in'));
	get('clock/out/{token}', array('as' => 'clock.out', 'uses' => 'ClockController@out'));
	Route::any('attendance', array('as'=>'clock.attendance','uses'=>'ClockController@attendance'));
	get('attendance_monthly', 'ClockController@attendanceMonthly');
	post('attendance_monthly', array('as'=>'clock.attendanceMonthlyReport','uses'=>'ClockController@attendanceMonthlyReport'));
	post('uploadAttendance',array('as' => 'clock.uploadAttendance','uses' => 'ClockController@uploadAttendance'));
	get('update_attendance','ClockController@updateAttendance');
	post('updateAttendance',array('as' => 'clock.updateAttendance','uses' => 'ClockController@updateStaffAttendance'));
	
	post('/payroll/store',array('as' => 'payroll.store','uses' => 'PayrollController@store'));
	get('/payroll/generate/{action}/{payroll_slip_id}','PayrollController@generate');
	get('/payroll','PayrollController@index',['only' => ['create', 'store','index']]); 
	Route::any('/payroll/create',array('as' => 'payroll.create','uses' => 'PayrollController@create'));
	get('/my_payroll','PayrollController@myPayroll');
	post('/my_payroll',array('as' => 'payroll.myPayroll','uses' => 'PayrollController@myPayroll'));
	get('/all_contribution','PayrollController@allContribution');
	post('/all_contribution',array('as' => 'payroll.allContribution','uses' => 'PayrollController@allContribution'));
		
	Route::model('ticket','\App\Ticket');
	resource('ticket', 'TicketController'); 
	post('updateTicketStatus', ['as' => 'ticket.updateTicketStatus', 'uses' => 'TicketController@updateTicketStatus']);
	Route::model('ticket_comment','\App\TicketComment');
	resource('ticket_comment', 'TicketCommentController',['only' => ['store','destroy']]); 
	resource('ticket_note', 'TicketNoteController',['only' => ['store','update']]); 
	Route::model('ticket_attachment','\App\TicketAttachment');
	resource('ticket_attachment', 'TicketAttachmentController',['only' => ['store','destroy']]); 
	
	Route::model('task','\App\Task');
	resource('task', 'TaskController'); 
	post('updateTaskProgress', ['as' => 'task.updateTaskProgress', 'uses' => 'TaskController@updateTaskProgress']);
	Route::model('comment','\App\Comment');
	resource('comment', 'CommentController',['only' => ['store','destroy']]); 
	resource('note', 'NoteController',['only' => ['store','update']]); 
	Route::model('attachment','\App\Attachment');
	resource('attachment', 'AttachmentController',['only' => ['store','destroy']]); 
	
	get('message/compose', 'MessageController@compose'); 
	post('message', ['as' => 'message.store', 'uses' => 'MessageController@store']);
	get('message/sent','MessageController@sent'); 
	get('message','MessageController@inbox'); 
	get('message/view/{id}/{token}', array('as' => 'message.view', 'uses' => 'MessageController@view'));
	get('message/{id}/delete/{token}', array('as' => 'message.delete', 'uses' => 'MessageController@delete'));
	
	Route::model('award','\App\Award');
	resource('award', 'AwardController'); 
	
	get('/application/{id}','JobController@applicationDetail');
	delete('deleteApplication/{id}',array('uses' => 'JobController@deleteApplication', 'as' => 'application.deleteApplication'));
	patch('/updateApplicationStatus/{id}', ['as' => 'application.updateApplicationStatus','uses' => 'JobController@updateApplicationStatus']);

	
	Route::model('role','\App\Role');
	resource('role', 'RoleController'); 
	post('save-permission',array('as' => 'configuration.save_permission','uses' => 'ConfigController@savePermission'));

	get('configuration', 'ConfigController@index'); 
	post('configuration', array('as' => 'configuration.store','uses' => 'ConfigController@store')); 
	post('office-time', array('as' => 'configuration.time','uses' => 'ConfigController@officeTime')); 
	post('sms-store', array('as' => 'configuration.smsStore','uses' => 'ConfigController@smsStore')); 
	post('mail-store', array('as' => 'configuration.mailStore','uses' => 'ConfigController@mailStore')); 
	post('job-store', array('as' => 'configuration.jobStore','uses' => 'ConfigController@jobStore')); 
	
	Route::model('award_type','\App\AwardType');
	resource('award_type', 'AwardTypeController'); 

	Route::model('custom_field','\App\CustomField');
	resource('custom_field', 'CustomFieldController'); 
	
	Route::model('leave_type','\App\LeaveType');
	resource('leave_type', 'LeaveTypeController'); 
	
	Route::model('document_type','\App\DocumentType');
	resource('document_type', 'DocumentTypeController'); 
	
	Route::model('salary_type','\App\SalaryType');
	resource('salary_type', 'SalaryTypeController'); 
	
	Route::model('expense_head','\App\ExpenseHead');
	resource('expense_head', 'ExpenseHeadController'); 
	
	resource('template', 'TemplateController',['only' => ['index', 'update']]); 
	resource('sms_template', 'SMSTemplateController',['only' => ['index', 'update']]); 

	Route::model('notice','\App\Notice');
	resource('notice', 'NoticeController'); 

	get('sms', 'SMSController@index'); 
	get('sms/{type}', 'SMSController@index'); 
	post('sms', array('as'=>'sms.store','uses'=>'SMSController@store')); 

	get('/change_password', 'EmployeeController@changePassword');
	post('/change_password',array('as'=>'change_password','uses' =>'EmployeeController@doChangePassword'));
	patch('/change_employee_password/{id}',array('as'=>'change_employee_password','uses' =>'EmployeeController@doChangeEmployeePassword'));
});
