@if (session()->has($status))
    <div class="alert alert-{{$status}}">
        {{ session($status) }}
    </div>
@endif
