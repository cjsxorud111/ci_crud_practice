<!DOCTYPE html>
<html lang="ko">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>메인</title>
	<style>
		.btn-group .dropdown-menu {
			min-width: 5px;
			left: 0;
            width: 60px;
            max-height: 120px; /* 드롭다운 메뉴의 최대 높이 설정 */
            overflow-y: auto; /* 내용이 넘치면 스크롤바 표시 */
		}
        .dropdown-item {
            position: relative;
            padding-left: 7px !important;
        }
        .btn.btn-danger.dropdown-toggle {
            border-top-left-radius: 0;
            border-bottom-left-radius: 0;
            background-color: #63b2e2;
            border-color: #63b2e2;
            width: 3.8rem;
            padding-left: 6px;
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
        
		.table-responsive {
			border: 1px solid #dee2e6;
			border-radius: 10px;
			background-color: #ffffff;
            overflow: hidden;
			box-shadow: 0 0 16px rgba(0, 0, 0, 0.1);
			z-index: 5;
			position: relative;
            padding: 1rem 2rem 1.5rem 0.1rem;
		}
        
        .fa.fa-times-circle.delete-button {
            color: #fe5231;
        }
        
        .form-control.cost{
			border-top-right-radius: 0;
			border-bottom-right-radius: 0;
		}

        .under-btn {
            position: relative;
            top: -17px;
            z-index: 10000;
        } 
        
		#add-button,
		input[type="submit"] {
            background-color: #225ec3;
            color: #ffffff;
            border: #225ec3;
			text-align: center;
            font-weight: bold;
            font-size: 1em;
		}

		#for-button-control {
			text-align: center;
            padding-bottom: 5rem;
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

        .shift-right {
            transform: translateX(0.3em);
            transition: transform 0.3s ease;
        }

        .table tbody tr:hover {
            position: relative;
            z-index: 1; /* 다른 요소들보다 높은 값으로 설정 */
        }

        .introduce2 {
            margin-bottom: 3em;
        }
        
    </style>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <script src="https://code.jquery.com/jquery-latest.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
</head>
<body>
    <div class="content">
		<?php include 'navbar.php'; ?>
        <div id="for-button-control">
            <div class="introduce1">
                <h3>여행 경비 자동 계산 플래너</h3>
            </div>
            <div class="introduce2">
                시간과 여행지를 결정하고 여행 경비를 계산하세요
            </div>
            <form id="plan-form" action="store" method="post">
                <div class="container" style="max-width: 1100px">
                    <div class="table-responsive">
                        <table class="table" id="plan-table-id">
                            <thead>
                                <tr>
                                    <th style="background-color: #ffffff; color: #000000;" width="3%"></th>
                                    <th style="background-color: #ffffff; color: #000000;" width="13.5%">일정 시작시간</th>
                                    <th style="background-color: #ffffff; color: #000000;" width="13.5%">일정 마무리시간</th>
                                    <th style="background-color: #ffffff; color: #000000;" width="40%">여행지, 교통편 등</th>
                                    <th style="background-color: #ffffff; color: #000000;" width="30%">여행 경비 및 통화</th>
                                </tr>
                            </thead>
                            <?php
                            for ($i = 0; $i < 5; $i++) {
                                echo "<tr>";
                                echo "<td><i class='fa fa-times-circle delete-button' style='display: none;'></i></td>";
                                echo "<td style='background-color: #ffffff; padding: 0.2rem 0.2rem;'><input type='time' class='form-control' name='start_time[]' value='00:00'/></td>";
                                echo "<td style='background-color: #ffffff; padding: 0.2rem 0.2rem;'><input type='time' class='form-control' name='end_time[]' value='00:00'/></td>";
                                echo "<td class='cost-input-group' style='background-color: #ffffff; padding: 0.2rem 0.2rem;'><input type='text' autocomplete='off' class='form-control destination-input' name='destination_name[]' value=''/></td>";
                                echo "<td style='background-color: #ffffff; padding: 0.2rem 0.2rem;'>";
                                echo "<div class='d-flex cost-input-group'>";
                                echo "<input type='text' class='form-control flex-grow-1 cost' autocomplete='off' name='travel_cost[]' value='0'/>";
                                echo "<div class='btn-group'>";
                                echo "<button type='button' class='btn btn-danger dropdown-toggle' data-bs-toggle='dropdown' aria-expanded='false'>KRW</button>";
                                echo "<ul class='dropdown-menu'>";
                                // 드롭다운 메뉴 항목
                                $currencies = ['KRW', 'JPY', 'AED', 'AUD', 'BRL', 'CAD', 'CHF', 'CNY', 'CZK', 'DKK', 'EGP', 'EUR', 'GBP', 'HKD', 'HUF', 'IDR', 'ILS', 'INR', 'ISK', 'JPY', 'KRW', 'KWD', 'MYR', 'MXN', 'NOK', 'NZD', 'PHP', 'PLN', 'QAR', 'RON', 'RUB', 'SAR', 'SEK', 'SGD', 'THB', 'TRY', 'TWD', 'UAH', 'USD', 'VND', 'ZAR'];
                                foreach ($currencies as $currency) {
                                    echo "<li><a class='dropdown-item' href='#'>$currency</a></li>";
                                }
                                echo "</ul>";
                                echo "</div>";
                                echo "<input type='hidden' name='currency[]' value='KRW'>";
                                echo "</div></td>";
                                echo "</tr>";
                            }
                            ?>
                        </table>
                    </div>
                </div>
            </form>
            <div class="under-btn">
                <button class="btn btn-primary" id="add-button">일정추가</button>
                <input type="submit" class="btn btn-primary calc-btn" value="예산계산" form="plan-form">
            </div>
        </div>
    </div>
	<?php include 'footer.php'; ?>
    <script>
    
        $(document).ready(function(){
    
            $('.dropdown').on('show.bs.dropdown', function() {
                $(this).closest('.table-responsive').css('overflow', 'hidden');
            });
    
            // 드롭다운이 닫히면 table-responsive의 스크롤을 다시 활성화
            $('.dropdown').on('hide.bs.dropdown', function() {
                $(this).closest('.table-responsive').css('overflow', 'auto');
            });
    
            $('table tbody').on('mouseenter', 'tr', function() {
                
                // tbody 내의 행에 마우스가 들어갔을 때
                var activeDropdown = $('table .dropdown-menu.show').closest('tr');
    
                // 현재 행이 활성화된 드롭다운 메뉴를 포함하는 행이 아니라면 드롭다운 닫기
                if (activeDropdown.length && activeDropdown.get(0) !== $(this).get(0)) {
                    activeDropdown.find('.dropdown-toggle').dropdown('toggle');
                }
                $(this).addClass('shift-right').find('.delete-button').css('display', 'block');
            }).on('mouseleave', 'tr', function() {
                // tbody 내의 행에서 마우스가 떠났을 때
                $(this).removeClass('shift-right').find('.delete-button').css('display', 'none');
            });
    
    
            $(".dropdown-menu li a").click(function(){
                $(this).parents('.btn-group').find('.btn').html($(this).text() + ' <span class="caret"></span>');
            });
    
            $(".delete-button").click(function(){
                $(this).closest("tr").remove();
            });
    
            $(document).on("submit", "#plan-form", function (e) {
                
                // 각 .flex-grow-1 클래스를 가진 input 태그에 대해 처리
                $(".flex-grow-1").each(function () {
                    // 현재 입력 값에서 쉼표를 제거하고 숫자만 추출
                    const inputValue = $(this).val().replace(/,/g, ''); // 쉼표 제거
    
                    // 추출된 값을 해당 input 태그에 다시 설정
                    $(this).val(inputValue);
                });
                
            });
            
            // 페이지 로드 시 쿠키에서 폼 데이터를 불러와서 폼에 채워넣는 로직을 추가할 수도 있습니다.
            if ($.cookie('planFormData')) {
                // 쿠키에서 폼 데이터를 가져옵니다.
                var savedFormData = $.cookie('planFormData');

                // 가져온 데이터를 사용하여 폼을 채웁니다. (이 부분은 폼 구조와 데이터 형식에 따라 달라질 수 있습니다.)
                // 이 예제에서는 간단히 콘솔에 저장된 폼 데이터를 출력만 합니다.
                console.log('Saved Form Data:', savedFormData);
            }
            
            $(document).on("keyup", ".destination-input", function () {
                $.ajax({
                    url: "/plan/search_ajax",
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
                }.bind(this))
                .fail(function (error) {
                    console.error(error);
                });
            });
            //test
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
                $newRow.append(' <td><i class="fa fa-times-circle delete-button"  style="display: none;"></i></td><td style="background-color: #ffffff; padding: 0.2rem 0.2rem;"><input type="time" class="form-control" name="start_time[]" value="00:00"/></td>');
                $newRow.append('<td style="background-color: #ffffff; padding: 0.2rem 0.2rem;"><input type="time" class="form-control"  name="end_time[]" value="00:00"/></td>');
                $newRow.append('<td style="background-color: #ffffff; padding: 0.2rem 0.2rem;"><div class="cost-input-group"><input type="text" autocomplete="off" class="form-control destination-input" name="destination_name[]" value=""/><div/></td>');
                $newRow.append('<td style="background-color: #ffffff; padding: 0.2rem 0.2rem;"><div class="d-flex cost-input-group">' +
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
                    '</div></td></tr>');
    
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
