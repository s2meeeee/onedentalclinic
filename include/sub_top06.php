<div class="subTopBox01 subTopBg06">
	<div class="inner1200 txtCenter">
		<div class="fs50 fw9"><?php echo menu06 ?></div>
		<div class="fs30">심미치료도 처음부터 원(ONE)치과</div>
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
			<option value="<?php echo menu06_url ?>" selected="selected"><?php echo menu06 ?></option>
			<option value="<?php echo menu07_url ?>" ><?php echo menu07 ?></option>
			<option value="<?php echo menu08_url ?>"><?php echo menu08 ?></option>
		</select>	
		
		<select onchange="if(this.value) location.href=(this.value);">
		  	<option value="<?php echo menu0601_url ?>" <?php if (($pagename == 'full-bodied-laminate.php')) {?>selected="selected"<?php }  ?>><?php echo menu0601 ?></option>
			<option value="<?php echo menu0602_url ?>" <?php if (($pagename == 'all-ceramic.php')) {?>selected="selected"<?php }  ?>><?php echo menu0602 ?></option>
			<option value="<?php echo menu0603_url ?>" <?php if (($pagename == 'tooth-whitening.php')) {?>selected="selected"<?php }  ?>><?php echo menu0603 ?></option>
            <option value="<?php echo menu0604_url ?>" <?php if (($pagename == 'tooth-decay.php')) {?>selected="selected"<?php }  ?>><?php echo menu0604 ?></option>
			<!-- 치아교정추가 250417 -->
			<option value="<?php echo menu0605_url ?>" <?php if (($pagename == 'onebraces.php')) {?>selected="selected"<?php }  ?>><?php echo menu0605 ?></option>
			<option value="<?php echo menu0606_url ?>" <?php if (($pagename == 'oneqickbraces.php')) {?>selected="selected"<?php }  ?>><?php echo menu0606 ?></option>
		</select>	
	</div>
</div>
<?php if (($pagename == 'full-bodied-laminate.php')) {?>
<div class="inner1200">
	<div class="subTitiel01">
		<dl>Laminate</dl>
		<dt><?php echo menu0601 ?></dt>
		<dd>원치과에서는 미세 삭제량으로 단 하루만에 라미네이트 치료가 가능합니다.</dd>
	</div>
</div>
<?php }  ?>

<?php if (( $pagename == 'all-ceramic.php')) {?>
<div class="inner1200">
	<div class="subTitiel01">
		<dl>All Ceramic</dl>
		<dt><?php echo menu0602 ?></dt>
		<dd>색 없는 고르고 예쁜 치아 만들기 올세라믹으로 높은 강도와 자연스러움을 동시에 가질 수 있습니다.</dd>
	</div>
</div>
<?php }  ?>

<?php if (($pagename == 'tooth-whitening.php')) {?>
<div class="inner1200">
	<div class="subTitiel01">
		<dl>Dental Bleaching</dl>
		<dt><?php echo menu0603 ?></dt>
		<dd>안전한 치아미백으로 더욱 깨끗하고 청결한 이미지를 가질 수 있습니다.</dd>
	</div>
</div>
<?php }  ?>

<?php if (($pagename == 'tooth-decay.php')) {?>
<div class="inner1200">
	<div class="subTitiel01">
		<dl>Tooth Decay Treatment</dl>
		<dt><?php echo menu0604 ?></dt>
		<dd>충치치료, 초기 발견으로 치료하는 것이 중요합니다.</dd>
	</div>
</div>
<?php }  ?>
<!-- 치아교정추가 250417-->
<?php if (($pagename == 'onebraces.php')) {?>
<div class="inner1200">
	<div class="subTitiel01">
		<dl>Tooth Decay Treatment</dl>
		<dt><?php echo menu0605 ?></dt>
		<dd>기존 교정법들의 장점만을 압축한 ONE 교정</dd>
	</div>
</div>
<?php }  ?>

<?php if (($pagename == 'oneqickbraces.php')) {?>
<div class="inner1200">
	<div class="subTitiel01">
		<dl>Tooth Decay Treatment</dl>
		<dt><?php echo menu0606 ?></dt>
		<dd>치아 교정은 처음부터 원(ONE)치과</dd>
	</div>
</div>
<?php }  ?>
