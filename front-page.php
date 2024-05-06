<?php get_header(); ?>
<div class = "long-row center uc-blackbg">
    <div class = "row">
	<div class = "large-14 columns">
	    <?php if(is_active_sidebar('widget-1')): ?>
	    <?php dynamic_sidebar('widget-1'); ?>
	    <?php endif; ?>
	</div>
    </div>
</div>
<div class = "long-row center gray-gradient">
    <div class = "row">
	<div class = "large-14 columns">
<h2 class = "subsection-title">Developing News</h2>
<?php

$argv = array('category_name=front-page');

$front_page = new WP_Query($argv);

if($front_page->have_posts()):

?>
<ul class="small-block-grid-2 large-block-grid-4" id = "frontpage-news">
<?php while($front_page->have_posts()): $front_page->the_post(); ?>
<li><a href = "<?php the_permalink(); ?>">
<?php if(has_post_thumbnail()): ?>
<?php set_post_thumbnail_size(200, 200, false); the_post_thumbnail( 'thumbnail'); ?>
<?php else: ?>
<img src = "<?php print get_post_meta($front_page->post->ID, 'thumbnail', true); ?>" alt = ""/>
<?php endif; ?>
<br />
<?php the_title(); ?>
<br />
Published: <?php the_date(); ?>
</a>
</li>
<?php endwhile; ?>
</ul>
<p><b><a href = "http://news.engr.uconn.edu/" class = "button tiny">More news</a></b></p>
<?php endif; ?>
    </div>        
</div>	    
	</div>
    <div class = "long-row" id = "calendar-features">
        <div class = "row">
            <div class = "large-14 columns">
                <?php if(is_active_sidebar('left-subsection-bottom')): ?>
                <div class = "large-6 left">
                <?php dynamic_sidebar('left-subsection-bottom'); ?>
                </div>
                <?php endif; ?>
<div class = "large-2 center columns">
    &nbsp;
</div>
                <?php if(is_active_sidebar('right-subsection-bottom')): ?>
                <div class = "large-6 right columns">
                <?php dynamic_sidebar('right-subsection-bottom'); ?>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php get_footer(); ?>