<div>
    <div class="container">
        <div class="row">
          <div class="col col-login mx-auto">
            <form class="card" wire:submit.prevent="store">
              <div class="card-body p-6">
                <div class="card-title">Tambah Kegiatan Baru</div>
                <div class="form-group">
                  <label class="form-label">Nama Kegiatan</label>
                  <input type="text" wire:model="nama_kegiatan" class="form-control" placeholder="Isikan Nama Kegiatan">
                </div>
                <div class="form-group">
                  <label class="form-label">Tahun </label>
                <input type="text" class="form-control" placeholder="Isikan Tahun Pelaksanaan" wire:model="tahun" value="{{\Carbon\Carbon::now()->year}}">
                </div>
                <div class="form-group">
                  <label class="form-label">Deskripsi</label>
                  <textarea class="form-control" id="deskripsi" wire:model="deskripsi" rows="3"></textarea>
                </div>

                <div class="form-footer">
                  <button type="submit" class="btn btn-primary btn-block">Tambah Kegiatan Baru</button>
                </div>
              </div>
            </form>

          </div>
        </div>
    </div>
</div>
