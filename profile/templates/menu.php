<div class="menuSetting mediumTextBlack" <?php echo basename($_SERVER['PHP_SELF'], '.php') == 'index' ? 'hidden' : ''; ?>>
	<div class="SettingsProfileHeader"><div class="SettingsProfileHeaderLeftLine"></div>Меню</div>
	<div href="changeprofile" class="SettingsProfileElement <?php echo basename($_SERVER['PHP_SELF'], '.php') == 'changeprofile' ? 'SettingsProfileElementSelectedItem' : ''; ?>"><div></div><img src="/icons/wrechIcon.svg">Редактировать данные</div>
	<div href="changepassword" class="SettingsProfileElement <?php echo basename($_SERVER['PHP_SELF'], '.php') == 'changepassword' ? 'SettingsProfileElementSelectedItem' : ''; ?>"><div></div><img src="/icons/changePasswordIcon.svg">Изменить пароль</div>
	<div href="devices" class="SettingsProfileElement <?php echo basename($_SERVER['PHP_SELF'], '.php') == 'devices' ? 'SettingsProfileElementSelectedItem' : ''; ?>"><div></div><img src="/icons/myDevicesIcon.svg">Мои устройства</div>
	<div href="zapisi" class="SettingsProfileElement <?php echo basename($_SERVER['PHP_SELF'], '.php') == 'zapisi' ? 'SettingsProfileElementSelectedItem' : ''; ?>"><div></div><img src="/icons/list_icon.svg" width=8%>Записи на прием</div>
</div>