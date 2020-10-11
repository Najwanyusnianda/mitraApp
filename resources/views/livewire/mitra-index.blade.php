<div>
  <div class="page-header">
    <h1 class="page-title">
      Kelola Mitra
    </h1>
  </div>
    @if (session()->has('message'))
    <div class="alert alert-success" role="alert">
      <h4 class="alert-heading"></h4>
     
      <p class="mb-0">{{session('message')}}</p>
    </div>
        
    @endif

    @if (session()->has('info'))
    <div class="alert alert-info" role="alert">
      <h4 class="alert-heading"></h4>
     
      <p class="mb-0">{{session('info')}}</p>
    </div>
        
    @endif
   
  

    @livewire('kegiatan-select')
    <hr>
    <!--<div class="row">
      <div class="col-sm-6 col-lg-3">
        <div class="card">
          <div class="card-body text-center">
            <div class="card-category">Daftar Mitra</div>

            <div class="text-center mt-6">
              <a href="#" class="btn btn-secondary btn-block">Pilih</a>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-lg-3">
        <div class="card">
          <div class="card-body text-center">
            <div class="card-category">Penilaian</div>

            <div class="text-center mt-6">
              <a href="#" class="btn btn-secondary btn-block">Pilih</a>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-lg-3">
        <div class="card">
          <div class="card-body text-center">
            <div class="card-category">Output</div>

            <div class="text-center mt-6">
              <a href="#" class="btn btn-secondary btn-block">Pilih</a>
            </div>
          </div>
        </div>
      </div>



    </div>-->
    <ul class="nav nav-tabs">
      <li class="nav-item">
      <a class="nav-link {{$tabs==1 ? 'active' : ''}}" wire:click="changesTab(1)">Daftar Mitra</a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{$tabs==2 ? 'active' : ''}}" wire:click="changesTab(2)">Penilaian</a>
      </li>
      <li class="nav-item">
      <a class="nav-link {{$tabs==3 ? 'active' : ''}}" wire:click="changesTab(3)">Output</a>
      </li>
    </ul>

    <br>
    @if (!empty($kegiatan))
      @if ($tabs==1)
      <div class="card row-12">
        <div class="card-header">
        
         
              <h3 class="card-title">Daftar Mitra {{ $kegiatan->nama_kegiatan }} {{ $kegiatan->tahun }}</h3>
  
              <div class="card-options">
                <button type="button" class="btn btn-primary btn-sm"  wire:click="createMitra()">
                  Tambah Mitra Baru
                </button>
     
    
         

                <form action="">
                  <div class="input-group">
                    <input type="text" class="form-control form-control-sm ml-3" placeholder="Cari Mitra" name="s">
                    <span class="input-group-btn ml-2">
                      <button class="btn btn-sm btn-default" type="submit">
                        <span class="fe fe-search"></span>
                      </button>
                    </span>
                  </div>
                </form>
              </div>
           
        </div>
        <div class="card-body">
   
          @if ($mitras->isEmpty())
          <div class="alert alert-primary mt-5 mb-6">
            <div>Tidak ada mitra yang tersedia</div>
          </div>
          @else
          <table class="table card-table table-vcenter text-nowrap" style="vertical-align: middle;">
            <thead>
                <tr style="">
                    <th scope="col">#</th>
                    <th scope="col">Nama</th>
                    <th scope="col">NIK</th>
                    <th scope="col">No. HP</th>
                    <th scope="col">Kualifikasi Gadget</th>
                    <th scope="col">Kepemilikan Kendaran</th>
                    <th scope="col"></th>
                
  
  
                </tr>
            </thead>
            <tbody>
                <?php $no=0; ?>
                @foreach ($mitras as $mitra)
                <?php $no++; ?>
                <tr>
                <th scope="row">{{$no}}</th>
                    <td><strong>{{$mitra->name}}</strong></td>
                    <td>{{$mitra->nik}}</td>
                    <td>{{$mitra->phone}}</td>
                    <td>
                      <span class="status-icon bg-{{ $mitra->is_gadget ? 'success' : 'danger' }}"></span>
                      {{$mitra->is_gadget ? 'Terpenuhi' : 'Tidak Terpenuhi'}}
                    </td>
                    <td>
                      <span class="status-icon bg-{{ $mitra->is_kendaraan ? 'success' : 'danger' }}"></span>
                      {{$mitra->is_kendaraan ? 'Terpenuhi' : 'Tidak Terpenuhi'}}
                    </td>

                    <td class="text-right">
                      <button class="btn btn-secondary btn-sm" wire:click="getMitraDetail({{$mitra->id}})">Detail</button>
                      <div class="dropdown">
                        <button class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown" id="dropdownMenuButton" aria-haspopup="true" aria-expanded="false">Aksi</button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                          <a class="dropdown-item" wire:click="getMitra({{$mitra->id}})">Edit</a>
                          <a class="dropdown-item" wire:click="deleteMitra({{$mitra->id}})">Hapus</a>
     
                        </div>
                      </div>
  
                    </td>
                    <!--<td>
  
                      <button class="btn btn-sm btn-info text-white" wire:click="getMitra({{$mitra->id}})" ><i class="fe fe-edit"></i></button>
                      <button class="btn btn-sm btn-danger text-white" wire:click="deleteMitra({{$mitra->id}})" >Delete</button>
                  
                  </td>-->
                </tr> 
                @endforeach
    
                
            </tbody>
          
          </table>
        <!--{{$mitras->links()}}-->
          @endif
  
        </div>
      </div>   
      @endif

      @if ($tabs==2)
          @livewire('mitra-penilaian')
      @endif

      @if ($tabs==3)
        @livewire('output-index')
      @endif

    @endif

    <!--Modal-->
    <!-- Modal -->
    @if (!empty($kegiatan))
    <div class="modal fade" id="addMitra" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"  data-backdrop="static">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"></h5>
            <!--<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>-->
          </div>
          <div class="modal-body">
              @if ($statusUpdate)
              @livewire('mitra-update')
              @else
              @livewire('mitra-create',['kegiatan'=>$kegiatan])
              @endif
          </div>
  
        </div>
      </div>
    </div>
  
    <div class="modal fade" id="detailMitra" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"  data-backdrop="static">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"></h5>
            <!--<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>-->
          </div>
          <div class="modal-body">
              @livewire('mitra-detail')
          </div>
  
        </div>
      </div>
    </div>
    
    <script>
        window.addEventListener('closeModal',event=>{
          $('#addMitra').modal('hide');  
          $('#detailMitra').modal('hide');
        });
  
        window.addEventListener('showModal',event=>{
          $('#addMitra').modal('show');  
        });

        window.addEventListener('showModalDetail',event=>{
          $('#detailMitra').modal('show');  
        });
    </script>
  </div>
    @endif



