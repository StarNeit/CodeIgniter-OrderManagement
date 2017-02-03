
		<!-- Page Content -->
		<div class="page-content">
			<!-- Page Breadcrumb -->
			<div class="page-breadcrumbs">
				<ul class="breadcrumb">
					<li>
						<i class="fa fa-home"></i>
						<a href="#">Home</a>
					</li>
					<li class="active">Daily Operations</li>
				</ul>
			</div>
			<!-- /Page Breadcrumb -->
			<!-- Page Header -->
			<div class="page-header position-relative">
				<div class="header-title">
					<h1>
						Daily Operations
					</h1>
				</div>
			</div>
			<!-- /Page Header -->
			<!-- Page Body -->
			<div class="page-body">

				<div class="row">
					<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
						<div class="databox bg-white radius-bordered">
							<div class="databox-left bg-green">
								<div class="fa fa-dollar"></div>
							</div>
							<div class="databox-right">
								<span class="databox-number green">$1,111</span>
								<div class="databox-text darkgray">INCOME TODAY</div>
							</div>
						</div>
					</div>
					<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
						<div class="databox bg-white radius-bordered">
							<div class="databox-left bg-themesecondary">
								<div class="fa fa-calendar"></div>
							</div>
							<div class="databox-right">
								<span class="databox-number themesecondary">300</span>
								<div class="databox-text darkgray">CASES TODAY</div>
							</div>
						</div>
					</div>
					<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
						<div class="databox bg-white radius-bordered">
							<div class="databox-left bg-yellow">
								<div class="fa fa-child"></div>
							</div>
							<div class="databox-right">
								<span class="databox-number yellow">320</span>
								<div class="databox-text darkgray">CAREPROS TODAY</div>
							</div>
						</div>
					</div>
					<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
						<div class="databox bg-white radius-bordered">
							<div class="databox-left bg-themeprimary">
								<div class="databox-piechart">
									<div class="fa fa-check"></div>
								</div>
							</div>
							<div class="databox-right">
								<span class="databox-number themeprimary">102</span>
								<div class="databox-text darkgray">CASES COMPLETED</div>div>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-9">
						<div id="map-container"><div id="map"></div>
						</div>
					</div>
					<div class="col-lg-3">
						<div class="orders-container">
							<div class="orders-header">
								<h6>Map Toggles</h6>
							</div>
							<ul class="orders-list map-legend">
								<li class="order-item">
									<div class="row">
										<div class="col-lg-2">
											<div class="info fa fa-map-marker"></div>
										</div>
										<div class="col-lg-10">
											<span>Today's Case</span>
										</div>
									</div>
								</li>
								<li class="order-item top">
									<div class="row">
										<div class="col-lg-2">
											<div class="success fa fa-map-marker"></div>
										</div>
										<div class="col-lg-10">
											<span>Running Case</span>
										</div>
									</div>
								</li>
								<li class="order-item">
									<div class="row">
										<div class="col-lg-2">
											<div class="success fa fa-map-marker"></div>
										</div>
										<div class="col-lg-10">
											<span>Running Case</span>
										</div>
									</div>

								</li>
								<li class="order-item">
									<div class="row">
										<div class="col-lg-2">
											<div class="success fa fa-map-marker"></div>
										</div>
										<div class="col-lg-10">
											<span>Running Case</span>
										</div>
									</div>

								</li>
								<li class="order-item">
									<div class="row">
										<div class="col-lg-2">
											<div class="success fa fa-map-marker"></div>
										</div>
										<div class="col-lg-10">
											<span>Running Case</span>
										</div>
									</div>

								</li>
							</ul>
							<div class="orders-footer">
								<a class="show-all" href=""><i class="fa fa-angle-down"></i> Show All</a>
								<div class="help">
									<a href=""><i class="fa fa-question"></i></a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- /Page Body -->

		</div>
		<!-- /Page Content -->

<!--Basic Scripts-->
<script src="assets/admin/js/jquery-2.0.3.min.js"></script>
<script src="assets/admin/js/bootstrap.min.js"></script>
<script src="assets/admin/js/slimscroll/jquery.slimscroll.min.js"></script>

<!--Beyond Scripts-->
<script src="assets/admin/js/beyond.js"></script>

