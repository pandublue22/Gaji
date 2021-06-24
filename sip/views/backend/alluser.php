<script>
function submit(x) {
    if (x == 'add') {
        $('[name="idusers"]').val("");
        $('[name="user_fullname"]').val("");
        $('[name="user_name"]').val("");
        $('[name="user_email"]').val("");
        $('[name="user_type"]').val("");
        $('#modal_add .modal-title').html('Add New User')
        $('#email').prop('readonly', false);
        $('#username').prop('readonly', false);
        $('#access').show();
        $('#password').show();
        $('#btn-tambah').show();
        $('#btn-ubah').hide();
    } else {
        if (x == 1) {
            $('#access').hide();
        } else {
            $('#access').show();
        }
        $('#modal_add .modal-title').html('Edit User')
        $('#email').prop('readonly', true);
        $('#username').prop('readonly', true);
        $('#password').hide();
        $('#btn-tambah').hide();
        $('#btn-ubah').show();

        $.ajax({
            type: "POST",
            data: {
                id: x
            },
            url: '<?=base_url();?>user/view',
            dataType: 'json',
            success: function(data) {
                $('[name="idusers"]').val(data.idusers);
                $('[name="user_fullname"]').val(data.user_fullname);
                $('[name="user_name"]').val(data.user_name);
                $('[name="user_email"]').val(data.user_email);
                $('[name="user_type"]').val(data.user_type);
            }
        });
    }
}

function ubahuser() {
    var idusers = $('[name="idusers"]').val();
    var user_fullname = $('[name="user_fullname"]').val();
    var user_email = $('[name="user_email"]').val();
    var user_name = $('[name="user_name"]').val();
    var user_type = $('[name="user_type"]').val();
    $.ajax({
        type: "POST",
        data: {
            idusers: idusers,
            user_fullname: user_fullname,
            user_email: user_email,
            user_name: user_name,
            user_type: user_type
        },
        url: '<?=base_url();?>user/updateUser',
        success: function() {
            $('#modal_add').modal('hide');
            toastr.success("Update Successfully");
            setTimeout(() => {
                window.location =
                    "<?=site_url();?>user/alluser";
            }, 2500);
        }
    });
}

function ubah_password(x) {
    $.ajax({
        type: "POST",
        data: {
            id: x
        },
        url: '<?=base_url();?>user/view',
        dataType: 'json',
        success: function(data) {
            $('[name="idusers"]').val(data.idusers);
            // $('[name="user_password"]').val(data.user_password);
        }
    });
    if (x == 'ganti') {
        // var table = 'produk';
        // var id = $('[name="id"]').val();
        var action = '<?= base_url(); ?>user/changepassword';
        $('#form-ganti-password').attr('action', action).submit();
    }
}


