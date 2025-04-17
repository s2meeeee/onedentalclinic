<div class="subTopBox01 subTopBg05">
	<div class="inner1200 txtCenter">
		<div class="fs50 fw9"><?php echo menu05 ?></div>
		<div class="fs30">임플란트는 처음부터 원(ONE)치과 </div>
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
			<option value="<?php echo menu05_url ?>" selected="selected"><?php echo menu05 ?></option>
			<option value="<?php echo menu06_url ?>"><?php echo menu06 ?></option>
			<option value="<?php echo menu07_url ?>" ><?php echo menu07 ?></option>
			<option value="<?php echo menu08_url ?>"><?php echo menu08 ?></option>
		</select>	
		
		<select onchange="if(this.value) location.href=(this.value);">
		  	<option value="<?php echo menu0501_url ?>" <?php if (($pagename == 'w-surgery.php')) {?>selected="selected"<?php }  ?>><?php echo menu0501 ?></option>
			<option value="<?php echo menu0502_url ?>" <?php if (($pagename == 'w-scaling.php')) {?>selected="selected"<?php }  ?>><?php echo menu0502 ?></option>
		</select>	
	</div>
</div>
<?php if (($pagename == 'w-surgery.php')) {?>
<div class="inner1200">
	<div class="subTitiel01">
		<dl>WaterLaser Dentistry</dl>
		<dt><?php echo menu0501 ?></dt>
		<dd>통증과 부담은 줄이고 섬세함과 편안함은 높이는 원데이 물방울레이저 치료</dd>
	</div>
</div>
<?php }  ?>

<?php if (( $pagename == 'w-scaling.php')) {?>
<div class="inner1200">
	<div class="subTitiel01">
		<dl>WaterLaser Scaling</dl>
		<dt><?php echo menu0502 ?></dt>
		<dd>통증과 부담은 줄이고 섬세함과 편안함은 높이는 원데이 물방울레이저 스케일링 치료</dd>
	</div>
</div>
<?php }  ?>

