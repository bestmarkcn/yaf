<?php /* Smarty version 2.6.26, created on 2021-09-19 11:20:50
         compiled from index%5Cmedootest.phtml */ ?>
<html>
<head>
<title><?php echo $this->_tpl_vars['header']; ?>
</title>
</head>
<body>
<ul>
<?php $_from = $this->_tpl_vars['users']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['user']):
?>
<li><?php echo $this->_tpl_vars['user']['id']; ?>
</li>
<?php endforeach; endif; unset($_from); ?>
</ul>

</body>
</html>