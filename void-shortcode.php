<?php  
// voidgrid Shortcodes 

$col_no=$count=$col_width=$post_count='';

function voidgrid_sc_post_grid( $atts ) {
    extract( shortcode_atts( array ( 
         'display_type'  => '1',   
         'posts' => -1,
         'posts_per_row' => 2,
         'category' => '',
         'category_name'    => '',
         'image_style'  => '1',
         'orderby'          => 'date',
         'order'            => 'DESC', 
         'offset'           => 0,  
         'sticky_ignore'    => 0,
         'display_type'       => 'grid',

 
    ), $atts ));

   
    global $col_no,$count,$col_width;
  
  $count = 0;         
  if ($posts_per_row==1)  { $col_width = 12; $col_no = 1; }
  else if ($posts_per_row==2){ $col_width = 6; $col_no = 2; }
  else if ($posts_per_row==3){ $col_width = 4; $col_no = 3; }
  else if ($posts_per_row==4){ $col_width = 3; $col_no = 4; }
  else if ($posts_per_row==6){ $col_width = 2; $col_no = 6; }
  else{ $col_width = 12; $col_no = 1; }
   
    if( $display_type == '1' ){
      $display_type = 'grid';
    }
    elseif( $display_type == '2'){
      $display_type = 'list';
    }
    elseif( $display_type == '3'){
      $display_type = 'first-post-grid';
    }
    elseif( $display_type == '4'){
      $display_type = 'first-post-list';
    }
    elseif( $display_type == '5'){
      $display_type = 'minimal';
    }
    if( !empty( $image_style ) ){
      if( $image_style == 1){
        $image_style = '';
      }
      elseif( $image_style == 2){
        $image_style = 'top-left';
      }
      else{
        $image_style = 'top-right';
      }
    }
    else{
      $image_style = '';
    }         

  
  $templates = new Void_Template_Loader;
  ob_start(); 

  $grid_query= null;
  $args = array(
        'display_type'  => $display_type,
       'post_type'      => 'post',
       'post_status'    => 'publish',
       'posts_per_page' => $posts,    
       'cat'            => $category,
       'image_style'    => $image_style,
       'category_name'    => $category_name,
       'orderby'          => $orderby,
       'order'            => $order,   //ASC / DESC
       'offset'           => $offset,
       'ignore_sticky_posts' => $sticky_ignore,

     //  'suppress_filters' => true       
  );


$grid_query = new WP_Query( $args );
  global $post_count;
  $post_count = $posts;
 ?>

<div class="content-area void-grid">
  <div class="site-main <?php echo esc_html( $display_type . ' '. $image_style); ?>" >       
    <div class="row">       
      <?php
      if ( $grid_query->have_posts() ) : 

            /* Start the Loop */
        while ( $grid_query->have_posts() ) : $grid_query->the_post();?>          
          <?php
          $count++;
          $templates->get_template_part( 'content', $display_type );

        endwhile; ?>

      <?php else :

          $templates->get_template_part( 'content', 'none' );

      endif; ?>

    </div><!-- #main -->
  </div><!-- #primary -->
</div>

<?php
wp_reset_postdata();
return ob_get_clean();
}
add_shortcode('voidgrid_sc_post_grid', 'voidgrid_sc_post_grid');
