@extends('layouts.petugas')
@section('title', 'KlikLelang - Masyarakat')

@section('content')
  <div class="masyarakat">
    <x-breadcrumb groupPage="Master Data" currentPage="Masyarakat"></x-breadcrumb>
    <section>
      <x-data-table title="Daftar Masyarakat"
        description="Berikut adalah data masyarakat yang telah ditambahkan ke sistem."
        withAdd="{{ route('masyarakat.create') }}" withAddText="Tambah Masyarakat" :rowHeaders="['NIK', 'Nama Lengkap', 'Username', 'Telepon', 'Alamat', 'Status', '']" withoutOptional>
        @foreach ($daftarMasyarakat as $masyarakat)
          <x-row>
            <x-cell>
              <p class="default-cell-text" style="color: #667085">{{ $daftarMasyarakat->firstItem() + $loop->index }}</p>
            </x-cell>
            <x-cell>
              <p class="default-cell-text">{{ $masyarakat->nik }}</p>
            </x-cell>
            <x-cell>
              <p class="default-cell-text" style="font-weight: 500">{{ $masyarakat->nama_lengkap }}</p>
            </x-cell>
            <x-cell>
              <p class="default-cell-text" style="color: #667085">{{ '@' . $masyarakat->username }}</p>
            </x-cell>
            <x-cell>
              <p class="default-cell-text">{{ $masyarakat->telp }}</p>
            </x-cell>
            <x-cell className="alamat-cell">
              <p class="default-cell-text">{{ $masyarakat->alamat }}</p>
            </x-cell>
            <x-cell>
              <span
                class="badge {{ $masyarakat->status === 'aktif' ? 'aktif' : 'blokir' }}">{{ $masyarakat->status ?? 'Nonaktif' }}</span>
            </x-cell>
            <x-cell>
              <div class="masyarakat-actions">
                @if ($masyarakat->status === 'aktif')
                  <x-custom-action actionTo="{{ route('masyarakat.block', $masyarakat) }}" method="PATCH" icon="block"
                    color="#475467">Blokir</x-custom-action>
                @else
                  <x-custom-action actionTo="{{ route('masyarakat.unblock', $masyarakat) }}" method="PATCH" icon="unblock"
                    color="#027a48">Unblokir</x-custom-action>
                @endif
                <div class="masyarakat-edit-delete">
                  <x-edit-action to="{{ route('masyarakat.edit', $masyarakat) }}"></x-edit-action>
                  <x-delete-action actionTo="{{ route('masyarakat.destroy', $masyarakat) }}"></x-delete-action>
                </div>
              </div>
            </x-cell>
          </x-row>
        @endforeach
        <x-slot name="footer">
          {{ $daftarMasyarakat->links('components.pagination') }}
        </x-slot>
      </x-data-table>
    </section>
  </div>
@endsection

@push('styles')
  <link rel="stylesheet" href="{{ asset('css/pages/dashboard/masyarakat/style.css') }}">
@endpush