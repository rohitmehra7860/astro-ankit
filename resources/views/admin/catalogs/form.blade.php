@csrf
<div class="row">
    <div class="col-md-12 mb-3">
        <label for="title" class="form-label">Title</label>
        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" id="title"
            placeholder="Title" value="{{ old('title', $catalog->title ?? '') }}">
        @error('title')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-6 mb-3">
        <label for="image_url" class="form-label">Image</label>
        <input type="file" name="image_url" class="form-control @error('image_url') is-invalid @enderror"
            id="image_url" placeholder="Image">
        @error('image_url')
            <div class="text-danger">{{ $message }}</div>
        @enderror
        <div class="mt-2">
            <img id="imagePreview" src="{{ isset($catalog->image_url) ? asset($catalog->image_url) : '' }}"
                class="img-thumbnail" width="150"
                style="display: {{ isset($catalog->image_url) ? 'block' : 'none' }};">
        </div>
    </div>

    <div class="col-md-6 mb-3">
        <label for="pdf_url" class="form-label">PDf <span class="text-danger">*</span></label>
        <input type="file" name="pdf_url" class="form-control @error('pdf_url') is-invalid @enderror" id="pdf_url"
            placeholder="Image">
        @error('pdf_url')
            <div class="text-danger">{{ $message }}</div>
        @enderror
        <div class="mt-2">
            <iframe src="{{ isset($catalog->pdf_url) ? asset($catalog->pdf_url) : '' }}" frameborder="0"></iframe>
        </div>
    </div>
</div>
