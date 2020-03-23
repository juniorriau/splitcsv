<!doctype html>
<html>
    <head>
        <title>harviacode.com - codeigniter crud generator</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"/>
        <style>
            body{
                padding: 15px;
            }
        </style>
    </head>
    <body>
        <h2 style="margin-top:0px">Data <?php echo $button ?></h2>
        <?php echo form_open_multipart($action); ?>
	    <div class="form-group">
            <label for="no">File CSV</label>
            <input type="file" name="file" id="file"/>
        </div>
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('data') ?>" class="btn btn-default">Cancel</a>
		<?php echo form_close(); ?>
    </body>
</html>