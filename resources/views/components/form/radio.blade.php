<label for="">{{  $label }}</label>
@foreach ($items as $key => $value)
    <div class="form-check">
        <input class="form-check-input" 

        name="{{ $name }}" 
        type="radio" 
        value="{{ $key }}" 
        @checked(old($key,$checked) == $key) 
        id="flexCheckDefault" >

        <label class="form-check-label" for="flexCheckDefault">
        {{ $value}}
        </label>
    </div>
@endforeach

@error($name)
        <div class="text-danger">{{ $message }}</div>
@enderror







