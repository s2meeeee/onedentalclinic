<div class="subTopBox01 subTopBg02">
	<div class="inner1200 txtCenter">
		<div class="fs50 fw9"><?php echo menu02 ?></div>
		<div class="fs30">임플란트는 처음부터 원(ONE)치과</div>
	</div>
</div>
<div class="subMap">
	<div class="inner">
		<a href="/"><img src="/img/home.png"></a>
		<select onchange="if(this.value) location.href=(this.value);">
		  	<option value="<?php echo menu01_url ?>" ><?php echo menu01 ?></option>
			<option value="<?php echo menu02_url ?>" selected="selected"><?php echo menu02 ?></option>
			<option value="<?php echo menu03_url ?>"><?php echo menu03 ?></option>
			<option value="<?php echo menu04_url ?>"><?php echo menu04 ?></option>
			<option value="<?php echo menu05_url ?>"><?php echo menu05 ?></option>
			<option value="<?php echo menu06_url ?>"><?php echo menu06 ?></option>
			<option value="<?php echo menu07_url ?>"><?php echo menu07 ?></option>
			<option value="<?php echo menu08_url ?>"><?php echo menu08 ?></option>
		</select>	
		
		<select onchange="if(this.value) location.href=(this.value);">
		  	<!--<option value="<?php echo menu0206_url ?>" <?php if (($pagename == 'medical.php')) {?>selected="selected"<?php }  ?>><?php echo menu0206 ?></option>
			<option value="<?php echo menu0207_url ?>" <?php if (($pagename == 'staff.php')) {?>selected="selected"<?php }  ?>><?php echo menu0207 ?></option>
			<option value="<?php echo menu0208_url ?>" <?php if (($pagename == 'management.php')) {?>selected="selected"<?php }  ?>><?php echo menu0208 ?></option>-->
            <option value="<?php echo menu0200_url ?>" <?php if (($pagename == 'one-system.php')) {?>selected="selected"<?php }  ?>><?php echo menu0200 ?></option>         <!--추가-->
			<option value="<?php echo menu0201_url ?>" <?php if (($pagename == 'one-system.php')) {?>selected="selected"<?php }  ?>><?php echo menu0201 ?></option>
			<option value="<?php echo menu0202_url ?>" <?php if (($pagename == 'grafting-implant.php')) {?>selected="selected"<?php }  ?>><?php echo menu0202 ?></option>
			<option value="<?php echo menu0203_url ?>" <?php if (($pagename == 'sleep-implant.php')) {?>selected="selected"<?php }  ?>><?php echo menu0203 ?></option>
			<option value="<?php echo menu0204_url ?>" <?php if (($pagename == 'maxillary-colostomy.php')) {?>selected="selected"<?php }  ?>><?php echo menu0204 ?></option>
			<option value="<?php echo menu0205_url ?>" <?php if (($pagename == 'Implant-dentures.php')) {?>selected="selected"<?php }  ?>><?php echo menu0205 ?></option>
		</select>	
	</div>
</div>



<?php if (($pagename == 'onecare.php')) {?>
<div class="inner1200">
	<div class="subTitiel01">
		<dl>ONE care Implant</dl>
		<dt><?php echo menu0200 ?></dt>
		<dd>단 한분만을 위한 전담 주치의들이 완성하는 임플란트 </dd>
	</div>
</div>
<?php }  ?> <!--추가-->




<?php if (($pagename == 'one-system.php')) {?>
<div class="inner1200">
	<div class="subTitiel01">
		<dl>ONE.ONE Sytem</dl>
		<dt><?php echo menu0201 ?></dt>
		<dd>단 한분만을 위한 전담 주치의들이 완성하는 임플란트  </dd>
	</div>
</div>
<?php }  ?>



<?php if (( $pagename == 'grafting-implant.php')) {?>
<div class="inner1200">
	<div class="subTitiel01">
		<dl>Bone graft Implant</dl>
		<dt><?php echo menu0202 ?></dt>
		<dd>경험이 풍부한 의료진이 검증된 재료를 사용하여 시술합니다. </dd>
	</div>
</div>
<?php }  ?>


<?php if (($pagename == 'sleep-implant.php')) {?>
<div class="inner1200">
	<div class="subTitiel01">
		<dl>Sleep Implant</dl>
		<dt><?php echo menu0203 ?></dt>
		<dd>임플란트, 치과 공포증 이제 문제없습니다. </dd>
	</div>
</div>
<?php }  ?>


<?php if (($pagename == 'maxillary-colostomy.php')) {?>
<div class="inner1200">
	<div class="subTitiel01">
		<dl>Maxillary sinus Implant</dl>
		<dt><?php echo menu0204 ?></dt>
		<dd>임플란트 식립을 위한 공간을 확보하는 수술입니다.  </dd>
	</div>
</div>
<?php }  ?>

<?php if (( $pagename == 'Implant-dentures.php')) {?>
<div class="inner1200">
	<div class="subTitiel01">
		<dl>Implant Denture</dl>
		<dt><?php echo menu0205 ?></dt>
		<dd>경험이 풍부한 의료진이 검증된 재료를 사용하여 시술합니다. </dd>
	</div>
</div>
<?php }  ?>

<?php if (($pagename == 'medical.php')) {?>
<div class="inner1200">
	<div class="subTitiel01">
		<dl>ONE.ONE Sytem</dl>
		<dt><?php echo menu0206 ?></dt>
		<dd>20여년간 2만여 환자분의 전담 주치의로 환자분의 치아와 마음을 같이 다스리겠습니다</dd>
	</div>
</div>
<?php }  ?>

<?php if (($pagename == 'staff.php')) {?>
<div class="inner1200">
	<div class="subTitiel01">
		<dl>ONE.ONE Sytem</dl>
		<dt><?php echo menu0207 ?></dt>
		<dd>임상 경력 39년, 34년, 22년 임플란트 수술을 책임지고 있는 전담 의료진의 임상 경력 입니다 </dd>
	</div>
</div>
<?php }  ?>

<?php if (( $pagename == 'management.php')) {?>
<div class="inner1200">
	<div class="subTitiel01">
		<dl>ONE.ONE Sytem</dl>
		<dt><?php echo menu0208 ?></dt>
		<dd>원치과는 상담문의를 하는 순간부터 수술까지 체계적으로 관리합니다. </dd>
	</div>
</div>
<?php }  ?>

