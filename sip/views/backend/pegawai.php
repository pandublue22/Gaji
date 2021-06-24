<script>
function submit(x) {
    if (x == 'add') {
        // window.location = "<?=site_url();?>gaji";
        // $('[name="idpegawai"]').val("");
        // $('[name="nip"]').val("");
        // $('[name="nama"]').val("");
        $('[name="golongan_idpeg"]').val(0);
        // $('[name="jk"]').val("");
        // $('[name="agama"]').val("");
        // $('[name="telp"]').val("");
        $('#modal_add .modal-title').html('Tambah Pegawai Baru')
        $('#btn-tambah').show();
        $('#btn-ubah').hide();
    } else {
        $('#modal_add .modal-title').html('Ubah Data Pegawai')
        $('#btn-tambah').hide();
        $('#btn-ubah').show();

        $.ajax({
            type: "POST",
            data: {
                id: x
            },
            url: '<?=base_url();?>pegawai/view',
            dataType: 'json',
            success: function(data) {
                $('[name="idpegawai"]').val(data.idpegawai);
                $('[name="nip"]').val(data.nip);
                $('[name="nama"]').val(data.nama);
                $('[name="golongan_idpeg"]').val(data.golongan_idpeg);
                $('[name="jk"]').val(data.jk);
                $('[name="agama"]').val(data.agama);
                $('[name="telp"]').val(data.telp);
            }
        });
    }
}

function ubah() {
    var idpegawai = $('[name="idpegawai"]').val();
    var nip = $('[name="nip"]').val();
    var nama = $('[name="nama"]').val();
    var golongan_idpeg = $('[name="golongan_idpeg"]').val();
    var jk = $('[name="jk"]').val();
    var agama = $('[name="agama"]').val();
    var telp = $('[name="telp"]').val();
    $.ajax({
        type: "POST",
        data: {
            idpegawai: idpegawai,
            nip: nip,
            nama: nama,
            golongan_idpeg: golongan_idpeg,
            jk: jk,
            agama: agama,
            telp: telp
        },
        url: '<?=base_url();?>pegawai/ubah',
        success: function() {
            $('#modal_add').modal('hide');
            toastr.success("Update Successfully");
            setTimeout(() => {
                window.location =
                    "<?=site_url();?>pegawai";
            }, 2500);
        }
    });
}

$(function() {
    $('[name="golongan_idpeg"]').on('change', function() {
        var x = $('[name="golongan_idpeg"]').val();
        $.ajax({
            type: "POST",
            data: {
                id: x
            },
            url: '<?=base_url();?>pegawai/viewGolongan',
            dataType: 'json',
            success: function(data) {
                var html = `
                <div class="form-group">
                    <label>Golongan<span style="color:red;">*</span></label>
                    <input type="text" class="form-control" name="golongan" value="` + data.golongan + `"
                        readonly>
                </div>`;
                $('#detail_golongan').html(html);
            }
        });
    });

    $('#delete_permanen_all').click(function() {
        $('#modal_delete').modal('show', {
            backdrop: 'static',
            keyboard: false
        });
        $('#deleted').click(function() {
            var delete_check = $('.check:checked');
            if (delete_check.length > 0) {
                var delete_value = [];
                $(delete_check).each(function() {
                    delete_value.push($(this).val());
                });

                $.ajax({
                    type: 'post',
                    url: '<?=base_url();?>pegawai/delete',
                    data: {
                        id: delete_value
                    },
                    success: function() {
                        $('#modal_delete').modal('hide');
                        toastr.success("Deleted Permanentelly Successfully");
                        setTimeout(() => {
                            window.location =
                                "<?=site_url();?>pegawai";
                        }, 2500);
                    }
                })
            } else {
                $('#modal_delete').modal('hide');
                toastr.warning("Please Select Data To Delete Permanentelly !");
            }
        })
    });
})
</script>
<!-- Content Header -->
<section class="content-header">
    <h1>
        <?=$title;?>
    </h1>
    <ol class="breadcrumb">
        <a href="#modal_add" class="btn btn-sm btn-primary btn-flat" data-toggle="modal" onclick="submit('add')"><i
                class="fa fa-plus"></i>
            Add New</a>
        <a href="#" class="btn btn-sm btn-primary btn-flat" data-toggle="tooltip" data-placement="top"
            title="Delete Permanentelly" id="delete_permanen_all"><i class="fa fa-trash"></i></a>
        <!-- <a href="<?=base_url('product/addproduct');?>" class="btn btn-sm btn-primary btn-flat" data-toggle="tooltip"
            data-placement="top" title="Export Excel"><i class="fa fa-file-excel-o"></i></a> -->
        <a href="<?=base_url('pegawai');?>" class="btn btn-sm btn-primary btn-flat" data-toggle="tooltip"
            data-placement="top" title="Refresh"><i class="fa fa-refresh"></i></a>
    </ol>
