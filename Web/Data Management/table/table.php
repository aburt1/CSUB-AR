<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Table Editor</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
	<script src="//code.jquery.com/jquery-3.1.0.min.js"></script>
	<script src="//code.jquery.com/ui/1.12.0/jquery-ui.min.js"></script>
	<script src="//netdna.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js"></script>
	<script src="script/jquery.tabletojson.min.js"></script>
	<script src="script/FileSaver.min.js"></script>
	<script src="script/Blob.js"></script>
	<script src="script/MainScript.js"></script>
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css"/>
	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css"/>
	<link rel="stylesheet" href="style/style.css"/>
</head>
<body>
	<div class="container">
		<div class="d-flex justify-content-start">
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>#</th>
						<th>name</th>
						<th>latitude</th>
						<th>longitude</th>
						<th>description</th>
					</tr>
				</thead>
				<tbody>

				</tbody>
			</table>
		</div>
			<button type="button" id="serializeTable" class="btn btn-danger">Save Changes to Server</button>
			<button type="button" id="updateTable" class="btn btn-info" style="visibility:hidden">Update table from TextArea</button><br/><br/>
			
			<button type="button" id="loadJson" class="btn btn-warning">Reload Current Location Data</button>
			<textarea id="jsonTA" class="form-control" wrap="soft" rows="5" style="visibility:hidden"></textarea><br/>
		</div>

	</div>
	</body>
</html>
