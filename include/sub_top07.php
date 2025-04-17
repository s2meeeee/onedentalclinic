<div class="subTopBox01 subTopBg07">
	<div class="inner1200 txtCenter">
		<div class="fs50 fw9"><?php echo menu07 ?></div>
		<div class="fs30">임플란트는 처음부터 원(ONE)치과</div>
	</div>
</div>
<div class="subMap">
	<div class="inner">
		<a href="/"><img src="/img/home.png"></a>
		<select onchange="if(this.value) location.href=(this.value);">
		  	<option value="<?php echo menu01_url ?>" ><?php echo menu01 ?></option>
			<option value="<?php echo menu02_url ?>"><?php echo menu02 ?></option>
			<option value="<?php echo menu03_url ?>"><?php echo menu03 ?></option>
			<option value="<?php echo menu04_url ?>"><?php echo menu04 ?></option>
			<option value="<?php echo menu05_url ?>"><?php echo menu05 ?></option>
			<option value="<?php echo menu06_url ?>"><?php echo menu06 ?></option>
			<option value="<?php echo menu07_url ?>" selected="selected"><?php echo menu07 ?></option>
			<option value="<?php echo menu08_url ?>"><?php echo menu08 ?></option>
		</select>	
		
		<select onchange="if(this.value) location.href=(this.value);">
		  	<option value="<?php echo menu0701_url ?>" <?php if (($pagename == 'before-after.php'||  $pagename == 'before-after_view.php')) {?>selected="selected"<?php }  ?>><?php echo menu0701 ?></option>
			<option value="<?php echo menu0702_url ?>" <?php if (($pagename == 'review-video.php' ||  $pagename == 'review-video_view.php')) {?>selected="selected"<?php }  ?>><?php echo menu0702 ?></option>
			<option value="<?php echo menu0703_url ?>" <?php if (($pagename == 'with-star.php' ||  $pagename == 'with-star_view.php')) {?>selected="selected"<?php }  ?>><?php echo menu0703 ?></option>
			<option value="<?php echo menu0704_url ?>" <?php if (($pagename == 'notice.php'  ||  $pagename == 'notice_view.php')) {?>selected="selected"<?php }  ?>><?php echo menu0704 ?></option>
			<option value="<?php echo menu0705_url ?>" <?php if (($pagename == 'press.php'||  $pagename == 'press_view.php')) {?>selected="selected"<?php }  ?>><?php echo menu0705 ?></option>
		</select>	
	</div>
</div>
<?php if (($pagename == 'before-after.php'||  $pagename == 'before-after_view.php')) {?>
<div class="inner1200">
	<div class="subTitiel01">
		<dl>Community</dl>
		<dt><?php echo menu0701 ?></dt>
	</div>
</div>
<?php }  ?>

<?php if (( $pagename == 'review-video.php' ||  $pagename == 'review-video_view.php')) {?>
<div class="inner1200">
	<div class="subTitiel01">
		<dl>Community</dl>
		<dt><font style="color: #0158f3">오늘</font> 수술 전후 </dt>
		<dd>매일 매일 업데이트되는 원치과 생생한 수술 이야기</dd>
	</div>
</div>
<?php }  ?>


<?php if (( $pagename == 'with-star.php' ||  $pagename == 'with-star_view.php')) {?>
<div class="inner1200">
	<div class="subTitiel01">
		<dl>Community</dl>
		<dt><?php echo menu0703 ?></dt>
	</div>
</div>
<?php }  ?>


<?php if (($pagename == 'notice.php'  ||  $pagename == 'notice_view.php' )) {?>
<div class="inner1200">
	<div class="subTitiel01">
		<dl>One Notice</dl>
		<dt><?php echo menu0704 ?></dt>
	</div>
</div>
<?php }  ?>

<?php if (($pagename == 'press.php'||  $pagename == 'press_view.php')) {?>
<div class="inner1200">
	<div class="subTitiel01">
		<dl>One Press</dl>
		<dt><?php echo menu0705 ?></dt>
	</div>
</div>
<?php }  ?>