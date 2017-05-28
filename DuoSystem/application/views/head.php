<meta name="viewport" content="width=device-width, initial-scale=1">
<meta charset="utf-8">

<meta http-equiv="pragma" content="no-cache">
<meta http-equiv="Cache-control" content="no-cache">
<meta http-equiv="Cache-control" content="no-store">
<?php 
if(isset($refresh)
&& $refresh
&& !isset($_GET['refresh'])
&& @in_array($this->uri->segment(1), $refresh_pages)):
	$url = 'http://' . $_SERVER['SERVER_NAME'] .  $_SERVER['REQUEST_URI'];
	$ex_url = @explode('?', $url);
?>
<META HTTP-EQUIV=Refresh CONTENT="0; URL=<?php echo $url; ?><?php echo (@count($ex_url) > 1) ? '&' : '?&'; ?>refresh=true">
 
<?php endif;?>

<title>DUOSYSTEM <?php if(isset($title) && $title) echo '- ' . $title; ?></title>

<?php echo link_tag('media/css/reset.css'); ?>
<?php //echo link_tag('media/css/text.css'); ?>
<?php echo link_tag('media/css/bootstrap.css'); ?>
<?php echo link_tag('media/css/datepicker.css'); ?>
<?php echo link_tag('media/css/960.css'); ?>
<?php //echo link_tag('media/css/template.css'); ?>
<?php echo link_tag('media/plugins/jquery-ui.custom/jquery-ui.min.css'); ?>
<?php echo link_tag('media/css/bootstrap-theme.min.css'); ?>
<?php echo link_tag('media/css/jumbotron.css'); ?>

<link href='http://fonts.googleapis.com/css?family=Dosis|Ubuntu|Roboto+Slab|Arimo|Maven+Pro|Arvo|Play|Muli|Nunito|Asap|Questrial|PT+Sans+Caption|Armata|Changa+One|Gudea|Ropa+Sans|Rambla|Kreon|Orbitron|Voltaire|Exo+2|Oxygen|Merriweather+Sans|Oswald&subset=latin' rel='stylesheet' type='text/css'>
<script type="text/javascript" src="<?php echo base_url()?>media/js/jquery-2.0.3.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>media/js/bootstrap.min.js"></script>

<script src="<?php echo base_url()?>media/js/jquery.mask.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo base_url()?>media/js/jquery.validate.js"></script>
<script src="<?php echo base_url()?>media/js/util.validate.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo base_url()?>media/js/validar.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>media/plugins/jquery-ui.custom/jquery-ui.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>media/plugins/jquery.ui.datepicker-pt-BR.js"></script>


<script type="text/javascript" src="<?php echo base_url()?>media/js/jquery.maskMoney.min.js"></script>

<?php if(isset($js) && $js): ?>
<script type="text/javascript" src="<?php echo base_url()?>media/js/<?php echo $js; ?>.js"></script>
<?php endif; ?>

<?php if(isset($js_function) && $js_function): ?>
<script type="text/javascript"><?php echo $js_function; ?></script>
<?php endif; ?>
