/************
 * Slide css
 */
#tab_slide {
	color:  <?php echo $instance["font_color"]; ?>;
	font-family: <?php echo $instance["font_family"]; ?>;
	font-size: <?php echo $instance["font_size"]; ?>;
	top: <?php echo $instance["open_top"]; ?>%;
	position:fixed;
	z-index: 2147483647;
}

.tab_slide_corners_left {
	border-top-left-radius: 10px;
	border-bottom-left-radius: 10px;
}
.tab_slide_corners_right {
	border-top-right-radius: 10px;
	border-bottom-right-radius: 10px;
}
#tab_slide_include {
	padding: 30px 20px 20px 20px;	
}
#tab_slide_background {
<?php if (substr($instance["background"], 0, 7) == 'http://') { ?>
	background: url("<?php echo $instance["background"]; ?>");
	background-size: 100%;
	background-repeat: no-repeat;
<?php } else { ?>
	background: <?php echo $instance["background"]; ?>;
<?php } ?>

<?php if ($instance["borders"]) { ?>
        <?php $size = "1px 1px 2px"; ?>
	box-shadow: <?php echo $size . " " . $instance['font_color']; ?>;
<?php } ?>

	height:100%;
	opacity: <?php echo (float)$instance['opacity'] / 100; ?>;
	position:absolute; 
	top: 0;
	width:100%;
	z-index:-1;	
}
/**********************
 * Custom toggle class
 */
.make_it_slide { 
	/* custom class you can use to toggle the slide */
}
/******************
 * Default tab css
 */
#tab_toggle {
}
#tab_toggle:hover {
	cursor: pointer;
}
#tab_toggle_bg:hover {
	cursor: pointer;
}
/*****************
 * Text based tab
 */
.tab_text_bg {
	background-color:<?php echo $instance["tab_color"]; ?>;
	height: <?php echo $instance["tab_height"].$instance['window_unit']; ?>;
	overflow: hidden;
	position: absolute;
	top: <?php echo $instance["tab_top"]; ?>%;
	width: <?php echo $instance["tab_width"].$instance['window_unit']; ?>;
}
.tab_text_bg:hover {
  box-shadow:-1px 2px 2px #000000;
}
#tab_title_wrap {
	background-color: <?php echo $instance["tab_color"]; ?>;
	color: <?php echo $instance["font_color"]; ?>;
	display:block;
	font-family: <?php echo $instance["font_family"]; ?>;
	font-size: <?php echo $instance["tab_font_size"]; ?>;
	font-weight:bold;
	letter-spacing: 1px;
	margin-left: 1px;
	overflow: visible;
	position: relative;
	-webkit-transform: rotate(90deg);  /* Saf3.1+, Chrome */
	    -moz-transform: rotate(90deg);  /* FF3.5+ */
	       -o-transform: rotate(90deg);  /* Opera 10.5 */
	         zoom: 1;
}
/****************************************
 * Adjust the text offset for open/close
 */
.open_letter_reset {
	margin-top: <?php echo $instance["tab_margin_open"]; ?>px;
	opacity: <?php echo (float)$instance['opacity'] / 100; ?>;
}
.close_letter_reset {
	margin-top: <?php echo $instance["tab_margin_close"]; ?>px;
}
.tab_text_left {
	border-top-left-radius: 4px;
	border-bottom-left-radius: 4px;
<?php if ($instance["borders"]) { ?>
        <?php $size = "-1px 1px 1px"; ?>
	box-shadow: <?php echo $size . " " . $instance['font_color']; ?>;
<?php } ?>
	left: -<?php echo $instance["tab_width"]; ?>px;
}
.tab_text_right {
	border-top-right-radius: 4px;
	border-bottom-right-radius: 4px;
	<?php if ($instance["borders"]) { ?>
        <?php $size = "1px 1px 1px"; ?>
	box-shadow: <?php echo $size . " " . $instance['font_color']; ?>;
<?php } ?>
	right: -<?php echo $instance["tab_width"]; ?>px;
}
/* IE Offsets */
.newline {
	display: block;
	line-height: 0.7em; 
	margin-left: 3px;
	margin-bottom: 1px;
}
/******************
 * Image based tab
 */
.closed_action {
	background-image: url('assets/images/close.gif') !important;
	background-size: 12px 12px;
	background-repeat: no-repeat;
	height: 12px;
	margin-top: 7px;
	position: static;
	width: 12px;
}
 .open_action {
	background: url('<?php echo $instance["tab_image"]; ?>');
	background-repeat: no-repeat;
	height: <?php echo $instance["tab_height"]; ?>px;
	position: fixed;
	top:<?php echo $instance["tab_top"]; ?>%!important;
	width:<?php echo $instance["tab_width"]; ?>px;
}
.reset_right  {
	right: 0;
}
.reset_left  {
	left: 0;
}
.float_left  {
	float: left;
	margin-left: 7px;
}
.float_right  {
	float: right;
	margin-right: 7px;
}
