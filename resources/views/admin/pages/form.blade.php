@csrf
<div class="row">
    <div class="col-md-6 mb-3">
        <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" id="title"
            placeholder="Title" value="{{ old('title', $page->title ?? '') }}">
        @error('title')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-6 mb-3">
        <label for="slug" class="form-label">Slug <span class="text-danger">*</span></label>
        <input type="text" name="slug" class="form-control @error('slug') is-invalid @enderror" id="slug"
            placeholder="Slug" value="{{ old('slug', $page->slug ?? '') }}">
        @error('slug')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-12 mb-3">
        <label for="content" class="form-label">Content</label>
        <textarea name="content" id="content" class="form-control @error('content') is-invalid @enderror">{{ old('content', $page->content ?? '') }}</textarea>
        @error('content')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <hr>
    <div class="col-md-12 mb-3">
        <label for="meta_title" class="form-label">Meta Title</label>
        <input type="text" name="meta_title" class="form-control" id="meta_title" placeholder="Meta Title"
            value="{{ old('meta_title', $page->meta_title ?? '') }}">
    </div>
    <div class="col-md-12 mb-3">
        <label for="meta_description" class="form-label">Meta Description</label>
        <textarea name="meta_description" id="meta_description" class="form-control" rows="3">{{ old('meta_description', $page->meta_description ?? '') }}</textarea>
    </div>
    <div class="col-md-12 mb-3">
        <label for="meta_keywords" class="form-label">Meta Keywords</label>
        <input type="text" name="meta_keywords" class="form-control" id="meta_keywords" placeholder="Meta Keywords"
            value="{{ old('meta_keywords', $page->meta_keywords ?? '') }}">
    </div>
    <hr>
    <div class="col-md-12 mb-3">
        <label for="meta_tags" class="form-label">Meta Tags and Head Code</label>
        <textarea name="meta_tags" id="meta_tags" class="form-control" rows="5">{{ old('meta_tags', $page->meta_tags ?? '') }}</textarea>
    </div>
</div>
