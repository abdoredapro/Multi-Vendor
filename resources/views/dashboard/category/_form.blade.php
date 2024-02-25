<div class="form-group">
    <x-form.input label='Category Name' type='text' name='name' :value='$category->name' />

</div>

<div class="form-group">
    <label for="">Category parent</label>
    <select name="parent_id" class="form-control" >
        <option value="">Primary Category</option>
        @foreach ($all_parent as $parent)
        <option value="{{ $parent->id }}" @selected(old('parent_id', $category->parent_id) == $parent->id)>{{ $parent->name }}</option>
        @endforeach
    </select>
    @error('parent_id')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>


<div class="form-group">
    <x-form.textarea  class="form-control" label='Description' name='description' :value='$category->description' />
</div>

<div class="form-group">
    <x-form.input label='Image' type='file' name='image' />

</div>

<div class="form-group">


    <x-form.radio  label='Status' name='status' :checked='$category->status' :items="['active' => 'Active', 'inactive'=>'Inactive']"  />
</div>


<input type="submit" value="{{ $btn ?? 'Save' }}" class="mb-4 btn  btn-primary">

