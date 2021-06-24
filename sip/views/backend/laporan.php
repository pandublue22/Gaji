<script>
function submit(x) {
    if (x == 'add') {
        $('[name="id"]').val("");
        $('[name="category_name"]').val("");
        $('[name="category_description"]').val("");
        $('#modal_add .modal-title').html('Add New Image Product')
        $('#image').show();
        $('#btn-tambah').show();
        $('#btn-ubah').hide();
    } else {
        $('#modal_add .modal-title').html('Edit Image Product')
        $('#image').hide();
        $('#btn-tambah').hide();
        $('#btn-ubah').show();

        $.ajax({
            type: "POST",
            data: {
                id: x
            },
            url: '<?=base_url();?>category/view',
            dataType: 'json',
            success: function(data) {
                $('[name="idcategory"]').val(data.idcategory);
                $('[name="category_name"]').val(data.category_name);
                $('[name="category_description"]').val(data.category_description);
            }
        });
    }
}

function ubahkategori(x) {
    var idcategory = $('[name="idcategory"]').val();
    var category_name = $('[name="category_name"]').val();
    var category_description = $('[name="category_description"]').val();
    $.ajax({
        type: "POST",
        data: {
            idcategory: idcategory,
            category_name: category_name,
            category_description: category_description
        },
        url: '<?=base_url();?>category/editCategory',
        success: function() {
            $('#modal_add').modal('hide');
            toastr.success("Update Successfully");
            setTimeout(() => {
                window.location =
                    "<?=site_url();?>category";
            }, 2500);
        }
    });
}

function ubah_gambar(x) {
    $.ajax({
        type: "POST",
        data: {
            id: x
        },
        url: '<?=base_url();?>image/view',
        dataType: 'json',
        success: function(data) {
            var html = '<img src="<?= base_url(); ?>uploads/products/' + data.image +
                '" alt="kosong" width="100%" height="300">';
            $('#view_gambar').html(html);
            $('[name="idimage"]').val(data.idImage);
        }
    });
    if (x == 'ganti') {
        // var table = 'produk';
        // var id = $('[name="id"]').val();
        var action = '<?= base_url(); ?>image/edit';
        $('#form-ganti-gambar').attr('action', action).submit();
    }
}

$(function() {
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
                    url: '<?=base_url();?>image/delete',
                    data: {
                        idx: delete_value
                    },
                    success: function() {
                        $('#modal_delete').modal('hide');
                        toastr.success("Deleted Permanentelly Successfully");
                        setTimeout(() => {
                            window.location =
                                "<?=site_url();?>image";
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
        <a href="<?=base_url('laporan');?>" class="btn btn-sm btn-primary btn-flat" data-toggle="tooltip"
            data-placement="top" title="Refresh"><i class="fa fa-refresh"></i></a>
    </ol>
</section>
<!-- Main content -->
<section class="content">
    <?php $this->load->view('backend/alert'); ?>
    <div class="box">
        <div class="box-body">
            <form action="<?= base_url('laporan/cetak'); ?>" method="post" target="_blank">
                <div class="row">
                    <div class="col-md-2 col-xs-6">
                        <div class="form-group">
                            <label>Tanggal</label>
                            <div class="input-group date datepicker">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" class="form-control" name="tgl" placeholder="Tanggal">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>NIP</label>
                            <input type="text" class="form-control nip" name="nip" placeholder="Nomor Induk Pegawai">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Nama Pegawai</label>
                            <input type="text" class="form-control" name="nama" placeholder="Nama Pegawai">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Golongan</label>
                            <select name="golongan_id" class="form-control select2" style="width:100%;">
                                <option value="">-- Semua Golongan --</option>
                                <?php foreach(golongan() as $g):?>
                                <option value="<?=$g['idgolongan'];?>">
                                    <?=$g['golongan'];?>
                                </option>
                                <?php endforeach;?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2 text-center"style="line-height:80px;">
                            <a href="<?=base_url('ImportController');?>" class="btn btn-sm btn-success btn-flat">
                                Import Data</a>

                    </div>
                    <div class="col-md-2 text-center" style="line-height:80px;">
                        <button type="submit" class="btn btn-sm btn-success btn-flat">Tampilkan &
                            Cetak</button>
                    </div>
                </div>
            </form>
            <div class="table-responsive">
                <table id="example1" class="table table-bordered table-striped table-hover">
                    <thead class="bg-gray">
                        <tr>
                            <th width="20">NO</th>
                            <th>TANGGAL</th>
                            <th>NIP</th>
                            <th>NAMA PEGAWAI</th>
                            <th>GOLONGAN</th>
                            <th>GAJI POKOK</th>
                            <th>POTONGAN KORPRI</th>
                            <th>POTONGAN LAIN</th>
                            <th>POTONGAN IK</th>
                            <th>POTONGAN IKM</th>
                            <th>KOPERASI</th>
                            <th>DHARMA WANITA</th>
                            <th>TUNJANGAN</th>
                            <th>LEMBUR</th>
                            <th>GAJI BERSIH</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
					$n=1; 
					foreach(gaji() as $g): 
					?>
                        <tr>
                            <td><?=$n++.'.';?></td>
                            <td><?=$g['tanggal'];?></td>
                            <td><?=$g['nip'];?></td>
                            <td><?=$g['nama'];?></td>
                            <td><?=$g['golongan'];?></td>
                            <td><?='Rp. '.money($g['gaji_pokok']);?></td>
                            <td><?='Rp. '.money($g['potongan']);?></td>
                            <td><?='Rp. '.money($g['korpri']);?></td>
                            <td><?='Rp. '.money($g['kristiani']);?></td>
                            <td><?='Rp. '.money($g['muslim']);?></td>
                            <td><?='Rp. '.money($g['dh_wanita']);?></td>    
                            <td><?='Rp. '.money($g['tunjangan']);?></td>
                            <td><?='Rp. '.money($g['jam_lembur']*$g['uang_lembur']);?></td>
                            <td><?='Rp. '.money($g['gaji_bersih']);?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


</section>
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
