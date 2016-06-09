<script>
    jQuery(document).ready(function(){
        
       jQuery(".scp_clicker").click(function(){
           if(jQuery(this).hasClass("open")){
               jQuery(this).removeClass("open");
               jQuery("#scp_widget").animate({"left":"-250px"},500,function(){
                   //jQuery(this).css({"width":"0"});
               });
           }else{
               jQuery(this).addClass("open");
               jQuery("#scp_widget").animate({"left":"0"},500);
           }
           
       }); 
    });
    
</script>