</section>
<!-- Main content -->
<section class="content">
    <?php $this->load->view('backend/alert'); ?>
    <div class="box">
        <div class="box-body table-responsive">
            <table id="example1" class="table table-bordered table-striped table-hover">
                <thead class="bg-gray">
                    <tr>
                        <th width="20">NO</th>
                        <th width="5"><input type="checkbox" id="check_all" value=""></th>
                        <th width="5"><i class="fa fa-edit"></i></th>
                        <!-- <th width="5"><i class="fa fa-image"></i></th> -->
                        <!-- <th width="5"><i class="fa fa-eye"></i></th> -->
                        <th>NIP</th>
                        <th>NAMA PEGAWAI</th>
                        <th>GOLONGAN</th>
                        <th>JK</th>
                        <th>AGAMA</th>
                        <th>NO. HP</th>
                        <!-- <th>CREATED</th> -->
                    </tr>
                </thead>
                <tbody>
                    <?php 
					$n=1; 
					foreach(pegawai() as $p): 
					?>
                    <tr>
                        <td><?=$n++.'.';?></td>
                        <td><input type="checkbox" class="check" name="check_id[]" value="<?=$p['idpegawai'];?>"></td>
                        <td>
                            <a href="#modal_add" data-toggle="modal" onclick="submit(<?=$p['idpegawai'];?>)"><i
                                    class="fa fa-edit"></i></a>
                        </td>
                        <td><?=$p['nip'];?></td>
                        <td><?=$p['nama'];?></td>
                        <td><?=$p['golongan_idpeg'];?></td>
                        <td><?=$p['jk'];?></td>
                        <td><?=$p['agama'];?></td>
                        <td><?=$p['telp'];?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</section>
<!-- Modal view produk -->
<div class="modal fade" id="modal_add" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?=base_url('pegawai/addNew');?>" method="post" enctype="multipart/form-data">
                <div class="modal-header bg-blue">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>NIP <span style="color:red;">*</span></label>
                        <input type="hidden" class="form-control" name="idpegawai">
                        <input type="text" class="form-control nip" name="nip" placeholder="Nomor Induk Pegawai"
                            required>
                    </div>
                    <div class="form-group">
                        <label>Nama Lengkap <span style="color:red;">*</span></label>
                        <input type="text" class="form-control" name="nama" placeholder="Nama Lengkap" required>
                    </div>
                    <div class="form-group">
                                <label>Golongan <span style="color:red;">*</span></label>
                                <select name="golongan_idpeg" class="form-control">
                                    <option value="">-- Pilih Golongan --</option>
                                    <?php foreach(golongan() as $g):?>
                                    <option value="<?=$g['idgolongan'];?>">
                                        <?=$g['golongan'];?>
                                    </option>
                                    <?php endforeach;?>
                                </select>
                    </div>
                    <div class="form-group">
                        <label>Jenis Kelamin <span style="color:red;">*</span></label>
                        <select name="jk" class="form-control">
                            <option value="Laki-Laki">Laki-Laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Agama <span style="color:red;">*</span></label>
                        <select name="agama" class="form-control">
                            <option value="Islam">Islam</option>
                            <option value="Kristen Protestan">Kristen Protestan</option>
                            <option value="Kristen Katolik">Kristen Katolik</option>
                            <option value="Hindu">Hindu</option>
                            <option value="Budha">Budha</option>
                            <option value="Konghucu">Konghucu</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>No. HP <span style="color:red;">*</span></label>
                        <input type="text" class="form-control number" name="telp" placeholder="Nomor Handphone"
                            required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-default btn-flat pull-left"
                        data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-sm btn-success btn-flat" id="btn-tambah">Tambah</button>
                    <button type="button" class="btn btn-sm btn-success btn-flat" id="btn-ubah"
                        onclick="ubah()">Ubah</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal konfirmasi delete -->
<div class="modal fade" id="modal_delete" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Konfirmasi</h4>
            </div>
            <div class="modal-body bg-red">
                <p>Anda yakin akan menghapus data ini ? </p>
            </div>
            <div class="modal-footer">
                <button class="btn btn-sm btn-default btn-flat" data-dismiss="modal">Cancel</button>
                <button class="btn btn-sm btn-danger btn-flat" id="deleted">Yes, Delete</button>
            </div>
        </div>
    </div>
</div>