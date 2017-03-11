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
