<!DOCTYPE html>
<html lang="ko">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>메인</title>
	<style>
		.btn-group .dropdown-menu {
			min-width: auto;
			left: 0;
		}
        .btn.btn-danger.dropdown-toggle {
            border-top-left-radius: 0;
            border-bottom-left-radius: 0;
        }

		.logo {
			display: flex;
			align-items: center;
			padding: 10px;
			margin: 20px 0 60px 40px;
		}

		.logo img,
		img {
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

		.table {
			min-width: 800px;
			overflow: visible;
			z-index: 5;
			border-collapse: collapse;
			width: 100%;
            
		}
        
		.table th,
		.table td {
			white-space: nowrap;
			text-align: center;
			border: none;
            
		}

        .table td {
            /*border: 1px solid blue;*/
        }
        .table tr {
            /*border: 1px solid red;*/
        }

		.table-responsive {
			border: 1px solid #dee2e6;
			border-radius: 10px;
			padding: 10px;
			background-color: #8CBBBB;
			overflow: auto;
			box-shadow: 0 0 16px rgba(0, 0, 0, 0.1);
			z-index: 5;
			position: relative;
		}

        .form-control.cost{
			border-top-right-radius: 0;
			border-bottom-right-radius: 0;
		}

		#add-button,
		input[type="submit"] {
			z-index: 10;
			background-color: #007bff;
			color: #ffffff;
			border: none;
			text-align: center;
			top: 0;
		}

		#for-button-control {
			text-align: center;
		}

		#for-button-control .centered-content {
			display: inline-block;
			text-align: left;
		}

		.suggestion_box, .destination-input {
			box-sizing: border-box; /* padding과 border가 최종 너비/높이 계산에 포함되도록 합니다. */
		}

		.suggestion_box {
			z-index: 1000;  /* 값은 충분히 높게 설정하십시오 */
			position: absolute;  /* absolute positioning을 사용하여 위치를 제어합니다. */
			background-color: #fff;  /* 배경색을 설정 */
			border: 1px solid #ccc;
			max-height: 100px;
			overflow-y: auto;
			width: calc(100% - 2px);
		}

		.destination-input {
			width: 50%; /* 입력 필드의 너비를 100%로 설정합니다. */
		}
		.suggestion-item {
			padding: 5px 10px;
			cursor: pointer;
			border-bottom: 1px solid #eee;
		}

		.suggestion-item:hover {
			background-color: #f5f5f5;
		}
	</style>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-latest.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">PocketPlan</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
            <a class="nav-item nav-link active" href="#">Home <span class="sr-only">(current)</span></a>
            <a class="nav-item nav-link" href="#">Features</a>
            <a class="nav-item nav-link" href="#">Pricing</a>
            <a class="nav-item nav-link disabled" href="#">Disabled</a>
        </div>
    </div>
</nav> 
<div class="logo">
	<a href="http://localhost:8080/trip_plan_controller/plan/main" style="display: flex; align-items: center;">
		<div class="logo-text">포켓플랜</div>
	</a>
