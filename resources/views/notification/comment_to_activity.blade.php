<a href="{{url('/activity/'.$notification->data['activity'].'/show/')}}">
    <i class="fa fa-comments text-black"></i> {{$notification->data['user']['name']}} menulis komentar pada activity <strong>{{$notification->data['activity']}} </strong>
</a>