@csrf
<div class="row">
    <div class="col-md-6 mb-3">
        <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" id="title"
            placeholder="Title" value="{{ old('title', $product->title ?? '') }}">
        @error('title')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-6 mb-3">
        <label for="slug" class="form-label">Slug <span class="text-danger">*</span></label>
        <input type="text" name="slug" class="form-control @error('slug') is-invalid @enderror" id="slug"
            placeholder="Slug" value="{{ old('slug', $product->slug ?? '') }}">
        @error('slug')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-6 mb-3">
        <label for="category_id" class="form-label">Product Category</label>
        <select class="form-select" name="category_id" id="category_id">
            <option value="">No product category selected</option>
            @foreach ($product_categories as $item)
                <option value="{{ $item->id }}"
                    @if (old('category_id') == $item->id) selected
                    @elseif (isset($product) && $product->category_id == $item->id && !old('category_id'))
                        selected @endif>
                    {{ $item->title }}
                </option>
            @endforeach
        </select>
        @error('category_id')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-6 mb-3">
        <label for="sku" class="form-label">SKU</label>
        <input type="text" name="sku" class="form-control @error('sku') is-invalid @enderror" id="sku"
            placeholder="Sku" value="{{ old('sku', $product->sku ?? '') }}">
        @error('sku')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-12 mb-3">
        <label for="images" class="form-label">Product Images <span class="text-danger">*</span></label>
        <input type="file" name="images[]" class="form-control @error('images') is-invalid @enderror" id="image_url"
            multiple>

        @error('images')
            <div class="text-danger">{{ $message }}</div>
        @enderror
        <div class="mt-2" id="imagePreviewContainer"></div>
        <!-- Preview Uploaded Images -->
        <div class="mt-2 d-flex flex-wrap" id="sortable-images">
            @if (isset($product) && $product->images)
                @foreach ($product->images as $image)
                    <div class="p-2 image-box" data-id="{{ $image->id }}">
                        <img src="{{ asset($image->image_url) }}" class="img-thumbnail m-1"
                            style="height: 200px; width: 100%; object-fit: contain;">
                        <a class="btn btn-danger delete-confirm d-block btn-sm"
                            data-url="{{ route('admin.products.deleteImage', $image->id) }}">
                            <i class="fa-solid fa-trash"></i>
                        </a>
                    </div>
                @endforeach
            @endif
        </div>

    </div>
    <div class="col-md-12 mb-3">
        <label for="content" class="form-label">Content</label>
        <textarea name="content" id="content" class="form-control @error('content') is-invalid @enderror">{{ old('content', $product->content ?? '') }}</textarea>
        @error('content')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <hr>
    <div class="col-md-12 mb-3">
        <label for="meta_tags" class="form-label">Meta Tags and Head Code</label>
        <textarea name="meta_tags" id="meta_tags" class="form-control" rows="5">{{ old('meta_tags', $product->meta_tags ?? '') }}</textarea>
    </div>
</div>



