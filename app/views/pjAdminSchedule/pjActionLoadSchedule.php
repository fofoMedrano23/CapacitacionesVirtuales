<?php
$week_start = isset($tpl['option_arr']['o_week_start']) && in_array((int) $tpl['option_arr']['o_week_start'], range(0,6)) ? (int) $tpl['option_arr']['o_week_start'] : 0;
$jqDateFormat = pjUtil::jqDateFormat($tpl['option_arr']['o_date_format']);
if(isset($tpl['schedule_arr']) && !empty($tpl['schedule_arr']))
{ 
	foreach($tpl['schedule_arr'] as $key => $schedule)
	{
		?>
		<tr data-id="<?php echo $schedule['id'];?>">
			<td>
				<input type="hidden" name="schedule_id[<?php echo $schedule['id']; ?>]" value="<?php echo $schedule['id']; ?>" />
				<span class="pj-form-field-custom pj-form-field-custom-after">
					<input type="text" name="date[<?php echo $schedule['id'];?>]" value="<?php echo date($tpl['option_arr']['o_date_format'], strtotime($schedule['start_ts']));?>" class="pj-form-field pointer w80 required datepick" value="" readonly="readonly" rel="<?php echo $week_start; ?>" rev="<?php echo $jqDateFormat; ?>"/>
					<span class="pj-form-field-after"><abbr class="pj-form-field-icon-date"></abbr></span>
				</span>
			</td>
			<td>
				<input name="start_time[<?php echo $schedule['id'];?>]" value="<?php echo date($tpl['option_arr']['o_time_format'], strtotime($schedule['start_ts']));?>" class="pj-timepicker pj-form-field w70 required" data-type="start" data-index="<?php echo $schedule['id'];?>"/>
			</td>
			<td>
				<input name="end_time[<?php echo $schedule['id'];?>]" value="<?php echo date($tpl['option_arr']['o_time_format'], strtotime($schedule['end_ts']));?>" class="pj-timepicker pj-form-field w70 required" data-type="end" data-index="<?php echo $schedule['id'];?>"/>
			</td>
			<td>
				<select name="teacher_id[<?php echo $schedule['id'];?>]" class="pj-form-field required w160">
					<option value="">-- <?php __('lblChoose'); ?>--</option>
					<?php
					foreach ($tpl['teacher_arr'] as $k => $v)
					{
						?><option value="<?php echo $v['id']; ?>"<?php echo $v['id'] == $schedule['teacher_id'] ? ' selected="selected"' : NULL;?>><?php echo pjSanitize::html( $v['name']); ?></option><?php
					}
					?>
				</select>
			</td>
			<td>
				<?php
				foreach ($tpl['lp_arr'] as $v)
				{
					?>
					<p class="pj-multilang-wrap" data-index="<?php echo $v['id']; ?>" style="display: <?php echo (int) $v['is_default'] === 0 ? 'none' : NULL; ?>">
						<span class="inline_block">
							<input type="text" name="i18n[<?php echo $v['id']; ?>][venue][<?php echo $schedule['id'];?>]"  value="<?php echo isset($schedule['i18n']) ? htmlspecialchars(stripslashes(@$schedule['i18n'][$v['id']]['venue'])) : NULL; ?>" class="pj-form-field w140<?php echo (int) $v['is_default'] === 0 ? NULL : ' required'; ?>" lang="<?php echo $v['id']; ?>" data-msg-required="<?php __('pj_field_required');?>"/>
							<?php if ((int) $tpl['option_arr']['o_multi_lang'] === 1 && count($tpl['lp_arr']) > 1) : ?>
							<span class="pj-multilang-input"><img src="<?php echo PJ_INSTALL_URL . PJ_FRAMEWORK_LIBS_PATH . 'pj/img/flags/' . $v['file']; ?>" alt="" /></span>
							<?php endif; ?>
						</span>
					</p>
					<?php
				} 
				?>
			</td>
			<?php
			if($key == 0)
			{ 
				?>
				<td>
					<a class="pj-table-icon-menu pj-table-button" href="#" data-id="{INDEX}"><span class="pj-button-arrow-down"></span></a>
					<span id="pj_menu_<?php echo $schedule['id'];?>" class="pj-menu-list-wrap" style="display: none;">
						<span class="pj-menu-list-arrow"></span>
						<ul class="pj-menu-list">
							<li><a href="#" data-index="<?php echo $schedule['id'];?>" data-period="day" class="lnkNext"><?php __('btnNextDay'); ?></a></li>
							<li><a href="#" data-index="<?php echo $schedule['id'];?>" data-period="week" class="lnkNext"><?php __('btnNextWeek'); ?></a></li>
						</ul>
					</span>
				</td>
				<?php
			}else{
				?>
				<td class="align_center">
					<a href="#" class="pj-delete cpRemoveSchedule"></a>&nbsp;
					<a class="pj-table-icon-menu pj-table-button" href="#" data-id="{INDEX}"><span class="pj-button-arrow-down"></span></a>
					<span id="pj_menu_<?php echo $schedule['id'];?>" class="pj-menu-list-wrap" style="display: none;">
						<span class="pj-menu-list-arrow"></span>
						<ul class="pj-menu-list">
							<li><a href="#" data-index="<?php echo $schedule['id'];?>" data-period="day" class="lnkNext"><?php __('btnNextDay'); ?></a></li>
							<li><a href="#" data-index="<?php echo $schedule['id'];?>" data-period="week" class="lnkNext"><?php __('btnNextWeek'); ?></a></li>
						</ul>
					</span>
				</td>
				<?php
			} 
			?>
		</tr>
		<?php
	}
}else{
	$index = 'cp_' . rand(1, 999999);
	?>
	<tr>
		<td>
			<span class="pj-form-field-custom pj-form-field-custom-after">
				<input type="text" name="date[<?php echo $index;?>]" class="pj-form-field pointer w80 required datepick" value="" readonly="readonly" rel="<?php echo $week_start; ?>" rev="<?php echo $jqDateFormat; ?>"/>
				<span class="pj-form-field-after"><abbr class="pj-form-field-icon-date"></abbr></span>
			</span>
		</td>
		<td>
			<input name="start_time[<?php echo $index;?>]" class="pj-timepicker pj-form-field w70 required" data-type="start" data-index="<?php echo $index;?>"/>
		</td>
		<td>
			<input name="end_time[<?php echo $index;?>]" class="pj-timepicker pj-form-field w70 required" data-type="end" data-index="<?php echo $index;?>"/>
		</td>
		<td>
			<select name="teacher_id[<?php echo $index;?>]" class="pj-form-field required w160">
				<option value="">-- <?php __('lblChoose'); ?>--</option>
				<?php
				foreach ($tpl['teacher_arr'] as $k => $v)
				{
					?><option value="<?php echo $v['id']; ?>"><?php echo pjSanitize::html( $v['name']); ?></option><?php
				}
				?>
			</select>
		</td>
		<td>
			<?php
			foreach ($tpl['lp_arr'] as $v)
			{
				?>
				<p class="pj-multilang-wrap" data-index="<?php echo $v['id']; ?>" style="display: <?php echo (int) $v['is_default'] === 0 ? 'none' : NULL; ?>">
					<span class="inline_block">
						<input type="text" name="i18n[<?php echo $v['id']; ?>][venue][<?php echo $index;?>]" class="pj-form-field w140<?php echo (int) $v['is_default'] === 0 ? NULL : ' required'; ?>" lang="<?php echo $v['id']; ?>" data-msg-required="<?php __('pj_field_required');?>"/>
						<?php if ((int) $tpl['option_arr']['o_multi_lang'] === 1 && count($tpl['lp_arr']) > 1) : ?>
						<span class="pj-multilang-input"><img src="<?php echo PJ_INSTALL_URL . PJ_FRAMEWORK_LIBS_PATH . 'pj/img/flags/' . $v['file']; ?>" alt="" /></span>
						<?php endif; ?>
					</span>
				</p>
				<?php
			} 
			?>
		</td>
		<td>
			<a class="pj-table-icon-menu pj-table-button" href="#" data-id="{INDEX}"><span class="pj-button-arrow-down"></span></a>
			<span id="pj_menu_<?php echo $index;?>" class="pj-menu-list-wrap" style="display: none;">
				<span class="pj-menu-list-arrow"></span>
				<ul class="pj-menu-list">
					<li><a href="#" data-index="<?php echo $index;?>" data-period="day" class="lnkNext"><?php __('btnNextDay'); ?></a></li>
					<li><a href="#" data-index="<?php echo $index;?>" data-period="week" class="lnkNext"><?php __('btnNextWeek'); ?></a></li>
				</ul>
			</span>
		</td>
	</tr>
	<?php
} 
?>