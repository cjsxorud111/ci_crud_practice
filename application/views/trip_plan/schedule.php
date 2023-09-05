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
            margin-top: 20px;
            margin-left: 40px;
            margin-bottom: 40px;
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

        .center {
            text-align: center;
        }

        .container {
            margin-top: 20px;
        }

        /* 새로 추가한 스타일 */
        table.table td,
        table.table th {
            font-size: 16px;
        }

        p.center {
            font-size: 18px;
            margin-top: 20px; /* 여행계획과 총 경비 간격 조절 */
        }
    </style>
	<script src="https://code.jquery.com/jquery-latest.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
</head>
<body>

<div class="logo">
    <a href="http://localhost:8080/trip_plan_controller/plan/main" style="display: flex; align-items: center;">
        <img src="https://res-3.cloudinary.com/jnto/image/upload/w_2064,h_1300,c_fill,f_auto,fl_lossy,q_auto/v1675339920/tokyo/Tokyo_s_id19_18" alt="IMG">
        <div class="logo-text">예산계산여행플래너</div>
    </a>
</div>


<div class="container" id="content">
	<br>

	<h2 class="center" style="margin-top: 20px; margin-bottom: 10px;">여행계획</h2>
	<br>
	<div class="table-responsive" id="table-content">
		<table class="table table-bordered text-center">
			<thead>
			<tr>
				<th>시작시간</th>
				<th>끝시간</th>
				<th>여행지</th>
				<th>경비</th>
			</tr>
			</thead>
			<tbody>
			<?php foreach ($datas as $data): ?>
				<tr>
					<td><?=date('H:i', strtotime($data['start_time'])); ?></td>
					<td><?=date('H:i', strtotime($data['end_time'])); ?></td>
					<td><?=$data['destination_name']; ?></td>
					<td><?=$data['travel_cost']; ?></td>
				</tr>
			<?php endforeach; ?>
			</tbody>
		</table>
	</div>
	<h2 class="center" style="margin-top: 20px;">총 경비</h2>
	<p class="center" style="font-size: 20px;"><?php echo $total_travel_cost; ?> 원</p>
</div>

<button id="download" class="btn btn-primary" onclick="downloadPDF()" style="display: block; margin: auto;">저장하기</button>
<script>

	function downloadPDF() {
		var element = document.getElementById('content');
		html2canvas(element).then(function (canvas) {
			var imgData = canvas.toDataURL('image/png');
			var doc = new jspdf.jsPDF();
			var imgProps = doc.getImageProperties(imgData);
			var pdfWidth = doc.internal.pageSize.getWidth();
			var pdfHeight = (imgProps.height * pdfWidth) / imgProps.width;
			doc.addImage(imgData, 'PNG', 0, 0, pdfWidth, pdfHeight);
			doc.save('여행계획표.pdf');
		});
	}
</script>

</body>
</html>
