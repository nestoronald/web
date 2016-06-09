<?php
error_reporting(0);
$login_domain = 'sidetab';

	if ( !current_user_can('manage_options') ) {
		// Apparently not.
		die( __( 'ACCESS DENIED: Your don\'t have permission to do this.', $login_domain) );
		}
        if (isset($_POST['set_defaults']))  {
			check_admin_referer('sidetab_options');
			$Sidetab_OldOptions = array(
				'tabs'		=> 1,
				'tabcolor1'		=> '#000000',
				'tabtext1'		=> 'More Info',
                'tabcolortext1'  =>'#ffffff',
  				'tabcolor2'		=> '#000000',
				'tabtext2'		=> 'More Info',
                'tabcolortext2'  =>'#ffffff',
				'tabcolor3'		=> '#000000',
				'tabtext3'		=> 'More Info',
                'tabcolortext3'  =>'#ffffff',                              
				);

			update_option('Sidetab_options', $Sidetab_OldOptions);
				
			echo '<div id="message" class="updated fade"><p><strong>' . __( 'Side Tabs Default Options reloaded.', $login_domain) . '</strong></p></div>';
			
		}
		elseif ($_POST['action'] == 'update' ) {
			
			check_admin_referer('login_options'); // check the nonce
					// If we've updated settings, show a message
			echo '<div id="message" class="updated fade"><p><strong>' . __( 'Side Tabs Options saved.', $login_domain) . '</strong></p></div>';
            for($i=1;$i<=$_POST['op_tabs'];$i++){
                $Sidetab_newOptions['tabcolor'.$i]=$_POST['op_tabcolor'.$i];
                $Sidetab_newOptions['tabtext'.$i]=$_POST['op_tabtext'.$i];
                $Sidetab_newOptions['tabcolortext'.$i]=$_POST['op_colortext'.$i];
            }
            $Sidetab_newOptions['tabs']=$_POST['op_tabs'];

		update_option('Sidetab_options', $Sidetab_newOptions);

		}	

		$Sidetab_newOptions = get_option('Sidetab_options');   

	/**
	*	Let's get some variables for multiple instances
	*/
    $checked = ' checked="checked"';
    $selected = ' selected="selected"';
	$site = get_option('siteurl'); 
?>

<div class="wrap">
<form name="login_options" method="post" action="<?php echo $_SERVER['REQUEST_URI'] ?>">
<?php if ( function_exists('wp_nonce_field') )
		wp_nonce_field('login_options'); echo "\n"; ?>
		
<div style="">
  <h2 style="display:inline; position: relative;">Side Tabs Options</h2>
 </div><br style="clear:both;" />
 
<div id="sidetab">
<div id="choiceTemplate"><input id="op_tabs" name="op_tabs" type="hidden" value="3" />
    <? for($i=1;$i<=3;$i++){ //$Sidetab_newOptions['tabs']?>
    <ul style="list-style: none;" id="current-<?=$i?>">
        <li style="padding: 6px 0px 8px;">
            <label for="op_tabcolor"> Color of tab <?=$i?> :
    		<input class="colortab" type="text" value="<?=$Sidetab_newOptions['tabcolor'.$i]?>" maxlength="7" size="10" id="op_tabcolor<?=$i?>" name="op_tabcolor<?=$i?>" /></label> 
    		<span class="setting-description">#000000</span>
        </li>
        <li style="padding: 6px 0px 8px;">
            <label for="op_tabtext"> Tag Label (text on tab) of tab <?=$i?> :
    		<input type="text" value="<?=$Sidetab_newOptions['tabtext'.$i]?>" maxlength="50" size="50" id="op_tabtext<?=$i?>" name="op_tabtext<?=$i?>" class="span-text" /></label> 
	   </li> 
        <li style="padding: 6px 0px 8px;">
            <label for="op_tabtext"> Color of Tag Label (text of tab) of tab <?=$i?> :
    		<input class="colortab" type="text" value="<?=$Sidetab_newOptions['tabcolortext'.$i]?>" maxlength="50" size="50" id="op_colortext<?=$i?>" name="op_colortext<?=$i?>"/></label> 
	   </li>               
       <li><hr /></li>
    </ul>
    <? }
    ?>
</div>

<div id="addremovelink" style="clear:both"><a id="removechoice" href="javascript:;">Remove Tab</a>
<a id="addchoice" href="#">Add Tab</a></div>

 
<p class="submit">
		<input type="submit" id="update2" class="button-primary" value="<?php _e(' Update options',$login_domain); ?> &raquo;" />
		<input type="hidden" name="action" id="action" value="update" />
 </p>
 </form>
</div>

<h1>Introduction</h1>

For updates and other information regarding this plugin, please visit <a href="http://www.slrlounge.com/side-tab-wordpress-plugin-free-slr-lounge-download">http://www.slrlounge.com/side-tab-wordpress-plugin-free-slr-lounge-download</a>

