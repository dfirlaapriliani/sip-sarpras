@extends('layout_admin.admin')

@section('title', 'Dashboard Admin')
@section('page-title', 'Admin Dashboard')

@section('content')
<div class="p-4 sm:p-6 lg:p-8">
    <div class="max-w-3xl mx-auto bg-white shadow-lg rounded-xl p-6 sm:p-8">
        <h1 class="text-2xl sm:text-3xl font-bold text-blue-800 mb-6">Detail User</h1>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-2 mb-4 rounded">
                {{ session('success') }}
            </div>
        @endif

        <div class="mb-6 space-y-2 text-gray-700 text-sm sm:text-base">
            <p><span class="font-semibold">Nama:</span> {{ $user->name }}</p>
            <p><span class="font-semibold">Email:</span> {{ $user->email }}</p>
            <p><span class="font-semibold">Role Saat Ini:</span> {{ $user->role->nama_role ?? '-' }}</p>
        </div>

        <form action="{{ route('admin.rolemanagement.update', $user->id) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <label class="block">
                <span class="text-gray-700 font-medium mb-1">Ubah Role</span>
                <select name="role_id" class="w-full border border-gray-300 rounded px-3 py-2 text-sm sm:text-base focus:ring-2 focus:ring-blue-400 focus:outline-none">
                    @foreach ($roles as $role)
                        <option value="{{ $role->id_role }}" {{ $user->role_id == $role->id_role ? 'selected' : '' }}>
                            {{ $role->nama_role }}
                        </option>
                    @endforeach
                </select>
            </label>

            <div class="flex flex-col sm:flex-row sm:gap-3 gap-2">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-medium px-4 py-2 rounded transition">
                    Update Role
                </button>
                <a href="{{ route('admin.rolemanagement.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-medium px-4 py-2 rounded transition text-center">
                    Kembali
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
