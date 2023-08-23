<div class="container">
	<?php echo form_open('calculator/Calculator/calculate'); ?>
	<dl>
		<dt>input</dt>
		<dd>
			<input type="text" name="numbers" value="" />
		</dd>
	</dl>

	<button type="submit">계산하기</button>
	<?php form_close(); ?>
</div>
