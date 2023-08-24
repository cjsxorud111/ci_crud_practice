회원리스트 화면
<table border="1">
	<tr>
		<th>email</th>
		<th>작성일</th>
		<th>관리</th>
	</tr>
	<?php
	foreach ($list as $ls) {
		?>
		<tr>
			<td><?=$ls->email;?></td>
			<td><?=$ls->regdate;?></td>
			<td>
				<a href="/members/show/<?=$ls->idx;?>">View</a>
				<a href="/members/edit/<?=$ls->idx;?>">Edit</a>
				<a href="/members/delete/<?=$ls->idx;?>">Delete</a>
			</td>
		</tr>

		<?php
	}
	?>
	<tr>
		<th colspan="3">
			<?=$pages;?>
		</th>
	</tr>

</table>

<a href="/members/join">회원가입</a>
