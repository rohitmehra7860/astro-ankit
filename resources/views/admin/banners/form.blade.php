@csrf
<div class="row">
    <div class="col-md-12 mb-3">
        <label for="title" class="form-label">Title</label>
        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" id="title"
            placeholder="Title" value="{{ old('title', $banner->title ?? '') }}">
        @error('title')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-12 mb-3">
        <label for="content" class="form-label">Content</label>
        <textarea name="content" id="content" class="form-control @error('content') is-invalid @enderror">{{ old('content', $banner->content ?? '') }}</textarea>
        @error('content')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-12 mb-3">
        <label for="link" class="form-label">Link</label>
        <input type="text" name="link" class="form-control @error('link') is-invalid @enderror" id="link"
            placeholder="Link" value="{{ old('link', $banner->link ?? '') }}">
        @error('link')
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
            <img id="imagePreview" src="{{ isset($banner->image_url) ? asset($banner->image_url) : '' }}"
                class="img-thumbnail" width="150"
                style="display: {{ isset($banner->image_url) ? 'block' : 'none' }};">
        </div>
    </div>
    <div class="col-md-6 mb-3">
        <label for="mobile_image_url" class="form-label">Mobile Image</label>
        <input type="file" name="mobile_image_url"
            class="form-control @error('mobile_image_url') is-invalid @enderror" id="mobile_image_url"
            placeholder="Image">
        @error('mobile_image_url')
            <div class="text-danger">{{ $message }}</div>
        @enderror
        <div class="mt-2">
            <img id="imagePreview2"
                src="{{ isset($banner->mobile_image_url) ? asset($banner->mobile_image_url) : '' }}"
                class="img-thumbnail" width="150"
                style="display: {{ isset($banner->mobile_image_url) ? 'block' : 'none' }};">
        </div>
    </div>
</div>
