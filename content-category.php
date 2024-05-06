<p><b><?php the_title(); ?></b></p>
<?php print get_the_excerpt(); ?> . . .
<p><b>Published:</b> <?php the_date(); ?></p>
<p><b>Categories:</b> <?php
$categories = get_the_category();
$separator = ', ';
$output = '';
if($categories){
	foreach($categories as $category) {
		$output .= '<a href="'.get_category_link( $category->term_id ).'" title="' . esc_attr( sprintf( __( "View all posts in %s" ), $category->name ) ) . '">'.$category->cat_name.'</a>'.$separator;
	}
echo trim($output, $separator);
}
?></p>
<p><a href = "<?php the_permalink(); ?>" class = "button whitelabel">read more</a></p>
<hr />