@extends('doctor.doctormaster')

@section('content')
<div class="page-wrapper">
    <div class="content">
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <h4 class="page-title">Add Report</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <form method="POST" action="{{ route('DoctorReportManager.reports.save') }}"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Patient Name</label>
                                <select class="form-control" id="patient_id" name="patient_id" required>
                                    <option>Select</option>
                                    @foreach( $patients as $patient)
                                    <option value="{{ $patient->id }}"
                                        {{$request_report && $request_report->patient_id == $patient->id ? 'selected':''}}>
                                        {{ $patient->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Patient Age</label>
                                <input id="age" name="age" class="form-control" type="number" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Sickness</label>
                        <textarea id="sickness" name="sickness" cols="30" rows="4" class="form-control"
                            required></textarea>
                    </div>
                    <div class="form-group">
                        <label>Medicine</label>
                        <textarea id="medicine" name="medicine" cols="30" rows="4" class="form-control"
                            required></textarea>
                    </div>
                    <div class="m-t-20 text-center">
                        <button type="submit" class="btn btn-primary submit-btn">Create Report</button>
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
