@extends('layouts.petugas')
@section('title', 'KlikLelang - Petugas')

@section('content')
  <div class="i-petugas">
    <x-breadcrumb groupPage="Master Data" currentPage="Petugas"></x-breadcrumb>
    <section>
      <x-data-table title="Daftar Petugas"
        description="Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestiae, neque!"
        withAdd="{{ route('petugas.create') }}" withAddText="Tambah Petugas" :rowHeaders="['Nama Petugas', 'Username', 'Level', '']" withoutOptional>
        @foreach ($daftarPetugas as $petugas)
          <x-row>
            <x-cell>
              <p class="default-cell-text" style="color: #667085">{{ $daftarPetugas->firstItem() + $loop->index }}</p>
            </x-cell>
            <x-cell>
              <p class="default-cell-text" style="font-weight: 500">{{ $petugas->nama_petugas }}</p>
            </x-cell>
            <x-cell>
              <p class="default-cell-text" style="color: #667085">{{ '@' . $petugas->username }}</p>
            </x-cell>
            <x-cell>
              <span
                class="badge {{ $petugas->level->level === 'administrator' ? 'admin' : 'petugas' }}">{{ $petugas->level->level }}</span>
            </x-cell>
            <x-cell>
              <div class="petugas-actions">
                <x-edit-action to="{{ route('petugas.edit', $petugas) }}"></x-edit-action>
                <x-delete-action actionTo="{{ route('petugas.destroy', $petugas) }}"></x-delete-action>
              </div>
            </x-cell>
          </x-row>
        @endforeach
        <x-slot name="footer">
          {{ $daftarPetugas->links('components.pagination') }}
        </x-slot>
      </x-data-table>
    </section>
  </div>
@endsection

@push('styles')
  <link rel="stylesheet" href="{{ asset('css/pages/dashboard/petugas/style.css') }}">
@endpush