<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	

	<link rel="stylesheet" href="<?php echo base_url(); ?>css/bootstrap.min.css" type="text/css" />
	<style>
    /* Remove the navbar's default margin-bottom and rounded borders */ 
    .navbar {
      margin-bottom: 0;
      border-radius: 0;
    }
    
    /* Set height of the grid so .sidenav can be 100% (adjust as needed) */
    .row.content {height: 450px}
    
    /* Set gray background color and 100% height */
    .sidenav {
      padding-top: 20px;
      background-color: #f1f1f1;
      height: 100%;
    }
    
    /* Set black background color, white text and some padding */
    footer {
      background-color: #555;
      color: white;
      padding: 15px;
    }
    
    /* On small screens, set height to 'auto' for sidenav and grid */
    @media screen and (max-width: 767px) {
      .sidenav {
        height: auto;
        padding: 15px;
      }
      .row.content {height:auto;} 
    }
	
  </style>
</head>
<body>

<!--
To whom it may concern:
currently, this screen does not have any kind of error throws, when, for example,
a text box is left unfilled. However, it most certainly would benefit from such
a thing, therefore, this needs to eventually be implemented, using either
JavaScript, or PHP, whichever strikes your fancy more.
-->

<form action= "/action_page.php"> <!--Needs an actual separate webpage for this-->
	<div id="nameEntry">
		Search by keywords:<br>
		<input type="text" name="keyword" value=""><br>
		Search by author:<br>
		<input type="text" name="author" value=""><br><br>
	</div>
	
	
	<div id="catType">
		Category:
		<select id="category">
		<option value="volvo">My favourite car</option>
		<option value="saab">Saab</option>
		<option value="opel">Opel</option>
		<option value="audi">Audi</option>
		</select>
		
		Type:
		<select id="category">
		<option value="volvo">Volvo</option>
		<option value="saab">Saab</option>
		<option value="opel">Opel</option>
		<option value="audi">length</option>
		</select>
		
	</div>
	
	<div>
		<head>
			<meta charset="utf-8">
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
			<link rel="stylesheet" href="/resources/demos/style.css">
			<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
			<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
			<script>
				$( function() {
				var dateFormat = "mm/dd/yy",
					from = $( "#from" )
						.datepicker({
						defaultDate: "-1d",
						maxDate: "+0d",
						changeMonth: true,
						numberOfMonths: 3
						})
						.on( "change", function() {
							to.datepicker( "option", "minDate", getDate( this ) );
						}),
					to = $( "#to" ).datepicker({
						defaultDate: "+0d",
						maxDate: "+0d",
						changeMonth: true,
						numberOfMonths: 3
					})
					.on( "change", function() {
						from.datepicker( "option", "maxDate", getDate( this ) );
					});
			 
				function getDate( element ) {
					var date;
					try {
						date = $.datepicker.parseDate( dateFormat, element.value );
					} catch( error ) {
						date = null;
					}
			 
				return date;
				}
				} );
			</script>
		</head>
		<body>
		 
		Filter by age:
		<label for="from">From </label>
		<input type="text" id="from" name="from">
		<label for="to">to</label>
		<input type="text" id="to" name="to">
		 
		 
		</body>
	</div>
	
	<div id="newOrOld">
		Search by time: 
		<input type="radio" name="pollAge" id="newer" value="1" checked="checked">
		<label for="newer">Newer first</label>
		<input type="radio" name="pollAge" id="older" value="2">
		<label for="older">Older first</label>
	</div>
	
	<div id="popularityFilter">
	Filter by popularity: 
	<input type="radio" name="pollPopularity" id="more" value="1" checked="checked">
	<label for="more">More popular first</label>
	<input type="radio" name="pollPopularity" id="less" value="2">
	<label for="less">Less popular first</label>
	</div>
	
	<div id="pollActivity">
	Poll activity:
	<input type="radio" name="pollActivity" id="active" value="1">
	<label for="active">Active</label>
	<input type="radio" name="pollActivity" id="closed" value="2">
	<label for="closed">Closed</label>
	<input type="radio" name="pollActivity" id="all" value="3" checked="checked">
	<label for="all">All</label>
	</div>
	
	
	<input type="submit" value="Search">
</form>

