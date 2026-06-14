@csrf
<div class="row">
    <div class="col-md-6 mb-3">
        <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" id="title"
            placeholder="Title" value="{{ old('title', $zodiacSign->title ?? '') }}">
        @error('title')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-6 mb-3">
        <label for="slug" class="form-label">Slug <span class="text-danger">*</span></label>
        <input type="text" name="slug" class="form-control @error('slug') is-invalid @enderror" id="slug"
            placeholder="Slug" value="{{ old('slug', $zodiacSign->slug ?? '') }}">
        @error('slug')
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
            <img id="imagePreview" src="{{ isset($zodiacSign->image_url) ? asset($zodiacSign->image_url) : '' }}"
                class="img-thumbnail" width="150"
                style="display: {{ isset($zodiacSign->image_url) ? 'block' : 'none' }};">
        </div>
    </div>
    <div class="col-md-12 mb-3">
        <label for="content" class="form-label">Content</label>
        <textarea name="content" id="content" class="form-control @error('content') is-invalid @enderror">{{ old('content', $zodiacSign->content ?? '') }}</textarea>
        @error('content')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <hr>
    <div class="col-md-12 mb-3">
        <label for="meta_title" class="form-label">Meta Title</label>
        <input type="text" name="meta_title" class="form-control" id="meta_title" placeholder="Meta Title"
            value="{{ old('meta_title', $zodiacSign->meta_title ?? '') }}">
    </div>
    <div class="col-md-12 mb-3">
        <label for="meta_description" class="form-label">Meta Description</label>
        <textarea name="meta_description" id="meta_description" class="form-control" rows="3">{{ old('meta_description', $zodiacSign->meta_description ?? '') }}</textarea>
    </div>
    <div class="col-md-12 mb-3">
        <label for="meta_keywords" class="form-label">Meta Keywords</label>
        <input type="text" name="meta_keywords" class="form-control" id="meta_keywords" placeholder="Meta Keywords"
            value="{{ old('meta_keywords', $zodiacSign->meta_keywords ?? '') }}">
    </div>
    <hr>
    <div class="col-md-12 mb-3">
        <label for="meta_tags" class="form-label">Meta Tags and Head Code</label>
        <textarea name="meta_tags" id="meta_tags" class="form-control" rows="5">{{ old('meta_tags', $zodiacSign->meta_tags ?? '') }}</textarea>
    </div>

</div>
