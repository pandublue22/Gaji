<script>
function submit(x) {
    if (x == 'add') {
        // window.location = "<?=site_url();?>gaji";
        // $('[name="tanggal"]').val("");
        // $('[name="pegawai_id"]').val("");
        //$('[name="golongan_id"]').val(0);
        // $('[name="potongan"]').val("");
        // $('[name="tunjangan"]').val("");
        // $('[name="gaji_bersih"]').val("");
        // $('[name="tunjangan"]').prop('readonly', true);
        $('#modal_add .modal-title').html('Tambah Gaji Baru')
        $('#btn-tambah').show();
        $('#btn-ubah').hide();
    } else {
        $('#modal_add .modal-title').html('Ubah Data Gaji')
        $('#btn-tambah').hide();
        $('#btn-ubah').show();

        $.ajax({
            type: "POST",
            data: {
                id: x
            },
            url: '<?=base_url();?>gaji/view',
            dataType: 'json',
            success: function(data) {
                $('[name="idgaji"]').val(data.idgaji);
                $('[name="tanggal"]').val(data.tanggal);
                $('[name="pegawai_id"]').val(data.pegawai_id);
                $('[name="golongan_id"]').val(data.golongan_id);
                $('[name="potongan"]').val(data.potongan);
                $('[name="tunjangan"]').val(data.tunjangan);
                $('[name="gaji_bersih"]').val(data.gaji_bersih);
            }
        });
    }
}

function ubah() {
    var idgaji = $('[name="idgaji"]').val();
    var tanggal = $('[name="tanggal"]').val();
    var pegawai_id = $('[name="pegawai_id"]').val();
    var golongan_id = $('[name="golongan_id"]').val();
    var potongan = $('[name="potongan"]').val();
    var tunjangan = $('[name="tunjangan"]').val();
    var gaji_bersih = $('[name="gaji_bersih"]').val();
    alert(tanggal);
    $.ajax({
        type: "POST",
        data: {
            idgaji: idgaji,
            tanggal: tanggal,
            pegawai_id: pegawai_id,
            golongan_id: golongan_id,
            potongan: potongan,
            tunjangan: tunjangan,
            gaji_bersih: gaji_bersih
        },
        url: '<?=base_url();?>gaji/ubah',
        success: function() {
            $('#modal_add').modal('hide');
            toastr.success("Update Successfully");
            setTimeout(() => {
                window.location =
                    "<?=site_url();?>gaji";
            }, 2500);
        }
    });
}

// function potongan() {
//     var hasil = $('[name="gaji_pokok"]').val() - $('[name="potongan"]').val();
//     $('[name="gaji_bersih"]').val(hasil);
// }
function convertToRupiah(angka) {
    var rupiah = '';
    var angkarev = angka.toString().split('').reverse().join('');
    for (var i = 0; i < angkarev.length; i++)
        if (i % 3 == 0) rupiah += angkarev.substr(i, 3) + '.';
    return rupiah.split('', rupiah.length - 1).reverse().join('');
}