<p class="first">The <em>Sliding Side Tab</em> gives you the option to add up to three tabs afixed to the left side of your Wordpress site that slide out when the user hovers over the tab.  

<p>This plugin is fully widgetized so you can add almost anything you want, from recent posts, facebook and other social networking information, plain text, contact forms and more!</p>

<p>Fully control the color of the tabs as well as the labels for the tabs in an easy-to-use backend.</p>

<img src="http://www.slrlounge.com/wp-content/uploads/2010/10/main_side_tab_tagged.png" alt="" title="main_side_tab_tagged" width="513" height="357" class="aligncenter size-full wp-image-4976" />

<p>We all know how important the real estate on your screen is.  If you add a "Facebook Badge," a user profile, a contact form, or any other item or section to your site, you run the risk of cluttering your page or introducing inconsistent design elements to your page.  
<br/>
<br/>
The "Side Tab" Wordpress plugin is designed to solve this very problem by inserting up to 3 tabs that are affixed to the left side of your website.  These tabs use jQuery to slide open when your user hovers his or her mouse over the tab.  You have full control over the content of each tab, as it utilizes Wordpress widgets.  You also have full control over the color of the tabs as well as the labels (the text) of the tabs.  
<br/>
<br/>
The best way to illustrate this is by showing an example.  This very page (yes, the one you are currently reading) uses this plugin; and so does our <a href="http://www.linandjirsablog.com">photography blog</a>.  Notice how the items inside of the tabs contain information that would either not fit on the page or would not look good on the page as a static item.  Having a sliding tab gives you the freedom to insert items that would otherwise not fit on the page either because of their size or because of their inconsistent look.</p>

So you want to use the pluggin?  Here are the steps to downloading and installing the Side Tab Wordpress Plugin
<H1>Overview of Installation</H1>
1) Download Plugin
<br/>2) Upload Plugin
<br/>3) Activate Plugin
<br/>4) Add php code to Footer
<br/>5) Edit Plugin Settings (of tabs, text on tabs, color of text)
<br/>6) Add Widgets (in Appearance Menu)
<br/>7) Enjoy!
<br/><br/>

<h1>Detailed Instructions for Installation</h1>
<strong>1) Download</strong> - the pluggin by <a href="http://www.slrlounge.com/side-tab-wordpress-plugin-free-slr-lounge-download">clicking here</a></li>
<br/><br/>
<strong>2) Upload</strong> - now that we have the plugin saved on your computer, the next step is to get the plugin into your <code>/wp-content/plugins</code> directory.  There are two methods for doing this:
<br/><br/>
Method a) Dashboard - This is the easier method of the two.  
<br/><br/>
i.  In the Wordpress Dashboard (www.yoursite.com/wp-admin) of your site, click on "Plugins" -> "Add New"
<br/><br/>
Please click the "Add New"
<br/><br/>
<img src="http://www.slrlounge.com/wp-content/uploads/2010/10/editor-680x307.jpg" alt="" title="editor" width="680" height="307" class="aligncenter size-large wp-image-4969" />

<br/>ii.  Click the "Upload" button at the top of the page (see image below).  Then press the "Choose File" button, find the zipped file on your computer, select the file, and click "Install Now"
<br/>
<img src="http://www.slrlounge.com/wp-content/uploads/2010/10/upload_choose_install_tagged.jpg" alt="upload_choose_install_tagged" title="upload_choose_install_tagged" width="624" height="313" class="aligncenter size-full wp-image-4980" />
<br/>
Method b) FTP program - If you download Filezilla or any other 3rd party FTP software, you can log into your site and navigate to the <code>/wp-content/plugins</code> directory and drag and drop the unzipped plugin folder into the directory.
<br/><br/>
<strong>3) Activate The Plugin</strong> - Press "Activate Plugin"
<br/>
<br/>
<img src="http://www.slrlounge.com/wp-content/uploads/2010/10/activate_plugin_tagged-680x222.png" alt="" title="activate_plugin_tagged" width="680" height="222" class="aligncenter size-large wp-image-4983" />
<br/>
<br/>
<strong>4) Edit the Footer.php document</strong> - Go to the Footer.php file in the Editor (Appearance -> Editor -> Footer.php) and enter the following line of code: 
<br/>
<br/>
<b>&lt;<code>?php if(function_exists('get_side_tab'))get_side_tab();</code>?&gt;</b>
<br/>
<br/>
(code with unnecessary spacing may lead to an error).<br/>
<br/>
<img src="http://www.slrlounge.com/wp-content/uploads/2010/10/select_footer_tagged-680x311.png" alt="select_footer_tagged" title="select_footer_tagged" width="680" height="311" class="aligncenter size-large wp-image-4984" />
<br/>
insert the code and press "update file"
<br/>
<img src="http://www.slrlounge.com/wp-content/uploads/2010/10/insert_php_tagged-680x344.png" alt="" title="insert_php_tagged" width="680" height="344" class="aligncenter size-large wp-image-4998" />

