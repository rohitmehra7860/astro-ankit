@csrf
<div class="row">
    <div class="col-md-6 mb-3">
        <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name"
            placeholder="Name" value="{{ old('name', $testimonial->name ?? '') }}">
        @error('name')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6 mb-3">
        <label for="image_url" class="form-label">Image <span class="text-danger">*</span></label>
        <input type="file" name="image_url" class="form-control @error('image_url') is-invalid @enderror"
            id="image_url" placeholder="Image">
        @error('image_url')
            <div class="text-danger">{{ $message }}</div>
        @enderror
        <div class="mt-2">
            <img id="imagePreview" src="{{ isset($testimonial->image_url) ? asset($testimonial->image_url) : '' }}"
                class="img-thumbnail" width="150"
                style="display: {{ isset($testimonial->image_url) ? 'block' : 'none' }};">
        </div>
    </div>
    <div class="col-md-12 mb-3">
        <label for="content" class="form-label">Content <span class="text-danger">*</span></label>
        <textarea name="content" id="content" class="form-control @error('content') is-invalid @enderror">{{ old('content', $testimonial->content ?? '') }}</textarea>
        @error('content')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

</div>
