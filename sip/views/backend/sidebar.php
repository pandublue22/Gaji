<!-- sidebar: style can be found in sidebar.less -->
<section class="sidebar">
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN MENU</li>
        <li <?=isset($dashboard) ? 'class="active"':'';?>>
            <a href="<?= base_url('dashboard'); ?>">
                <i class="fa fa-dashboard"></i> <span>DASHBOARD</span>
            </a>
        </li>
        <?php if ($this->session->userdata('access') === 'super_user' || $this->session->userdata('access') === 'administrator' || $this->session->userdata('access') === 'user'): ?>
        <li class="treeview <?=isset($pegawai) ? 'active':'';?>">
            <a href="#">
                <i class="fa fa-pencil-square-o"></i>
                <span>PEGAWAI</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <li <?=isset($allpegawai) ? 'class="active"':'';?>><a href="<?=site_url('pegawai');?>"><i
                            class="fa fa-angle-double-right"></i> Semua
                        Pegawai</a></li>
                <li <?=isset($golongan) ? 'class="active"':'';?>><a href="<?=site_url('golongan');?>"><i
                            class="fa fa-angle-double-right"></i>
                        Golongan</a>
                </li>
            </ul>
        </li>
        <?php endif;?>
        <?php if ($this->session->userdata('access') === 'super_user' || $this->session->userdata('access') === 'administrator' || $this->session->userdata('access') === 'user'): ?>
        <li <?=isset($gaji) ? 'class="active"':'';?>>
            <a href="<?=base_url('gaji');?>">
                <i class="fa fa-check-square-o"></i> <span>GAJIAN</span>
            </a>
        </li>
        <?php endif;?>
        <?php if ($this->session->userdata('access') === 'super_user' || $this->session->userdata('access') === 'administrator'): ?>
        <li <?=isset($alluser) ? 'class="active"':'';?>>
            <a href="<?=base_url('user/alluser');?>">
                <i class="fa fa-users"></i> <span>PENGGUNA</span>
            </a>
        </li>
        <?php endif;?>
        <?php if ($this->session->userdata('access') === 'super_user' || $this->session->userdata('access') === 'administrator'): ?>
        <li <?=isset($laporan) ? 'class="active"':'';?>>
            <a href="<?=base_url('laporan');?>">
                <i class="fa fa-newspaper-o"></i> <span>LAPORAN</span>
            </a>
        </li>
        <?php endif;?>
        <?php if ($this->session->userdata('access') === 'super_user' || $this->session->userdata('access') === 'administrator' || $this->session->userdata('access') === 'user'): ?>
        <li <?=isset($gaji) ? 'class="active"':'';?>>
            <a href="<?=base_url('gaji');?>">
                <i class="fa fa-newspaper-o"></i> <span>LAPORAN BPD</span>
            </a>
        </li>
        <?php endif;?>
        <?php if ($this->session->userdata('access') === 'super_user' || $this->session->userdata('access') === 'administrator'): ?>
        <li <?=isset($company_profile) ? 'class="active"':'';?>>
            <a href="<?=base_url('settings');?>">
                <i class="fa fa-cog"></i> <span>PENGATURAN</span>
            </a>
        </li>
        <?php endif;?>
        <!-- <?php if ($this->session->userdata('access') === 'super_user'): ?>
        <li class="treeview">
            <a href="#">
                <i class="fa fa-wrench"></i> <span>MAINTENANCE</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <li><a href="<?=site_url('maintenance/backup_database');?>"><i class="fa fa-angle-double-right"></i>
                        Backup Database</a>
                </li>
                <li><a href="<?=site_url('maintenance/backup_apps');?>"><i class="fa fa-angle-double-right"></i> Backup
                        Apps</a>
                </li>
            </ul>
        </li>
        <?php endif;?> -->
        <li class="header">UTILITY</li>
        <li><a href="#" data-toggle="control-sidebar"><i class="fa fa-cogs text-red"></i>
                <span>More Settings</span></a></li>
    </ul>
</section>