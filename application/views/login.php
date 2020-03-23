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
        <h2 style="margin-top:0px;text-align:center">Login</h2>
        <div class="row" style="margin: 0 auto">
			<div class="col-md-4"></div>
			<div class="col-md-4">
				<form action="<?php echo $action; ?>" method="post">
					<div class="form-group">
						<label for="varchar">Username </label>
						<input type="text" class="form-control" name="username" id="username" placeholder="Username"/>
					</div>
					<div class="form-group">
						<label for="varchar">Password </label>
						<input type="password" class="form-control" name="password" id="password" placeholder="Password"/>
					</div>
					<button type="submit" class="btn btn-primary">Login</button> 
					<a href="<?php echo site_url() ?>" class="btn btn-default">Cancel</a>
				</form>
			</div>
			<div class="col-md-4"></div>
        </div>

    </body>
</html>