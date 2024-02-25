    
    <div class="form-group">
        <x-form.input label='Role Name' type='text' name='name' :value='$role->name' />
    </div>

<fieldset>
    <legend>{{ __('Abilities') }}</legend>

    @foreach (config('ability') as $ability_code => $ability_name)
        <div class="row">
            <div class="col-md-6">
                {{  $ability_name }}
            </div>
            
            <div class="col-md-2">
                <input type="radio" id="allow" name="abilities[{{ $ability_code }}]" value="allow" @checked(($role_abilities[$ability_code] ?? '') == 'allow')>
                <label for="allow">Allow</label>
            </div>
            <div class="col-md-2">
                <input type="radio" id="deny" name="abilities[{{ $ability_code }}]" @checked(($role_abilities[$ability_code] ?? '') == 'deny') value="deny">
                <label for="deny">Deny</label>
            </div>
        </div>

    @endforeach

</fieldset>

<div class="form-group">
    <input type="submit" value="{{ $btn ?? 'Save' }}" class="mb-4 btn  btn-primary">
</div>

