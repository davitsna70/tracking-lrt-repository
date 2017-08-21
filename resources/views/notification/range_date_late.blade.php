<a href="{{url('/activity/'.$notification->data['activity']['id'].'/show/')}}">
    <i class="fa fa-book text-aqua"></i><strong>{{$notification->data['activity']['judul']}}</strong> hampir terlambat <strong>{{$notification->data['rangeTime']}} hari</strong> </strong>
</a>