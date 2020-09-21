<div>
    @if (session()->has('message'))
    .<div class="alert alert-success" role="alert">
      <h4 class="alert-heading"></h4>
     
      <p class="mb-0">{{session('message')}}</p>
    </div>
        
    @endif
    @if ($statusUpdate)
    @livewire('mitra-update')
    @else
    @livewire('mitra-create')
    @endif
  
  
    <div class="card">
        <div class="card-header">

        </div>
        <div class="card-body">
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
                            <button class="btn btn-sm btn-info text-white" wire:click="getMitra({{$mitra->id}})">Edit</button>
                            <button class="btn btn-sm btn-danger text-white" wire:click="deleteMitra({{$mitra->id}})">Delete</button>
                        </td>
                    </tr> 
                    @endforeach
        
                    
                </tbody>
            </table>
        </div>
    </div>

</div>
