<a href="{{url('/activity/'.$notification->data['activity']['id'].'/show/')}}">
    <i class="fa fa-rss text-warning"></i><strong>{{$notification->data['activity']['judul']}}</strong> hampir terlambat <strong>{{$notification->data['rangeTime']}} hari</strong> </strong>
</a>