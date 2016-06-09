<?php
/*
 * @author: Bilal Hassan
 * Date: 02/13/2014
 * 
 */
?>
<div id="scp_widget">
    <div class="scp_box"><ul>
            <?php
            
            $args = array('numberposts' => $num_posts);
            $recent_posts = wp_get_recent_posts($args);
            foreach ($recent_posts as $post) {
                $output = "";
                $output = "<li>";
                $output .= '<a class="scp_thumb" href="' . get_permalink($post["ID"])
                        . '" title="Look ' . esc_attr($post["post_title"]) . '" >'
                        . get_the_post_thumbnail($post["ID"], "thumbnail") . '</a>';
                $output .= '<a class="scp_title" href="' . get_permalink($post["ID"])
                        . '" title="Look ' . esc_attr($post["post_title"]) . '" >'
                        . $post["post_title"] . '</a> </li> ';

                echo $output;
            }
            ?>
        </ul>
    </div>
    <div class="scp_clicker">
        <span><?php _e("Recommended"); ?></span>
    </div>
</div>