<!--Easy Pie Charts Needed Scripts-->


<script src="assets/admin/js/charts/easypiechart/jquery.easypiechart.js"></script>
<script src="assets/admin/js/charts/easypiechart/easypiechart-init.js"></script>

<script>
	var chartfirstcolor = "#57b5e3";
	var chartsecondcolor = "#f4b400";
	var chartthirdcolor = "#d73d32";
	var chartfourthcolor = "#8cc474";
	var chartfifthcolor = "#bc5679";
	var gridbordercolor = "#eee";

	var pieData = [
		{
			value: 30,
			color: chartfirstcolor
		},
		{
			value: 50,
			color: chartsecondcolor
		},
		{
			value: 100,
			color: chartfourthcolor
		}

	];

	InitiateEasyPieChart.init();
	//Pie Chart BandWidth
	var data = [
		{ data: [[1, 50]], color: '#11a9cc' },
		{ data: [[1, 80]], color: '#ffce55' },
		{ data: [[1, 30]], color: '#e75b8d' }
	];
	var placeholder = $("#pie-chart-bandwidth");
	placeholder.unbind();


</script>


<!--Google Analytics::Demo Only-->
<script>
	(function (i, s, o, g, r, a, m) {
		i['GoogleAnalyticsObject'] = r; i[r] = i[r] || function () {
				(i[r].q = i[r].q || []).push(arguments)
			}, i[r].l = 1 * new Date(); a = s.createElement(o),
			m = s.getElementsByTagName(o)[0]; a.async = 1; a.src = g; m.parentNode.insertBefore(a, m)
	})(window, document, 'script', 'http://www.google-analytics.com/analytics.js', 'ga');

	ga('create', 'UA-52103994-1', 'auto');
	ga('send', 'pageview');

</script>

<!--Google Map-->
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>
<script type="text/javascript">
	// When the window has finished loading create our google map below
	google.maps.event.addDomListener(window, 'load', init);

	function init() {
		// Basic options for a simple Google Map
		// For more options see: https://developers.google.com/maps/documentation/javascript/reference#MapOptions
		var mapOptions = {
			// How zoomed in you want the map to start at (always required)
			zoom: 11,

			// The latitude and longitude to center the map (always required)
			center: new google.maps.LatLng(1.296782, 103.852151), // Singapore

			// How you would like to style the map.
			// This is where you would paste any style found on Snazzy Maps.
			styles: [   {       "featureType":"landscape",      "stylers":[         {               "hue":"#FFBB00"         },          {               "saturation":43.400000000000006         },          {               "lightness":37.599999999999994          },          {               "gamma":1           }       ]   },  {       "featureType":"road.highway",       "stylers":[         {               "hue":"#FFC200"         },          {               "saturation":-61.8          },          {               "lightness":45.599999999999994          },          {               "gamma":1           }       ]   },  {       "featureType":"road.arterial",      "stylers":[         {               "hue":"#FF0300"         },          {               "saturation":-100           },          {               "lightness":51.19999999999999           },          {               "gamma":1           }       ]   },  {       "featureType":"road.local",     "stylers":[         {               "hue":"#FF0300"         },          {               "saturation":-100           },          {               "lightness":52          },          {               "gamma":1           }       ]   },  {       "featureType":"water",      "stylers":[         {               "hue":"#0078FF"         },          {               "saturation":-13.200000000000003            },          {               "lightness":2.4000000000000057          },          {               "gamma":1           }       ]   },  {       "featureType":"poi",        "stylers":[         {               "hue":"#00FF6A"         },          {               "saturation":-1.0989010989011234            },          {               "lightness":11.200000000000017          },          {               "gamma":1           }       ]   }]
		};

		// Get the HTML DOM element that will contain your map
		// We are using a div with id="map" seen below in the <body>
		var mapElement = document.getElementById('map');

		// Create the Google Map using our element and options defined above
		var map = new google.maps.Map(mapElement, mapOptions);

		// Let's also add a marker while we're at it
		var marker = new google.maps.Marker({
			position: new google.maps.LatLng(40.6700, -73.9400),
			map: map,
			title: 'Snazzy!'
		});
	}
</script>
