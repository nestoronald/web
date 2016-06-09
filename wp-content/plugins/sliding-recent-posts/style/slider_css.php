<style>
    #scp_widget{
        position: fixed;
        width: 300px;
        top: <?php echo $position ?>px;
        left: -250px;
        background: #464646;
        background: rgba(0,0,0,0.5);
        z-index: 9999;
        <?php
            if($rounded_corners == 'yes'){
                echo "border-top-right-radius: 20px;border-bottom-right-radius: 20px;";
            }
        ?>
    }
    #scp_widget .scp_clicker{
        cursor: pointer;
        width: 50px;
        background: <?php echo $background_color?>;
        height: 100%;
        position: absolute;
        top: 0;
        right: 0;
        box-shadow: 0 0 10px #676767;
        transition: 0.3s all ease-in-out;
        -moz-transition: 0.3s all ease-in-out;
        -webkit-transition: 0.3s all ease-in-out;
        <?php
            if($rounded_corners == 'yes'){
                echo "border-top-right-radius: 20px;border-bottom-right-radius: 20px;";
            }
        ?>    
    }
    #scp_widget .scp_clicker:hover{
        box-shadow: 0 0 10px #333;
    }
    #scp_widget .scp_clicker span{
        position: relative;
        color: <?php echo $font_color ?>;
        top: 100px;
        font-size: 24px;
        display: block;
        transform:rotate(90deg);
        -ms-transform:rotate(90deg); /* IE 9 */
        -webkit-transform:rotate(90deg);
    }
    #scp_widget .scp_box{
        padding: 10px;
        width: 250px;
    }
    #scp_widget li{
        height: 20%;
        overflow: hidden;
        margin-bottom: 8px;
        border-bottom: 1px solid #ffdddd;
        padding-bottom: 5px;
    }
    #scp_widget li:last-child{
        border: none;
    }
    #scp_widget li a.scp_title{
        color: #ffdddd !important;
        margin-left: 10px;
    }
    #scp_widget li img{
        width: 50px;
        height: 50px;
        float: left;
    }
</style>
