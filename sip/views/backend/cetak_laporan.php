<html>

<head>
    <style type="tetx/css">
        h2{ 
				padding:0px;
				margin:0px;
			}
			text{
				padding:0px;
				}
			td{
				text-align:center;
			}
		</style>
    <title><?= $title; ?></title>

    <!-- Favicons -->
    <link href="<?= base_url(); ?>assets/front-end/img/<?= settings('general','favicon'); ?>" rel="icon">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="<?= base_url('assets/'); ?>bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url('assets/'); ?>bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="<?= base_url('assets/'); ?>bower_components/Ionicons/css/ionicons.min.css">
    <!-- DataTables -->
    <link rel="stylesheet"
        href="<?= base_url('assets/'); ?>bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="<?= base_url('assets/'); ?>bower_components/select2/dist/css/select2.min.css">
    <!-- bootstrap datepicker -->
    <link rel="stylesheet"
        href="<?= base_url('assets/'); ?>bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url('assets/'); ?>dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
	folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="<?= base_url('assets/'); ?>dist/css/skins/_all-skins.min.css">
    <!-- Google Font -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body>

    <div style="page-break-after:always;">
        <center>
            <h2 style="line-height:5px;color:green;"><?=settings('company_profile','company_name');?></h2>
            <p>
                <i
                    style="font-size:12pt;"><?='Website : '.settings('company_profile','website').', Email :'.settings('company_profile','email').', Fax : '.settings('company_profile','fax').', No. Telp : '.settings('company_profile','phone');?></i><br>
                <i
                    style="font-size:12pt;"><?='Alamat : '.settings('company_profile','street_address').', '.settings('company_profile','village').', '.settings('company_profile','sub_district').', '.settings('company_profile','district').'. Kode Pos : '.settings('company_profile','postal_code');?></i>
            </p>
            <hr style="border:1.5px solid">
            <hr style="border:0.5px solid;margin-top:-15px;">
            <h3>LAPORAN DAFTAR GAJIAN<h3>
        </center>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th width="20">NO</th>
                        <th>TANGGAL</th>
                        <th>NIP</th>
                        <th>NAMA PEGAWAI</th>
                        <th>GOLONGAN</th>
                        <th>GAJI POKOK</th>
                        <th>POTONGAN</th>
                        <th>TUNJANGAN</th>
                        <th>LEMBUR</th>
                        <th>GAJI BERSIH</th>
                    </tr>
                </thead>
                <tbody id="myTable">
                    <?php $no=1; foreach($data as $row): ?>
                    <tr>
                        <td><?= $no++.'.'; ?></td>
                        <td><?= $row->tanggal; ?></td>
                        <td><?= $row->nip; ?></td>
                        <td><?= $row->nama; ?></td>
                        <td><?= $row->golongan; ?></td>
                        <td><?= 'Rp. '.money($row->gaji_pokok); ?></td>
                        <td><?= 'Rp. '.money($row->potongan); ?></td>
                        <td><?= 'Rp. '.money($row->tunjangan); ?></td>
                        <td><?= 'Rp. '.money($row->jam_lembur*$row->uang_lembur); ?></td>
                        <td><?= 'Rp. '.money($row->gaji_bersih); ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <br>
        <p style="text-align:center;margin-left:400px;">
            Tanda Tangan
            <br>
            <br>
            <br>
            <br>
            <br>
            <?=settings('company_profile','headmaster');?></p>

    </div>
</body>

<!-- jQuery 3 -->
<script src="<?= base_url('assets/'); ?>bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?= base_url('assets/'); ?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="<?= base_url('assets/'); ?>bower_components/fastclick/lib/fastclick.js"></script>
<!-- DataTables -->
<script src="<?= base_url('assets/'); ?>bower_components/datatables.net/js/jquery.dataTables.min.js">
</script>
<script src="<?= base_url('assets/'); ?>bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js">
</script>
<!-- CK Editor -->
<script src="<?= base_url('assets/'); ?>bower_components/ckeditor/ckeditor.js"></script>
<!-- Select2 -->
<script src="<?= base_url('assets/'); ?>bower_components/select2/dist/js/select2.full.min.js"></script>
<!-- bootstrap datepicker -->
<script src="<?= base_url('assets/'); ?>bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js">
</script>
<!-- Mask Money -->
<script src="<?= base_url('assets/'); ?>plugins/jquery-mask.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url('assets/'); ?>dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?= base_url('assets/'); ?>dist/js/demo.js"></script>

</html>

<script>
window.print();
</script>
