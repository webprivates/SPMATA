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
        <h2 style="margin-top:0px">Tbl_hasil Read</h2>
        <table class="table">
	    <tr><td>Id Pengunjung</td><td><?php echo $id_pengunjung; ?></td></tr>
	    <tr><td>Kd Penyakit</td><td><?php echo $kd_penyakit; ?></td></tr>
	    <tr><td>Tanggal</td><td><?php echo $tanggal; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('hasil') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </body>
</html>