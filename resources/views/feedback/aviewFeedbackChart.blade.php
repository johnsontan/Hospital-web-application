<!DOCTYPE HTML>
<html>
<head>
<link href="https://canvasjs.com/assets/css/jquery-ui.1.11.2.min.css" rel="stylesheet" />
<script>

 window.onload = function () {

// Construct options first and then pass it as a parameter
var options1 = {
	animationEnabled: true,
	title: {
		text: "Average rating of treatment"
	},
	data: [{
		type: "column", //change it to line, area, bar, pie, etc
		legendText: "Try Resizing with the handle to the bottom right",
		showInLegend: true,
		dataPoints: [
			@foreach ( session()->get('averageRating') as $rating)
			{ label: "{{$rating->treatmentTitle}}",y: {{$rating->averageRating}} },
			@endforeach
			]
		}]
};

var options2 = {
	animationEnabled: true,
	title: {
		text: "Total feedback per treatment"
	},
	data: [{
		type: "column", //change it to line, area, bar, pie, etc
		legendText: "Try Resizing with the handle to the bottom right",
		showInLegend: true,
		dataPoints: [
			@foreach ( session()->get('feedbackCount') as $count)
			{ label: "{{$count->treatmentTitle}}",y: {{$count->feedbackCount}} },
			@endforeach
			]
		}]
};
$("#resizable").resizable({
	create: function (event, ui) {
		//Create chart.
		$("#chartContainer1").CanvasJSChart(options1);
	},
	resize: function (event, ui) {
		//Update chart size according to its container size.
		$("#chartContainer1").CanvasJSChart().render();
	}
    
});
$("#resizable2").resizable({
	create: function (event, ui) {
		//Create chart.
		$("#chartContainer2").CanvasJSChart(options2);
	},
	resize: function (event, ui) {
		//Update chart size according to its container size.
		$("#chartContainer2").CanvasJSChart().render();
	}
    
});


}

</script>
</head>
<body>
	
	
	

	
<div id="resizable" style="height: 370px;border:1px solid gray; margin-bottom:30px;">
    
	<div id="chartContainer1" style="height: 100%; width: 100%;"></div>
</div>

<div id="resizable2" style="height: 370px;border:1px solid gray;  margin-bottom:30px;">
    
	<div id="chartContainer2" style="height: 100%; width: 100%;"></div>
</div>
<div class="d-flex justify-content-center">
	<a class="btn btn-primary btn-lg" href="{{ route('feedback.aview') }}" onclick="forgetSession()" role="button">
		Back to Dashboard
	</a>
</div>
<script src="https://canvasjs.com/assets/script/jquery-1.11.1.min.js"></script>
<script src="https://canvasjs.com/assets/script/jquery-ui.1.11.2.min.js"></script>
<script src="https://canvasjs.com/assets/script/jquery.canvasjs.min.js"></script>
<script>
function forgetSession()
{
	Session::forget('averageRating');
	Session::forget('feedbackCount');
}
</script>
</body>
</html>