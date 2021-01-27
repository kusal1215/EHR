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
                <form  method="POST" action="{{ route('AdminAppointmentManager.addAppointmentsToDB') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Appointment ID</label>
                                <input name="aptId" id="aptId" class="form-control" type="text" value="APT-{{ $number }}" readonly="">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Patient Name</label>
                                <select class="form-control" id="patientId" name="patientId" required>
                                    <option>Select</option>
                                    @foreach( $patients as $patient)
                                    <option value="{{ $patient -> id }}">{{ $patient -> name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Department</label><br>
                                <select id="dept" name="dept" class="form-control" required>
                                    <option>Select</option>
                                    <option>Dentists</option>
                                    <option>Neurology</option>
                                    <option>Opthalmology</option>
                                    <option>Orthopedics</option>
                                    <option>Cancer Department</option>
                                    <option>ENT Department</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Doctor</label>
                                <select id="doctorId" name="doctorId" class="form-control" required>
                                    <option>Select</option>
                                    @foreach( $doctors as $doctor)
                                        <option value="{{ $doctor -> id }}">{{ $doctor -> firstname }} {{ $doctor -> lastname }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Date</label>
                                <div class="cal-icon">
                                    <input id="aptDate" name="aptDate" type="text" class="form-control datetimepicker" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Time</label>
                                <div class="time-icon">
                                    <input type="text" name="aptTime" class="form-control" id="datetimepicker3" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Patient Email</label>
                                <input id="aptEmail" name="aptEmail" class="form-control" type="email" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Patient Phone Number</label>
                                <input  id="aptPhoneNo" name="aptPhoneNo" class="form-control" type="text" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Message</label>
                        <textarea id="aptMsg" name="aptMsg" cols="30" rows="4" class="form-control" required></textarea>
                    </div>
                    <div class="m-t-20 text-center">
                        <button type="submit" class="btn btn-primary submit-btn" {{ $doctors_count== 0 || $patients_count == 0 ?'disabled':''}}>Create Appointment</button>
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
