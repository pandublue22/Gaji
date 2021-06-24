<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <?=$title;?>
    </h1>
</section>

<!-- Main content -->
<section class="content">
    <!-- Info boxes -->
    <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="fa fa-folder"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">PEGAWAI</span>
                    <span class="info-box-number"><?=count(pegawai());?></span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-red"><i class="fa fa-folder"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">GOLONGAN</span>
                    <span class="info-box-number"><?=count(golongan());?></span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-green"><i class="fa fa-check"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">GAJIAN</span>
                    <span class="info-box-number"><?=count(gaji());?></span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-yellow"><i class="fa fa-users"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">PENGGUNA</span>
                    <span class="info-box-number"><?=count(pengguna());?></span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->


    <!-- Main row -->
    <div class="row">
        <!-- Left col -->
        <div class="col-md-8">
            <div class="row">
                <div class="col-md-6">
                </div>
                <!-- /.col -->

                <div class="col-md-6">
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <!-- TABLE: LATEST ORDERS -->
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Daftar Gajian Terakhir</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                                class="fa fa-times"></i></button>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table no-margin">
                            <thead>
                                <tr>
                                    <th>NIP</th>
                                    <th>GAJI POKOK</th>
                                    <th>POTONGAN</th>
                                    <th>TUNJANGAN</th>
                                    <th>LEMBUR</th>
                                    <th>GAJI BERSIH</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
								foreach($gajian as $g): 
								?>
                                <tr>
                                    <td><a href="<?=base_url('gaji/detail/');?><?=$g['idgaji'];?>"><?=$g['nip'];?></a>
                                    </td>
                                    <td><?=money($g['gaji_pokok']);?></td>
                                    <td><?=money($g['potongan']);?></td>
                                    <td><?=money($g['tunjangan']);?></td>
                                    <td><?=money($g['jam_lembur']*$g['uang_lembur']);?></td>
                                    <td><?=money($g['gaji_bersih']);?></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.table-responsive -->
                </div>
                <!-- /.box-body -->
                <div class="box-footer clearfix">
                    <p class="pull-left text-yellow">* Klik NIP Pegawai untuk melihat detail gaji</p>
                    <a href="<?=base_url('gaji');?>" class="btn btn-sm btn-default btn-flat pull-right">Lihat Semua
                        Daftar
                        Gaji</a>
                </div>
                <!-- /.box-footer -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-4">
            <!-- About Me Box -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Informasi Profil Anda</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <strong><i class="fa fa-user margin-r-5"></i> <?=user()['user_fullname'];?></strong>
                    <p class="text-muted">
                        Nama lengkap anda
                    </p>
                    <hr>
                    <strong><i class="fa fa-user margin-r-5"></i> <?=user()['user_name'];?></strong>
                    <p class="text-muted">Username anda</p>
                    <hr>
                    <strong><i class="fa fa-envelope margin-r-5"></i> <?=user()['user_email'];?></strong>
                    <p class="text-muted">Alamat email anda</p>
                    <hr>
                    <strong><i class="fa fa-key margin-r-5"></i> <?=user()['user_type'];?></strong>
                    <p class="text-muted">Hak akses anda</p>
                    <hr>

                    <strong><i class="fa fa-history margin-r-5"></i>
                        <?=date('Y-m-d H:i:s',user()['last_loggin']);?></strong>

                    <p>Waktu terakhir anda login</p>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
    <!-- /.row -->
</section>
<!-- /.content -->



<!-- Add the sidebar's background. This div must be placed
	immediately after the control sidebar -->
<div class="control-sidebar-bg"></div>
<!-- modal info -->
<div class="modal fade" id="modal_info">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Informasi</h4>
            </div>
            <div class="modal-body">
                <h4>Selamat Datang</h4>
                <p>Anda telah berhasil login dengan hak akses <b><?=$this->session->userdata('access');?></b></p>
            </div>
            <!-- <div class="modal-footer">
					<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary">Save changes</button>
				</div> -->
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<script>
$(document).ready(function() {
    $('#modal_info').modal('show', {
        backdrop: 'static'
    });
});
</script>
