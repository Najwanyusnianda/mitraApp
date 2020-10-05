<div>
    <div class="card row-12">
        <div class="card-header">
        
         
              <h3 class="card-title">Output Kegiatan</h3>
  
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
                    <th>Aksi</th>

  
  
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
                        <div class="dropdown">
                            <button class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown" id="dropdownMenuButton" aria-haspopup="true" aria-expanded="false">Aksi</button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                              <a class="dropdown-item" target="_blank" href="{{ url('/output/sertifikat/'.$kegiatan_id.'/'.$mitra->id) }}">Sertifikat</a>
                              <a class="dropdown-item" href="#">Kontrak</a>
                              <a class="dropdown-item" href="#">SPJ</a>
         
                            </div>
                        </div>
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
</div>