{{-- <div class="row mb-3">
    <hr>
    <h5>Product Attributes</h5>
    <div id="product-attributes">
        @php
            $oldAttributes = old('attributes', $product->attributes ?? []);
        @endphp

        @if (count($oldAttributes) > 0)
            @foreach ($oldAttributes as $key => $attribute)
                <div class="attribute-row row mb-3">
                    <div class="col-md-3 mb-3">
                        <label class="form-label">Size <span class="text-danger">*</span></label>
                        <select name="attributes[{{ $key }}][size_id]" class="form-select">
                            <option value="">Select Size</option>
                            @foreach ($sizes as $size)
                                <option value="{{ $size->id }}"
                                    {{ old("attributes.$key.size_id", $attribute->size_id ?? '') == $size->id ? 'selected' : '' }}>
                                    {{ $size->name }}
                                </option>
                            @endforeach
                        </select>
                        @error("attributes.$key.size_id")
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-3 mb-3">
                        <label class="form-label">Color <span class="text-danger">*</span></label>
                        <select name="attributes[{{ $key }}][color_id]" class="form-select">
                            <option value="">Select Color</option>
                            @foreach ($colors as $color)
                                <option value="{{ $color->id }}"
                                    {{ old("attributes.$key.color_id", $attribute->color_id ?? '') == $color->id ? 'selected' : '' }}>
                                    {{ $color->name }}
                                </option>
                            @endforeach
                        </select>
                        @error("attributes.$key.color_id")
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-2 mb-3">
                        <label class="form-label">Stock <span class="text-danger">*</span></label>
                        <input type="number" name="attributes[{{ $key }}][stock]" class="form-control"
                            value="{{ old("attributes.$key.stock", $attribute->stock ?? '') }}">
                        @error("attributes.$key.stock")
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-2 mb-3">
                        <label class="form-label">Price <span class="text-danger">*</span></label>
                        <input type="text" name="attributes[{{ $key }}][price]" class="form-control"
                            value="{{ old("attributes.$key.price", $attribute->price ?? '') }}">
                        @error("attributes.$key.price")
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-2 mb-3">
                        <label class="form-label">Discount Price</label>
                        <input type="text" name="attributes[{{ $key }}][discount_price]"
                            class="form-control"
                            value="{{ old("attributes.$key.discount_price", $attribute->discount_price ?? '') }}">
                        @error("attributes.$key.discount_price")
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-1 d-flex align-items-end">
                        <button type="button" class="btn btn-danger remove-attribute">X</button>
                    </div>
                </div>
            @endforeach
        @else
            <!-- Show an empty row if no attributes exist -->
            <div class="attribute-row row mb-3">
                <div class="col-md-3 mb-3">
                    <label class="form-label">Size <span class="text-danger">*</span></label>
                    <select name="attributes[0][size_id]" class="form-select">
                        <option value="">Select Size</option>
                        @foreach ($sizes as $size)
                            <option value="{{ $size->id }}">{{ $size->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-3 mb-3">
                    <label class="form-label">Color <span class="text-danger">*</span></label>
                    <select name="attributes[0][color_id]" class="form-select">
                        <option value="">Select Color</option>
                        @foreach ($colors as $color)
                            <option value="{{ $color->id }}">{{ $color->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-2 mb-3">
                    <label class="form-label">Stock <span class="text-danger">*</span></label>
                    <input type="number" name="attributes[0][stock]" class="form-control">
                </div>

                <div class="col-md-2 mb-3">
                    <label class="form-label">Price <span class="text-danger">*</span></label>
                    <input type="text" name="attributes[0][price]" class="form-control">
                </div>

                <div class="col-md-2 mb-3">
                    <label class="form-label">Discount Price</label>
                    <input type="text" name="attributes[0][discount_price]" class="form-control">
                </div>

                <div class="col-md-1 d-flex align-items-end">
                    <button type="button" class="btn btn-danger remove-attribute">X</button>
                </div>
            </div>
        @endif
    </div>
    <button type="button" class="btn btn-sm btn-secondary" id="add-attribute">+ Add Attribute</button>
</div> --}}

<script>
    //attributes js 
    // document.getElementById('add-attribute').addEventListener('click', function() {
    //     let index = document.querySelectorAll('.attribute-row').length; // Get correct index
    //     let newRow = `
    //     <div class="attribute-row row mb-3">
    //         <div class="col-md-3 mb-3">
    //             <label class="form-label">Size <span class="text-danger">*</span></label>
    //             <select name="attributes[${index}][size_id]" class="form-select">
    //                 <option value="">Select Size</option>
    //                 @foreach ($sizes ?? [] as $size)
    //                     <option value="{{ $size->id }}">{{ $size->name }}</option>
    //                 @endforeach
    //             </select>
    //         </div>
    //         <div class="col-md-3 mb-3">
    //             <label class="form-label">Color <span class="text-danger">*</span></label>
    //             <select name="attributes[${index}][color_id]" class="form-select">
    //                 <option value="">Select Color</option>
    //                 @foreach ($colors ?? [] as $color)
    //                     <option value="{{ $color->id }}">{{ $color->name }}</option>
    //                 @endforeach
    //             </select>
    //         </div>
    //         <div class="col-md-2 mb-3">
    //             <label class="form-label">Stock <span class="text-danger">*</span></label>
    //             <input type="number" name="attributes[${index}][stock]" class="form-control">
    //         </div>
    //         <div class="col-md-2 mb-3">
    //             <label class="form-label">Price <span class="text-danger">*</span></label>
    //             <input type="text" name="attributes[${index}][price]" class="form-control">
    //         </div>
    //         <div class="col-md-2 mb-3">
    //             <label class="form-label">Discount Price</label>
    //             <input type="text" name="attributes[${index}][discount_price]" class="form-control">
    //         </div>
    //         <div class="col-md-1 d-flex align-items-end">
    //             <button type="button" class="btn btn-danger remove-attribute">X</button>
    //         </div>
    //     </div>`;

    //     document.getElementById('product-attributes').insertAdjacentHTML('beforeend', newRow);
    // });

    // document.addEventListener('click', function(event) {
    //     if (event.target.classList.contains('remove-attribute')) {
    //         event.target.closest('.attribute-row').remove();
    //     }
    // });


    //product image order
    $(function() {
        $('#sortable-images').sortable({
            update: function(event, ui) {
                let order = [];
                $('.image-box').each(function(index) {
                    order.push({
                        id: $(this).data('id'),
                        image_order: index + 1
                    });
                });

                $.ajax({
                    url: "{{ route('admin.products.reorderImages') }}",
                    method: 'POST',
                    data: {
                        order: order,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        console.log('Reorder success');
                    },
                    error: function() {
                        alert('Failed to reorder images');
                    }
                });
            }
        });
    });
</script>
