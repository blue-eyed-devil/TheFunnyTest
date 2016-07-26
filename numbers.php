<?
class generateSequence{
	private $ceiling;

    public function __construct($ceiling){
        $this->ceiling = $ceiling;
    }
	
	public function allNumbers(){
		$numbers = array();
		for($i = 1; $i <= $this->ceiling; $i++){
			$numbers[] = $i;
		}
		return $numbers;
	}

	public function oddEvenNumbers($type){
		$numbers[$type] = array();
		foreach($this->allNumbers() AS $number){
			if ($number % 2 === 0) {
				$numbers['even'][] = $number;
			}else{
				$numbers['odd'][] = $number;
			}
		}
		return $numbers[$type];
	}

	public function replaceNumbers(){
		$numbers = array();
		foreach($this->allNumbers() AS $k => $v){
			if($v % 3 === 0 && $v % 5 === 0) {
				$numbers[$k] = "Z";
			}elseif($v % 3 === 0) {
				$numbers[$k] = "C";
			}elseif($v % 5 === 0){
				$numbers[$k] = "E";
			}else{
				$numbers[$k] = $v;
			}
		}
		return $numbers;
	}

	public function fibonacciNumbers(){
		$numbers = array();
		$lower = 0;
		$upper = 1;
		while($fib < $this->ceiling){
			$fib = $lower + $upper;
			$lower = $upper;
			$upper = $fib;
			if($upper <= $this->ceiling){
				$numbers[] = $upper;
			}
		}
		return $numbers;
	}

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="Igor Mizak">
	<link rel="icon" href="favicon.ico">
	<title>Number Sequences</title>

	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body>
	<div class="container">
		<div class="jumbotron" style="margin-top: 30px">
			<h1>Hello, world!</h1>
			<p>This is a random number sequences generator.</p>
			<p>Insert your value and choose what numbers sequence you want to generate.</p>
			<div class="row">
				<form role="form" method="get" action="" id="numberseq">
                	<input type="hidden" value="" name="seq" id="seq">
					<div class="form-group form-group-lg col-xs-12 col-sm-4">
						<input type="number" name="number" class="form-control" id="number">
					</div>
				</form>
			</div>
			<p>
				<div class="btn-group btn-group-justified" role="group" aria-label="...">
					<a class="getseq btn btn-primary btn-lg" href="" id="all" role="button">All Numbers</a>
					<a class="getseq btn btn-primary btn-lg" href="" id="even" role="button">Even Numbers</a>
					<a class="getseq btn btn-primary btn-lg" href="" id="odd" role="button">Odd Numbers</a>
					<a class="getseq btn btn-primary btn-lg" href="" id="replaced" role="button">Replaced Multiples</a>
					<a class="getseq btn btn-primary btn-lg" href="" id="fibonacci" role="button">Fibonacci Numbers</a>
				</div>
			</p>
		</div>
		<div id="result-wrap">
<?php
if(isset($_GET['number'])){
	
	if($_GET['number'] == ""){
		$error = "The input is empty.";
	}elseif(is_numeric($_GET['number'])){

		if($_GET['number'] > 0){

			if(floor($_GET['number']) == $_GET['number']){
				
				$sequence = new generateSequence($_GET['number']);
				if($_GET['seq'] == "all"){
					$result = $sequence->allNumbers();
				}elseif($_GET['seq'] == "even"){
					$result = $sequence->oddEvenNumbers('even');
				}elseif($_GET['seq'] == "odd"){
					$result = $sequence->oddEvenNumbers('odd');
				}elseif($_GET['seq'] == "replaced"){
					$result = $sequence->replaceNumbers();
				}elseif($_GET['seq'] == "fibonacci"){
					$result = $sequence->fibonacciNumbers();
				}else{
					$error = "Unknown number sentence.";
				}
				
			}else{
				
				$error = "Please use whole number instead of decimal.";
			}
			
		}else{
			
			$error = "Number must be greater than 0.";
			
		}
	}else{
		
		$error = "Your input is not a number.";
		
	}
}

if(isset($error) && $error != ""){
?>
			<div class="alert alert-danger" id="result">
				<?php echo $error ?>
			</div>
<?php
}elseif(isset($result)){
?>
			<div class="panel panel-default" id="result">
				<div class="panel-heading">Your requested sequence</div>
				<div class="panel-body">
<?php
	if(!empty($result)){
		echo implode(', ', $result);
	}else{
		echo "No results for your chosen number please try again";
	}
?>
				</div>
			</div>
<?php
}
?>
		</div>
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>	
	<script type="text/javascript">
	$(document).ready(function() {
		$(".getseq").on("click", function(e){
			e.preventDefault();
			$("#seq").val(this.id);
			var url = $(location).attr("href").split("?")[0]+"?"+$("#numberseq").serialize();
			$("#result-wrap").slideUp("slow").load(url + " #result").slideDown("slow");
		});
	});
	</script>
</body>
</html>
