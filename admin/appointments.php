<!DOCTYPE html>
<html>
<head>
	<title>Doctor Appointments  | Dr.Thaj</title>
	<link rel="stylesheet" type="text/css" href="easycal.css">
	<style>
		body{ width: 960px; margin: 0 auto; font-size: 12px; font-family: Arial; box-sizing: border-box;}
	</style>
</head>
<body>

	<div class="mycal" style="width:100%;"></div>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/underscore.js/1.7.0/underscore-min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.8.4/moment.min.js"></script>
	<!--<script type="text/javascript" src="lib/jquery-1.11.1.min.js"></script>
	<script type="text/javascript" src="lib/underscore-1.7.0.min.js"></script>
	<script type="text/javascript" src="lib/moment-2.9.0.min.js"></script>-->
	<script type="text/javascript" src="dataset.js"></script>
	<script type="text/javascript" src="easycal.js"></script>

	<script>
		$('.mycal').easycal({
			startDate : '31-10-2014', // OR 31/10/2104
			timeFormat : 'HH:mm',
			columnDateFormat : 'dddd, DD MMM',
			minTime : '09:00:00',
			maxTime : '19:00:00',
			slotDuration : 30,
			timeGranularity : 15,
			
			dayClick : function(el, startTime){
				console.log('Slot selected: ' + startTime);
			},
			eventClick : function(eventId){
				console.log('Event was clicked with id: ' + eventId);
			},

			events : getEvents(),
			
			overlapColor : '#FF0',
			overlapTextColor : '#000',
			overlapTitle : 'Multiple'
		});


	</script>
</body>
</html>