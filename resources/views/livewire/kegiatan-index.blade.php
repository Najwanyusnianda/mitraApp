<div>
  <section>
    <div class="page-header">
      <h1 class="page-title">
        Daftar Kegiatan
      </h1>
    </div>

  </section>
    <section>
        <div class="container">
            @foreach ($kegiatans as $kegiatan)

            <div class="row-lg-8">
                <div class="card">
                  <div class="card-header">
                    <span class="mr-2 badge {{$kegiatan->is_active ? 'badge-success' : 'badge-danger' }} badge-sm"> {{$kegiatan->is_active ? 'aktif' : 'selesai' }} </span>
                    <h3 class="card-title">
                         {{$kegiatan->nama_kegiatan }}
                    </h3>
                   
                    <div class="card-options">
                      <a href="#" class="btn btn-secondary btn-sm">Detail</a>
                      @if ($kegiatan->is_active)
                      <a href="#" class="btn btn-outline-danger btn-sm ml-2" wire:click="inActiveKegiatan({{ $kegiatan->id }})"> Tutup</a>
                      @else
                          
                      @endif
                      
                    </div>
                  </div>
                  <div class="card-body">
                    {{$kegiatan->deskripsi}}
                  </div>
                </div>
            </div>
            @endforeach
            {{$kegiatans->links()}}
        </div>
    </section>


</div>
