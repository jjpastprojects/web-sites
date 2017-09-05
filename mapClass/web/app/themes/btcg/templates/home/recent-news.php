<?php
use Roots\Sage\Utils;
?>

<div class="recent-news">

  <h2><span>Recent News &amp; Class Information</span></h2>

  <div class="news-content">
    <div id="news-slider" data-slick='{"slidesToShow": 1, "slidesToScroll": 1, "dots": true, "arrows": false, "autoplay": true, "autoplaySpeed": 4000}'>
      <?php
      $news_args = array(
        'post_type' => 'post',
        'posts_per_page' => 4
      );
      $news_query = new WP_Query( $news_args );
      while ( $news_query->have_posts() ) :
        $news_query->the_post();
      ?>
        <div>
          <h3 class="headline">
            <a href="<?php the_permalink(); ?>">
              <?php echo the_title('', '', false); ?>
            </a>
          </h3>
          <?php echo '<time class="updated" datetime="'. get_the_time('c') .'" pubdate>'. sprintf(__('Posted on %s', 'roots'), get_the_date(), get_the_time()) .'</time>'; ?>
          <figure class="story-thumb">
            <a href="<?php the_permalink(); ?>">
              <?php the_post_thumbnail('thumbnail'); ?>
            </a>
          </figure>
          <p>
          <?php
            $content = strip_tags(get_the_content());
            echo Utils\limit_chars($content, 500);
          ?>
          <a href="<?php the_permalink(); ?>">Read More</a>
          </p>
        </div>

      <?php endwhile; ?>
    </div>

  </div> <!--/.news-content-->

</div>
