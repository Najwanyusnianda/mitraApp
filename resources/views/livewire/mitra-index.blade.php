<div>
    
    @livewire('mitra-create')
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
                            <button class="btn btn-sm btn-info text-white">Edit</button>
                            <button class="btn btn-sm btn-danger text-white">Delete</button>
                        </td>
                    </tr> 
                    @endforeach
        
                    
                </tbody>
            </table>
        </div>
    </div>

</div>
