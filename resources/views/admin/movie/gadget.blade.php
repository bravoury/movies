@forelse($movie as $key => $val)
<div class="movie-gadget-box">
    <p>{!!@$val->name!!}</p>
    <p class="text-muted"><small><i class="ion ion-android-person"></i> {!!@$val->user->name!!} at {!! format_date($val->created_at)!!}</small></p>
</div>
@empty
<div class="movie-gadget-box">
    <p>No Movie</p>
</div>
@endif