<a href="{{url('/activity/'.$notification->data['activity']['id'].'/show/')}}">
    <i class="fa fa-remove text-danger"></i> {{$notification->data['user']['name']}} telah 'undone' checklist pada aktifitas <strong>{{$notification->data['activity']['judul']}} </strong>
</a>