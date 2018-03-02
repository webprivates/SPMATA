<div class="content-wrapper">
    
    <section class="content">
        <div class="box box-warning box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">INPUT DATA TBL_GEJALA</h3>
            </div>
            <form action="<?php echo $action; ?>" method="post">
            
<table class='table table-bordered>'        

	    <tr><td width='200'>Kode Gejala <?php echo form_error('kd_gejala') ?></td><td><input type="text" class="form-control" name="kd_gejala" id="kd_gejala" placeholder="Kd Gejala" value="<?php echo $kd_gejala; ?>" /></td></tr>
	    <tr><td width='200'>Nama Gejala <?php echo form_error('nm_gejala') ?></td><td><input type="text" class="form-control" name="nm_gejala" id="nm_gejala" placeholder="Nm Gejala" value="<?php echo $nm_gejala; ?>" /></td></tr>
	    <tr><td></td><td><input type="hidden" name="id_gejala" value="<?php echo $id_gejala; ?>" /> 
	    <button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> <?php echo $button ?></button> 
	    <a href="<?php echo site_url('gejala') ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Kembali</a></td></tr>
	</table></form>        </div>
</div>
</div>