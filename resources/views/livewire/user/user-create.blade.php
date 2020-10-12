<div>
    {{-- Care about people's approval and you will be their prisoner. --}}

            <form class="card" wire:submit.prevent="store">
                <div class="card-header text-center">
                  <div class="card-title">
                    <strong> Detail Pengguna </strong>
                    
                  </div>
                </div>
                <div class="card-body p-6">
                  <div class="form-group">
                    <label class="form-label">Nama Lengkap Pengguna</label>
                    <input type="text" wire:model="name" name="name" id="name" class="form-control form-control-lg" placeholder="Isikan Nama Lengkap">
                  </div>
                  <div class="form-group">
                    <label class="form-label">Email</label>
                    <input type="email" wire:model="email" class="form-control form-control-lg" name="email" id="email" placeholder="Isikan Alamat Email">
                  </div>
                  <div class="form-group">
                    <label class="form-label">Password</label>
                    <input type="password" wire:model="password" id="password" class="form-control form-control-lg" placeholder="Isikan Password akun">
                  </div>
                  




                  
                  <div class="form-footer m-4">
                    <button type="submit" class="btn btn-primary btn-block ">Update / Tambah Pengguna</button>
                  </div>
                </div>
              </form>
    
</div>
