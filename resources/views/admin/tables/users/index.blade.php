@extends('admin.layouts.app')

@section('content')
<div class="p-6 bg-[#F8FAFC] min-h-screen">

    {{-- HEADER & SEARCH --}}
    <div class="flex flex-col md:flex-row md:items-center justify-between mb-8 gap-4">
        <div>
            <h1 class="text-2xl font-bold text-slate-800 tracking-tight">Daftar Admin</h1>
            <p class="text-sm text-slate-500">Kelola hak akses administrator sistem PT Sayap Sembilan Satu</p>
        </div>
        <div class="relative">
            <span class="absolute inset-y-0 left-3 flex items-center text-slate-400">
                <i class="bi bi-search"></i>
            </span>
            <input type="text" placeholder="Cari berdasarkan nama..."
                class="pl-10 pr-4 py-2 w-full md:w-72 rounded-xl border border-slate-200 focus:border-orange-500 focus:ring-2 focus:ring-orange-200 outline-none transition-all text-sm">
        </div>
    </div>

    {{-- STATS CARDS --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 flex items-center space-x-4">
            <div class="w-14 h-14 bg-slate-100 rounded-full flex items-center justify-center text-slate-600">
                <i class="bi bi-people-fill text-2xl"></i>
            </div>
            <div>
                <p class="text-sm font-medium text-slate-500">Total Admin</p>
                <p class="text-2xl font-bold text-slate-800">{{ $users->count() }}</p>
            </div>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 flex items-center space-x-4">
            <div class="w-14 h-14 bg-emerald-50 rounded-full flex items-center justify-center text-emerald-500">
                <i class="bi bi-wifi text-2xl"></i>
            </div>
            <div>
                <p class="text-sm font-medium text-slate-500">Admin Online</p>
                {{-- Logika sederhana: setidaknya 1 (yaitu user yang sedang melihat halaman ini) --}}
                <p class="text-2xl font-bold text-slate-800">1</p>
            </div>
        </div>
    </div>

    {{-- TABLE SECTION --}}
    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-[#0F172A] text-white uppercase text-[11px] tracking-widest font-bold">
                        <th class="px-6 py-4">No.</th>
                        <th class="px-6 py-4">Admin</th>
                        <th class="px-6 py-4">Tanggal Dibuat</th>
                        <th class="px-6 py-4">Status / Aktivitas</th>
                        <th class="px-6 py-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach($users as $index => $user)
                    <tr class="hover:bg-slate-50/50 transition-colors group">
                        <td class="px-6 py-5 text-sm font-medium text-slate-400">{{ $index + 1 }}</td>
                        <td class="px-6 py-5">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-orange-100 rounded-full flex items-center justify-center text-orange-600 font-bold text-sm">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </div>
                                <div>
                                    <p class="text-sm font-bold text-slate-800 leading-tight">{{ $user->name }}</p>
                                    <p class="text-xs text-slate-400">{{ $user->email }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-5 text-sm text-slate-600">
                            {{ $user->created_at->format('d M Y') }}
                        </td>
                        <td class="px-6 py-5">
                            @if(auth()->id() == $user->id)
                                <span class="flex items-center text-xs font-bold text-emerald-500 uppercase">
                                    <span class="w-2 h-2 bg-emerald-500 rounded-full mr-2 animate-pulse"></span>
                                    Online Sekarang
                                </span>
                            @else
                                <span class="text-sm text-slate-400 italic">Offline</span>
                            @endif
                        </td>
                        <td class="px-6 py-5">
                            <div class="flex items-center justify-center space-x-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                <a href="{{ route('admin.users.edit', $user->id) }}" class="p-2 text-blue-500 hover:bg-blue-50 rounded-lg transition-colors" title="Edit">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                @if(auth()->id() !== $user->id)
                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus admin ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="p-2 text-red-500 hover:bg-red-50 rounded-lg transition-colors" title="Hapus">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
