<style>
    #wrapper{
        border: 1px solid #f0f0f0;

        width: 60%;
        padding: 10px;
    }
    #sidebar{
        width: 30%;
        background:#edeae6;
        float: right;
    }
    #wrapper input[type='text']{
        width: 20%;
    }
    .form-field label{
        width: 20%;
        display: inline-block;
    }
    .titlediv{
        padding: 5px;
    }
    .titlediv:nth-child(odd){
        background: #ebebeb;

    }
    .srp_submit{
        margin-top: 20px;
    }

</style>
<h2>Recent Posts Widget Settings</h2>

<form name="post_form" class="construction-form" method="post" action="" enctype="multipart/form-data">
    <div id="sidebar">
        <h2 style="color: #B0CB1F;background: #414141;text-align: center;padding: 10px 0;margin-top: 10px;">Plugin Details</h2>
        <p style="text-align: center;padding: 10px">
            <?php _e("Use this plugin to show your most recent posts & articles to draw attention of your website visitors") ?>
            <br>
            <?php _e("You can use the options to select the number of posts that show up and change the colors to match your website!") ?>
            <br>
            
        </p>
        <p style="text-align: center">
            <a href="http://smartcatdesign.net/sliding-recent-posts-free-wordpress-plugin/" target="_blank" class="button button-primary">Plugin Site</a>
        </p>
        <p style='text-align: center'>
            <img src='../images/logo.png' style="max-width: 100%"/>
        </p>
    </div>
    <div id="wrapper" class="updated">
        <div class="titlediv">
            <div class="form-field title">
                <label>
                    <?php _e("Number of Posts") ?>
                </label>
                <select name="num_posts">
                    <option value="3" <?php echo ($num_posts == 3) ? 'selected=selected' : '' ?>>3</option>
                    <option value="5" <?php echo ($num_posts == 5) ? 'selected=selected' : '' ?>>5</option>
                </select>
            </div>
        </div>
        <div class="titlediv">
            <div class="form-field title">
                <label>
                    <?php _e("Position from Top") ?>
                </label>
                <input type="text" class="scp_text" id="position_box" name="position" value="<?php echo $position ?>" size="10"/>px<br>
            </div>
        </div>
    </div>
    <div id="wrapper" class="updated">
        
        <div class="titlediv">
            <div class="form-field title">
                <label>
                    <?php _e("Background Color") ?>
                </label>
                <input type="text" class="scp_text" id="bg_colorbox" name="background_color" value="<?php echo $background_color ?>" size="10"/><br>
            </div>
        </div>
        <div class="titlediv">
            <div class="form-field title">
                <label>
                    <?php _e("Font Color") ?>
                </label>
                <input type="text" class="scp_text" id="font_colorbox" name="font_color" value="<?php echo $font_color ?>" size="10"/><br>
            </div>
        </div>
        <div class="titlediv">
            <div class="form-field title">
                <label>
                    <?php _e("Rounded Corners") ?>
                </label>
                <select name="rounded_corners">
                    <option value="yes" <?php echo ($rounded_corners=='yes') ? 'selected=selected' : '' ?>>Yes</option>
                    <option value="no" <?php echo ($rounded_corners == 'no') ? 'selected=selected' : '' ?>>No</option>
                </select>
            </div>
        </div>




    </div>

    <div class="srp_submit">
        <input type="submit" name="submit" value="Save" class="button button-primary"/>
        <input type="hidden" name="srp_save" value="save"/>
    </div>
</form>



<script language="JavaScript">
    jQuery("#position_box").focusout(function(){
        
    });
    
    jQuery('#bg_colorbox').miniColors({
        change: function(hex, rgb) {
            jQuery("#console").prepend("HEX: " + hex + " (RGB: " + rgb.r + ", " + rgb.g + ", " + rgb.b + ")<br />");
        }
    });
    jQuery('#font_colorbox').miniColors({
        change: function(hex, rgb) {
            jQuery("#console").prepend("HEX: " + hex + " (RGB: " + rgb.r + ", " + rgb.g + ", " + rgb.b + ")<br />");
        }
    });

</script>



