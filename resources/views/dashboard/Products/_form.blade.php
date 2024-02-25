

<div class="form-group">
    <x-form.input label='Product Name' type='text' name='name' :value='$product->name' />
</div>

<div class="form-group">
    <label for="">Category</label>

    <select name="category_id" class="form-control" >
        <option value="">Primary Category</option>
        @foreach (App\Models\Category::all() as $category)
        <option value="{{ $category->id }}" @selected(old('parent_id', $product->category_id) == $category->id)>{{ $category->name }}</option>
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

    <x-form.input label='Product Price' type='text' name='price' :value='$product->price' />

</div>

<div class="form-group">

    <x-form.input label='Product Compare' type='text' name='compare_price' :value='$product->compare_price' />

</div>


<div class="form-group">

    <x-form.input label='Tags' type='text' name='tags'   :value='$tag' />

</div>


<div class="form-group">
    <x-form.radio  label='Status' name='status' :checked='$category->status' :items="['active' => 'Active', 'inactive'=>'Inactive']"  />
</div>


<input type="submit" value="{{ $btn ?? 'Save' }}" class="mb-4 btn  btn-primary">
@push('style')
<link href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css" rel="stylesheet" type="text/css" />
@endpush

@push('scripts')

    <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>
    <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.polyfills.min.js"></script>

        <script>
            var inputElm = document.querySelector('[name=tags]'),
            tagify = new Tagify (inputElm);

            inputElm.addEventListener('change', onChange)

            function onChange(e){
            // outputs a String
            console.log(e.target.value)
            }
        </script>


@endpush