<h1>Using the plugin</h1>

<br/><strong>5) Edit Side Tab Settings</strong> - After activating the Plugin and adding in the footer code, go to your dashboard and look under the "Settings" section where you'll find "Side Tabs."  Click "Side Tab" and select your desired color for the tab, the labels (the text on the tabs), and the color of the labels.  Add and remove the tabs from this screen as well.  You can add up to three tabs.
<br/>
<img src="http://www.slrlounge.com/wp-content/uploads/2010/10/settings.jpg" alt="" title="settings" width="623" height="302" class="aligncenter size-full wp-image-4963" />
<br/>
<img src="http://www.slrlounge.com/wp-content/uploads/2010/10/side_tab_color_tagged-680x321.png" alt="" title="side_tab_color_tagged" width="680" height="321" class="aligncenter size-large wp-image-4985" />
<br/>
<br/>
<strong>6) Add Content to the Tabs</strong> - Next click on 'Widgets' under 'Appearance' and see the "Side Tab1," "Side Tab2," and "Side Tab3" (NOTE: There will only be Side Tab2 and Side Tab3 on this screen if you chose to use 3 tabs in the previous step).  In these tabs, drag in your Recent Posts Widgets, Archives Widgets, and other widgets.  If you're trying to add third party information, like Facebook Fan Page information, etc, insert a "text" widget and input the necessary code.  Make sure you click Save after you've entered in your desired information.
<br/>
<br/>
<img src="http://www.slrlounge.com/wp-content/uploads/2010/10/side_tabs-680x298.jpg" alt="" title="side_tabs" width="680" height="298" class="aligncenter size-large wp-image-4966" />
<br/><br/>
<img src="http://www.slrlounge.com/wp-content/uploads/2010/10/side_tab_text-680x453.jpg" alt="" title="side_tab_text" width="680" height="453" class="aligncenter size-large wp-image-4965" />
<br/><br/>
Example: If you would like to add a "Facebook Badge," Go to <a href="http://www.facebook.com/badges/" target="_blank">http://www.facebook.com/badges/</a>, navigate to the following screen, copy the code, and paste it into a text widget like you see above.
<br/><br/>
<img src="http://www.slrlounge.com/wp-content/uploads/2010/10/facebook_badge-680x374.jpg" alt="" title="facebook_badge" width="680" height="374" class="aligncenter size-large wp-image-4961" />


<script src="<?=WP_PLUGIN_URL?>/side-tab/js/jquery-latest.js"></script>
<script src="<?=WP_PLUGIN_URL?>/side-tab/js/colorpicker.js"></script>
<link rel="stylesheet" href="<?=WP_PLUGIN_URL?>/side-tab/css/colorpicker.css"/>
<script>
var $jx = jQuery.noConflict();

$jx(document).ready(function() {
    $jx('#addchoice').click(function(){
        
        var current = $jx("#op_tabs").val();
        current = ++current;
        if(current >3){
            alert('You can\'t creat over 3 sliding');
            return false;
        }
        $jx("#choiceTemplate").append('<ul id="current-'+(current)+'" style="list-style: none;"><li style="border-bottom:1px solid #cdcdcd; padding: 6px 0px 8px 0px;"><label for="op_tabcolor">The color of the tabs'+current+': <input type="text" class="span-text" name="op_tabcolor'+current+'" id="op_tabcolor'+current+'" size="10" maxlength="7" value="<?=$Sidetab_newOptions[tabcolor1]?>"/></label> <span class="setting-description">#000000</span></li><li style="border-bottom:1px solid #cdcdcd; padding: 6px 0px 8px 0px;"><label for="op_tabtext">The Text of the tabs'+current+' :<input type="text" class="span-text" name="op_tabtext'+current+'" id="op_tabtext'+current+'" size="50" maxlength="50" value="<?=$Sidetab_newOptions[tabtext1]?>" /></label> <span class="setting-description">More Tabs</span></li></ul>');
        $jx("#op_tabs").val(current);
    return false;
    })
    
    $jx("#removechoice").click(function(){
        var current = $jx("#op_tabs").val();
        //removing the element
        $jx('#current-'+current).remove();
        //assign the current element count
        current =--current;
        $jx("#op_tabs").val(current);
    });
    $jx('.colortab').ColorPicker({
    	onSubmit: function(hsb, hex, rgb, el) {
    		$jx(el).val('#'+hex);
    		$jx(el).ColorPickerHide();
    	},
    	onBeforeShow: function () {
    		$jx(this).ColorPickerSetColor(this.value);
    	}
    })
    .bind('keyup', function(){
    	$jx(this).ColorPickerSetColor(this.value);
    });

    //$jx('.colortab').ColorPicker({flat: true});

})
</script>