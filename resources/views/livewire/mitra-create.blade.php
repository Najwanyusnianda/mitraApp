<div>
<div class="card text-left">
  
  <div class="card-body">
    <h4 class="card-title">Tambah Mitra Baru</h4>
    <!--form tambah mitra baru-->
    <form wire:submit.prevent="store">
        
        
        <div class="form-group">
        <label for="">Nama : {{$name}}</label>
          <input wire:model="name" type="text" name="name"   id="name" class="form-control" placeholder="" aria-describedby="helpId">
          <small id="helpId" class="text-muted">Isikan nama lengkap</small>
         
        </div>
        <div class="form-group">
        <label for="">Nomor Telepon/HP : {{$phone}}</label>
            <input wire:model="phone" type="text" name="phone" id="phone" class="form-control" placeholder="" aria-describedby="helpId">
            <small id="helpId" class="text-muted">Isikan no. Hp yang aktif</small>
        </div>
    <button type="submit" class="btn btn-sm btn-primary">Submit</button>
   </form>

  
  </div>
</div>
</div>
