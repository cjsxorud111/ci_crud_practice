상세페이지 입니다.
<table border="1">
	<tr>
		<th>제목</th>
		<td><?= $view->title; ?></td>
	</tr>
	<tr>
		<th>작성일</th>
		<td><?= $view->regdate; ?></td>
	</tr>
	<tr>
		<th>내용</th>
		<td><?= $view->contents; ?></td>
	</tr>
	<tr>
		<th colspan="2">
			<a href="/board">목록</a>
		</th>
	</tr>
</table>
