<div>
  <div class="page-header">
    <h1 class="page-title">
      Kelola Pengguna
    </h1>
  </div>
    <div class="row">
      <div class="col-12">
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
      </div>

  

    </div>
    <div class="row">
        <div class="col-sm-4">
            @livewire('user.user-create')
        </div>
        <div class="card col-sm-8 mx-auto p-5">
          <div class="card-header">
            <div class="card-title">
              <h5>
              <strong>Daftar Pengguna</strong>
            </h5>
          </div>
          </div>
          <div class="card-body">
            <table class="table table-striped table-inverse ">
              <thead class="thead-inverse">
                  <tr>
                      <th>No</th>
                      <th>Nama</th>
                      <th>email</th>
                      <th></th>
                  </tr>
                  </thead>
                  <tbody>
                    @forelse ($users as $key => $user)
                      @if ($user->role==1)
                          
                      @else
                      <tr>
                        <td scope="row">{{$key+1}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>
                            <div class="input-group">
                                <span class="input-group-btn">
                                    <button class="btn btn-info btn-sm" type="button" aria-label="" wire:click='getUser({{$user->id}})'>Kelola</button>
                                    <button class="btn btn-danger btn-sm" type="button" aria-label="" wire:click='confirmation({{$user->id}})'>Hapus</button>
                              </span>
                              
                            </div>
                        </td>
                        </tr> 
                      @endif

                    @empty
                        
                    @endforelse


                  </tbody>
          </table>
          </div>


        </div>
    </div>


    <div class="modal fade" id="deleteUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"  data-backdrop="static">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Hapus Pengguna</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
        
              Apakah anda akan menghapus pengguna ini ?
              <br>
              <p></p>
              <div class="alert alert-danger" role="alert">
                Pengguna akan dihapus permanen
              </div>
              
             
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
             <button type="button" class="btn btn-primary" wire:click="deletePengguna()">Ya</button>
            </div>
          </div>
        </div>
    </div>

      <script>
        window.addEventListener('closeConfirmationModal',event=>{
          $('#deleteUser').modal('hide');  
        });
  
        window.addEventListener('showConfirmationModal',event=>{
          $('#deleteUser').modal('show');  
        });

    </script>
</div>
