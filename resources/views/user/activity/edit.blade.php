@extends('backpack::layout')

@section('header')
    <section class="content-header">
        <h1>
            TrackingLRT<small>Create Activity</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url(config('backpack.base.route_prefix', 'admin')) }}">{{ config('backpack.base.project_name') }}</a></li>
            <li class="active">Create Activity</li>
        </ol>
    </section>
@endsection


@section('content')

    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title">Edit Activity</h3>
        </div>

        <!-- /.box-header -->
        <div class="box-body">
            @if(count($errors)>0)
                <div class="callout callout-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form role="form" action="{{url("/activity".$activity->id."/save_change")}}" method="post" enctype="multipart/form-data">

            {{csrf_field()}}
            <!-- text input -->
                <div class="form-group {{$errors->has('judul')?'has-error':''}}">
                    <label>Judul</label>
                    <input type="text" class="form-control " {{($activity->user_id == \Illuminate\Support\Facades\Auth::user()->id)?'':'disabled'}} name="judul" placeholder="Enter ..." value="{{$activity->judul}}">
                </div>

                <div id="description-text" >&emsp;<span class="fa fa-plus inline"></span><p class="inline"> <u>Tambah Deskripsi</u> </p></div>
                <div class="form-group" id="description-form" style="display: none">
                    <label>Deskripsi</label>
                    <textarea class="form-control " {{($activity->user_id == \Illuminate\Support\Facades\Auth::user()->id)?'':'disabled'}} rows="3" name="deskripsi" placeholder="Enter ..." >{{$activity->deskripsi}}</textarea>
                </div>

                <div id="attachment-text" >&emsp;<span class="fa fa-plus inline"></span><p class="inline"> <u>Tambah Lampiran</u> </p></div>
                <div class="form-group" id="attachment-form" style="display: none">
                    <label>Lampiran</label>
                    @foreach(\App\AttachmentActivity::where('activity_id', '=', $activity->id)->get() as $lampiran)
                        <ul>
                            <li><a href="{{url('/activity/file/'.basename($lampiran->lampiran))}}">{{$lampiran->nama_asli_lampiran}}</a></li>
                        </ul>
                    @endforeach
                    <input type="file" name="attachment_activity" class="form-control "{{($activity->user_id == \Illuminate\Support\Facades\Auth::user()->id)?'':'disabled'}} placeholder="Enter...">
                </div>

                <!-- select -->
                @if(Auth::user()->role == 'super_admin')
                <div class="form-group {{$errors->has('hak_akses')?'has-error':''}}">
                    <label>Hak Akses</label>
                    <select class="form-control " {{($activity->user_id == \Illuminate\Support\Facades\Auth::user()->id)?'':'disabled'}} name="hak_akses">
                        <option value="" disabled="">--- Pilih Hak Akses ---</option>
                        <option value="private" {{($activity->hak_akses=='private')?'selected':''}}>Private</option>
                        <option value="team" {{($activity->hak_akses=='team')?'selected':''}}>Team</option>
                        @if(\Illuminate\Support\Facades\Auth::user()->role != 'member_group')
                            <option value="public" {{($activity->hak_akses=='public')?'selected':''}}>Public</option>
                        @endif
                    </select>
                </div>
                @endif

                <div class="form-group">
                    <label>Range Waktu:</label><br/>
                    <div class="row">
                        <div class="col-sm-6">
                            {{--<label>Tanggal Mulai:</label>--}}
                            <div class="input-group date {{$errors->has('tanggal_mulai')?'has-error':''}}" >
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" class="form-control pull-right " {{($activity->user_id == \Illuminate\Support\Facades\Auth::user()->id)?'':'disabled'}} id="datepicker-1" name="tanggal_mulai" placeholder="Tanggal Mulai" value="{{$activity->tanggal_mulai}}">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            {{--<label>Tanggal Berakhir:</label>--}}
                            <div class="input-group date {{$errors->has('tanggal_berakhir')?'has-error':''}}" >
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" class="form-control pull-right "{{($activity->user_id == \Illuminate\Support\Facades\Auth::user()->id)?'':'disabled'}} id="datepicker-2" name="tanggal_berakhir" placeholder="Tanggal Berakhir" value="{{$activity->tanggal_berakhir}}">
                            </div>
                        </div>
                    </div>
                    <!-- /.input group -->
                </div>

                {{--<div class="form-group {{$errors->has('status')?'has-error':''}}">--}}
                    {{--<label>Status</label>--}}
                    {{--<select class="form-control "{{($activity->user_id == \Illuminate\Support\Facades\Auth::user()->id)?'':'disabled'}} name="status">--}}
                        {{--<option value="" disabled>--- Pilih Status ---</option>--}}
                        {{--<option value="plan" {{($activity->status =='plan')? 'selected':''}}>Plan</option>--}}
                        {{--<option value="ongoing" {{($activity->status =='ongoing')? 'selected':''}}>On Going</option>--}}
                        {{--<option value="late">Late</option>--}}
                        {{--<option value="pending" {{($activity->status =='pending')? 'selected':''}}>Pending</option>--}}
                        {{--<option value="done">Done</option>--}}
                    {{--</select>--}}
                {{--</div>--}}

                <div class="form-group  " {{($activity->user_id == \Illuminate\Support\Facades\Auth::user()->id)?'':'disabled'}} id="checklist">
                    <label for="checklist">Check List :</label>  <button type="button" id="checklist-more" class="btn btn-primary btn-xs" {{($activity->user_id == Auth::user()->id)?'':'disabled'}}>Add More Checklist</button>
                    <ul>
                        <div id="list-checklist">
                            @foreach($activity->list_to_dos as $list_to_do)
                                <li>{{$list_to_do->judul}}</li>
                                @if($list_to_do->deskripsi!=null)
                                    Deskripsi : {{$list_to_do->deskripsi}}<br>
                                @endif
                                @if(count($list_to_do->attachment_list_to_dos)>0)
                                    Lampiran :
                                    <ul>
                                        @foreach($list_to_do->attachment_list_to_dos as $attachment_list_to_do)
                                            <a href="/activity/file/{{basename($attachment_list_to_do->lampiran)}}">{{basename($attachment_list_to_do->nama_asli_lampiran)}}</a>
                                        @endforeach
                                    </ul>
                                @endif
                                <a href="/activity/list_to_do/delete/{{$list_to_do->id}}/{{$activity->id}}" class="btn btn-danger btn-xs" {{($activity->user_id == Auth::user()->id)?'':'disabled'}}> Delete</a>
                            @endforeach
                            <div id="checklist-list-0" style="display: none">
                                <li id="checklist-list-text-0"></li>
                                <button class="btn btn-warning btn-xs" type="button" id="checklis-button-0" onclick="$('#checklist-0').toggle('fast');$('#checklist-list-0').toggle('fast');" {{($activity->user_id == Auth::user()->id)?'':'disabled'}}>Edit</button>
                                <button type="button" class="btn btn-danger btn-xs" onclick="$('#checklist-0').remove();$('#checklist-list-0').remove();" {{($activity->user_id == Auth::user()->id)?'':'disabled'}}>Delete</button>
                            </div>
                        </div>
                    </ul>
                    <div class="ui-widget" id="input-checklist" >
                        <div id="checklist-0">
                            <div class="form-group">
                                <input {{($activity->user_id == \Illuminate\Support\Facades\Auth::user()->id)?'':'disabled'}} id="checklist-judul-0" name="checklist-judul[]" class="form-control" style="color: #0c0c0c" placeholder="Enter CheckList Judul">
                            </div>
                            <div id="checklist-deskripsi-teks-0" onclick="$('#checklist-deskripsi-teks-0').toggle('fast');$('#checklist-deskripsi-form-0').toggle('fast');">&emsp;<span class="fa fa-plus inline"></span><p class="inline"><u>Add Description</u> </p></div>
                            <div class="form-group" id="checklist-deskripsi-form-0" style="display: none" >
                                {{--<li><label>Deskripsi Check List</label></li>--}}
                                <textarea {{($activity->user_id == \Illuminate\Support\Facades\Auth::user()->id)?'':'disabled'}} class="form-control" rows="3" name="checklist-deskripsi-input[]" placeholder="Enter Description Of CheckList"></textarea>
                            </div>
                            <div id="checklist-attachment-teks-0" onclick="$('#checklist-attachment-teks-0').toggle('fast');$('#checklist-attachment-form-0').toggle('fast');">&emsp;<span class="fa fa-plus inline"></span><p class="inline"><u>Add Attachment</u> </p></div>
                            <div class="form-group" id="checklist-attachment-form-0" style="display: none">
                                {{--<li><label>Attachment Check List</label></li>--}}
                                <input {{($activity->user_id == \Illuminate\Support\Facades\Auth::user()->id)?'':'disabled'}} type="file" class="form-control" name="checklist-attachment-input[]" placeholder="Enter Attachment Check List">
                            </div>
                            <button class="btn btn-primary btn-xs" type="button" onclick="$('#checklist-list-text-0').text($('#checklist-judul-0').val());$('#checklist-0').toggle('fast');$('#checklist-list-0').toggle('fast');" {{($activity->user_id == Auth::user()->id)?'':'disabled'}}> Add</button>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="member">Members :</label> <button class="btn btn-danger btn-xs inline" type="button" id="clear-member" {{($activity->user_id == Auth::user()->id)?'':'disabled'}}> Clear Member</button>
                    <ul id="member-list">
                        @foreach($user_activity as $member)
                            <li>{{$member->user->name}}</li>
                            <a href="/activity/member/delete/{{$member->id}}/{{$activity->id}}" class="btn btn-danger btn-xs"> Delete</a>
                        @endforeach
                    </ul>
                    <div id="member-hide-input">

                    </div>
                    <div class="ui-widget">
                        {{--<label for="tags">Tags: </label>--}}
                        <input id="add-member-input" class="" {{($activity->user_id == \Illuminate\Support\Facades\Auth::user()->id)?'':'disabled'}} style="color: #0c0c0c" placeholder="Enter Member Name">
                        <button type="button" id="member-button" class="btn btn-primary btn-xs" {{($activity->user_id == Auth::user()->id)?'':'disabled'}}>Add Member</button>
                    </div>
                </div>
                <input type="hidden" name="_method" value="PUT">
                <button type="submit" class="btn btn-primary pull-right" name="create" value="create" id="btn-create-activity" {{($activity->user_id == Auth::user()->id)?'':'disabled'}}>Update Activity</button>
            </form>
            <!-- /.box-body -->
        </div>
    </div>

    <script type="text/javascript" id="script-for-page">
        var iteratorCheckList = 1;

        $(function () {

            $('#datepicker-1').datepicker({
                autoclose: true
            });

            $('#datepicker-2').datepicker({
                autoclose: true
            });

        });

        $(document).ready(
            $('#description-text').on('click',
                function (){
                    $('#description-text').toggle('fast');
                    $('#description-form').toggle('fast');
                }
            ),
            $('#attachment-text').on('click',
                function () {
                    $('#attachment-text').toggle('fast');
                    $('#attachment-form').toggle('fast');
                }
            ),
            $( function() {
                $( "#add-member-input" ).autocomplete({
                    source: 'http://localhost:8000/activity/search_by_name',
                    appendTo : $('#createActivity')
                });
            } ),
            $('#member-button').on('click',
                function () {
                    var memberInput = $('#add-member-input');
                    var memberList = $('#member-list');
                    var memberHideInput = $('#member-hide-input');
                    if(memberInput.val()!="") {
                        memberHideInput.append(
                            '<input type="hidden" value="' +
                            memberInput.val()
                            + '" name="memberName[]">'
                        );
                        memberList.append(
                            '<li>' +
                            memberInput.val()
                            + '</li>'
                        );
                        memberInput.val("");
                    }
                }
            )
            ,
            $('#checklist-more').on('click',
                function () {
                    $('#input-checklist').append(
                        '<div id="checklist-'+iteratorCheckList+'">\n' +
                        '                            <input id="checklist-judul-'+iteratorCheckList+'" name="checklist-judul[]" class="form-control" style="color: #0c0c0c" placeholder="Enter CheckList Judul" {{($activity->user_id == Auth::user()->id)?'':'disabled'}}>\n' +
                        '                            <div id="checklist-deskripsi-teks-'+iteratorCheckList+'" onclick="$(\'#checklist-deskripsi-teks-'+iteratorCheckList+'\').toggle(\'fast\');$(\'#checklist-deskripsi-form-'+iteratorCheckList+'\').toggle(\'fast\');">&emsp;<span class="fa fa-plus inline"></span><p class="inline"><u>Add Description</u> </p></div>\n' +
                        '                            <div class="form-group" id="checklist-deskripsi-form-'+iteratorCheckList+'" style="display: none" >\n' +
                        '                                {{--<li><label>Deskripsi Check List</label></li>--}}\n' +
                        '                                <textarea class="form-control" rows="3" name="checklist-deskripsi-input[]" placeholder="Enter Description Of CheckList" {{($activity->user_id == Auth::user()->id)?'':'disabled'}}></textarea>\n' +
                        '                            </div>\n' +
                        '                            <div id="checklist-attachment-teks-'+iteratorCheckList+'" onclick="$(\'#checklist-attachment-teks-'+iteratorCheckList+'\').toggle(\'fast\');$(\'#checklist-attachment-form-'+iteratorCheckList+'\').toggle(\'fast\');">&emsp;<span class="fa fa-plus inline"></span><p class="inline"><u>Add Attachment</u> </p></div>\n' +
                        '                            <div class="form-group" id="checklist-attachment-form-'+iteratorCheckList+'" style="display: none">\n' +
                        '                                {{--<li><label>Attachment Check List</label></li>--}}\n' +
                        '                                <input type="file" class="form-control" name="checklist-attachment-input[]" placeholder="Enter Attachment Check List" {{($activity->user_id == Auth::user()->id)?'':'disabled'}}>\n' +
                        '                            </div>\n' +
                        '                            <button class="btn btn-primary btn-xs" type="button" onclick="$(\'#checklist-list-text-'+iteratorCheckList+'\').text($(\'#checklist-judul-'+iteratorCheckList+'\').val());$(\'#checklist-'+iteratorCheckList+'\').toggle(\'fast\');$(\'#checklist-list-'+iteratorCheckList+'\').toggle(\'fast\');" {{($activity->user_id == Auth::user()->id)?'':'disabled'}}> Add</button>\n' +
                        '                        </div>'
                    );
                    $('#list-checklist').append(
                        '<div id="checklist-list-'+iteratorCheckList+'" style="display: none">\n' +
                        '                            <li id="checklist-list-text-'+iteratorCheckList+'"></li>\n' +
                        '                            <button class="btn btn-warning btn-xs" type="button" id="checklis-button-'+iteratorCheckList+'" onclick="$(\'#checklist-'+iteratorCheckList+'\').toggle(\'fast\');$(\'#checklist-list-'+iteratorCheckList+'\').toggle(\'fast\');">Edit</button>\n' +
                        '                            <button type="button" class="btn btn-danger btn-xs" onclick="$(\'#checklist-'+iteratorCheckList+'\').remove();$(\'#checklist-list-'+iteratorCheckList+'\').remove();">Delete</button>\n'+
                        '                        </div>'
                    );
                    iteratorCheckList++;
                }
            ),
            $('#clear-member').on('click',
                function () {
                    $('#member-list').html("");
                    $('#member-hide-input').html("");
                }
            )
        );

    </script>

@endsection
