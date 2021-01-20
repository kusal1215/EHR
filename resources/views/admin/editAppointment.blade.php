@extends('admin.adminmaster')

@section('content')
    <div class="page-wrapper">
        <div class="content">
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <h4 class="page-title">Add Appointment</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <form  method="POST" action="{{url('/ehr/admin/updateAppointment')}}/{{ $appointment -> id }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Appointment ID</label>
                                    <input name="aptId" id="aptId" class="form-control" type="text" value="{{ $appointment -> aptId }}" readonly="">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Patient Name</label>
                                    <select class="form-control" id="patientId" name="patientId"  >
                                        <option> select </option>
                                        <option selected value="{{ $appointment -> patient -> id }}" readonly="">{{ $appointment -> patient -> name }}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Department</label><br>
                                    <select id="dept" name="dept" class="form-control" required >
                                        <option> select </option>
                                        <option selected>{{ $appointment -> department }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Doctor</label>
                                    <select id="doctorId" name="doctorId" class="form-control"  required >
                                        <option> select </option>
                                        <option selected value="{{ $appointment -> doctor -> id }}">{{ $appointment -> doctor -> name }}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Date</label>
                                    <div class="cal-icon">
                                        <input id="aptDate" name="aptDate" type="text" class="form-control datetimepicker" value="{{ $appointment -> date }}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Time</label>
                                    <div class="time-icon">
                                        <input type="text" name="aptTime" class="form-control" id="datetimepicker3" value="{{ $appointment -> time }}" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Patient Email</label>
                                    <input id="aptEmail" name="aptEmail" class="form-control" type="email" value="{{ $appointment -> patient_email }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Patient Phone Number</label>
                                    <input  id="aptPhoneNo" name="aptPhoneNo" class="form-control" type="text" value="{{ $appointment -> patient_phone_no }}" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Message</label>
                            <textarea id="aptMsg" name="aptMsg" cols="30" rows="4" class="form-control" required> {{ $appointment -> message }}</textarea>
                        </div>
                        <div class="form-group">
                            <label class="display-block">Appointment Status</label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" id="product_active" value="0" {{ $appointment -> seen == false ?'checked':''}}>
                                <label class="form-check-label" for="product_active">
                                    Pending Appointment
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" id="product_inactive" value="1" {{ $appointment -> seen == true ?'checked':''}}>
                                <label class="form-check-label" for="product_inactive">
                                    Completed
                                </label>
                            </div>
                        </div>
                        <div class="m-t-20 text-center">
                            <button type="submit" class="btn btn-primary submit-btn">Update Appointment</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="notification-box">
            <div class="msg-sidebar notifications msg-noti">
                <div class="topnav-dropdown-header">
                    <span>Messages</span>
                </div>
                <div class="drop-scroll msg-list-scroll" id="msg_list">
                    <ul class="list-box">
                        @foreach($messages as $message)
                            <li>
                                <a href="{{url('/chatify')}}">
                                    <div class="list-item">
                                        <div class="list-left">
                                            <span class="avatar"><img src="{{ asset('/storage/'.config('chatify.user_avatar.folder').'/'.$message->avatar) }}"></span>
                                        </div>
                                        <div class="list-body">
                                            <span class="message-author">{{ $message -> name }}</span>
                                            <span class="message-time">{{ $message -> 	created_at }}</span>
                                            <div class="clearfix"></div>
                                            <span class="message-content">{{ $message -> body }}</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="topnav-dropdown-footer">
                    <a href="{{url('/chatify')}}">See all messages</a>
                </div>
            </div>
        </div>
    </div>
@endsection
