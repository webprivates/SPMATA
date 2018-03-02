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
        <h2 style="margin-top:0px">Tbl_gejala Read</h2>
        <table class="table">
	    <tr><td>Kd Gejala</td><td><?php echo $kd_gejala; ?></td></tr>
	    <tr><td>Nm Gejala</td><td><?php echo $nm_gejala; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('gejala') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </body>
</html>