function convertToAngka(rupiah) {
    return parseInt(rupiah.replace(/,.*|[^0-9]/g, ''), 10);
}
$(function() {

    $('[name="potongan"]').prop('readonly', true);
    $('[name="tunjangan"]').prop('readonly', true);
//    $('[name="lembur"]').prop('readonly', true);
    $('[name="potongan"]').on('change', function() {
        // var value = $('[name="potongan"]').val();
        var potongan = convertToAngka($('[name="potongan"]').val());
        // var potongan = value.replace(/\./g, "");
        var hasil = convertToAngka($('[name="gaji_pokok"]').val()) - potongan;
        $('[name="gaji_bersih"]').val(convertToRupiah(hasil));
        $('[name="tunjangan"]').prop('readonly', false);
    });
    $('[name="tunjangan"]').on('change', function() {
        // var value1 = $('[name="potongan"]').val();
        var potongan = convertToAngka($('[name="potongan"]').val());
        // var potongan = value1.replace(/\./g, "");
        // var value2 = $('[name="tunjangan"]').val();
        var tunjangan = convertToAngka($('[name="tunjangan"]').val());
        // var tunjangan = value2.replace(/\./g, "");
        var hasil = tunjangan + convertToAngka($('[name="gaji_bersih"]').val());
        $('[name="gaji_bersih"]').val(convertToRupiah(hasil));
//        $('[name="lembur"]').prop('readonly', false);
    });
//    $('[name="lembur"]').on('change', function() {
//        var lembur = convertToAngka($('[name="lembur"]').val());
//        var harga = convertToAngka($('[name="uang_lembur"]').val());
//      var total_lembur = harga * lembur;
//      var hasil = total_lembur + convertToAngka($('[name="gaji_bersih"]').val());
//      $('[name="gaji_bersih"]').val(convertToRupiah(hasil));
//    });
    $('[name="pegawai_id"]').on('change', function() {
        var x = $('[name="pegawai_id"]').val();
        $.ajax({
            type: "POST",
            data: {
                id: x
            },
            url: '<?=base_url();?>gaji/viewPegawai',
            dataType: 'json',
            success: function(data) {
                var html = `
                <div class="form-group">
                    <label>Nama Pegawai<span style="color:red;">*</span></label>
                    <input type="text" class="form-control" name="nama" value="` + data.nama + `"
                        readonly>
                </div>`;
                $('#detail_pegawai').html(html);
                var html = `
                <div class="form-group">
                    <label>Golongan<span style="color:red;">*</span></label>
                    <input type="text" class="form-control" name="golongan_idpeg" value="` + data.golongan_idpeg + `"
                        readonly>
                </div>`;
                $('#detail_golonganpegawai').html(html);
                
            }
        });
    });
    $('[name="golongan_id"]').on('change', function() {
        var x = $('[name="golongan_id"]').val();
        $.ajax({
            type: "POST",
            data: {
                id: x
            },
            url: '<?=base_url();?>gaji/viewGolongan',
            dataType: 'json',
            success: function(data) {
                var html = `
                <div class="form-group">
                    <label>Gaji Pokok<span style="color:red;">*</span></label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            Rp.
                        </div>
                        <input type="text" class="form-control uang" name="gaji_pokok" value="` + convertToRupiah(data.gaji_pokok) + `"
                            readonly>
                    </div>
                </div>`;

                $('#detail_golongan').html(html);
                var html = `
                <div class="form-group">
                    <label>Potongan Korpri<span style="color:red;">*</span></label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            Rp.
                        </div>
                        <input type="text" class="form-control uang" name="gaji_pokok" value="` + convertToRupiah(data.korpri) + `"
                            readonly>
                    </div>
                </div>`;
                $('#detail_golongan_korpri').html(html);
                var html = `
                <div class="form-group">
                    <label>Potongan IK<span style="color:red;">*</span></label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            Rp.
                        </div>
                        <input type="text" class="form-control uang" name="gaji_pokok" value="` + convertToRupiah(data.kristiani) + `"
                            readonly>
                    </div>
                </div>`;
                $('#detail_golongan_kristiani').html(html);
                var html = `
                <div class="form-group">
                    <label>Potongan IKM<span style="color:red;">*</span></label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            Rp.
                        </div>
                        <input type="text" class="form-control uang" name="gaji_pokok" value="` + convertToRupiah(data.muslim) + `"
                            readonly>
                    </div>
                </div>`;
                $('#detail_golongan_muslim').html(html);
                var html = `
                <div class="form-group">
                    <label>Potongan Dharma Wanita<span style="color:red;">*</span></label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            Rp.
                        </div>
                        <input type="text" class="form-control uang" name="gaji_pokok" value="` + convertToRupiah(data.dh_wanita) + `"
                            readonly>
                    </div>
                </div>`;
                $('#detail_golongan_dh_wanita').html(html);
                $('[name="potongan"]').prop('readonly', false);
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
                    url: '<?=base_url();?>gaji/delete',
                    data: {
                        id: delete_value
                    },
                    success: function() {
                        $('#modal_delete').modal('hide');
                        toastr.success("Deleted Permanentelly Successfully");
                        setTimeout(() => {
                            window.location =
                                "<?=site_url();?>gaji";
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
        <a href="<?=base_url('gaji');?>" class="btn btn-sm btn-primary btn-flat" data-toggle="tooltip"
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
                        <!-- <th width="5"><i class="fa fa-edit"></i></th> -->
                        <!-- <th width="5"><i class="fa fa-image"></i></th> -->
                        <th width="5"><i class="fa fa-eye"></i></th>
                        <th>TANGGAL</th>
                        <th>NIP</th>
                        <th>NAMA PEGAWAI</th>                       
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
                        <td><input type="checkbox" class="check" name="check_id[]" value="<?=$g['idgaji'];?>"></td>
                        <!-- <td>
                            <a href="#modal_add" data-toggle="modal" onclick="submit(<?=$g['idgaji'];?>)"><i
                                    class="fa fa-edit"></i></a>
                        </td> -->
                        <td>
                            <a href="<?=base_url('gaji/detail/');?><?=$g['idgaji'];?>"><i class="fa fa-eye"></i></a>
                        </td>
                        <td><?=$g['tanggal'];?></td>
                        <td><?=$g['nip'];?></td>
                        <td><?=$g['nama'];?></td>
                        <td><?='Rp. '.money($g['gaji_bersih']);?></td>
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
            <form action="<?=base_url('gaji/addNew');?>" method="post" enctype="multipart/form-data">
                <div class="modal-header bg-blue">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tanggal <span style="color:red;">*</span></label>
                                <div class="input-group date datepicker">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="hidden" class="form-control" name="idgaji">
                                    <input type="text" class="form-control" name="tanggal" placeholder="Tanggal"
                                        required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>NIP <span style="color:red;">*</span></label>
                                <select name="pegawai_id" class="form-control select2" style="width:100%;">
                                    <option value="">-- Pilih NIP Pegawai --</option>
                                    <?php foreach(pegawai() as $p):?>
                                    <option value="<?=$p['idpegawai'];?>"><?=$p['nip'];?></option>
                                    <?php endforeach;?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div id="detail_pegawai">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div id="detail_golonganpegawai">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Golongan <span style="color:red;">*</span></label>
                                <select name="golongan_id" class="form-control select2" style="width:100%;">
                                    <option value="">-- Pilih Golongan --</option>
                                    <?php foreach(golongan() as $g):?>
                                    <option value="<?=$g['idgolongan'];?>">
                                        <?=$g['golongan'];?>
                                    </option>
                                    <?php endforeach;?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div id="detail_golongan">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div id="detail_golongan_korpri">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div id="detail_golongan_kristiani">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div id="detail_golongan_muslim">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div id="detail_golongan_dh_wanita">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Potongan<span style="color:red;">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        Rp.
                                    </div>
                                    <input type="text" class="form-control uang" name="potongan" placeholder="Potongan"
                                        required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tunjangan<span style="color:red;">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        Rp.
                                    </div>
                                    <input type="text" class="form-control uang" name="tunjangan"
                                        placeholder="Tunjangan" required>
                                </div>
                            </div>
                        </div>
          
<!--
Input Jam Lembur
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Jam Lembur<span style="color:red;">*</span></label>
                                <div class="input-group">
                                    <input type="hidden" class="form-control uang" name="uang_lembur"
                                        value="<?=$harga_lembur;?>">
                                    <input type="text" class="form-control uang" name="lembur"
                                        placeholder="Jumlah jam lembur" required>
                                    <div class="input-group-addon">
                                        Jam / Rp. <b id="harga-lembur"><?=money($harga_lembur);?></b>-,
                                    </div>
                                </div>
                            </div>
                        </div>
-->                        
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Gaji Bersih<span style="color:red;">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        Rp.
                                    </div>
                                    <input type="text" class="form-control uang" name="gaji_bersih"
                                        placeholder="Gaji Bersih" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-sm btn-default btn-flat pull-left"
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