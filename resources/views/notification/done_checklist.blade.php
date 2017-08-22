<a href="{{url('/activity/'.$notification->data['activity']['id'].'/show/')}}">
    <i class="fa fa-check text-aqua"></i> {{$notification->data['user']['name']}} telah 'done' checklist pada aktifitas <strong>{{$notification->data['activity']['judul']}} </strong>
</a>