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
	</style>
</head>
<body>

<a href="http://localhost:8080/trip_plan_controller/plan/main" class="logo">
	<img src="logo_image_path.png" alt="IMG">
	<div class="logo-text">예산계산여행플래너</div>
</a>


<form id="plan-form" action="store" method="post">
	<table id="plan-table">

		<tr>
			<th>1. 일정시작</th>
			<td>
				<input type="time" name="start_time[]" value=""/>
			</td>

			<th>일정마무리</th>
			<td>
				<input type="time" name="end_time[]" value=""/>
			</td>

			<th>일정</th>
			<td>
				<input type="text" name="destination_name[]" value=""/>
			</td>

			<th>경비</th>
			<td>
				<input type="text" name="travel_cost[]" value=""/>
			</td>
		</tr>
	</table>

	<input type="submit" value="예산계산"><br><br>
</form>
<button id="add-button">일정추가</button>
<script>
	document.addEventListener("DOMContentLoaded", function () {
		const planTable = document.getElementById("plan-table");
		const addButton = document.getElementById("add-button");

		let rowCount = 2; // 행의 개수를 추적하기 위한 변수

		addButton.addEventListener("click", function () {
			const newRow = planTable.insertRow(-1);
			newRow.classList.add("new-row"); // 새로운 행에 클래스 추가

			const cell0 = newRow.insertCell(0);
			cell0.textContent = rowCount; // 행 번호 추가

			const cell1 = newRow.insertCell(1);
			cell1.innerHTML = "<tr><th>. 일정시작시간</th>";

			const cell2 = newRow.insertCell(2);
			cell2.innerHTML = '<td><input type="time" name="start_time[]" value=""/></td>';

			const cell3 = newRow.insertCell(3);
			cell3.innerHTML = "<th>일정마무리시간</th>";

			const cell4 = newRow.insertCell(4);
			cell4.innerHTML = '<td><input type="time" name="end_time[]" value=""/></td>';

			const cell5 = newRow.insertCell(5);
			cell5.innerHTML = "<th>플랜</th>";

			const cell6 = newRow.insertCell(6);
			cell6.innerHTML = '<td><input type="text" name="destination_name[]" value=""/></td>';

			const cell7 = newRow.insertCell(7);
			cell7.innerHTML = "<th>경비</th>";

			const cell8 = newRow.insertCell(8);
			cell8.innerHTML = '<td><input type="text" name="travel_cost[]" value=""/></td></tr>';

			rowCount++;
		});
	});
</script>
</body>
</html>
