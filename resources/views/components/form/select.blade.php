

<label for="">{{ $label }}</label>
<select class="form-control"  name="{{ $name }}"   >
    @foreach ($options as $option => $key)
        <option value="{{ $option }}">{{ $key }}</option>
    @endforeach
</select>