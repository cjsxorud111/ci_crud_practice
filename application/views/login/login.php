<div class="container">
	<?php echo form_open('members/login'); ?>
	<dl>
		<dt>email</dt>
		<dd>
			<input type="text" name="email" value="" />
		</dd>
	</dl>

	<dl>
		<dt>password</dt>
		<dd>
			<input type="text" name="password" value="" />
		</dd>
	</dl>
	<button type="submit">로그인</button>
	<?php form_close(); ?>
</div>
