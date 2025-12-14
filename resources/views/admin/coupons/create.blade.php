@extends('admin.layouts.app')

@php
    $title = 'Create Coupon';
    $subTitle = 'Add new coupon';
@endphp

@section('content')
    <div class="card p-24">
        <form action="{{ route('admin.coupons.store') }}" method="POST">
            @csrf

            <div class="row">
                <div class="col-md-6 mb-20">
                    <label class="form-label">Code *</label>
                    <input type="text" name="code" class="form-control" value="{{ old('code') }}" required>
                </div>

                <div class="col-md-6 mb-20">
                    <label class="form-label">Discount Type *</label>
                    <select name="discount_type" class="form-select" required>
                        <option value="fixed" {{ old('discount_type') === 'fixed' ? 'selected' : '' }}>Fixed</option>
                        <option value="percent" {{ old('discount_type') === 'percent' ? 'selected' : '' }}>Percent</option>
                    </select>
                </div>

                <div class="col-md-6 mb-20">
                    <label class="form-label">Discount Value *</label>
                    <input type="number" step="0.01" name="discount_value" class="form-control"
                        value="{{ old('discount_value') }}" required>
                </div>

                <div class="col-md-6 mb-20">
                    <label class="form-label">Expiry Date *</label>
                    <input type="date" name="expiry_date" class="form-control" value="{{ old('expiry_date') }}" required>
                </div>

                <div class="d-flex justify-content-center gap-3 mt-24">
                    <a href="{{ route('admin.coupons.index') }}" class="btn btn-outline-danger">Cancel</a>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
        </form>
    </div>
@endsection
