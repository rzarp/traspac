<table>
    <thead>
        <tr>
                <th> No </th>
                <th>Nip</th>
                <th>Nama</th>
                <th>Tempat Lahir</th>
                <th>Alamat</th>
                <th>Tanggal Lahir</th>
                <th>Jenis kelamin</th>
                <th>Golongan</th>
                <th>Eselon</th>
                <th>Jabatan</th>
                <th>Tempat tugas</th>
                <th>Agama</th>
                <th>Unit kerja</th>
                <th>No Hp</th>
                <th>NPWP</th>
                <th>Created at</th>
                <th>Updated at</th>
        </tr>
    </thead>
    <tbody>
        @foreach($form as $f)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $f->nip }}</td>
                <td>{{ $f->nama }}</td>
                <td>{{ $f->tempat_lahir }}</td> 
                <td>{{ $f->alamat }}</td>
                <td>{{ $f->tgl_lahir }}</td>
                <td>{{ $f->jenis_kelamin }}</td>
                <td>{{ $f->golongan }}</td>
                <td>{{ $f->eselon }}</td>
                <td>{{ $f->jabatan }}</td>  
                <td>{{ $f->tempat_tugas }}</td>
                <td>{{ $f->agama }}</td>
                <td>{{ $f->unit_kerja }}</td>
                <td>{{ $f->no_hp }}</td>
                <td>{{ $f->npwp }}</td>
                <td>{{ $f->created_at }}</td>
                <td>{{ $f->updated_at }}</td>
            </tr>
        @endforeach
    </tbody>
</table>