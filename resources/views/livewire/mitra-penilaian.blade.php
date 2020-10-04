<div>
    <div class="card row-12">
        <div class="card-header">
        
         
              <h3 class="card-title">Penilaian Mitra</h3>
  
              <div class="card-options">
                <div class="dropdown">
                    <button class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown" id="dropdownMenuButton" aria-haspopup="true" aria-expanded="false">Filter</button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                      <a class="dropdown-item" href="#">Semua mitra</a>
                      <a class="dropdown-item" href="#">Belum ada penilaian</a>
                      <a class="dropdown-item" href="#">Sudah ada penilaian</a>
                    </div>
                  </div>
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
                    <th>NIK</th>
                    <th>Pelatihan</th>
                    <th>Pelaksanaan Lapangan</th>
                    <th>Evaluasi Lapangan</th>
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
                    <td>{{$mitra->nik ?? 'tidak ada'}}</td>
                    <td>
                        <span class="badge badge-pill badge-{{$mitra->avg_pelatihan ? 'success' : 'danger' }}">
                            {{$mitra->avg_pelatihan ?? 'belum ada penilaian'}}
                        </span>
                    </td>
                    <td>
                        <span class="badge badge-pill badge-{{$mitra->avg_pelaksanaan ? 'success' : 'danger' }}">
                            {{$mitra->avg_pelaksanaan ?? 'belum ada penilaian'}}
                        </span>
                    </td>
                    <td>
                        <span class="badge badge-pill badge-{{$mitra->avg_evaluasi ? 'success' : 'danger' }}">
                            {{$mitra->avg_evaluasi ?? 'belum ada penilaian'}}
                        </span>
                    </td>
                    <td class="text-right">
               
                      @if (empty($mitra->avg_evaluasi))
                      <button class="btn btn-secondary btn-sm" wire:click="addPenilaian({{ $mitra->id }})">
                        @if (empty($mitra->avg_pelatihan))
                          Beri nilai pelatihan
                        @else
                          @if (empty($mitra->avg_pelaksanaan))
                          Beri nilai Pelaksaaan Lapangan
                          @else
                          Beri nilai Evaluasi Lapangan    
                          @endif
                        @endif
                        
                        </button>
                      @else
                          <button disabled="disabled" class="btn btn-success btn-sm"> Sudah diberi nilai</button>
                      @endif

    
                    </td>
                    <!--<td>
  
                        <button class="btn btn-sm btn-info text-white" wire:click="getMitra({{$mitra->id}})" >Update Data</button>
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




      <!--modal-->
      
    @if (!empty($kegiatan))
   
    <div class="modal fade" id="addPenilaian" tabindex="-1" role="dialog" aria-labelledby="penilaianLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="penilaianLabel">Penilaian Mitra</h5>
            <!--<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>-->
          </div>
          <div class="modal-body">
              @livewire('mitra-penilaian-create',['kegiatan_id'=>$kegiatan->id])
          </div>
  
        </div>
      </div>
    </div>
  
    <script>
        window.addEventListener('closeModalPenilaian',event=>{
          $('#addPenilaian').modal('hide');  
        });
  
        window.addEventListener('showModalPenilaian',event=>{
          $('#addPenilaian').modal('show');  
        });
    </script>
  </div>
    @endif
</div>