</div>
<div id="for-button-control">
<form id="plan-form" action="store" method="post">
	<div class="container">
		<div class="table-responsive">
			<table class="table" id="plan-table-id">
                <thead>
                    <tr>
                        <th style="background-color: #8CBBBB;" width="20%">일정 시작시간</th>
                        <th style="background-color: #8CBBBB;" width="20%">일정 마무리시간</th>
                        <th style="background-color: #8CBBBB;" width="30%">여행지, 교통편 등</th>
						<th style="background-color: #8CBBBB;" width="30%">여행 경비 및 통화</th> <!-- 열 이름을 변경하였습니다. -->
                    </tr>
                </thead>
				<tr>
					<td style="background-color: #8CBBBB; padding: 0.2rem 0.2rem;"><input type="time" class="form-control" name="start_time[]" value="00:00"/></td>
					<td style="background-color: #8CBBBB; padding: 0.2rem 0.2em;"><input type="time" class="form-control" name="end_time[]" value="00:00"/></td>
					<td class="cost-input-group" style="background-color: #8CBBBB; padding: 0.2rem 0.2rem;"><input type="text" autocomplete="off" class="form-control destination-input" name="destination_name[]" value=""/></td>
					<td style="background-color: #8CBBBB; padding: 0.2rem 0.2rem;">
						<div class="d-flex cost-input-group">
							<input type="text" class="form-control flex-grow-1 cost" autocomplete="off" name="travel_cost[]" value="0"/>
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
						</div>
					</td>
				</tr>
				<tr>
					<td style="background-color: #8CBBBB; padding: 0.2rem 0.2rem;"><input type="time" class="form-control" name="start_time[]" value="00:00"/></td>
					<td style="background-color: #8CBBBB; padding: 0.2rem 0.2em;"><input type="time" class="form-control" name="end_time[]" value="00:00"/></td>
					<td class="cost-input-group" style="background-color: #8CBBBB; padding: 0.2rem 0.2rem;"><input type="text" autocomplete="off" class="form-control destination-input" name="destination_name[]" value=""/></td>
					<td style="background-color: #8CBBBB; padding: 0.2rem 0.2rem;">
						<div class="d-flex cost-input-group">
							<input type="text" class="form-control flex-grow-1 cost" autocomplete="off" name="travel_cost[]" value="0"/>
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
						</div>
					</td>
				</tr>
				<tr>
					<td style="background-color: #8CBBBB; padding: 0.2rem 0.2rem;"><input type="time" class="form-control" name="start_time[]" value="00:00"/></td>
					<td style="background-color: #8CBBBB; padding: 0.2rem 0.2em;"><input type="time" class="form-control" name="end_time[]" value="00:00"/></td>
					<td class="cost-input-group" style="background-color: #8CBBBB; padding: 0.2rem 0.2rem;"><input type="text" autocomplete="off" class="form-control destination-input" name="destination_name[]" value=""/></td>
					<td style="background-color: #8CBBBB; padding: 0.2rem 0.2rem;">
						<div class="d-flex cost-input-group">
							<input type="text" class="form-control flex-grow-1 cost" autocomplete="off" name="travel_cost[]" value="0"/>
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
						</div>
					</td>
				</tr>
				<tr>
					<td style="background-color: #8CBBBB; padding: 0.2rem 0.2rem;"><input type="time" class="form-control" name="start_time[]" value="00:00"/></td>
					<td style="background-color: #8CBBBB; padding: 0.2rem 0.2em;"><input type="time" class="form-control" name="end_time[]" value="00:00"/></td>
					<td class="cost-input-group" style="background-color: #8CBBBB; padding: 0.2rem 0.2rem;"><input type="text" autocomplete="off" class="form-control destination-input" name="destination_name[]" value=""/></td>
					<td style="background-color: #8CBBBB; padding: 0.2rem 0.2rem;">
						<div class="d-flex cost-input-group">
							<input type="text" class="form-control flex-grow-1 cost" autocomplete="off" name="travel_cost[]" value="0"/>
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
						</div>
					</td>
				</tr>
				<tr>
                    <td style="background-color: #8CBBBB; padding: 0.2rem 0.2rem;"><input type="time" class="form-control" name="start_time[]" value="00:00"/></td>
                    <td style="background-color: #8CBBBB; padding: 0.2rem 0.2em;"><input type="time" class="form-control" name="end_time[]" value="00:00"/></td>
                    <td class="cost-input-group" style="background-color: #8CBBBB; padding: 0.2rem 0.2rem;"><input type="text" autocomplete="off" class="form-control destination-input" name="destination_name[]" value=""/></td>
                    <td style="background-color: #8CBBBB; padding: 0.2rem 0.2rem;">
						<div class="d-flex cost-input-group">
							<input type="text" class="form-control flex-grow-1 cost" autocomplete="off" name="travel_cost[]" value="0"/>
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
						</div>
					</td>
				</tr>
                <tr>
                    <td style="background-color: #8CBBBB; padding: 0.2rem 0.2rem;"><input type="time" class="form-control" name="start_time[]" value="00:00"/></td>
                    <td style="background-color: #8CBBBB; padding: 0.2rem 0.2em;"><input type="time" class="form-control" name="end_time[]" value="00:00"/></td>
                    <td class="cost-input-group" style="background-color: #8CBBBB; padding: 0.2rem 0.2rem;"><input type="text" autocomplete="off" class="form-control destination-input" name="destination_name[]" value=""/></td>
                    <td style="background-color: #8CBBBB; padding: 0.2rem 0.2rem;">
                        <div class="d-flex cost-input-group">
                            <input type="text" class="form-control flex-grow-1 cost" autocomplete="off" name="travel_cost[]" value="0"/>
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
                        </div>
                    </td>
                </tr>
                <tr>
                    <td style="background-color: #8CBBBB; padding: 0.2rem 0.2rem;"><input type="time" class="form-control" name="start_time[]" value="00:00"/></td>
                    <td style="background-color: #8CBBBB; padding: 0.2rem 0.2em;"><input type="time" class="form-control" name="end_time[]" value="00:00"/></td>
                    <td class="cost-input-group" style="background-color: #8CBBBB; padding: 0.2rem 0.2rem;"><input type="text" autocomplete="off" class="form-control destination-input" name="destination_name[]" value=""/></td>
                    <td style="background-color: #8CBBBB; padding: 0.2rem 0.2rem;">
                        <div class="d-flex cost-input-group">
                            <input type="text" class="form-control flex-grow-1 cost" autocomplete="off" name="travel_cost[]" value="0"/>
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
                        </div>
                    </td>
                </tr>
                <tr>
                    <td style="background-color: #8CBBBB; padding: 0.2rem 0.2rem;"><input type="time" class="form-control" name="start_time[]" value="00:00"/></td>
                    <td style="background-color: #8CBBBB; padding: 0.2rem 0.2em;"><input type="time" class="form-control" name="end_time[]" value="00:00"/></td>
                    <td class="cost-input-group" style="background-color: #8CBBBB; padding: 0.2rem 0.2rem;"><input type="text" autocomplete="off" class="form-control destination-input" name="destination_name[]" value=""/></td>
                    <td style="background-color: #8CBBBB; padding: 0.2rem 0.2rem;">
                        <div class="d-flex cost-input-group">
                            <input type="text" class="form-control flex-grow-1 cost" autocomplete="off" name="travel_cost[]" value="0"/>
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
                        </div>
                    </td>
                </tr>
			</table>
		</div>
	</div>
