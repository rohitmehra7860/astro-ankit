@csrf
<div class="row">
    <div class="col-md-6 mb-3">
        <label for="title" class="form-label">Title </label>
        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" id="title"
            placeholder="Title" value="{{ old('title', $gallery->title ?? '') }}">
        @error('title')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-6 mb-3">
        <label for="image_url" class="form-label">Images <span class="text-danger">*</span></label>
        {{-- <input type="file" name="image_url" class="form-control @error('image_url') is-invalid @enderror"
            id="image_url" placeholder="Images"> --}}
        <input type="file" name="{{ isset($gallery) ? 'image_url' : 'image_url[]' }}"
            {{ isset($gallery) ? ' ' : 'multiple' }} class="form-control @error('image_url') is-invalid @enderror"
            id="image_url">

        @error('image_url')
            <div class="text-danger">{{ $message }}</div>
        @enderror

        <div class="mt-2" id="imagePreviewcontainer-fluid"></div>

        <!-- Preview Uploaded Images -->
        <div class="mt-2 d-flex flex-wrap">
            @if (isset($gallery) && $gallery->image_url)
                <div class="p-2">
                    <img src="{{ asset($gallery->image_url) }}" class="img-thumbnail m-1" width="100"
                        style="height: 200px;
    width: 100%;
    object-fit: contain;">
                </div>
            @endif
        </div>

    </div>
</div>
