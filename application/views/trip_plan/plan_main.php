<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>메인</title>
	<style>
		table {
			min-width: 800px; /* adjust this value as needed */
		}
		table th, table td {
			white-space: nowrap;
		}

		.logo {
			display: flex;
			align-items: center;
			padding: 10px;
            margin-top: 20px;
            margin-left: 40px;
            margin-bottom: 60px;
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
        table th {
            text-align: center;
        }

        table td {
            text-align: center;
        }

        .table-responsive {
            overflow: visible;
        }

        .table {
            overflow: visible;
        }

        .table td, .table th {
            overflow: visible;
        }

        .table .btn-group {
            position: static;
        }

    </style>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-latest.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
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
                        <th width="20%">일정 시작시간</th>
                        <th width="20%">일정 마무리시간</th>
                        <th width="20%">여행지, 교통편 등</th>
                        <th width="25%">여행 경비(입장료, 교통비 등)</th>
                        <th width="15%"></th>
                    </tr>
                </thead>

				<tr>
					<td><input type="time" class="form-control" name="start_time[]" value="00:00"/></td>
					<td><input type="time" class="form-control" name="end_time[]" value="00:00"/></td>
					<td><input type="text" class="form-control" name="destination_name[]" value=""/></td>
                    <td><input type="text" class="form-control" name="travel_cost[]" value="0"/></td>
                    <td>
                        <div class="btn-group">
                            <button type="button" class="btn btn-danger dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">KRW</button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">KRW</a></li>
                                <li><a class="dropdown-item" href="#">JPY</a></li>
								<li><a class="dropdown-item" href="#">AED</a></li> <!-- UAE -->
								<li><a class="dropdown-item" href="#">AUD</a></li> <!-- Australia -->
								<li><a class="dropdown-item" href="#">BRL</a></li> <!-- Brazil -->
								<li><a class="dropdown-item" href="#">CAD</a></li> <!-- Canada -->
								<li><a class="dropdown-item" href="#">CHF</a></li> <!-- Switzerland -->
								<li><a class="dropdown-item" href="#">CNY</a></li> <!-- China -->
								<li><a class="dropdown-item" href="#">CZK</a></li> <!-- Czech Republic -->
								<li><a class="dropdown-item" href="#">DKK</a></li> <!-- Denmark -->
								<li><a class="dropdown-item" href="#">EGP</a></li> <!-- Egypt -->
								<li><a class="dropdown-item" href="#">EUR</a></li> <!-- Eurozone countries -->
								<li><a class="dropdown-item" href="#">GBP</a></li> <!-- United Kingdom -->
								<li><a class="dropdown-item" href="#">HKD</a></li> <!-- Hong Kong -->
								<li><a class="dropdown-item" href="#">HUF</a></li> <!-- Hungary -->
								<li><a class="dropdown-item" href="#">IDR</a></li> <!-- Indonesia -->
								<li><a class="dropdown-item" href="#">ILS</a></li> <!-- Israel -->
								<li><a class="dropdown-item" href="#">INR</a></li> <!-- India -->
								<li><a class="dropdown-item" href="#">ISK</a></li> <!-- Iceland -->
								<li><a class="dropdown-item" href="#">JPY</a></li> <!-- Japan -->
								<li><a class="dropdown-item" href="#">KRW</a></li> <!-- South Korea -->
								<li><a class="dropdown-item" href="#">KWD</a></li> <!-- Kuwait -->
								<li><a class="dropdown-item" href="#">MYR</a></li> <!-- Malaysia -->
								<li><a class="dropdown-item" href="#">MXN</a></li> <!-- Mexico -->
								<li><a class="dropdown-item" href="#">NOK</a></li> <!-- Norway -->
								<li><a class="dropdown-item" href="#">NZD</a></li> <!-- New Zealand -->
								<li><a class="dropdown-item" href="#">PHP</a></li> <!-- Philippines -->
								<li><a class="dropdown-item" href="#">PLN</a></li> <!-- Poland -->
								<li><a class="dropdown-item" href="#">QAR</a></li> <!-- Qatar -->
								<li><a class="dropdown-item" href="#">RON</a></li> <!-- Romania -->
								<li><a class="dropdown-item" href="#">RUB</a></li> <!-- Russia -->
								<li><a class="dropdown-item" href="#">SAR</a></li> <!-- Saudi Arabia -->
								<li><a class="dropdown-item" href="#">SEK</a></li> <!-- Sweden -->
								<li><a class="dropdown-item" href="#">SGD</a></li> <!-- Singapore -->
								<li><a class="dropdown-item" href="#">THB</a></li> <!-- Thailand -->
								<li><a class="dropdown-item" href="#">TRY</a></li> <!-- Turkey -->
								<li><a class="dropdown-item" href="#">TWD</a></li> <!-- Taiwan -->
								<li><a class="dropdown-item" href="#">UAH</a></li> <!-- Ukraine -->
								<li><a class="dropdown-item" href="#">USD</a></li> <!-- United States -->
								<li><a class="dropdown-item" href="#">VND</a></li> <!-- Vietnam -->
								<li><a class="dropdown-item" href="#">ZAR</a></li> <!-- South Africa -->

							</ul>
                        </div>
						<input type="hidden" name="currency[]" value="KRW">
                        <button type="button" class="btn btn-danger delete-button" style="margin-left: 6px;">삭제</button>
                    </td>
				</tr>

			</table>

		</div>
	</div>

</form>

<div style="width: 90%; text-align: center; margin-bottom: 10px;"">
	<button class="btn btn-primary" id="add-button">일정추가</button>
</div>
<div style="width: 90%; text-align: right;">
	<input type="submit" class="btn btn-primary" value="예산계산" form="plan-form">
</div>

<script>
    $(document).ready(function(){
        $(".dropdown-menu li a").click(function(){
            $(this).parents('.btn-group').find('.btn').html($(this).text() + ' <span class="caret"></span>');
        });
    });

    $(document).ready(function(){
        $(".delete-button").click(function(){
            $(this).closest("tr").remove();
        });
    });

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
            cell4.innerHTML = '<td>' +
                '<div class="btn-group">' +
                '<button type="button" class="btn btn-danger dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">KRW</button>' +
                '<ul class="dropdown-menu"><li>' +
                '<a class="dropdown-item" href="#">KRW</a></li><li><a class="dropdown-item" href="#">JPY</a></li></ul></div>' +
				'<input type="hidden" name="currency[]" value="KRW">' +
                '<button type="button" class="btn btn-danger delete-button" style="margin-left: 10px;">삭제</button></td>';

            cell4.querySelector('.dropdown-menu').addEventListener('click', function(event) {
                const clickedItem = event.target;
                if(clickedItem.classList.contains('dropdown-item')) {
                    cell4.querySelector('.btn').textContent = clickedItem.textContent;
                }
            });

            rowCount++;

			// 삭제 버튼에 이벤트 리스너 추가
			cell4.querySelector('.delete-button').addEventListener('click', function() {
				planTable.deleteRow(newRow.rowIndex);
				rowCount--;
			});

			document.querySelectorAll(".dropdown-menu").forEach(function (dropdownMenu, index) {
				dropdownMenu.addEventListener("click", function (event) {
					const clickedItem = event.target;
					if (clickedItem.classList.contains("dropdown-item")) {
						const selectedCurrency = clickedItem.textContent;
						document.querySelectorAll("input[name='currency[]']")[index].value = selectedCurrency;
					}
				});
			});
		});
	});
</script>
</body>
</html>
