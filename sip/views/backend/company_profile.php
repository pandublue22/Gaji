<script>
function submit(x) {
    $('#modal_edit .modal-title').html('Edit Setting Value')
    // $('#image').hide();
    // $('#btn-tambah').hide();
    // $('#btn-ubah').show();

    $.ajax({
        type: "POST",
        data: {
            id: x
        },
        url: '<?=base_url();?>settings/view',
        dataType: 'json',
        success: function(data) {
            $('[name="id"]').val(data.id);
            $('[name="value"]').val(data.value);
        }
    });
}
</script>
<!-- Content Header -->
<section class="content-header">
    <h1>
        <?=$title;?>
    </h1>
    <ol class="breadcrumb">
        <a href="<?=base_url('settings');?>" class="btn btn-sm btn-primary btn-flat" data-toggle="tooltip"
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
                        <th width="5"><i class="fa fa-edit"></i></th>
                        <th>SETTING NAME</th>
                        <th>SETTING VALUE</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
					$n=1; 
					foreach(settings('company_profile',null) as $sg): 
					?>
                    <tr>
                        <td><?=$n++.'.';?></td>
                        <td><a href="#modal_edit" data-toggle="modal" onclick="submit(<?=$sg['id'];?>)"><i
                                    class="fa fa-edit"></i></a>
                        </td>
                        <td><?=$sg['description'];?></td>
                        <td><?php if($sg['value']!='' || $sg['value']!=null){echo $sg['value'];}else{echo $sg['default'];}?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</section>
<!-- Modal view produk -->
<div class="modal fade" id="modal_edit" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?=base_url('settings/editCompanyProfile');?>" method="post" enctype="multipart/form-data">
                <div class="modal-header bg-blue">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Setting Value <span style="color:red;">*</span></label>
                        <input type="hidden" class="form-control" name="id">
                        <input type="text" class="form-control" name="value" placeholder="Setting Value" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-default btn-flat pull-left"
                        data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-sm btn-success btn-flat" id="btn-tambah">Edit</button>
                </div>
            </form>
        </div>
    </div>
</div>
