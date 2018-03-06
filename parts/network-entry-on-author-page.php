<div class="content-section">
  <div class="content-section-content">
    <?php
      $author = get_user_by( 'slug', get_query_var( 'author_name' ) );
      $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
      $args = array(
        'post_type' => 'network_post',
        's' => esc_html( get_search_query( false ) ),
        'posts_per_page' => 5,
        'paged' => $paged,
        'author' => $author->ID
      );
      $query = new WP_Query( $args );
    ?>

    <?php if ( $query->have_posts() ) : ?>
      <?php while ( $query->have_posts() ) : $query->the_post(); ?>
      <article class="post">
        <div class="featured-image">
          <?php get_the_post_thumbnail(); ?>
        </div>
        <h3>
          <a href="<?php echo get_permalink();?>">
            <?php the_title(); ?>
          </a>
        </h3>
        <div class="meta">
          <p class="date">
            <span class="fa fa-clock-o"></span>
            <?php echo the_time( get_option( 'date_format' ) ); ?>
          </p>
          <p class="comments">
            <a href="<?php comments_link(); ?>">
              <span class="fa fa-comments-o"></span>
              <?php comments_number(); ?> 
            </a>
          </p>
        </div>
        <?php the_excerpt(); ?>
      </article>
      <hr class="dark" />
    <?php endwhile; ?>

    <nav class="paging row">
      <?php if( get_next_posts_link('', $query->max_num_pages) ) : ?>
        <?php echo get_next_posts_link( 'Older Entries', $query->max_num_pages); ?>
      <?php endif; ?>
      <?php if( get_previous_posts_link() ) : ?>
        <?php echo get_previous_posts_link( 'Newer posts' ); ?>
      <?php endif; ?>
    </nav>

    <?php wp_reset_postdata(); ?>

    <?php else : ?>
      <p><?php _e( 'Sorry, no posts matched your criteria.', 'pmc' ); ?></p>
    <?php endif; ?> 
  </div>
</div>
