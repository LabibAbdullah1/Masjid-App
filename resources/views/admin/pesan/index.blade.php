@extends('layouts.app')

@section('title', 'Pesan & Saran Masuk')

@section('content')
    <div class="max-w-full min-w-full mx-auto mt-10 bg-white p-6 rounded-lg shadow" data-aos="fade-up">
        <h2 class="text-3xl font-semibold text-gray-800 mb-4 text-center">Daftar Pesan & Saran</h2>

        <!-- Form Bulk Delete -->
        <form id="bulkDeleteForm" action="{{ route('admin.pesan.bulkDelete') }}" method="POST">
            @csrf
            @method('DELETE')

            <div class="mb-4 flex justify-between items-center">
                <div>
                    <button type="submit" id="deleteSelectedBtn"
                        class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded hidden"
                        onclick="return confirm('Yakin ingin menghapus pesan terpilih?')">
                        Hapus Terpilih
                    </button>
                </div>
                <span class="text-gray-600 text-sm">Total Pesan: {{ $pesanSaran->total() }}</span>
            </div>

            <table class="w-full table-fixed border border-gray-200">
                <thead>
                    <tr class="bg-gray-100 text-left">
                        <th class="border py-1 text-center">
                            <input type="checkbox" id="selectAll">
                        </th>
                        <th class="border px-3 py-2">Pengirim</th>
                        <th class="border px-3 py-2">Pesan</th>
                        <th class="border px-3 py-2">Balasan</th>
                        <th class="border px-2 py-2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pesanSaran as $pesan)
                        <tr>
                            <td class="border px-1 py-2 text-center">
                                <input type="checkbox" name="ids[]" value="{{ $pesan->id }}" class="selectItem">
                            </td>
                            <td class="border px-3 py-2">{{ $pesan->user->name }}</td>
                            <td class="border px-3 py-2 break-words max-h-64 overflow-y-auto first-letter:uppercase">
                                {{ $pesan->pesan }}
                            </td>
                            <td class="border px-3 py-2 break-words max-h-64 overflow-y-auto first-letter:uppercase">
                                @if ($pesan->feedback)
                                    <span class="text-green-600">{{ $pesan->feedback }}</span>
                                    <br>
                                    <small class="text-gray-500">Dibalas pada:
                                        {{ $pesan->dibalas_pada->format('d M Y H:i') }}
                                    </small>
                                @else
                                    <span class="text-red-500">Belum dibalas</span>
                                @endif
                            </td>
                            <td class="border px-3 py-2">
                                <a href="{{ route('admin.pesan.edit', $pesan->id) }}"
                                    class="text-blue-600 mr-2"><i class="fa-regular fa-pen-to-square"></i></a>
                                <form action="{{ route('admin.pesan.destroy', $pesan->id) }}" method="POST"
                                    class="delete-form inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline"
                                        onclick="return confirm('Yakin hapus pesan ini?')">
                                        <i class="fa-regular fa-trash-can"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-4">Belum ada pesan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </form>

        <div class="mt-4">
            {{ $pesanSaran->links() }}
        </div>
    </div>

    <script>
        const selectAll = document.getElementById('selectAll');
        const checkboxes = document.querySelectorAll('.selectItem');
        const deleteBtn = document.getElementById('deleteSelectedBtn');

        selectAll.addEventListener('change', function() {
            checkboxes.forEach(cb => cb.checked = selectAll.checked);
            toggleDeleteButton();
        });

        checkboxes.forEach(cb => {
            cb.addEventListener('change', toggleDeleteButton);
        });

        function toggleDeleteButton() {
            const checkedCount = document.querySelectorAll('.selectItem:checked').length;
            deleteBtn.classList.toggle('hidden', checkedCount === 0);
        }
    </script>
@endsection
