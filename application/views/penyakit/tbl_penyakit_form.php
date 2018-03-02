<div class="content-wrapper">
    
    <section class="content">
        <div class="box box-warning box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">INPUT DATA TBL_PENYAKIT</h3>
            </div>
            <form action="<?php echo $action; ?>" method="post">
            
<table class='table table-bordered>'        

	    <tr><td width='200'>Kode Penyakit <?php echo form_error('kd_penyakit') ?></td><td><input type="text" class="form-control" name="kd_penyakit" id="kd_penyakit" placeholder="Kd Penyakit" value="<?php echo $kd_penyakit; ?>" /></td></tr>
	    <tr><td width='200'>Nama Penyakit <?php echo form_error('nm_penyakit') ?></td><td><input type="text" class="form-control" name="nm_penyakit" id="nm_penyakit" placeholder="Nm Penyakit" value="<?php echo $nm_penyakit; ?>" /></td></tr>
	  
	    <tr><td width='200'>Foto <?php echo form_error('foto') ?></td><td><input type="text" class="form-control" name="foto" id="foto" placeholder="Foto" value="<?php echo $foto; ?>" /></td></tr>
	    <tr><td></td><td><input type="hidden" name="id_penyakit" value="<?php echo $id_penyakit; ?>" /> 
	    <button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> <?php echo $button ?></button> 
	    <a href="<?php echo site_url('penyakit') ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Kembali</a></td></tr>
	</table></form>        </div>
</div>
</div>