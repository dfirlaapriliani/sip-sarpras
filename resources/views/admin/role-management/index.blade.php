@extends('layout_admin.admin')

@section('title', 'Dashboard Admin')
@section('page-title', 'Admin Dashboard')

@section('content')
<div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Role Management</h1>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-2 mb-3 rounded">
            {{ session('success') }}
        </div>
    @endif

    <table class="w-full border">
        <thead class="bg-gray-100">
            <tr>
                <th class="p-2">Nama</th>
                <th class="p-2">Email</th>
                <th class="p-2">Role</th>
                <th class="p-2">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($users as $user)
            <tr class="border-t">
                <td class="p-2">{{ $user->name }}</td>
                <td class="p-2">{{ $user->email }}</td>
                <td class="p-2">{{ $user->role->nama_role ?? '-' }}</td>
                <td class="p-2 flex gap-2">

                    {{-- SHOW --}}
                    <a href="{{ route('admin.rolemanagement.show', $user->id) }}"
                       class="bg-blue-500 text-white px-3 py-1 rounded">
                        Detail
                    </a>

                    {{-- DELETE --}}
                    <form action="{{ route('admin.rolemanagement.destroy', $user->id) }}"
                          method="POST"
                          onsubmit="return confirm('Yakin hapus user ini?')">
                        @csrf
                        @method('DELETE')
                        <button class="bg-red-500 text-white px-3 py-1 rounded">
                            Hapus
                        </button>
                    </form>

                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection
