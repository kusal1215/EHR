@extends('admin.adminmaster')

@section('content')
    <div class="page-wrapper">
        <div class="content">
            <div class="row">
                <div class="col-sm-4 col-3">
                    <h4 class="page-title">Doctors</h4>
                </div>
                <div class="col-sm-8 col-9 text-right m-b-20">
                    <a href="{{route('AdminManager.addDoctor')}}" class="btn btn-primary btn-rounded float-right"><i class="fa fa-plus"></i> Add Doctor</a>
                </div>
            </div>
            <div class="row doctor-grid">
                @foreach($doctors as $doctor)
                <div class="col-md-4 col-sm-4  col-lg-3">
                    <div class="profile-widget">
                        <div class="doctor-img">
                            <a class="avatar" href="#"><img alt="image" src="{{ asset('uploads/doctorsProfile/'.$doctor -> user_image) }}"></a>
                        </div>
                        <div class="dropdown profile-action">
                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="{{url('/ehr/admin/editDoctor')}}/{{$doctor -> id}}"><i class="fa fa-pencil m-r-5"></i> Edit</a> \
                                <a class="dropdown-item delete" href="#" data-toggle="modal" id="{{ $doctor -> id }}"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                            </div>
                        </div>
                        <h4 class="doctor-name text-ellipsis"><a href="#">{{ $doctor -> firstname }} {{ $doctor -> lastname }}</a></h4>
                        <div class="doc-prof">{{ $doctor -> spec }}</div>
                        <div class="user-country">
                            <i class="fa fa-map-marker"></i> {{ $doctor -> address }}
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="see-all">
                        <a class="see-all-btn" href="javascript:void(0);">Load More</a>
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
    <div id="delete_doctor" class="modal fade delete-modal" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <img src="/assets/img/sent.png" alt="" width="50" height="46">
                    <h3>Are you sure want to delete this Doctor?</h3>
                    <div class="m-t-20"> <a href="#" class="btn btn-white" data-dismiss="modal">Close</a>
                        <button type="button"  name="ok_button" id="ok_button" class="btn btn-danger">Delete</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function (){
            var  user_id;
            $(document).on('click' , '.delete' , function (){
                user_id = $(this).attr('id');
                console.log(user_id);
                $('#delete_doctor').modal('show');
            });

            $('#ok_button').click(function (){
                    console.log(user_id);
                    console.log('ajax in');
                $.ajax({
                    url:"/ehr/admin/deleteDoctor/"+user_id,
                    beforeSend:function (){
                        $('#ok_button').text('Deleting...');
                        console.log(this.url);
                    },
                    success:function (data){
                        setTimeout(function (){
                            $('#delete_doctor').modal('hide');
                            // alert('Data Deleted');
                            window.location.reload();
                        },2000);
                    }
                })
            });
        });
    </script>
    <script>
        $(document).ready( function () {
            $('.mydatadable').DataTable();
        } );
    </script>
    {{--    <script src="/assets/js/jquery.dataTables.min.js"></script>--}}
    {{--    <script src="/assets/js/dataTables.bootstrap4.min.js"></script>--}}
    <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
@endsection
