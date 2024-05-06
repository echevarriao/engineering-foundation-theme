<?php get_header(); ?>

<?php if(have_posts()): ?>

<h3 class = "doctitle">Archives: <?php print get_the_date('Y'); ?></h3>

<?php while(have_posts()): the_post(); ?>

<?php get_template_part('content', 'archive'); ?>

<?php endwhile; ?>

<?php else: ?>

<?php get_template_part('content', '404'); ?>

<?php endif; ?>

<?php if(is_archive()): ?>
<p><b>Available Archives</b></p>
<ul>
    <?php wp_get_archives('type=yearly'); ?>
</ul>
<?php endif; ?>

<?php get_footer(); ?>