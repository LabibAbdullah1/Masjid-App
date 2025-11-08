{{-- resources/views/admin/jadwal-ceramah/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Jadwal Ceramah')

@section('content')
    <div class="container mx-auto px-4 py-8" data-aos="fade-up">
        <h1 class="text-3xl font-bold mb-6 text-center text-green-700">
            📅 Jadwal Ceramah
        </h1>

        <!-- Tombol Tambah -->
        <div class="flex justify-end mb-4">
            <a href="{{ route('admin.jadwal-ceramah.create') }}"
                class="bg-yellow-600 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded-lg shadow-md transition duration-300">
                + Tambah Jadwal
            </a>
        </div>

        <!-- Tabel -->
        <div class="bg-white shadow-lg rounded-lg overflow-x-auto max-w-full border-2 border-green-600" data-aos="fade-up"
            data-aos-delay="200">
            <table class="min-w-full leading-normal">
                <thead class="bg-green-600 text-white">
                    <tr>
                        <th
                            class="px-5 py-3 border-b-2 border-gray-200 text-left text-sm font-semibold uppercase tracking-wider">
                            No
                        </th>
                        <th
                            class="px-5 py-3 border-b-2 border-gray-200 text-left text-sm font-semibold uppercase tracking-wider">
                            Penceramah
                        </th>
                        <th
                            class="px-5 py-3 border-b-2 border-gray-200 text-left text-sm font-semibold uppercase tracking-wider">
                            judul
                        </th>
                        <th
                            class="px-5 py-3 border-b-2 border-gray-200 text-left text-sm font-semibold uppercase tracking-wider">
                            Tanggal
                        </th>
                        <th
                            class="px-5 py-3 border-b-2 border-gray-200 text-left text-sm font-semibold uppercase tracking-wider">
                            Waktu
                        </th>
                        <th
                            class="px-5 py-3 border-b-2 border-gray-200 text-center text-sm font-semibold uppercase tracking-wider">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($jadwal as $item)
                        <tr class="hover:bg-green-50 transition duration-150">
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                {{ $loop->iteration + ($jadwal->currentPage() - 1) * $jadwal->perPage() }}
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                {{ $item->penceramah }}
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                {{ $item->judul }}
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                {{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('l, d M Y') }}
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                {{ \Carbon\Carbon::parse($item->waktu)->format('H:i') }} WIB
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                                <div class="flex justify-center space-x-2">
                                    <a href="{{ route('admin.jadwal-ceramah.edit', $item->id) }}"
                                        class="text-yellow-600 hover:text-yellow-800 transition duration-150">
                                        <i class="fa-regular fa-pen-to-square mr-2"></i>
                                    </a>
                                    <form action="{{ route('admin.jadwal-ceramah.destroy', $item->id) }}" method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus jadwal ini?')" class="delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="text-red-600 hover:text-red-800 transition duration-150">
                                            <i class="fa-regular fa-trash-can"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-5 py-5 text-center text-gray-500">
                                Belum ada jadwal ceramah.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-6">
            {{ $jadwal->links() }}
        </div>
    </div>
@endsection
