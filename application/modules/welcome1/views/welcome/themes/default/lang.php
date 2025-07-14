<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
<select onchange="javascript:window.location.href='<?php echo base_url(); ?>LanguageSwitcher/switchLang/'+this.value;">
    <option value="english" <?php if($this->session->userdata('site_lang') == 'english') echo 'selected="selected"'; ?>>English</option>
    <option value="spanish" <?php if($this->session->userdata('site_lang') == 'spanish') echo 'selected="selected"'; ?>>Spanish</option>
    <option value="bulgarian" <?php if($this->session->userdata('site_lang') == 'bulgarian') echo 'selected="selected"'; ?>>Bulgarian</option>   
</select>
<p><?php echo $this->lang->line('welcome_message'); ?></p>

<?php
//echo $this->router->fetch_class()."<br />";
//echo $this->router->fetch_method();
//echo $this->router->class."<br />";
//echo $this->router->method;
//echo $this->router->fetch_module();
?>
</body>
</html>