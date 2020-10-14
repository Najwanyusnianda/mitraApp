<div>
    <div class="page-header">
        <h1 class="page-title">
          Daftar Mitra
        </h1>
      
    </div>
    <div class="row gutters-xs">
        <!--<div class="col">
            <div class="form-group">
                <div class="custom-file">
                  <input type="file" class="custom-file-input" name="example-file-input-custom">
                  <label class="custom-file-label">Pilih File</label>
                </div>
            </div>
        </div>
        <span class="col-auto">
            <a href="#" class="btn btn-info" type="submit"><i class="fas fa-upload"></i> Upload Daftar Mitra</a>
        </span>-->
      </div>

    <div class="card row-12">
       
        <div class="card-header">
            <h3 class="card-title"></h3>
            <div class="card-options">
                <div class="dropdown">
                <button class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown" id="dropdownMenuButton" aria-haspopup="true" aria-expanded="false"> <i class="fas fa-filter"></i>{{$kecamatan ==null ? 'Filter Kecamatan' : $kecamatan=="semua" ? 'Filter Kecamatan' : $kecamatan}}</button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                      <a class="dropdown-item" href="#" wire:click="filterKecamatan('semua')">Semua Mitra</a>
                        @foreach ($kecamatans as $key =>$kec)
                            <a class="dropdown-item" href="#"wire:click="filterKecamatan('{{$kec}}')">{{$key+1}}. {{$kec}}</a>
                        @endforeach
                  
               
                    </div>
                  </div>
                <form action="">
                  <div class="input-group">
                    <input type="text" class="form-control form-control-sm ml-3" placeholder="Cari Mitra" name="search" wire:model="search">
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
            <table class="table table-hover table-outline table-vcenter text-nowrap card-table" id="mitraTable">
                <thead>
                    <tr>
                        <th>NIK</th>
                        <th>Nama</th>
                        <th>Jenis Kelamin</th>
                    
                        <th>Kecamatan</th>

                    </tr>
                </thead>
                <tbody>
                    @if ($mitras->isNotEmpty())
                    @foreach ($mitras as $mitra)
                        <tr>
                            <td> <strong>{{$mitra->nik}} </strong> </td>
                            <td> <strong>{{ $mitra->name }}</strong> </td>
                            <td>
                                {{$mitra->jenis_kelamin}}
                            </td>
                            
                            <td> {{$mitra->kecamatan}}  </td>
                        </tr>
                     @endforeach
                    @endif
        
                </tbody>
            </table>
        </div>
        <div class="card-footer text-muted">
            {{$mitras->links()}}
        </div>
    </div>
    <script>


    </script>
</div>