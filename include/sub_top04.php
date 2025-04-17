<div class="subTopBox01 subTopBg04">
	<div class="inner1200 txtCenter">
		<div class="fs50 fw9"><?php echo menu04 ?></div>
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
			<option value="<?php echo menu04_url ?>" selected="selected"><?php echo menu04 ?></option>
			<option value="<?php echo menu05_url ?>"><?php echo menu05 ?></option>
			<option value="<?php echo menu06_url ?>"><?php echo menu06 ?></option>
			<option value="<?php echo menu07_url ?>" ><?php echo menu07 ?></option>
			<option value="<?php echo menu08_url ?>"><?php echo menu08 ?></option>
		</select>	
		
		<select onchange="if(this.value) location.href=(this.value);">
		  	<option value="<?php echo menu04_url ?>" <?php if (($pagename == 'navigation-implant.php')) {?>selected="selected"<?php }  ?>><?php echo menu04 ?></option>
		</select>	
	</div>
</div>
<?php if (($pagename == 'navigation-implant.php')) {?>
<div class="inner1200">
	<div class="subTitiel01">
		<dl>Navigation Implant</dl>
		<dt><?php echo menu04 ?></dt>
		<dd>수술 전 모의 시뮬레이션으로 수술 과정을 파악이 가능한 임플란트 </dd>
	</div>
</div>
<?php }  ?>
