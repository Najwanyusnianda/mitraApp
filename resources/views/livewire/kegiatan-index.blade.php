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
                <div class="card col-sm-6 mx-auto shadow-lg p-3 mb-5 bg-white rounded">
                  <div class="card-header">
                    <!--<span class="mr-2 tag {{$kegiatan->is_active ? 'tag-info ' : '' }} badge-sm"> {{$kegiatan->is_active ? 'aktif' : 'selesai' }} </span>-->
                    <h3 class="card-title">
                         {{$kegiatan->nama_kegiatan }} {{ $kegiatan->tahun }}
                    </h3>
                   
                    <div class="card-options">
    
                      <div class="item-action dropdown">
                        <a href="javascript:void(0)" data-toggle="dropdown" class="icon" aria-expanded="false"><i class="fe fe-more-vertical"></i></a>
                        <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; transform: translate3d(-181px, 20px, 0px); top: 0px; left: 0px; will-change: transform;">
               
                          <a href="#" class="dropdown-item" wire:click="updateData({{ $kegiatan->id }})"><i class="dropdown-icon fe fe-edit-2"></i>Update Kegiatan</a>
                          <a href="#" class="dropdown-item" wire:click="confirmation({{ $kegiatan->id }})"><i class="dropdown-icon fe fe-trash"  ></i> Hapus Kegiatan</a>
                          <div class="dropdown-divider"></div>
                          <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fe fe-link"></i> Template Sertifikat</a>
                          <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fe fe-link"></i> Template SPK</a>
                        </div>
                      </div>
                      @if ($kegiatan->is_active && auth()->user()->role==1)
              
                      @else
                          
                      @endif
                      
                    </div>
                  </div>
                  <div class="card-body">
                    <nav aria-label="breadcrumb">
                      <ol class="breadcrumb">
                        <li class="breadcrumb-item " aria-current="page">
                          <i class="fe fe-users" data-toggle="tooltip" title="" data-original-title="fe fe-calendar"></i>
                          Mitra</li>
                           : &nbsp;  
                          @forelse ($count_mitra as $count)
                          @if ($count->kegiatan_id==$kegiatan->id)
                             <strong>{{ $count->count }} </strong>&nbsp;   Orang
                          @else    
                          
                          @endif
                      @empty
                         <span class="badge badge-warning">tidak tersedia</span>
                      @endforelse
                      </ol>
                    </nav>
 
                  
                    <nav aria-label="breadcrumb">
                      <ol class="breadcrumb">
                        <li class="breadcrumb-item " aria-current="page">
                          <i class="fe fe-calendar" data-toggle="tooltip" title="" data-original-title="fe fe-calendar"></i>
                          Jadwal</li>
                      </ol>
                    </nav>
                    <div class="row align-items-center">

                      <div class="col-sm-6">
                          <span class="text-muted"> Pelatihan</span>
                      </div>
                      <div class="col-sm 6">

                        : {{ \Carbon\Carbon::parse($kegiatan->pelatihan_mulai)->translatedFormat('d F Y')}} - {{ \Carbon\Carbon::parse($kegiatan->pelatihan_selesai)->translatedFormat('d F Y')}}
                      </div>
                    </div>
                    <hr class="mt-0 mb-2">
                    <div class="row align-items-center">

                      <div class="col-sm-6">
                          <span class="text-muted"> Pelaksanaan Lapangan</span>
                      </div>
                      <div class="col-sm 6">

                        : {{ \Carbon\Carbon::parse($kegiatan->pelaksanaan_mulai)->translatedFormat('d F Y')}} - {{ \Carbon\Carbon::parse($kegiatan->pelaksanaan_selesai)->translatedFormat('d F Y')}}
                      </div>
                    </div>
                    <hr class="mt-0 mb-2">

                  </div>
                 <!-- <div class="card-footer m-0 p-0">
                    <button type="button" name="" id="" class="btn btn-primary btn-block m-0 btn-lg" btn-lg btn-block">Detail</button>
                  </div>-->
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
