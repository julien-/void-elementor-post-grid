<?php 

function voidgrid_get_flat_icons() {
		return [
			'fi flaticon-contact'=>'<span class="fi flaticon-contact"></span>Contact',
			'fi flaticon-double-angle-pointing-to-right'=>'Double Angle Pointing To Right',
			'fi flaticon-e-mail-envelope'=>'E Mail Envelope',
			'fi flaticon-envelope'=>'Envelope',
			'fi flaticon-fast-forward-double-right-arrows'=>'Fast Forward Double Right Arrows',
			'fi flaticon-fence'=>'Fence',
			'fi flaticon-info'=>'Info',
			'fi flaticon-lawn-mower'=>'Lawn Mower',
			'fi flaticon-location'=>'Location',
			'fi flaticon-log'=>'Log',
			'fi flaticon-mail'=>'Mail',
			'fi flaticon-people'=>'People',
			'fi flaticon-people-1'=>'People 1',
			'fi flaticon-portfolio-black-symbol'=>'Portfolio Black Symbol',
			'fi flaticon-question'=>'Question',
			'fi flaticon-right-arrows-couple'=>'Right Arrows Couple',
			'fi flaticon-sprout'=>'Sprout',
			'fi flaticon-watering-can'=>'Watering Can'
		];
	}

function voidgrid_post_orderby_options(){
    $orderby = array(
        'ID' => 'Post Id',
        'author' => 'Post Author',
        'title' => 'Title',
        'date' => 'Date',
        'modified' => 'Last Modified Date',
        'parent' => 'Parent Id',
        'rand' => 'Random',
        'comment_count' => 'Comment Count',
        'menu_order' => 'Menu Order',
    );

    return $orderby;
}

	
function void_grid_post_type(){
	$args= array(
			'public'	=> 'true',
			'_builtin'	=> false
		);
	$post_types = get_post_types( $args, 'names', 'and' );
	$post_types = array( 'post'	=> 'post' ) + $post_types;
	return $post_types;
}

