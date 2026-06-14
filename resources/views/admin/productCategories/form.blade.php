@csrf
<div class="row">
    <div class="col-md-4 mb-3">
        <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" id="title"
            placeholder="Title" value="{{ old('title', $productCategory->title ?? '') }}">
        @error('title')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-4 mb-3">
        <label for="slug" class="form-label">Slug <span class="text-danger">*</span></label>
        <input type="text" name="slug" class="form-control @error('slug') is-invalid @enderror" id="slug"
            placeholder="Slug" value="{{ old('slug', $productCategory->slug ?? '') }}">
        @error('slug')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-4 mb-3">
        <label for="parent_id" class="form-label">Parent productCategory</label>
        <select class="form-select" name="parent_id" id="parent_id">
            <option value="">No Parent Product Category</option>
            @foreach ($productCategories as $item)
                <option value="{{ $item->id }}"
                    {{ isset($productCategory) && $productCategory->parent_id == $item->id ? 'selected' : '' }}>
                    {{ $item->title }}
                </option>
            @endforeach
        </select>
        @error('parent_id')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-12 mb-3">
        <label for="image_url" class="form-label">Image <span class="text-danger">*</span></label>
        <input type="file" name="image_url" class="form-control @error('image_url') is-invalid @enderror"
            id="image_url" placeholder="Image">
        @error('image_url')
            <div class="text-danger">{{ $message }}</div>
        @enderror
        <div class="mt-2">
            <img id="imagePreview"
                src="{{ isset($productCategory->image_url) ? asset($productCategory->image_url) : '' }}"
                class="img-thumbnail" width="150"
                style="display: {{ isset($productCategory->image_url) ? 'block' : 'none' }};">
        </div>
    </div>
    <div class="col-md-12 mb-3">
        <label for="content" class="form-label">Content</label>
        <textarea name="content" id="content" class="form-control @error('content') is-invalid @enderror">{{ old('content', $productCategory->content ?? '') }}</textarea>
        @error('content')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <hr>
    <div class="col-md-12 mb-3">
        <label for="meta_tags" class="form-label">Meta Tags and Head Code</label>
        <textarea name="meta_tags" id="meta_tags" class="form-control" rows="5">{{ old('meta_tags', $productCategory->meta_tags ?? '') }}</textarea>
    </div>

</div>
