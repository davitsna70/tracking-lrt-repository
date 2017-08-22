<a href="{{url('/activity/'.$notification->data['activity']['id'].'/show/')}}">
    <i class="fa fa-flag-checkered text-success"></i> <strong>{{$notification->data['activity']['judul']}} </strong> telah selesai dilakukan pada {{$notification->data['activity']['waktu_selesai']}}
</a>