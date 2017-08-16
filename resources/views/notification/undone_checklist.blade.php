<a href="{{url('/activity/'.$notification->data['activity']['id'].'/show/')}}">
    <i class="fa fa-book text-aqua"></i>{{$notification->data['user']['name']}} telah 'undone' checklist pada aktifitas <strong>{{$notification->data['activity']['judul']}} </strong>
</a>