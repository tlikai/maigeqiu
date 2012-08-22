<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7"/>
    <link href="<?php echo Yii::app()->baseUrl; ?>/css/reset.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo Yii::app()->baseUrl; ?>/css/crbj.css" rel="stylesheet" type="text/css"/>
    <script language="javascript" type="text/javascript" src="<?php echo Yii::app()->baseUrl; ?>/js/jquery.js"/></script>
    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
    <script>
       (function(){
          var ac = document.createElement('script'); ac.type = 'text/javascript'; ac.async = true;
          ac.src =  'http://a.tbcdn.cn/apps/stargate/ac/js/proxy.js?t='+new Date().getTime();
          var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ac, s);
       })();
    </script>
</head>
<body>
    <div id="main">
        <?php echo $content; ?>
    </div>
</body>
</html>
