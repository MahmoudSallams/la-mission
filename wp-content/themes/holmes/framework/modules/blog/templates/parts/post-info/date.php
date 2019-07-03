<?php
$month = get_the_time( 'm' );
$year  = get_the_time( 'Y' );
$title = get_the_title();
?>
<div itemprop="dateCreated" class="mkdf-post-info-date entry-date published updated">
	<?php if ( empty( $title ) && holmes_mkdf_blog_item_has_link() ) : ?>
    <a itemprop="url" href="<?php the_permalink() ?>">
		<?php else: ?>
        <a itemprop="url" href="<?php echo get_month_link( $year, $month ); ?>">
			<?php endif; ?>
            <div class="mkdf-date__day">
				<?php the_time( 'd' ); ?>
            </div>
            <div class="mkdf-date__line"></div>
            <div class="mkdf-date__month-year">
				<?php the_time( 'F, Y' ); ?>
            </div>
        </a>
        <meta itemprop="interactionCount" content="UserComments: <?php echo get_comments_number( holmes_mkdf_get_page_id() ); ?>"/>
</div>