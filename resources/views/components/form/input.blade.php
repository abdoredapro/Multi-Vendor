@props([
    'label' => '',
    'type' => 'text',
    'name',
    'value' => '',
    'place' => '',
])


<label for="">{{ $label }}</label>

    <input 
    type="{{ $type}}" 
    name="{{ $name }}"  
    value="{{ old($name, $value) }}" 

    placeholder="{{ $place }}" 

    {{ $attributes->class([
        'form-control',
        'is-invalid' => $errors->has($name)
        ]) }}
        >
@error($name)
    <div class="text-danger">{{ $message }}</div>
@enderror