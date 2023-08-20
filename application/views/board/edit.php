글 수정 화면 입니다.
<form name="bfpm" action="/board/update/<?=$edit->idx;?>" method="post">
	<input type="hidden" name="_method" value="PUT" />
	<table board="1">
		<tr>
			<th>제목</th>
			<td>
				<input type="text" name="title" value="<?=$edit->title;?>"/>
			</td>
		</tr>
		<tr>
			<th>내용</th>
			<td>
				<textarea name="contents" rows="8"><?=$edit->contents;?></textarea>
			</td>
		</tr>
		<tr>
			<th colspan="2">
				<input type="submit" value="수정하기"/>
				<a href="/board">목록</a>
			</th>
		</tr>
	</table>
</form>