</form>
<button class="btn btn-primary" id="add-button">일정추가</button>
<input type="submit" class="btn btn-primary" value="예산계산" form="plan-form">
</div>
<script>

	$(document).ready(function(){
		$(".dropdown-menu li a").click(function(){
			$(this).parents('.btn-group').find('.btn').html($(this).text() + ' <span class="caret"></span>');
		});

		$(".delete-button").click(function(){
			$(this).closest("tr").remove();
		});

		$(document).on("submit", "#plan-form", function () {
			// 각 .flex-grow-1 클래스를 가진 input 태그에 대해 처리
			$(".flex-grow-1").each(function () {
				// 현재 입력 값에서 쉼표를 제거하고 숫자만 추출
				const inputValue = $(this).val().replace(/,/g, ''); // 쉼표 제거

				// 추출된 값을 해당 input 태그에 다시 설정
				$(this).val(inputValue);
			});
		});

		$(document).on("keyup", ".destination-input", function () {
			$.ajax({
				url: "/trip_plan_controller/plan/search_ajax",
				data: {keyword: $(this).val()},
				method: "GET"
			})
				.done(function (result) {
					let suggestionBox = $(this).next(".suggestion_box");
					let inputWidth = $(".destination-input").outerWidth();
					if (!suggestionBox.length) {
						$(this).after('<div class="suggestion_box"></div>');
						suggestionBox = $(this).next(".suggestion_box");
					}
					suggestionBox.html(result);
					$(".suggestion_box").css("width", inputWidth);
				}.bind(this));
		});

		$(document).on("mousedown", ".suggestion-item", function (event) {
			event.preventDefault();

			// 클릭한 제안된 단어를 가져와서 입력 필드에 설정합니다.
			const selectedWord = $(this).text();

			$(this).closest(".cost-input-group").find(".destination-input").val(selectedWord);

			// 단어 제안을 숨깁니다.
			$(this).closest(".suggestion_box").hide();
		});

		$(document).on("blur", ".destination-input", function () {
			$(this).next(".suggestion_box").hide();
		});

		$(document).on("focus", ".destination-input", function() {
			$(this).next(".suggestion_box").show();
		});

		$(document).on("mousedown", ".suggestion_box", function (event) {
			event.preventDefault();
		});

		// 세 자리마다 쉼표를 추가하는 함수
		function addCommas(number) {
			return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
		}

		$(document).on("input", ".flex-grow-1", function () {

			let inputValue = $(this).val();
			// 숫자 이외의 문자 및 특수 문자를 제거합니다.
			inputValue = inputValue.replace(/[^0-9]/g, "");

			if (inputValue.length > 0) {
				// 세 자리마다 쉼표를 추가합니다.
				const formattedValue = addCommas(inputValue);
				$(this).val(formattedValue);
			} else {
				// 숫자 이외의 입력이 있을 때
				const originalValue = $(this).data("original-value");
				if (originalValue !== undefined) {
					$(this).val(originalValue);
				} else {
					// 원본 값이 없는 경우에는 기본값으로 "0"을 설정합니다.
					$(this).val("");
				}
			}
		});
		$(document).on("keydown", ".flex-grow-1", function (e) {
			const key = e.key;

			// 입력에 필요한 키보드만 허용합니다.
			if (/^[0-9]$/.test(key) || ["Backspace", "ArrowLeft", "ArrowRight", "ArrowUp", "ArrowDown", "Space"].includes(key)) {
				// 허용되는 키보드 입력은 처리합니다.
				return;
			}
			e.preventDefault();
		});

		$(document).on("mousedown", function (event) {
			// 다른 곳을 클릭했을 때
			if (!$(event.target).is(".flex-grow-1")) {

				// 각 input 태그에 대해 처리
				$(".flex-grow-1").each(function () {
					const originalValue = $(this).data("original-value");
					if (originalValue !== undefined) {

						const trimmedValue = $(this).val().trim();
						if (trimmedValue === "" || trimmedValue === "0") {
							$(this).val(originalValue);
						}
					} else {
						if ($(this).val() === "") {
							$(this).val(0);
						}
					}
				});
			}
		});

		$(document).on("mousedown", ".flex-grow-1", function () {
			// 원본 값이 0인 경우에만 입력 값을 공백으로 설정

			const originalValue = $(this).val();
			if (originalValue === "0") {
				$(this).val("");
			}
		});

		let rowCount = 2; // 행의 개수를 추적하기 위한 변수

		function updateCurrencyValue($dropdownMenu, index) {

			$dropdownMenu.on("click", ".dropdown-item", function() {
				const selectedCurrency = $(this).text();
				$("input[name='currency[]']").eq(index).val(selectedCurrency);
			});
		}

		$(".dropdown-menu").each(function(index, dropdownMenu) {
			updateCurrencyValue($(dropdownMenu), index);
		});

		const $planTable = $("#plan-table-id");
		const $addButton = $("#add-button");

		$addButton.click(function() {
			const $newRow = $('<tr>').addClass('new-row');
			$newRow.append('<td style="background-color: #8CBBBB; padding: 0.2rem 0.2rem;"><input type="time" class="form-control" name="start_time[]" value="00:00"/></td>');
			$newRow.append('<td style="background-color: #8CBBBB; padding: 0.2rem 0.2rem;"><input type="time" class="form-control"  name="end_time[]" value="00:00"/></td>');
			$newRow.append('<td style="background-color: #8CBBBB; padding: 0.2rem 0.2rem;"><div class="cost-input-group"><input type="text" autocomplete="off" class="form-control destination-input" name="destination_name[]" value=""/><div/></td>');
			$newRow.append('<td style="background-color: #8CBBBB; padding: 0.2rem 0.2rem;"><div class="d-flex cost-input-group">' +
				'<input type="text" class="form-control flex-grow-1 cost" autocomplete="off" name="travel_cost[]" value="0"/><div class="btn-group">' +
				'<button type="button" class="btn btn-danger dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">KRW</button><ul class="dropdown-menu">' +
				'<li><a class="dropdown-item" href="#">KRW</a></li>' +
				'<li><a class="dropdown-item" href="#">JPY</a></li>' +
				'<li><a class="dropdown-item" href="#">AED</a></li>' +
				'<li><a class="dropdown-item" href="#">AUD</a></li>' +
				'<li><a class="dropdown-item" href="#">BRL</a></li>' +
				'<li><a class="dropdown-item" href="#">CAD</a></li>' +
				'<li><a class="dropdown-item" href="#">CHF</a></li>' +
				'<li><a class="dropdown-item" href="#">CNY</a></li>' +
				'<li><a class="dropdown-item" href="#">CZK</a></li>' +
				'<li><a class="dropdown-item" href="#">DKK</a></li>' +
				'<li><a class="dropdown-item" href="#">EGP</a></li>' +
				'<li><a class="dropdown-item" href="#">EUR</a></li>' +
				'<li><a class="dropdown-item" href="#">GBP</a></li>' +
				'<li><a class="dropdown-item" href="#">HKD</a></li>' +
				'<li><a class="dropdown-item" href="#">HUF</a></li>' +
				'<li><a class="dropdown-item" href="#">IDR</a></li>' +
				'<li><a class="dropdown-item" href="#">ILS</a></li>' +
				'<li><a class="dropdown-item" href="#">INR</a></li>' +
				'<li><a class="dropdown-item" href="#">ISK</a></li>' +
				'<li><a class="dropdown-item" href="#">JPY</a></li>' +
				'<li><a class="dropdown-item" href="#">KRW</a></li>' +
				'<li><a class="dropdown-item" href="#">KWD</a></li>' +
				'<li><a class="dropdown-item" href="#">MYR</a></li>' +
				'<li><a class="dropdown-item" href="#">MXN</a></li>' +
				'<li><a class="dropdown-item" href="#">NOK</a></li>' +
				'<li><a class="dropdown-item" href="#">NZD</a></li>' +
				'<li><a class="dropdown-item" href="#">PHP</a></li>' +
				'<li><a class="dropdown-item" href="#">PLN</a></li>' +
				'<li><a class="dropdown-item" href="#">QAR</a></li>' +
				'<li><a class="dropdown-item" href="#">RON</a></li>' +
				'<li><a class="dropdown-item" href="#">RUB</a></li>' +
				'<li><a class="dropdown-item" href="#">SAR</a></li>' +
				'<li><a class="dropdown-item" href="#">SEK</a></li>' +
				'<li><a class="dropdown-item" href="#">SGD</a></li>' +
				'<li><a class="dropdown-item" href="#">THB</a></li>' +
				'<li><a class="dropdown-item" href="#">TRY</a></li>' +
				'<li><a class="dropdown-item" href="#">TWD</a></li>' +
				'<li><a class="dropdown-item" href="#">UAH</a></li>' +
				'<li><a class="dropdown-item" href="#">USD</a></li>' +
				'<li><a class="dropdown-item" href="#">VND</a></li>' +
				'<li><a class="dropdown-item" href="#">ZAR</a></li>' +
				'</ul></div>' +
				'<input type="hidden" name="currency[]" value="KRW">' +
				'<button type="button" class="btn btn-danger delete-button" style="margin-left: 6px;">삭제</button></div></td></tr>');

			$newRow.find('.dropdown-menu').on('click', '.dropdown-item', function() {
				$(this).closest('.d-flex').find('.btn.dropdown-toggle').text($(this).text());
			});

			$newRow.find('.delete-button').click(function() {
				$(this).closest('tr').remove();
				rowCount--;
			});

			$planTable.append($newRow);
			rowCount++;

			$(".dropdown-menu").each(function(index, dropdownMenu) {
				updateCurrencyValue($(dropdownMenu), index);
			});
		});
	});
</script>
</body>
</html>
