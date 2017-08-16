<a href="{{url('/activity/'.$notification->data['activity']['id'].'/show/')}}">
    <i class="fa fa-book text-aqua"></i><strong>{{$notification->data['activity']['judul']}} </strong> telah selesai dilakukan pada {{$notification->data['activity']['waktu_selesai']}}
</a>