<html>
<head>
    <title>Convert JSON file to Array using jQuery</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body>
    <p>Converting JSON file to an array and populating a SELECT dropdown list with the data using jQuery!</p>

    <select id="birds">
        <option value="">-- Select --</option>
    </select>
</body>
<script>
    var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
	  if (this.readyState == 4 && this.status == 200) {
		var myObj = JSON.parse(this.responseText);
		document.getElementById("demo").innerHTML = myObj.name;
	  }
	};
	xmlhttp.open("GET", "data.json", true);
	xmlhttp.send();
</script>
</html>