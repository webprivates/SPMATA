<!doctype html>
<html>
    <head>
        <title>harviacode.com - codeigniter crud generator</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
        <style>
            body{
                padding: 15px;
            }
        </style>
    </head>
    <body>
        <h2 style="margin-top:0px">Tbl_penyakit Read</h2>
        <table class="table">
	    <tr><td>Kd Penyakit</td><td><?php echo $kd_penyakit; ?></td></tr>
	    <tr><td>Nm Penyakit</td><td><?php echo $nm_penyakit; ?></td></tr>
	    <tr><td>Definisi</td><td><?php echo $definisi; ?></td></tr>
	    <tr><td>Solusi</td><td><?php echo $solusi; ?></td></tr>
	    <tr><td>Foto</td><td><?php echo $foto; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('penyakit') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </body>
</html>