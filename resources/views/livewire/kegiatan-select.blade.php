<div>
    {{-- Knowing others is intelligence; knowing yourself is true wisdom. --}}
<div class="card row-12">
    <div class="card-status bg-blue"></div>
    <div class="card-header">
        Pilih Kegiatan: {{ $kegiatan_id }}
         <span class="spinner-grow spinner-grow-sm text-primary" role="status" aria-hidden="true" wire:loading></span>
         <span class="spinner-grow spinner-grow-sm text-primary" role="status" aria-hidden="true" wire:loading></span>
         <span class="spinner-grow spinner-grow-sm text-primary" role="status" aria-hidden="true" wire:loading></span>
    </div>
    <div class="card-body">
    
        @if ($kegiatans->isNotEmpty())
            
        <div class="form-group">
            <label for=""></label>
            <select class="custom-select" name="" id=""  wire:model="kegiatan_id">
                <option selected>Pilih Kegiatan</option>
                @foreach ($kegiatans as $kegiatan)
            <option value="{{$kegiatan->id}}">{{$kegiatan->nama_kegiatan}} {{ $kegiatan->tahun }}</option>
                @endforeach
 
            </select>
        </div>
        @else
        
        <div class="alert alert-primary mt-5 mb-6">
            <div>Tidak ada kegiatan yang ditemukan<strong><a href="{{ url('/kegiatan/create') }}"> Buat Kegiatan Baru?</a></strong></div>
        </div>
        @endif
        
        @if ($kegiatan_id != null)
        <div class="row align-items-center">

            <div class="col-sm-6">
                <span class="text-muted"> Pelatihan</span>
            </div>
            <div class="col-sm 6">

              : {{ \Carbon\Carbon::parse($pelatihan_mulai)->translatedFormat('d F Y')}} - {{ \Carbon\Carbon::parse($pelatihan_selesai)->translatedFormat('d F Y')}}
            </div>
          </div>
          <hr class="mt-0 mb-2">
          <div class="row align-items-center">

            <div class="col-sm-6">
                <span class="text-muted"> Pelaksanaan Lapangan</span>
            </div>
            <div class="col-sm 6">

              : {{ \Carbon\Carbon::parse($pelaksanaan_mulai)->translatedFormat('d F Y')}} - {{ \Carbon\Carbon::parse($pelaksanaan_selesai)->translatedFormat('d F Y')}}
            </div>
          </div>
          <hr class="mt-0 mb-2">
        @else
            
        @endif
    </div>
</div>
</div>
