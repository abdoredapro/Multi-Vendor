


<label for="">{{ $label }}</label>
<textarea name="{{ $name }}"  {{ $attributes }}>{{ $value }}</textarea>
@error($name)
    <div class="text-danger">{{ $message }}</div>
@enderror