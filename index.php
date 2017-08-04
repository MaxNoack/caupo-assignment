<?php
	require_once('controller.php');
?>

<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="styles.css">
	<title>Caupo Assignment</title>
</head>
<body>
	<div class="container">
		<h2>Edit store products</h2>
		<p><span class="error">* Required</span></p>
		<!-- <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
			<div class="form-group">
			<label for="agent_type">Name</label>
			</div>
			<div class="form-group">
				<input type="text" name="name" value="<?php echo $name; ?>"><span class="error"><?php echo $nameErr; ?></span><br><br>
			</div>
			Sku: <input type="text" name="sku" value="<?php echo $sku; ?>"><span class="error"><?php echo $skuErr; ?><br><br>
			Price: <input type="text" name="price" value="<?php echo $price; ?>"><span class="error"><?php echo $priceErr; ?><br><br>
			<input type="submit">
		</form> -->

<form>
  <div class="form-group" method="post">
    <label for="exampleInputEmail1"><span class="error">*</span> Name</label>
    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Name">
    <span class="error"><?php echo "baam!" ?></span>
    <small class="form-text text-muted">Full name of the product</small>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1"><span class="error">*</span> Sku</label>
    <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Sku">
    <small class="form-text text-muted">Sku code</small>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1"><span class="error">*</span> Price</label>
    <input type="number" class="form-control" id="exampleInputPassword1" placeholder="Price">
    <small class="form-text text-muted">Price with VAT included</small>
  </div>
  <button type="submit" class="btn btn-primary">Save</button>
  <button type="submit" class="btn btn-danger">Delete product</button>
</form>
	</div>
</body>
</html>