$(function() {
    $('#block_all').click(function() {
        $('#modal_block').modal('show', {
            backdrop: 'static',
            keyboard: false
        });
        $('#blocked').click(function() {
            var block_check = $('.check:checked');
            if (block_check.length > 0) {
                var block_value = [];
                $(block_check).each(function() {
                    block_value.push($(this).val());
                });

                $.ajax({
                    type: 'post',
                    url: '<?=base_url();?>user/block',
                    data: {
                        id: block_value
                    },
                    success: function() {
                        $('#modal_block').modal('hide');
                        toastr.success("Block User Successfully");
                        setTimeout(() => {
                            window.location =
                                "<?=site_url();?>user/alluser";
                        }, 2500);
                    }
                })
            } else {
                $('#modal_block').modal('hide');
                toastr.warning("Please Select User To Blocked!");
            }
        })
    });
    $('#restore_all').click(function() {
        var restore_check = $('.check:checked');
        if (restore_check.length > 0) {
            var restore_value = [];
            $(restore_check).each(function() {
                restore_value.push($(this).val());
            });
            $.ajax({
                type: 'post',
                url: '<?=site_url();?>user/unblock',
                data: {
                    id: restore_value
                },
                success: function() {
                    toastr.success("Unblock User Successfully");
                    setTimeout(() => {
                        window.location =
                            "<?=site_url();?>user/alluser";
                    }, 2500);
                }
            })
        } else {
            toastr.warning("Please Select User To Unblocked !");
        }
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
        <!-- <a href="#" class="btn btn-sm btn-primary btn-flat" data-toggle="tooltip" data-placement="top" title="Delete"
			id="delete_all"><i class="fa fa-recycle"></i></a> -->
        <a href="#" class="btn btn-sm btn-primary btn-flat" data-toggle="tooltip" data-placement="top"
            title="Block User" id="block_all"><i class="fa fa-ban"></i></a>
        <a href="#" class="btn btn-sm btn-primary btn-flat" data-toggle="tooltip" data-placement="top"
            title="Unblock User" id="restore_all"><i class="fa fa-history"></i></a>
        <!-- <a href="<?=base_url('product/addproduct');?>" class="btn btn-sm btn-primary btn-flat" data-toggle="tooltip"
            data-placement="top" title="Export Excel"><i class="fa fa-file-excel-o"></i></a> -->
        <a href="<?=base_url('user/alluser');?>" class="btn btn-sm btn-primary btn-flat" data-toggle="tooltip"
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
                        <th width="5"><i class="fa fa-key"></i></th>
                        <th>FULLNAME</th>
                        <th>EMAIL</th>
                        <th>USERNAME</th>
                        <th>DATETIME</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
					$n=1; 
					foreach($alluser as $u): 
					?>
                    <tr <?php if($u['is_block']==1){ echo 'style="color:red;text-decoration:line-through;"';}?>>
                        <td><?=$n++.'.';?></td>
                        <td><input type="checkbox" class="check" name="check_id[]" value="<?=$u['idusers'];?>"></td>
                        <td><a href="#modal_add" data-toggle="modal" onclick="submit(<?=$u['idusers'];?>)"><i
                                    class="fa fa-edit"></i></a>
                        </td>
                        <td><a href="#ganti_password" data-toggle="modal"
                                onclick="ubah_password(<?=$u['idusers'];?>)"><i class="fa fa-key"></i></a>
                        </td>
                        <td><?=$u['user_fullname'];?></td>
                        <td><?=$u['user_email'];?></td>
                        <td><?=$u['user_name'];?></td>
                        <td><?=date('Y-m-d H:i:s',$u['create_at']);?></td>
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
            <form action="<?=base_url('user/addNewUser');?>" method="post" enctype="multipart/form-data">
                <div class="modal-header bg-blue">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Fullname <span style="color:red;">*</span></label>
                        <input type="hidden" class="form-control" name="idusers">
                        <input type="text" class="form-control" name="user_fullname" placeholder="Fullname" required>
                    </div>
                    <div class="form-group">
                        <label>Email <span style="color:red;">*</span></label>
                        <input type="email" class="form-control" name="user_email" id="email"
                            placeholder="Email addrees" required>
                    </div>
                    <div class="form-group">
                        <label>Username <span style="color:red;">*</span></label>
                        <input type="text" class="form-control" name="user_name" id="username" placeholder="Username"
                            required>
                    </div>
                    <div class="form-group" id="password">
                        <label>Password <span style="color:red;">*</span></label>
                        <input type="password" class="form-control" name="user_password" placeholder="Password"
                            required>
                    </div>
                    <div class="form-group" id="access">
                        <label>User Access <span style="color:red;">*</span></label>
                        <select name="user_type" class="form-control">
                            <option value="administrator">Administrator</option>
                            <option value="user">User</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-default btn-flat pull-left"
                        data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-sm btn-success btn-flat" id="btn-tambah">Add</button>
                    <button type="button" class="btn btn-sm btn-success btn-flat" id="btn-ubah"
                        onclick="ubahuser()">Edit</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal konfirmasi delete -->
<div class="modal fade" id="modal_block" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Konfirmasi</h4>
            </div>
            <div class="modal-body bg-red">
                <p>Anda yakin akan memblokir akun ini ? </p>
            </div>
            <div class="modal-footer">
                <button class="btn btn-sm btn-default btn-flat" data-dismiss="modal">Cancel</button>
                <button class="btn btn-sm btn-danger btn-flat" id="blocked">Yes, Block</button>
            </div>
        </div>
    </div>
</div>
