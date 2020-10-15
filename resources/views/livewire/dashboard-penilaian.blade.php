<div>
    <div class="row">
        <div class="card">
            <div class="card-header">
                Kinerja Mitra Pada Kegiatan {{$kegiatan->nama_kegiatan}}
            </div>
            <div class="card-body">
                    <div class="table-responsiive">
                        <table class="table table-hover table-striped">
                            <thead class="thead-inverse">
                                <tr>
                                    <th>Kecamatan</th>
                                    <th>Nilai Kinerja</th>
                                    
                                </tr>
                                </thead>
                                <tbody>
                                    @forelse ($avg_kecamatans as $kecamatan)
                                    <tr>
                                        <th scope="row"><strong> {{$kecamatan->kecamatan}}</strong></th>
                                    <td>{{ round($kecamatan->avg,2) }}</td>
                                    </tr>
                                    @empty
                                        <p>Tidak ada penilaian</p>
                                    @endforelse
                                    @if ($avg_kab !=null)
                                    <tr>
                                        <th scope="row"><strong><h6>Kota Subulussalam</h6></strong></th>
                                        <td>{{$avg_kab->avg}}</td>
                                    </tr>
                                    @endif

                                </tbody>
                        </table>
                    </div>
            </div>

        </div>
    </div>
</div>
