@csrf
<div class="row">
    <!-- Coupon Code -->
    <div class="col-md-4 mb-3">
        <label for="code" class="form-label">Coupon Code <span class="text-danger">*</span></label>
        <input type="text" name="code" class="form-control @error('code') is-invalid @enderror" id="code"
            placeholder="Enter Coupon Code" value="{{ old('code', $coupon->code ?? '') }}">
        @error('code')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <!-- Discount Type (Fixed / Percentage) -->
    <div class="col-md-4 mb-3">
        <label for="type" class="form-label">Discount Type <span class="text-danger">*</span></label>
        <select name="type" class="form-select @error('type') is-invalid @enderror">
            <option value="fixed" {{ old('type', $coupon->type ?? '') == 'fixed' ? 'selected' : '' }}>Fixed (₹)
            </option>
            <option value="percentage" {{ old('type', $coupon->type ?? '') == 'percentage' ? 'selected' : '' }}>
                Percentage (%)</option>
        </select>
        @error('type')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <!-- Discount Value -->
    <div class="col-md-4 mb-3">
        <label for="discount_value" class="form-label">Discount Value <span class="text-danger">*</span></label>
        <input type="text" name="discount_value" class="form-control @error('discount_value') is-invalid @enderror"
            id="discount_value" placeholder="Enter Discount Value"
            value="{{ old('discount_value', $coupon->discount_value ?? '') }}">
        @error('discount_value')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <!-- Minimum Order Amount -->
    <div class="col-md-4 mb-3">
        <label for="minimum_order_amount" class="form-label">Minimum Order Amount (₹)</label>
        <input type="text" name="minimum_order_amount"
            class="form-control @error('minimum_order_amount') is-invalid @enderror" id="minimum_order_amount"
            placeholder="Enter Minimum Order Amount"
            value="{{ old('minimum_order_amount', $coupon->minimum_order_amount ?? '') }}">
        @error('minimum_order_amount')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <!-- Usage Limit -->
    <div class="col-md-4 mb-3">
        <label for="usage_limit" class="form-label">Usage Limit</label>
        <input type="number" name="usage_limit" class="form-control @error('usage_limit') is-invalid @enderror"
            id="usage_limit" placeholder="Enter Maximum Usages"
            value="{{ old('usage_limit', $coupon->usage_limit ?? '') }}">
        @error('usage_limit')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <!-- Expiry Date -->
    <div class="col-md-4 mb-3">
        <label for="expires_at" class="form-label">Expiry Date</label>
        <input type="date" name="expires_at" class="form-control @error('expires_at') is-invalid @enderror"
            id="expires_at" value="{{ old('expires_at', $coupon->expires_at ?? '') }}">
        @error('expires_at')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
</div>
