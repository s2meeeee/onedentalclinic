<div class="subTopBox01 subTopBg03">
	<div class="inner1200 txtCenter">
		<div class="fs50 fw9"><?php echo menu03 ?></div>
		<div class="fs30">임플란트는 처음부터 원(ONE)치과</div>
	</div>
</div>
<div class="subMap">
	<div class="inner">
		<a href="/"><img src="/img/home.png"></a>
		<select onchange="if(this.value) location.href=(this.value);">
		  	<option value="<?php echo menu01_url ?>" ><?php echo menu01 ?></option>
			<option value="<?php echo menu02_url ?>"><?php echo menu02 ?></option>
			<option value="<?php echo menu03_url ?>" selected="selected"><?php echo menu03 ?></option>
			<option value="<?php echo menu04_url ?>"><?php echo menu04 ?></option>
			<option value="<?php echo menu05_url ?>"><?php echo menu05 ?></option>
			<option value="<?php echo menu06_url ?>"><?php echo menu06 ?></option>
			<option value="<?php echo menu07_url ?>" ><?php echo menu07 ?></option>
			<option value="<?php echo menu08_url ?>"><?php echo menu08 ?></option>
		</select>	
		
		<select onchange="if(this.value) location.href=(this.value);">
		  	<!--<option value="<?php echo menu0301_url ?>" <?php if (($pagename == 'laser-implant.php')) {?>selected="selected"<?php }  ?>><?php echo menu0301 ?></option>-->
			<option value="<?php echo menu0302_url ?>" <?php if (($pagename == 'ostem-implant.php')) {?>selected="selected"<?php }  ?>><?php echo menu0302 ?></option>
			<option value="<?php echo menu0303_url ?>" <?php if (($pagename == 'point-implant.php')) {?>selected="selected"<?php }  ?>><?php echo menu0303 ?></option>
			<option value="<?php echo menu0304_url ?>" <?php if (($pagename == 'point-implant2.php')) {?>selected="selected"<?php }  ?>><?php echo menu0304 ?></option>
		</select>	
	</div>
</div>
<?php if (($pagename == 'laser-implant.php')) {?>
<div class="inner1200">
	<div class="subTitiel01">
		<dl>Laser Implant</dl>
		<dt><?php echo menu0301 ?></dt>
		<dd>수술 후 출혈, 통증 등 후유증이 거의 없습니다</dd>
	</div>
</div>
<?php }  ?>

<?php if (($pagename == 'ostem-implant.php')) {?>
<div class="inner1200">
	<div class="subTitiel01">
		<dl>Implant Type</dl>
		<dt>오스템 임플란트 (SOI등급)</dt>
		<dd>치과의사가 직접 만든 임플란트, 대부분의 케이스에 사용 가능합니다.</dd>
	</div>
</div>
<?php }  ?>

<?php if (($pagename == 'point-implant.php')) {?>
<div class="inner1200">
	<div class="subTitiel01">
		<dl>Implant Type</dl>
		<dt>포인트 임플란트 (S.L.A등급)</dt>
		<dd>치과의사가 직접 만든 임플란트, 대부분의 케이스에 사용 가능합니다.</dd>
	</div>
</div>
<?php }  ?>

<?php if (($pagename == 'point-implant2.php')) {?>
<div class="inner1200">
	<div class="subTitiel01">
		<dl>Implant Type</dl>
		<dt>디오 임플란트 (VUV등급)</dt>
		<dd>치과의사가 직접 만든 임플란트, 대부분의 케이스에 사용 가능합니다.</dd>
	</div>
</div>
<?php }  ?>