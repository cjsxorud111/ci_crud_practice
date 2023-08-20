게시판 리스트 입니다.
<table border="1">
	<tr>
		<th>제목</th>
		<th>작성일</th>
		<th>관리</th>
	</tr>
	<?php
	foreach ($list as $ls) {

	?>
	<tr>
		<td><?=$ls->title;?></td>
		<td><?=$ls->regdate;?></td>
		<td>
			<a href="/board/show/<?=$ls->idx;?>">View</a>
		</td>
	</tr>

	<?php
	}

	?>
</table>

<a href="/board/create">글쓰기</a>
