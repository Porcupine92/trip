<?php include_once('include/include.php');?>
<!DOCTYPE html>
<html>
    <head>
        <title>Trip</title>
        <meta CHARSET="UTF-8"/>
		<link rel="stylesheet" href="main.css"/>
    </head>
    <body>
	<?php
		$dist=array();
		$dist2=array();
		$dist3=array();
		$sum=array();
		$sum2=array();
		$sum3=array();
		$sql="SELECT * FROM trips";
		$result=mysqli_query($conn,$sql);
		
		echo '<table class="table">';
			echo '<thead>';
				echo '<tr>';
					echo '<th>';
						echo 'Trip';
					echo '</th>';
					echo '<th>';
						echo 'Distance';
					echo '</th>';
					echo '<th>';
						echo 'Measure interval';
					echo '</th>';
					echo '<th>';
						echo 'avg speed';
					echo '</th>';
				echo '</tr>';
			echo '</thead>';
			echo '<tbody>';
				while($row=mysqli_fetch_array($result)){
					$sql1="SELECT distance FROM trip_measures WHERE trip_id=".$row['id']." ORDER BY id DESC LIMIT 0,1";
					$result1=mysqli_query($conn,$sql1);
					$row1=mysqli_fetch_array($result1);
						//trip_id=1
							$sql2="SELECT distance FROM trip_measures WHERE trip_id=1 ORDER BY id ASC";
							$result2=mysqli_query($conn,$sql2);
								while($row2=mysqli_fetch_array($result2)){
									$dist[]=$row2['distance'];
								}
							
							for($i=0;$i<=count($dist);$i++){
								$sum[]=$dist[($i+1)]-$dist[$i];
							}
							
						//trip_id=2
							$sql2="SELECT distance FROM trip_measures WHERE trip_id=2 ORDER BY id ASC";
							$result2=mysqli_query($conn,$sql2);
								while($row2=mysqli_fetch_array($result2)){
									$dist2[]=$row2['distance'];
								}
							for($i=0;$i<=count($dist2);$i++){
								$sum2[]=$dist2[($i+1)]-$dist2[$i];
							}
							
						//trip_id=3	
							$sql2="SELECT distance FROM trip_measures WHERE trip_id=3 ORDER BY id ASC";
							$result2=mysqli_query($conn,$sql2);
								while($row2=mysqli_fetch_array($result2)){
									$dist3[]=$row2['distance'];
								}
							for($i=0;$i<=count($dist3);$i++){
								$sum3[]=$dist3[($i+1)]-$dist3[$i];
							}
						
						sort($sum);
						$endarr[]=end($sum);
						
						sort($sum2);
						$end2arr[]=end($sum2);
						
						sort($sum3);
						$end3arr[]=end($sum3);
					
					$speed=floor((3600 * $endarr[(($row['id'])-1)])/$row['measure_interval']);
					
					if((count($dist))<=1){
						echo 'Samochód nie poruszał się. Maksymalna średnia prędkość na godzinę wynosi 0.';
					}else{
						echo '<tr>';
							echo '<td>';
								echo $row['name'];
							echo '</td>';
							echo '<td>';
								echo $row1['distance'];
							echo '</td>';
							echo '<td>';
								echo $row['measure_interval'];
							echo '</td>';
							echo '<td>';
								echo $speed;
							echo '</td>';
						echo '</tr>';
					}
				}
			echo '</tbody>';
		echo '</table>';

	?>
	</body>
</html>
