@csrf
<div class="row">
    <div class="col-md-6 mb-3">
        <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name"
            placeholder="Name" value="{{ old('name', $size->name ?? '') }}">
        @error('name')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-6 mb-3">
        <label for="code" class="form-label">code <span class="text-danger">*</span></label>
        <input type="text" name="code" class="form-control @error('code') is-invalid @enderror" id="code"
            placeholder="S" value="{{ old('code', $size->code ?? '') }}">
        @error('code')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
</div>
