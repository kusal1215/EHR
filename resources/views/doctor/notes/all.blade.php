@extends('doctor.doctormaster')

@section('header')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">

@endsection

@section('content')
<div class="page-wrapper">
    <div class="content">
        <div class="row">
            <div class="col-sm-4 col-3">
                <h4 class="page-title">Notes</h4>
                <p class="text-success">{{ session('msg') }}</p>
            </div>
            <div class="col-sm-8 col-9 text-right m-b-20">
                <a href="{{ route('DoctorNoteManager.notes.add') }}"
                    class="btn btn btn-primary btn-rounded float-right"><i class="fa fa-plus"></i> Add Notes</a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="mydatadable table table-stripped" id="user_table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Appointment</th>
                                <th>Patient Name</th>
                                <th>Created At</th>
                                <th class="text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach(Auth::user()->doctor_note as $key => $note)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $note->appointment ? $note->appointment->aptId : '-'}}</td>
                                <td><img width="28" height="28" src="/assets/img/user.jpg" class="rounded-circle m-r-5"
                                        alt="">{{ $note->patient->name }}</td>
                                <td>{{$note->created_at}}</td>
                                <td class="text-right">
                                    <div class="dropdown dropdown-action">
                                        <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
                                            aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item"
                                                href="{{ route('DoctorNoteManager.notes.edit', $note->id) }}">
                                                <i class="fa fa-pencil m-r-5"></i> Edit
                                            </a>
                                            <a class="dropdown-item delete" id="{{ $note->id }}" href="#"
                                                data-toggle="modal"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
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
    <div id="delete_appointment" class="modal fade delete-modal" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <img src="/assets/img/sent.png" alt="" width="50" height="46">
                    <h3>Are you sure want to delete this Note?</h3>
                    <div class="m-t-20"> <a href="#" class="btn btn-white" data-dismiss="modal">Close</a>
                        <button type="button" name="ok_button" id="ok_button" class="btn btn-danger">Delete</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    $(document).ready(function () {
        var note_id;
        $(document).on('click', '.delete', function () {
            note_id = $(this).attr('id');
            $('#delete_appointment').modal('show');
        });

        $('#ok_button').click(function () {
            $.ajax({
                url: "/ehr/doctor/notes/delete/" + note_id,
                beforeSend: function () {
                    $('#ok_button').text('Deleting...');
                },
                success: function (data) {
                    setTimeout(function () {
                        $('#delete_appointment').modal('hide');
                        // alert('Data Deleted');
                        window.location.reload();
                    }, 2000);
                }
            })
        });
    });

</script>
<script>
    $(document).ready(function () {
        $('.mydatadable').DataTable();
    });

</script>
{{--    <script src="/assets/js/jquery.dataTables.min.js"></script>--}}
{{--    <script src="/assets/js/dataTables.bootstrap4.min.js"></script>--}}
<script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
@endsection
