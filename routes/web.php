<?php

use Facades\App\Util;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

// Route::get('/','Auth\LoginController@showLoginForm');

Route::get('/', 'HomeController@mainPage')->name('home');
// Route::get('/home', 'HomeController@dashboard')->name('home');
// Route::get('dashboard','HomeController@dashboard');
Route::get('staff', 'HomeController@staff');
// Route::get('visitors','HomeController@visitors');
Route::get('calendar', 'CalendarController@Calendar');
Route::get('calendarjson', 'CalendarController@calendarJson');

Route::get('admindeptt', 'AdminDepttController@AdminDepttEventList');

Route::get('exporttoexcel/{event_type_id}/{file_type}', 'AdminController@exportToExcel');
Route::get('geteventtypeid/{event_type_id}', 'AdminController@getEventTypeId');

Route::get('admindepttParticipantArrivalSuccess/{event_part_id}', 'AdminDepttController@admindepttParticipantArrivalSuccess');

Route::get('admindepttParticipantArrivalCancel/{event_part_id}', 'AdminDepttController@admindepttParticipantArrivalCancel');

Route::get('AdminDeptWatcher', 'AdminDepttController@AdminDeptWatcher');

Route::get('AdminDeptEventsWatcher', 'AdminDepttController@AdminDeptEventsWatcher');

Route::get('gatekeeper', 'GatekeeperController@gatekeeperEventList');

Route::get('gatekeeperList', 'GatekeeperController@gatekeeperList');

Route::get('gatekeeperParticipantArrivalSuccess/{event_part_id}', 'GatekeeperController@gatekeeperParticipantArrivalSuccess');

Route::get('gatekeeperParticipantArrivalCancel/{event_part_id}', 'GatekeeperController@gatekeeperParticipantArrivalCancel');

Route::get('GateKeeperWatcher', 'GatekeeperController@GateKeeperWatcher');

Route::get('GateKeeperEventsWatcher', 'GatekeeperController@GateKeeperEventsWatcher');

Route::get('gatekeeperVehicleArrivalSuccess/{event_vehicle_id}', 'GatekeeperController@gatekeeperVehicleArrivalSuccess');

Route::get('gatekeeperVehicleArrivalCancel/{event_vehicle_id}', 'GatekeeperController@gatekeeperVehicleArrivalCancel');

Route::get('helpdesk', 'HelpDeskController@helpDeskEventList');
Route::get('HelpDeskWatcher', 'HelpDeskController@helpDeskWatcher');
Route::get('HelpDeskEventsWatcher', 'HelpDeskController@HelpDeskEventsWatcher');

Route::get('getupcomingevents', 'HospitalityController@getUpcomingEvents');

Route::get('hospitality', 'HospitalityController@hospitality');
Route::get('hospitalityUpcoming', 'HospitalityController@hospitalityUpcoming');
Route::get('HospitalityWatcher', 'HospitalityController@hospitalityWatcher');

Route::get('HospitalityEventsWatcher', 'HospitalityController@HospitalityEventsWatcher');

Route::get('users', 'AdminController@allUsers');
Route::post('users', 'AdminController@storeUser');
Route::post('updateUser', 'AdminController@updateUser');
Route::get('showUser/{id}', 'AdminController@showUser');

Route::get('deleteUser/{id}', 'AdminController@deleteUser');

Route::get('meeting/{event_type?}', 'AdminController@allEvents');
Route::get('private_meeting/{event_type?}', 'AdminController@allEvents');
Route::get('visit/{event_type?}', 'AdminController@allEvents');

Route::get('eventDetail/{id}', 'AdminController@showEvent');

Route::post('addParticipant', 'AdminController@storeParticipant');
Route::post('addVehicle', 'AdminController@storeVehicle');

Route::get('showVehicle/{id}', 'AdminController@showVehicle');
Route::post('updateVehicle', 'AdminController@updateVehicle');
Route::get('deleteVehicle/{id}/{event_id}', 'AdminController@deleteVehicle');

Route::get('showParticipant/{id}/{event_id}', 'AdminController@showParticipant');
Route::post('updateParticipant', 'AdminController@updateParticipant');

Route::get('deleteParticipant/{id}/{event_id}', 'AdminController@deleteParticipant');

//Route::post('addEvent', 'AdminController@storeEvent');
Route::post('addEvent', 'AdminController@storeEvent');

Route::get('editEvent/{id}', 'AdminController@editEvent');
Route::get('deleteEvent/{id}', 'AdminController@deleteEvent');

Route::post('updateEvent', 'AdminController@updateEvent');

Route::get('hospitalityPackage', 'AdminController@hospitalityPackage');

Route::get('outgoing', 'AdminController@outgoingEvents');

Route::get('deleteExternalEvent/{id}', 'AdminController@deleteExternalEvent');
Route::post('storeExternalEvent', 'AdminController@storeExternalEvent');
Route::get('editExternalEvent/{id}', 'AdminController@editExternalEvent');
Route::post('updateExternalEvent', 'AdminController@updateExternalEvent');

Route::get('meetingDateTimeCheck/{request_type}', 'AdminController@meetingDateTimeCheck');

Route::get('sendEmail/{id}', 'UtilsController@sendEmail');
Route::get('sendSms/{id}', 'UtilsController@sendSms');

// Route For DG Dashboard
// Route::get("dgdashboard", 'DgController@index');

Route::get('superadmin/meeting/{event_type?}', 'DgController@allEvents');
Route::get('superadmin/private_meeting/{event_type?}', 'DgController@allEvents');
Route::get('superadmin/visit/{event_type?}', 'DgController@allEvents');

Route::get('superadmin/meetingApproval/{event_id}/{approval}', 'DgController@meetingApproval');

Route::get("dgoutgoing", 'DgController@outgoingEvents');
Route::get('superadmin/externalMeetingApproval/{event_id}/{approval}', 'DgController@externalMeetingApproval');

Route::get("dgvisits", 'DgController@dgVisits');
Route::get("dgstaff", 'DgController@dgStaff');
Route::get("dgcalendar", 'DgController@dgCalendar');

Route::get('/sendSms/{id}', function ($id) {
	return Util::sendSms($id);
});