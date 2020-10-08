<div>
    <div class="page-header">
        <h1 class="page-title">
          Daftar Mitra
        </h1>
      
    </div>
    <div class="row gutters-xs">
        <div class="col">
            <div class="form-group">
                <div class="custom-file">
                  <input type="file" class="custom-file-input" name="example-file-input-custom">
                  <label class="custom-file-label">Pilih File</label>
                </div>
            </div>
        </div>
        <span class="col-auto">
            <a href="#" class="btn btn-info" type="submit"><i class="fas fa-upload"></i> Upload Daftar Mitra</a>
        </span>
      </div>

    <div class="card row-12">
        <div class="card-header">
            <h3 class="card-title"></h3>
            <div class="card-options">


    
            </div>
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>Nama</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($mitras->isNotEmpty())
                    @foreach ($mitras as $mitra)
                        <tr>
                            <td>{{ $mitra->name }}</td>
                        </tr>
                     @endforeach
                    @endif
        
                </tbody>
            </table>
        </div>
        <div class="card-footer text-muted">
            Footer
        </div>
    </div>

</div>