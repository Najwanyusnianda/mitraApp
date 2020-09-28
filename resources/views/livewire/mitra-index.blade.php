<div>
    @if (session()->has('message'))
    <div class="alert alert-success" role="alert">
      <h4 class="alert-heading"></h4>
     
      <p class="mb-0">{{session('message')}}</p>
    </div>
        
    @endif
   
  

    @livewire('kegiatan-select')


    @if (!empty($kegiatan))
    
    <div class="card row-12">
      <div class="card-header">
      
          <div class="col-6">
            <button type="button" class="btn btn-primary btn-sm"  wire:click="createMitra()">
              Tambah Mitra Baru
            </button>
          </div>

          <div class="col-6">
            <button type="button" class="btn btn-secondary btn-sm"  wire:click="createMitra()">
              Upload Mitra
            </button>
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
                  <td>
                      <button class="btn btn-sm btn-info text-white" wire:click="getMitra({{$mitra->id}})" >Edit</button>
                      <button class="btn btn-sm btn-danger text-white" wire:click="deleteMitra({{$mitra->id}})" >Delete</button>
                  </td>
              </tr> 
              @endforeach
  
              
          </tbody>
        
        </table>
      <!--{{$mitras->links()}}-->
        @endif

      </div>
     </div>
    @endif

    <!--Modal-->
    <!-- Modal -->
    @if (!empty($kegiatan))
    <div class="modal fade" id="addMitra" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
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

