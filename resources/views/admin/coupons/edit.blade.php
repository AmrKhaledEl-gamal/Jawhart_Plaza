@extends('admin.layouts.app')

@php
    $title = 'Edit Coupon';
    $subTitle = 'Update coupon';
@endphp

@section('content')
    <div class="card p-24">
        <form action="{{ route('admin.coupons.update', $coupon) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-6 mb-20">
                    <label class="form-label">Code *</label>
                    <input type="text" name="code" class="form-control" value="{{ old('code', $coupon->code) }}" required>
                </div>

                <div class="col-md-6 mb-20">
                    <label class="form-label">Discount Type *</label>
                    <select name="discount_type" class="form-select" required>
                        <option value="fixed" {{ old('discount_type', $coupon->discount_type) === 'fixed' ? 'selected' : '' }}>Fixed</option>
                        <option value="percent" {{ old('discount_type', $coupon->discount_type) === 'percent' ? 'selected' : '' }}>Percent</option>
                    </select>
                </div>

                <div class="col-md-6 mb-20">
                    <label class="form-label">Discount Value *</label>
                    <input type="number" step="0.01" name="discount_value" class="form-control"
                        value="{{ old('discount_value', $coupon->discount_value) }}" required>
                </div>

                <div class="col-md-6 mb-20">
                    <label class="form-label">Expiry Date *</label>
                    <input type="date" name="expiry_date" class="form-control"
                        value="{{ old('expiry_date', optional($coupon->expiry_date)->format('Y-m-d')) }}" required>
                </div>

                <div class="d-flex justify-content-center gap-3 mt-24">
                    <a href="{{ route('admin.coupons.index') }}" class="btn btn-outline-danger">Cancel</a>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </div>
        </form>
    </div>
@endsection
