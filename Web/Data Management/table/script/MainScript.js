var main = function () {
	// Build html for buttons, add and delete rows in a table
	// add button
	
	var buttonsInPopover = 
	$('<button>').append(
		$('<span>').addClass('glyphicon glyphicon-plus'))
	.attr({
		type: 'button',
		class: 'btn btn-success',
		id: 'addButton'
	});

	// delete button
	var buttonDelete =
	$('<button>').append(
		$('<span>').addClass('glyphicon glyphicon-remove'))
	.attr({
		type: 'button',
		class: 'btn btn-danger',
		id: 'removeButton'
	});
		
	// Merge button
	$.merge(buttonsInPopover,buttonDelete);

	// for popover Settings
	var settings = {
		html: true,
		trigger: "manual",
		content: buttonsInPopover,
		animation: false,
		container: "body"
	};
	// Function popover binds to the rows of the table, plus the lights 
	function updatePopover(){
		$(".table tr").popover(settings).on("mouseenter", function () {
			var _this = this;
			$(this).popover("show");
			$(this).addClass("activated");
			$(".popover").on("mouseleave", function () {
				$(_this).popover("hide");
				$(_this).removeClass("activated");
			});
		}).on("mouseleave", function () {
			var _this = this;	
			if (!$(".popover:hover").length) {
				$(_this).popover("hide");
				$(_this).removeClass("activated");
			}
	});
	}
	updatePopover();

	// Dragging rows in the table
    $('.table tbody').sortable({
    	start: function(event, ui){ $('.activated').popover("hide"); },
    	stop: renumberTable
    });

    // Auxiliary function for sorting line numbers
    function renumberTable() {
    	$(".table tbody tr").each(function() {
    		count = $(this).parent().children().index($(this)) + 1;
    		$(this).find('th').html(count);
    	});
    }

    // string table
    var newTableRow = $('<tr>').append($('<th>'),$('<td>'),$('<td>'),$('<td>'),$('<td>'));
    // Add a row
	$('body').on("click","#addButton", function(){
		// If the selected table header, add a line to the top
		if($('.table thead tr').hasClass('activated')){
			$('.table tbody').prepend($(newTableRow).clone());
			renumberTable();
			updatePopover();
		}
		// Otherwise, after the current line
		else {
			$('.table tbody tr.activated').after($(newTableRow).clone());
			renumberTable();
			updatePopover();
		}
	});

	// Delete a row
	$('body').on("click","#removeButton", function(){
		$(".table tbody tr").popover("hide").remove("tr.activated");
		renumberTable();
	});

	// Make the body editable spreadsheet 
	$('.table tbody').editable({
		type: 'text',
		mode: 'inline',
		selector: 'td',
		emptytext: '',
		toggle: 'dblclick'
		});

	// Translate table data in JSON format
	$('#serializeTable').click(function() {
		var serialized = $('.table').tableToJSON({
			ignoreColumns: [0]
		});
		$('#jsonTA').val(JSON.stringify(serialized));
		$('.alert').hide();
		
		var dataFromTA = JSON.parse($('#jsonTA').val());
			var newFile = new Blob([JSON.stringify(dataFromTA)], {type: "application/json;charset=utf-8"});
			
			var xhr = new XMLHttpRequest();
			var url = "save.php";
			xhr.open("POST", url, true);
			xhr.setRequestHeader("Content-Type", "application/json");
			xhr.onreadystatechange = function () {
				if (xhr.readyState === 4 && xhr.status === 200) {
					var json = JSON.parse(xhr.responseText);
					console.log(json.email + ", " + json.password);
				}
				};
			var data = JSON.stringify(dataFromTA);
			xhr.send(data);
	});

	 // Construct a table of data from a Textarea
	$('#updateTable').click(function() {
		try{
			// null value is replaced by a blank line
			var tableData = JSON.parse($('#jsonTA').val(), function(key, value){
				if(value == null)
					return "";
				else
					return value;
			});

			$('.table tbody').empty();
			for (var i = 0; i < tableData.length; i++) {
			$('.table tbody').append($('<tr>').append(
				$('<th>').html(i+1), $('<td>').html(tableData[i].name), $('<td>').html(tableData[i].latitude), $('<td>').html(tableData[i].longitude), $('<td>').html(tableData[i].description)));
		}
		updatePopover();
		$('.alert').hide();
	}
	catch(e){
		$('.alert').show();
	}
});

	$('button.close').click(function() {
		$('.alert').hide();
	});

	// Load the original table from the file
	$('#loadJson').click(function() {
		$.getJSON('../data/data.json', function(json, textStatus) { 
			$('#jsonTA').val(JSON.stringify(json));
			$('#updateTable').trigger('click');
		}).fail(function(){
			$('#jsonTA').val("Failed to load data from file!");
		}
		);
	});


	// Save the file
	$('#saveJson').click(function() {
		try{
			var dataFromTA = JSON.parse($('#jsonTA').val());
			var newFile = new Blob([JSON.stringify(dataFromTA)], {type: "application/json;charset=utf-8"});
			
			var xhr = new XMLHttpRequest();
			var url = "save.php";
			xhr.open("POST", url, true);
			xhr.setRequestHeader("Content-Type", "application/json");
			xhr.onreadystatechange = function () {
				if (xhr.readyState === 4 && xhr.status === 200) {
					var json = JSON.parse(xhr.responseText);
					console.log(json.email + ", " + json.password);
				}
				};
			var data = JSON.stringify(dataFromTA);
			xhr.send(data);
		}
		catch(e){
			$('.alert').show();
		}
	});

	// Load the original table
	$('#loadJson').trigger('click');
}

$(document).ready(main);