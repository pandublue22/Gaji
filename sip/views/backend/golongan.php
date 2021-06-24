<script>
function submit(x) {
    if (x == 'add') {
        $('[name="idgolongan"]').val("");
        $('[name="golongan"]').val("");
        $('[name="gaji_pokok"]').val("");
        $('[name="korpri"]').val("");
        $('[name="kristiani"]').val("");
        $('[name="muslim"]').val("");
        $('[name="dh_wanita"]').val("");
        $('#modal_add .modal-title').html('Tambah Golongan Baru')
        $('#btn-tambah').show();
        $('#btn-ubah').hide();
    } else {
        $('#modal_add .modal-title').html('Ubah Data Golongan')
        $('#btn-tambah').hide();
        $('#btn-ubah').show();

        $.ajax({
            type: "POST",
            data: {
                id: x
            },
            url: '<?=base_url();?>golongan/view',
            dataType: 'json',
            success: function(data) {
                $('[name="idgolongan"]').val(data.idgolongan);
                $('[name="golongan"]').val(data.golongan);
                $('[name="gaji_pokok"]').val(data.gaji_pokok);
                $('[name="korpri"]').val(data.korpri);
                $('[name="kristiani"]').val(data.kristiani);
                $('[name="muslim"]').val(data.muslim);
                $('[name="dh_wanita"]').val(data.dh_wanita);
            }
        });
    }
}

function ubah() {
    var idgolongan = $('[name="idgolongan"]').val();
    var golongan = $('[name="golongan"]').val();
    var gaji_pokok = $('[name="gaji_pokok"]').val();
    var korpri = $('[name="korpri"]').val();
    var kristiani = $('[name="kristiani"]').val();
    var muslim = $('[name="muslim"]').val();
    var dh_wanita = $('[name="dh_wanita"]').val();
    $.ajax({
        type: "POST",
        data: {
            idgolongan: idgolongan,
            golongan: golongan,
            gaji_pokok: gaji_pokok,
            korpri: korpri,
            kristiani: kristiani,
            muslim: muslim,
            dh_wanita: dh_wanita
        },
        url: '<?=base_url();?>golongan/ubah',
        success: function() {
            $('#modal_add').modal('hide');
            toastr.success("Update Successfully");
            setTimeout(() => {
                window.location =
                    "<?=site_url();?>golongan";
            }, 2500);
        }
    });

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
                    url: '<?=base_url();?>golongan/delete',
                    data: {
                        id: delete_value
                    },
                    success: function() {
                        $('#modal_delete').modal('hide');
                        toastr.success("Deleted Permanentelly Successfully");
                        setTimeout(() => {
                            window.location =
                                "<?=site_url();?>golongan";
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
        <a href="<?=base_url('golongan');?>" class="btn btn-sm btn-primary btn-flat" data-toggle="tooltip"
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
                        <th>GOLONGAN</th>
                        <th>GAJI POKOK</th>
                        <th>KORPRI</th>
                        <th>IK</th>
                        <th>IKM</th>
                        <th>DHARMA WANITA</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
					$n=1; 
					foreach(golongan() as $g): 
					?>
                    <tr>
                        <td><?=$n++.'.';?></td>
                        <td><input type="checkbox" class="check" name="check_id[]" value="<?=$g['idgolongan'];?>"></td>
                        <td>
                            <a href="#modal_add" data-toggle="modal" onclick="submit(<?=$g['idgolongan'];?>)"><i
                                    class="fa fa-edit"></i></a>
                        </td>
                        <td><?=$g['golongan'];?></td>
                        <td><?='Rp. '.money($g['gaji_pokok']);?></td>
                        <td><?='Rp. '.money($g['korpri']);?></td>
                        <td><?='Rp. '.money($g['kristiani']);?></td>
                        <td><?='Rp. '.money($g['muslim']);?></td>
                        <td><?='Rp. '.money($g['dh_wanita']);?></td>
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
            <form action="<?=base_url('golongan/addNew');?>" method="post" enctype="multipart/form-data">
                <div class="modal-header bg-blue">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Golongan <span style="color:red;">*</span></label>
                        <input type="hidden" class="form-control" name="idgolongan">
                        <input type="text" class="form-control" name="golongan" placeholder="Golongan" required>
                    </div>
                    <div class="form-group">
                        <label>Gaji <span style="color:red;">*</span></label>
                        <input type="text" class="form-control" name="gaji_pokok" placeholder="Gaji Pokok"
                            required>
                    </div>
                    <div class="form-group">
                        <label>Korpri <span style="color:red;">*</span></label>
                        <input type="text" class="form-control" name="korpri" placeholder="Korpri"
                            required>
                    </div>
                    <div class="form-group">
                        <label>IK <span style="color:red;">*</span></label>
                        <input type="text" class="form-control" name="kristiani" placeholder="IK"
                            required>
                    </div>
                    <div class="form-group">
                        <label>IKM <span style="color:red;">*</span></label>
                        <input type="text" class="form-control" name="muslim" placeholder="IKM"
                            required>
                    </div>
                    <div class="form-group">
                        <label>Dharma Wanita <span style="color:red;">*</span></label>
                        <input type="text" class="form-control" name="dh_wanita" placeholder="Dharma Wanita"
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
