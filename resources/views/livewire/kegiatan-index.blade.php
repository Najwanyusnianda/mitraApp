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

            <div class="row-12  ">
                <div class="card col-sm-6 mx-auto ">
                  <div class="card-header">
                    <span class="mr-2 badge {{$kegiatan->is_active ? 'badge-success' : 'badge-danger' }} badge-sm"> {{$kegiatan->is_active ? 'aktif' : 'selesai' }} </span>
                    <h3 class="card-title">
                         {{$kegiatan->nama_kegiatan }} {{ $kegiatan->tahun }}
                    </h3>
                   
                    <div class="card-options">
                      <a href="#" class="btn btn-secondary btn-sm">Detail</a>
                      
                      @if ($kegiatan->is_active && auth()->user()->role==1)
                      <a href="#" class="btn btn-outline-danger btn-sm ml-2" wire:click="confirmation({{ $kegiatan->id }})"> Tutup</a>
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



    <div class="modal fade" id="closeKegiatan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"  data-backdrop="static">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Menutup Kegiatan</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            @if (!empty($kegiatan_chosen))
            Apakah anda akan menutup kegiatan {{ $kegiatan_chosen->nama_kegiatan }} {{ $kegiatan_chosen->tahun }} ?
            <br>
            <p></p>
            <div class="alert alert-danger" role="alert">
              Kegiatan tidak dapat diaktifkan kembali
            </div>
            @endif
           
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
           <button type="button" class="btn btn-primary" wire:click="inActiveKegiatan()">Ya</button>
          </div>
        </div>
      </div>
    </div>
  
    <script>
        window.addEventListener('closeConfirmationModal',event=>{
          $('#closeKegiatan').modal('hide');  
        });
  
        window.addEventListener('showConfirmationModal',event=>{
          $('#closeKegiatan').modal('show');  
        });
    </script>

</div>
