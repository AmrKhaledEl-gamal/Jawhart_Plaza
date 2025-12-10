@extends('admin.layouts.app')
@php
    $title = 'Edit User';
    $subTitle = 'Edit User';
@endphp

@section('content')
    <div class="card h-100 p-0 radius-12">
        <div class="card-body p-24">
            <div class="row justify-content-center">
                <div class="col-xxl-6 col-xl-8 col-lg-10">
                    <div class="card border">
                        <div class="card-body">
                            <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                {{-- Name --}}
                                <div class="mb-20">
                                    <label for="name" class="form-label fw-semibold text-primary-light text-sm mb-8">
                                        Full Name <span class="text-danger-600">*</span>
                                    </label>
                                    <input type="text" class="form-control radius-8 @error('name') is-invalid @enderror"
                                        id="name" placeholder="Enter Full Name" name="name"
                                        value="{{ old('name', $user->name) }}">
                                    @error('name')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                {{-- Email --}}
                                <div class="mb-20">
                                    <label for="email" class="form-label fw-semibold text-primary-light text-sm mb-8">
                                        Email <span class="text-danger-600">*</span>
                                    </label>
                                    <input type="email" class="form-control radius-8 @error('email') is-invalid @enderror"
                                        id="email" placeholder="Enter email address" name="email"
                                        value="{{ old('email', $user->email) }}">
                                    @error('email')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                {{-- Password (optional) --}}
                                <div class="mb-20">
                                    <label for="password" class="form-label fw-semibold text-primary-light text-sm mb-8">
                                        Password <span class="text-muted">(Leave empty if not changing)</span>
                                    </label>
                                    <input type="password"
                                        class="form-control radius-8 @error('password') is-invalid @enderror" id="password"
                                        placeholder="Enter new password" name="password">
                                    @error('password')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                {{-- Password Confirmation --}}
                                <div class="mb-20">
                                    <label for="password_confirmation"
                                        class="form-label fw-semibold text-primary-light text-sm mb-8">
                                        Password Confirmation
                                    </label>
                                    <input type="password" class="form-control radius-8" id="password_confirmation"
                                        placeholder="Confirm new password" name="password_confirmation">
                                </div>

                                {{-- Buttons --}}
                                <div class="d-flex align-items-center justify-content-center gap-3">
                                    <a href="{{ route('admin.users.index') }}"
                                        class="border border-danger-600 bg-hover-danger-200 text-danger-600 text-md px-56 py-11 radius-8 text-decoration-none">
                                        Cancel
                                    </a>
                                    <button type="submit"
                                        class="btn btn-primary border border-primary-600 text-md px-56 py-12 radius-8">
                                        Update
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
