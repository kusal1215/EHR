@extends('patient.master')

@section('header')

@endsection

@section('content')
<div class="page-wrapper">
    <div class="content">
        <div class="row">
            <div class="col-sm-4 col-3">
                <h4 class="page-title">Video Call</h4>
            </div>
            <div class="col-sm-8 col-9 text-right m-b-20">
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div id="media-div">
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

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Join a meeting</h5>
            </div>
            <div class="modal-body">
                <form>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="audioCheck" name="audio"
                            onchange="videoAudioStatus()">
                        <label class="custom-control-label" for="audioCheck">Don't connect to audio</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="videoCheck" name="video"
                            onchange="videoAudioStatus()">
                        <label class="custom-control-label" for="videoCheck">Turn off my video</label>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="video()" class="btn btn-primary">Join</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    // additional functions will be added after this point
    $(document).ready(function () {
        $('#exampleModal').modal({
            backdrop: 'static'
        });
        sessionStorage.setItem('video', 0);
        sessionStorage.setItem('audio', 0);
    });

    function videoAudioStatus() {
        if ($('#audioCheck').prop('checked')) {
            sessionStorage.setItem('audio', 1);
        } else {
            sessionStorage.setItem('audio', 0);
        }

        if ($('#videoCheck').prop('checked')) {
            sessionStorage.setItem('video', 1);
        } else {
            sessionStorage.setItem('video', 0);
        }
    }

    function video() {
        $('#exampleModal').modal('toggle');

        $('#unMuteBtn').fadeOut();
        // history.replaceState({}, null, "/create");


        Twilio.Video.createLocalTracks({
            audio: true,
            video: {
                width: 80
            }
        }).then(function (localTracks) {
            return Twilio.Video.connect('{{ $accessToken }}', {
                name: 'Room 1',
                tracks: localTracks,
                video: {
                    width: 1000,
                    frameRate: 24
                },
                maxAudioBitrate: 16000,
                networkQuality: {
                    local: 3,
                    remote: 3
                }
            });
        }).then(function (room) {
            room.participants.forEach(participantConnected);

            var previewContainer = document.getElementById(room.localParticipant.sid);
            if (!previewContainer || !previewContainer.querySelector('video')) {
                participantConnected(room.localParticipant);
            }

            room.on('participantConnected', function (participant) {
                participantConnected(participant);
            });

            room.on('participantDisconnected', function (participant) {
                participantDisconnected(participant);
            });
        });
    }
    var room1;

    function participantConnected(participant) {

        room1 = participant;

        const div = document.createElement('div');
        div.id = participant.sid;

        participant.tracks.forEach(function (track) {
            trackAdded(div, track)
        });

        participant.on('trackAdded', function (track) {
            trackAdded(div, track)
        });
        participant.on('trackRemoved', trackRemoved);
        document.getElementById('media-div').appendChild(div);
    }

    function participantDisconnected(participant) {
        participant.tracks.forEach(trackRemoved);
        document.getElementById(participant.sid).remove();
    }

    var count = 0;

    function trackAdded(div, track) {
        count++;
        div.appendChild(track.attach());
        var video = div.getElementsByTagName("video")[0];

        $('#closeBtn').html(
            "<button class='btn btn-danger' onclick='parent.window.close();' id='cancelBtn'><i class='fa fa-phone' id='cancelIcon'></i></button>"
        );
        if (sessionStorage.getItem('video') == 1) {
            muteVideo();
        } else {
            unMuteVideo();
        }

        if (sessionStorage.getItem('audio') == 1) {
            muteAudio();
        } else {
            unMuteAudio();
        }



        if (video) {
            $("#" + room1.sid + " video").css("width", "120px");
            $("#" + room1.sid).css({
                'left': '339px',
                'bottom': '605px',
                'position': 'relative'
            });

            if (count == 4) {
                video.setAttribute("style", "width:800px;");
            }

        }
    }

    function trackRemoved(track) {
        track.detach().forEach(function (element) {
            element.remove()
        });
    }


    function muteVideo() {
        room1.videoTracks.forEach(function (video) {
            var muteVideohtml = "";
            $('#videoBtn').html(muteVideohtml);
            $('#videoBtn').html(
                "<button class='btn btn-light' onclick='unMuteVideo()'><i class='fas fa-video'></i></button>"
            );
            video.disable();
        });
    }

    function unMuteVideo() {
        room1.videoTracks.forEach(function (videoTracks) {
            var html = "";
            $('#videoBtn').html(html);
            $('#videoBtn').html(
                "<button class='btn btn-light' onclick='muteVideo()'><i class='fas fa-video-slash'></i></button>"
            );
            videoTracks.enable();
        });
    }

    function unMuteAudio() {
        room1.audioTracks.forEach(function (audioTrack) {
            var unMuteAudiohtml = "";
            $('#audioBtn').html(unMuteAudiohtml);
            $('#audioBtn').html(
                "<button class='btn btn-light' onclick='muteAudio()'><i class='fas fa-microphone-alt-slash'></i></button>"
            );
            audioTrack.enable();
        });
    }

    function muteAudio() {
        room1.audioTracks.forEach(function (audioTrack) {
            var muteAudiohtml = "";
            $('#audioBtn').html(muteAudiohtml);
            $('#audioBtn').html(
                "<button class='btn btn-light' onclick='unMuteAudio()'><i class='fas fa-microphone-alt'></i></button>"
            );
            audioTrack.disable();
        });
    }

</script>
@endsection
