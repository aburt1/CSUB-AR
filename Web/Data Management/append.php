<?php  
 $message = '';  
 $error = '';  
 if(isset($_POST["submit"]))  
 {  
      if(empty($_POST["name"]))  
      {  
           $error = "<label class='text-danger'>Enter Name</label>";  
      }  
      else if(empty($_POST["latitude"]))  
      {  
           $error = "<label class='text-danger'>Enter Latitude</label>";  
      }
	  else if(empty($_POST["longitude"]))  
      {  
           $error = "<label class='text-danger'>Enter Longitude</label>";  
      } 
      else if(empty($_POST["description"]))  
      {  
           $error = "<label class='text-danger'>Enter Description</label>";  
      }  
      else  
      {  
           if(file_exists('data.json'))  
           {  
                $current_data = file_get_contents('data.json');  
                $array_data = json_decode($current_data, true);  
                $extra = array(  
                     'name'               =>     $_POST['name'],  
                     'latitude'          =>     $_POST["latitude"],
					 'longitude'          =>     $_POST["longitude"],
                     'description'     =>     $_POST["description"]
                );  
                $array_data[] = $extra;  
                $final_data = json_encode($array_data);  
                if(file_put_contents('data.json', $final_data . PHP_EOL))
                {  
                    $message = "<label class='text-success'>File Appended Successfully</p>";
                }  
           }  
           else  
           {  
                $error = 'JSON File not exits';  
           }
		   
      }  
 }
 ?>  
 <!DOCTYPE html>  
 <html>  
      <head>  
		    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
			<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
			<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
			<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
      </head>  
      <body>  
           <br />  
           <div class="container" style="width:500px;">  
                <h3 align="">Append Coordinates into JSON Database</h3><br />                 
                <form method="post">  
                     <?php   
                     if(isset($error))  
                     {  
                          echo $error;  
                     }  
                     ?>  
                     <br />  
                     <label>Name</label>  
                     <input type="text" name="name" class="form-control" /><br />  
                     <label>Latitude</label>  
                     <input type="text" name="latitude" id="latitude" class="form-control" /><br />  
					 <label>Longitude</label>  
                     <input type="text" name="longitude" id="longitude" class="form-control" /><br />  
                     <label>Description</label>  
                     <input type="text" name="description" class="form-control" /><br />
					 <input type="hidden" value="<?php echo $rand; ?>" name="randcheck" />
					 <input type ="button" name="getLocation" id="getLocation" class="btn btn-info" value="Get Location" onclick="getlocation()">
					 <input type="submit" name="submit" value="Append" class="btn btn-info" /><br />  
					 
					<script> 
						var variable1 = document.getElementById("getLocation"); 
						function getlocation(){ 
							navigator.geolocation.getCurrentPosition(showLoc); 
						} 
						function showLoc(pos){ 
							document.getElementById("latitude").value = pos.coords.latitude;
							document.getElementById("longitude").value = pos.coords.longitude;
						}
						document.getElementById("alarmmsg").innerHTML = 'Appended Successfully';

						setTimeout(function(){
							document.getElementById("alarmmsg").innerHTML = '';
						}, 3000);
						if ( window.history.replaceState ) {
							window.history.replaceState( null, null, window.location.href );
						}
					</script>
                     <?php
					 unset($_POST['submit']);
                     ?> 
                </form>  
           </div>  
           <br /> 
				<script>
						if ( window.history.replaceState ) {
							window.history.replaceState( null, null, window.location.href );
						}
				</script>
      </body>  
 </html>  