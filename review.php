<!doctype html>
<html lang="en">
	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="./css/bootstrap.css">
		
		<title>Travello - Review <?php echo $_GET['guideName'];?></title>
	</head>
	<body style="text-align: center;">
    <?php
    include('header.php');
    ?>
		<div id="parent" class="container">
			<div id="reviewHeader" class="container">
				<h1>Review your guide <?php echo $_GET['guideName'];?>!</h1>
				<p>Picture Here</p>
			</div>
			<div id="reviewParent" class="container">
				<form>
					<div class="form-group">
						<h4>What did you like about <?php echo $_GET['guideName'];?>?</h4>
						<textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
					</div>
					<div class="form-group">
						<h4>What did you NOT like about <?php echo $_GET['guideName'];?>?</h4>
						<textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
					</div>
					<div class="form-group">
						<h4>Rate <?php echo $_GET['guideName'];?>:</h4>
						<div class="btn-group btn-group-toggle" data-toggle="buttons">
							<label class="btn btn-warning active">
								<input type="radio" name="options" id="option5" autocomplete="off" checked>5
							</label>
							<label class="btn btn-warning">
								<input type="radio" name="options" id="option4" autocomplete="off">4
							</label>
							<label class="btn btn-warning">
								<input type="radio" name="options" id="option3" autocomplete="off">3
							</label>
							<label class="btn btn-warning">
								<input type="radio" name="options" id="option2" autocomplete="off">2
							</label>
							<label class="btn btn-warning">
								<input type="radio" name="options" id="option1" autocomplete="off">1
							</label>
						</div>
					</div>
					<button type="submit" class="btn btn-success">Submit</button>
				</form>

			</div>
		</div>
    <?php include('footer.php') ?>
	</body>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="./js/bootstrap.bundle.js"></script>
</html>