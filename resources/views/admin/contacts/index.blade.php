@extends('admin.layouts.app')
@php
    $title = 'Contacts ';
    $subTitle = 'Contacts';
@endphp

@section('content')
    <div class="card h-100 p-0 radius-12">
        <div class="card-body p-24">
            <div class="table-responsive scroll-sm">
                <table class="table bordered-table sm-table mb-0">
                    <thead>
                        <tr>
                            <th>S.L</th>
                            <th>الاسم</th>
                            <th>Email</th>
                            <th>رقم الهاتف</th>
                            <th>الرسالة</th>

                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($contacts as $contact)
                            <tr>
                                <td>{{ $loop->iteration + ($contacts->currentPage() - 1) * $contacts->perPage() }}</td>

                                {{-- ✅ Title translations --}}
                                <td>{{ $contact->full_name }}</td>
                                <td>{{ $contact->email }}</td>
                                <td>{{ $contact->phone_number }}</td>
                                <td>{{ $contact->message }}</td>

                                {{-- ✅ Actions --}}
                                <td class="text-center">
                                    <div class="d-flex align-items-center gap-10 justify-content-center">
                                        <form action="{{ route('admin.contacts.destroy', $contact->id) }}" method="POST"
                                            onsubmit="return confirm('Are you sure you want to delete this contact?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="bg-danger-focus bg-hover-danger-200 text-danger-600 fw-medium w-40-px h-40-px d-flex justify-content-center align-items-center rounded-circle border-0">
                                                <iconify-icon icon="fluent:delete-24-regular"
                                                    class="menu-icon"></iconify-icon>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted">لا يوجد أتصالات</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mt-24">
                <span>
                    Showing {{ $contacts->firstItem() ?? 0 }} to {{ $contacts->lastItem() ?? 0 }} of
                    {{ $contacts->total() ?? 0 }} entries
                </span>
                {{ $contacts->links() }}
            </div>
        </div>
    </div>
@endsection
