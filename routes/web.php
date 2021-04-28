<?php

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

Route::get('/', function () {
    return view('loginRegister.login');
});

Route::get('/ehr/register', function () {
    return view('loginRegister.register');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('/ehr')->group(function () {
    //  admin start here
    Route::get('/admin', 'AdminController@index')->name('AdminManager.admin');
    //  admin doctor part
    Route::get('/admin/doctor', 'AdminController@doctor')->name('AdminManager.doctor');
    Route::get('/admin/addDoctor', 'AdminController@addDoctorPage')->name('AdminManager.addDoctor');
    Route::post('/admin/addDoctorDB', 'AdminController@addDoctorDB')->name('AdminManager.addDoctorToDB');
    Route::get('/admin/deleteDoctor/{id}', 'AdminController@deleteDoctor')->name('AdminManager.deleteDoctor');
    Route::get('admin/editDoctor/{id}', 'AdminController@editDoctor')->name('AdminManager.editDoctor');
    Route::post('/admin/updateDoctor/{id}', 'AdminController@updateDoctor')->name('AdminManager.updateDoctor');

    //  appointment part
    Route::get('/admin/appointments', 'AdminAppointmentController@appointment')->name('AdminAppointmentManager.appointments');
    Route::get('/admin/addAppointments', 'AdminAppointmentController@loadAddAppointment')->name('AdminAppointmentManager.addAppointments');
    Route::post('/admin/addAppointmentsDB', 'AdminAppointmentController@addAppointmentDB')->name('AdminAppointmentManager.addAppointmentsToDB');
    Route::get('/admin/deleteAppointment/{id}', 'AdminAppointmentController@destroy')->name('AdminAppointmentManager.deleteAppointment');
    Route::get('/admin/editAppointment/{id}', 'AdminAppointmentController@editAppointment')->name('AdminAppointmentManager.editAppointment');
    Route::post('/admin/updateAppointment/{id}', 'AdminAppointmentController@updateAppointment')->name('AdminAppointmentManager.updateAppointment');

    //  admin patients
    Route::get('/admin/patients', 'AdminPatientController@patients')->name('AdminPatientManager.patients');
    Route::get('/admin/addPatientView', 'AdminPatientController@addPatientView')->name('AdminPatientManager.addPatientView');
    Route::post('/admin/addPatient', 'AdminPatientController@addPatient')->name('AdminPatientManager.addPatient');
    Route::get('/admin/deletePatient/{id}', 'AdminPatientController@deletePatient')->name('AdminAppointmentManager.deletePatient');
    Route::get('/admin/editPatientView/{id}', 'AdminPatientController@editPatientView')->name('AdminAppointmentManager.editPatientView');
    Route::post('/admin/updatePatient/{id}', 'AdminPatientController@updatePatient')->name('AdminAppointmentManager.updatePatient');
    //  admin end here


    //  doctor
    Route::get('/doctor', 'DoctorController@index')->name('DoctorManager.doctor');

    // doctor appointments
    Route::get('/doctor/appointments', 'DoctorAppointmentController@appointment')->name('DoctorAppointmentManager.appointments');
    Route::get('/doctor/appointments/view/{id}', 'DoctorAppointmentController@appointmentView')->name('DoctorAppointmentManager.appointments.view');
    Route::get('/doctor/appointments/seen/{id}', 'DoctorAppointmentController@appointmentSeen')->name('DoctorAppointmentManager.appointments.seen');
    Route::get('/doctor/appointments/pending/{id}', 'DoctorAppointmentController@appointmentPending')->name('DoctorAppointmentManager.appointments.pending');

    // doctor notes
    Route::get('/doctor/notes', 'DoctorNoteController@all')->name('DoctorNoteManager.notes.all');
    Route::get('/doctor/notes/add', 'DoctorNoteController@add')->name('DoctorNoteManager.notes.add');
    Route::post('/doctor/notes/save', 'DoctorNoteController@save')->name('DoctorNoteManager.notes.save');
    Route::get('/doctor/notes/edit/{id}', 'DoctorNoteController@edit')->name('DoctorNoteManager.notes.edit');
    Route::post('/doctor/notes/update/{id}', 'DoctorNoteController@update')->name('DoctorNoteManager.notes.update');
    Route::get('/doctor/notes/delete/{id}', 'DoctorNoteController@delete')->name('DoctorNoteManager.notes.delete');

    // doctor reports
    Route::get('/doctor/reports', 'DoctorReportController@all')->name('DoctorReportManager.reports.all');
    Route::get('/doctor/reports/add', 'DoctorReportController@add')->name('DoctorReportManager.reports.add');
    Route::post('/doctor/reports/save', 'DoctorReportController@save')->name('DoctorReportManager.reports.save');
    Route::get('/doctor/reports/edit/{id}', 'DoctorReportController@edit')->name('DoctorReportManager.reports.edit');
    Route::post('/doctor/reports/update/{id}', 'DoctorReportController@update')->name('DoctorReportManager.reports.update');
    Route::get('/doctor/reports/view/{id}', 'DoctorReportController@view')->name('DoctorReportManager.reports.view');
    Route::get('/doctor/reports/delete/{id}', 'DoctorReportController@delete')->name('DoctorReportManager.reports.delete');

    //  patient
    Route::get('/patient', 'PatientController@index')->name('PatientManager.patient');

    // patient appointments
    Route::get('/patient/appointments', 'PatientAppointmentController@appointment')->name('PatientAppointmentManager.appointments');
    Route::get('/patient/appointments/view/{id}', 'PatientAppointmentController@appointmentView')->name('PatientAppointmentManager.appointments.view');
    Route::get('/patient/appointments/request', 'PatientAppointmentController@appointmentRequest')->name('PatientAppointmentManager.appointments.request');
    Route::post('/patient/appointments/request/save', 'PatientAppointmentController@appointmentRequestSave')->name('PatientAppointmentManager.appointments.request.save');

    // patient reports
    Route::get('/patient/reports', 'PatientReportController@all')->name('PatientReportManager.reports');
    Route::get('/patient/reports/view/{id}', 'PatientReportController@view')->name('PatientReportManager.reports.view');
    Route::get('/patient/reports/request', 'PatientReportController@reportRequest')->name('PatientReportManager.reports.request');
    Route::post('/patient/reports/request/save', 'PatientReportController@reportRequestSave')->name('PatientReportManager.reports.request.save');
});
