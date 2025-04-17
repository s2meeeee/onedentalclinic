<div class="subTopBox01">
	<div class="inner1200 txtCenter">
		<div class="fs50 fw9"><?php echo menu01 ?></div>
		<div class="fs30">임플란트는 처음부터 원(ONE)치과</div>
	</div>
</div>
<div class="subMap">
	<div class="inner">
		<a href="/"><img src="/img/home.png"></a>
		<select onchange="if(this.value) location.href=(this.value);">
		  	<option value="<?php echo menu01_url ?>"  selected="selected"><?php echo menu01 ?></option>
			<option value="<?php echo menu02_url ?>"><?php echo menu02 ?></option>
			<option value="<?php echo menu03_url ?>"><?php echo menu03 ?></option>
			<option value="<?php echo menu04_url ?>"><?php echo menu04 ?></option>
			<option value="<?php echo menu05_url ?>"><?php echo menu05 ?></option>
			<option value="<?php echo menu06_url ?>"><?php echo menu06 ?></option>
			<option value="<?php echo menu07_url ?>"><?php echo menu07 ?></option>
			<option value="<?php echo menu08_url ?>"><?php echo menu08 ?></option>
		</select>	
		
		<select onchange="if(this.value) location.href=(this.value);">
		  	<option value="<?php echo menu0101_url ?>" <?php if (($pagename == 'introduce.php')) {?>selected="selected"<?php }  ?>><?php echo menu0101 ?></option>
			<option value="<?php echo menu0102_url ?>" <?php if (($pagename == 'doctor.php')) {?>selected="selected"<?php }  ?>><?php echo menu0102 ?></option>
			<option value="<?php echo menu0103_url ?>" <?php if (($pagename == 'preview.php')) {?>selected="selected"<?php }  ?>><?php echo menu0103 ?></option>
			<option value="<?php echo menu0104_url ?>" <?php if (($pagename == 'medical-guide.php')) {?>selected="selected"<?php }  ?>><?php echo menu0104 ?></option>
			<option value="<?php echo menu0105_url ?>" <?php if (($pagename == 'location.php')) {?>selected="selected"<?php }  ?>><?php echo menu0105 ?></option>
		</select>	
	</div>
</div>
<?php if (($pagename == 'introduce.php')) {?>
<div class="inner1200">
	<div class="subTitiel01">
		<dl>ONE DENTAL CLINIC</dl>
		<dt><?php echo menu0101 ?></dt>
	</div>
</div>
<?php }  ?>

<?php if (($pagename == 'doctor.php')) {?>
<div class="inner1200">
	<div class="subTitiel01">
		<dl>ONE DENTAL CLINIC DOCTOR INTRODUCE</dl>
		<dt><?php echo menu0102?></dt>
		<dd>숙련된 의료진, 수준높은 치료를 추구합니다</dd>
	</div>
</div>
<?php }  ?>



<?php if (( $pagename == 'preview.php' || $pagename == 'preview2.php')) {?>
<div class="inner1200">
	<div class="subTitiel01">
		<dl>ONE DENTAL LOCATION</dl>
		<dt><?php echo menu0103 ?></dt>
		<dd>편안한 공간, 정확도높은 첨단진료로 여러분의 치아를 지켜드립니다</dd>
	</div>
</div>
<?php }  ?>


<?php if (($pagename == 'onelab.php')) {?>
<div class="inner1200">
	<div class="subTitiel01">
		<dl>ONE DENTAL Laboratory</dl>
		<dt><?php echo menu0104 ?></dt>
		<dd>원치과는 자체 ONE기공센터 운영으로 보철물 전문 제작을 하고 있습니다.</dd>
	</div>
</div>
<?php }  ?>


<?php if (( $pagename == 'medical-guide.php')) {?>
<div class="inner1200">
	<div class="subTitiel01">
		<dl>ONE DENTAL CLINIC MEDICAL INFORMATION</dl>
		<dt><?php echo menu0105 ?></dt>
		<dd>단순 치료를 넘어 정확함과 편안함까지! 더 빠르고 더 정확한 진료로 안내하겠습니다.</dd>
	</div>
</div>
<?php }  ?>


<?php if (($pagename == 'location.php')) {?>
<div class="inner1200">
	<div class="subTitiel01">
		<dl>ONE DENTAL LOCATION</dl>
		<dt><?php echo menu0106 ?></dt>
		<dd>당신의 자신있는 미소를 위하여 오로지 실력으로 말하는 원치과에 오신걸 환영합니다.   </dd>
	</div>
</div>
<?php }  ?>






