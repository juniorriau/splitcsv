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
        <h2 style="margin-top:0px">Data List</h2>
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
				<a href="<?php echo site_url('login/logout')?>" class="btn btn-warning">Log Out</a>
                <?php echo anchor(site_url('data/create'),'Import', 'class="btn btn-primary"'); ?>
				<a href="<?php echo site_url('data/empty')?>" class="btn btn-danger">Empty Data</a>
				<a href="<?php echo site_url('data/export')?>" class="btn btn-success">Export Data</a>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 8px" id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-1 text-right">
            </div>
            <div class="col-md-3 text-right">
                <form action="<?php echo site_url('data/index'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('data'); ?>" class="btn btn-default">Reset</a>
                                    <?php
                                }
                            ?>
                          <button class="btn btn-primary" type="submit">Search</button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
        <table class="table table-bordered" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>No</th>
		<th>Date</th>
		<th>Action</th>
            </tr><?php
            foreach ($data_data as $data)
            {
                ?>
                <tr>
			<td width="80px"><?php echo ++$start ?></td>
			<td><?php echo $data->no ?></td>
			<td><?php echo $data->date ?></td>
			<td style="text-align:center" width="200px">
				<?php 
				echo anchor(site_url('data/update/'.$data->id),'Update'); 
				echo ' | '; 
				echo anchor(site_url('data/delete/'.$data->id),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
				?>
			</td>
		</tr>
                <?php
            }
            ?>
        </table>
        <div class="row">
            <div class="col-md-6">
                <a href="#" class="btn btn-primary">Total Record : <?php echo $total_rows ?></a>
	    </div>
            <div class="col-md-6 text-right">
                <?php echo $pagination ?>
            </div>
        </div>
    </body>
</html>