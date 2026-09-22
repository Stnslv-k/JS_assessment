<?php get_header(); ?>

<?php if ( have_posts() ) : ?>
    <?php while ( have_posts() ) : ?>
        <?php the_post(); ?>
        <article <?php post_class( 'mx-auto max-w-site px-6 py-12 lg:px-10' ); ?>>
            <?php the_content(); ?>
        </article>
    <?php endwhile; ?>
<?php endif; ?>

<?php get_footer(); ?>
