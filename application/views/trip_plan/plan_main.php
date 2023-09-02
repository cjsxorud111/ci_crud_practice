<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>메인</title>
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

		img {
			width: 300px;
			height: 150px;
			object-fit: cover;
		}
	</style>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

</head>
<body>

<div class="logo">
	<a href="http://localhost:8080/trip_plan_controller/plan/main" style="display: flex; align-items: center;">
		<img src="https://res-3.cloudinary.com/jnto/image/upload/w_2064,h_1300,c_fill,f_auto,fl_lossy,q_auto/v1675339920/tokyo/Tokyo_s_id19_18" alt="IMG">
		<div class="logo-text">예산계산여행플래너</div>
	</a>
</div>
<form id="plan-form" action="store" method="post">
	<div class="container">
		<div class="table-responsive">
			<table class="table" id="plan-table-id">
				<thead>
				<tr>
					<th>일정 시작시간</th>
					<th>일정 마무리시간</th>
					<th>여행 목적지</th>
					<th>여행 경비</th>
				</tr>
				</thead>

				<tr>
					<td><input type="time" class="form-control" name="start_time[]" value="00:00"/></td>
					<td><input type="time" class="form-control" name="end_time[]" value="00:00"/></td>
					<td><input type="text" class="form-control" name="destination_name[]" value=""/></td>
					<td><input type="text" class="form-control" name="travel_cost[]" value="0"/></td>
					<td></td>
				</tr>

			</table>

		</div>
	</div>

</form>

<div style="width: 90%; text-align: right; margin-bottom: 10px;"">
	<button class="btn btn-primary" id="add-button">일정추가</button>
</div>
<div style="width: 90%; text-align: right;">
	<input type="submit" class="btn btn-primary" value="예산계산" form="plan-form">
</div>

<script>
	document.addEventListener("DOMContentLoaded", function () {
		const planTable = document.getElementById("plan-table-id");
		const addButton = document.getElementById("add-button");

		let rowCount = 2; // 행의 개수를 추적하기 위한 변수

		addButton.addEventListener("click", function () {
			const newRow = planTable.insertRow(-1);
			newRow.classList.add("new-row"); // 새로운 행에 클래스 추가

			/*const cell0 = newRow.insertCell(0);
			cell0.textContent = rowCount; // 행 번호 추가*/

			const cell0 = newRow.insertCell(0);
			cell0.innerHTML = '<td><input type="time" class="form-control" name="start_time[]" value="00:00"/></td>';

			const cell1 = newRow.insertCell(1);
			cell1.innerHTML = '<td><input type="time" class="form-control"  name="end_time[]" value="00:00"/></td>';

			const cell2 = newRow.insertCell(2);
			cell2.innerHTML = '<td><input type="text" class="form-control" name="destination_name[]" value=""/></td>';

			const cell3 = newRow.insertCell(3);
			cell3.innerHTML = '<td><input type="text" class="form-control" name="travel_cost[]" value="0"/></td></tr>';

			const cell4 = newRow.insertCell(4);
			cell4.innerHTML = '<td><button type="button" class="btn btn-danger delete-button">삭제</button></td>';

			rowCount++;

			// 삭제 버튼에 이벤트 리스너 추가
			cell4.querySelector('.delete-button').addEventListener('click', function() {
				planTable.deleteRow(newRow.rowIndex);
				rowCount--;
			});
		});
	});
</script>
</body>
</html>
