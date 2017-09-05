
<div class="hero">
  <div class="row">
    <div class="column">

  <?php if( have_rows('home_hero') ) : ?>

    <ul class="small-block-grid-1 medium-block-grid-2 large-block-grid-4">

    <?php while ( have_rows('home_hero') ) : the_row(); ?>

        <li class="promo">

          <?php if ( get_sub_field('link') ) : ?>
            <a href="<?php the_sub_field('link'); ?>" class="promo-link">
          <?php endif; ?>

          <?php if ( get_sub_field('image') ) : ?>
            <figure class="promo-image">

              <?php
                $image = get_sub_field('image');
              ?>
              <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>">

              <?php if ( get_sub_field('heading') && get_sub_field('description') ) : ?>
                <figcaption class="promo-details">
                  <h2 class="promo-heading">
                    <?php the_sub_field('heading'); ?>
                  </h2>
                  <p class="promo-description">
                    <?php the_sub_field('description'); ?>
                  </p>
                  <span class="promo-link-text">Read More</span>
                </figcaption>
              <?php endif; ?>

            </figure>
          <?php endif; ?>

          <?php if ( get_sub_field('link') ) : ?>
            </a>
          <?php endif; ?>

        </li>

    <?php endwhile; ?>

    </ul>

  <?php endif; ?>

    </div> <!--/.column-->
  </div> <!--/.row-->
</div> <!--/.hero-->
