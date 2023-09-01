<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>스케쥴</title>
	<style>
		.logo {
			display: flex;
			align-items: center;
			padding: 10px;
		}

		.logo img {
			width: 40px;
			height: 40px;
			margin-right: 10px;
		}

		.logo-text {
			font-size: 24px;
			font-weight: bold;
		}
	</style>
</head>
<body>

<a href="http://localhost:8080/trip_plan_controller/plan/main" class="logo">
	<img src="logo_image_path.png" alt="IMG">
	<div class="logo-text">예산계산여행플래너</div>
</a>

<h2>Travel Data</h2>
<table>
	<thead>
	<tr>
		<th>Start Time</th>
		<th>End Time</th>
		<th>Destination Name</th>
		<th>Travel Cost</th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($datas as $data): ?>
		<tr>
			<td><?=$data['start_time']; ?></td>
			<td><?=$data['end_time']; ?></td>
			<td><?=$data['destination_name']; ?></td>
			<td><?=$data['travel_cost']; ?></td>
		</tr>
	<?php endforeach; ?>
	</tbody>
</table>

<h2>Total Travel Cost</h2>
<p><?php echo $total_travel_cost; ?></p>
</body>
</html>
