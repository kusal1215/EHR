@extends('admin.adminmaster')

@section('content')
    <div class="page-wrapper">
        <div class="content">
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <h4 class="page-title">Edit Doctor</h4>
                    <p>{{ session('msg') }}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <form method="POST" action="{{url('/ehr/admin/updateDoctor')}}/{{ $doctor -> id }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>First Name <span class="text-danger">*</span></label>
                                    <input class="form-control" id="firstname"
                                           name="firstname" type="text" value="{{ $doctor -> firstname }}">
                                    <input name="user_level" type="hidden" value="2">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Last Name</label>
                                    <input class="form-control" id="lastname"
                                           name="lastname" type="text" value="{{ $doctor -> lastname }}">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Username <span class="text-danger">*</span></label>
                                    <input class="form-control" id="name"
                                           name="name" type="text" value="{{ $doctor -> name }}">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Email <span class="text-danger">*</span></label>
                                    <input class="form-control" id="email" type="email"
                                           name="email" required autocomplete="email" value="{{ $doctor -> email }}">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Password</label>
                                    <input id="password" name="password"
                                           class="form-control" type="password"
                                           required autocomplete="new-password"
                                           value="{{ $doctor -> password }}">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Confirm Password</label>
                                    <input class="form-control" type="password"
                                           id="password-confirm"
                                           name="password_confirmation" required
                                           autocomplete="new-password"
                                           value="{{ $doctor -> password }}">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Date of Birth</label>
                                    <div class="cal-icon">
                                        <input type="text" class="form-control datetimepicker"
                                               id="birthdate" name="birthdate"
                                               value="{{ $doctor -> birthdate }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group gender-select">
                                    <label class="gen-label">Gender:</label>
                                    <div class="form-check-inline">
                                        <label class="form-check-label">
                                            <input type="radio" name="gender" class="form-check-input"
                                                   value="male"
                                                {{ $doctor -> gender == 'male' ?'checked':''}}>Male
                                        </label>
                                    </div>
                                    <div class="form-check-inline">
                                        <label class="form-check-label">
                                            <input type="radio" name="gender" class="form-check-input" value="female"
                                                {{ $doctor -> gender == 'female' ?'checked':''}}>Female
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label>Address</label>
                                            <input type="text" class="form-control"
                                                   id="address" name="address"
                                                   value="{{ $doctor -> address }}"
                                            >
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-6 col-lg-4">
                                        <div class="form-group">
                                            <label>Doctor Specializations <span class="text-danger">*</span></label>
                                            <select class="form-control select" required id="spec" name="spec">
                                                <option>Dentists</option>
                                                <option selected>{{ $doctor -> spec }}</option>
                                                <option>Diagnostic radiology</option>
                                                <option>Emergency medicine</option>
                                                <option>Neurology</option>
                                                <option>Opthalmology</option>
                                                <option>Orthopedics</option>
                                                <option>Cancer Department</option>
                                                <option>ENT Department</option>
                                                <option>Family medicine</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-6 col-lg-4">
                                        <div class="form-group">
                                            <label>City</label>
                                            <input type="text" class="form-control" id="city" name="city"
                                                   value="{{ $doctor -> city }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-6 col-lg-4">
                                        <div class="form-group">
                                            <label>Postal Code</label>
                                            <input type="text" class="form-control" id="postal_code" name="postal_code"
                                                   value="{{ $doctor -> postal_code }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Phone </label>
                                    <input class="form-control" type="text" id="phone" name="phone"
                                           value="{{ $doctor -> phone }}">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Avatar</label>
                                    <div class="profile-upload">
                                        <div class="upload-img">
                                            <img alt="" src="/assets/img/user.jpg">
                                        </div>
                                        <div class="upload-input">
                                            <input type="file" class="form-control" name="user_image"
                                                   value="{{ $doctor -> user_image }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Short Biography</label>
                            <textarea class="form-control" rows="3" cols="30" id="bio" name="bio">
                                {{ $doctor -> bio }}</textarea>
                        </div>
                        <div class="form-group">
                            <label class="display-block">Status</label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" id="doctor_active" value="active"
                                    {{ $doctor -> status == 'active' ?'checked':''}}>
                                <label class="form-check-label" for="doctor_active">
                                    Active
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" id="doctor_inactive" value="inactive"
                                    {{ $doctor -> status == 'inactive' ?'checked':''}}>
                                <label class="form-check-label" for="doctor_inactive">
                                    Inactive
                                </label>
                            </div>
                        </div>
                        <div class="m-t-20 text-center">
                            <button type="submit" class="btn btn-primary submit-btn">Update Doctor</button>
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
