@extends('patient.master')

@section('content')
<div class="page-wrapper">
    <div class="content">
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <h4 class="page-title">Request Report</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <form method="POST" action="{{ route('PatientReportManager.reports.request.save') }}"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Doctor</label>
                                <select id="doctorId" name="doctor_id" class="form-control" required>
                                    <option>Select</option>
                                    @foreach( $doctors as $doctor)
                                    <option value="{{ $doctor -> id }}">{{ $doctor -> firstname }}
                                        {{ $doctor -> lastname }}</option>
                                    @endforeach
                                </select>
                                <input type="hidden" name="patient_id" value="{{Auth::user()->id}}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Details</label>
                        <textarea id="details" name="details" cols="30" rows="4" class="form-control"
                            required></textarea>
                    </div>
                    <div class="m-t-20 text-center">
                        <button type="submit" class="btn btn-primary submit-btn">Request Report</button>
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
                                    <span class="avatar"><img
                                            src="{{ asset('/storage/'.config('chatify.user_avatar.folder').'/'.$message->avatar) }}"></span>
                                </div>
                                <div class="list-body">
                                    <span class="message-author">{{ $message->name }}</span>
                                    <span class="message-time">{{ $message->created_at }}</span>
                                    <div class="clearfix"></div>
                                    <span class="message-content">{{ $message->body }}</span>
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
