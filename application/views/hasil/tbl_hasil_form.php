<div class="content-wrapper">
    
    <section class="content">
        <div class="box box-warning box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">INPUT DATA TBL_HASIL</h3>
            </div>
            <form action="<?php echo $action; ?>" method="post">
            
<table class='table table-bordered>'        

	    <tr><td width='200'>Id Pengunjung <?php echo form_error('id_pengunjung') ?></td><td><input type="text" class="form-control" name="id_pengunjung" id="id_pengunjung" placeholder="Id Pengunjung" value="<?php echo $id_pengunjung; ?>" /></td></tr>
	    <tr><td width='200'>Kd Penyakit <?php echo form_error('kd_penyakit') ?></td><td><input type="text" class="form-control" name="kd_penyakit" id="kd_penyakit" placeholder="Kd Penyakit" value="<?php echo $kd_penyakit; ?>" /></td></tr>
	    <tr><td width='200'>Tanggal <?php echo form_error('tanggal') ?></td><td><input type="date" class="form-control" name="tanggal" id="tanggal" placeholder="Tanggal" value="<?php echo $tanggal; ?>" /></td></tr>
	    <tr><td></td><td><input type="hidden" name="id_hasil" value="<?php echo $id_hasil; ?>" /> 
	    <button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> <?php echo $button ?></button> 
	    <a href="<?php echo site_url('hasil') ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Kembali</a></td></tr>
	</table></form>        </div>
</div>
</div>