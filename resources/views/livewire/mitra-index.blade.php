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
        
         
              <h3 class="card-title">Daftar Mitra</h3>
  
              <div class="card-options">
                <button type="button" class="btn btn-primary btn-sm"  wire:click="createMitra()">
                  Tambah Mitra Baru
                </button>
     
    
         
                <button type="button" class="btn btn-secondary btn-sm ml-2"  wire:click="createMitra()">
                  Upload Mitra
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
        <div class="card-body mt-5">
          @if ($mitras->isEmpty())
              <h4>kosong</h4>
          @else
          <table class="table table-condensed">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama</th>
                    <th>No. HP</th>
                    <th>Kualifikasi Gadget</th>
                    <th>Kepemilikan Kendaran</th>
                    <th></th>
                
  
  
                </tr>
            </thead>
            <tbody>
                <?php $no=0; ?>
                @foreach ($mitras as $mitra)
                <?php $no++; ?>
                <tr>
                <th scope="row">{{$no}}</th>
                    <td>{{$mitra->name}}</td>
                    <td>{{$mitra->phone}}</td>
                    <th>Terpenuhi</th>
                    <th>Terpenuhi</th>

                    <td class="text-right">
                      <button class="btn btn-secondary btn-sm">Detail</button>
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
  
    <script>
        window.addEventListener('closeModal',event=>{
          $('#addMitra').modal('hide');  
        });
  
        window.addEventListener('showModal',event=>{
          $('#addMitra').modal('show');  
        });
    </script>
  </div>
    @endif



