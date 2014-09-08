<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package SCS
 * @since SCS 0.1
 */

get_header(); ?>

<div class="col1-layout">
 
    <div id="primary">
      <div id="content" role="main">
			<header class="entry-header">
            <h1 class="entry-title">
              <?php _e( 'Well this is somewhat embarrassing, isn&rsquo;t it?', 'squeeze' ); ?>
            </h1>
			 <div id="search">
    <?php get_search_form(); ?>
  </div>
          </header>
        <article id="post-0" class="post error404 not-found">
          
		 
          <div class="entry-content">
            <p>
              <?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching, or one of the links below, can help.', 'squeeze' ); ?>
            </p>
          </div>
          <!-- .entry-content --> 
        </article>
        <!-- #post-0 --> 
        
      </div>
      <!-- #content --> 
    </div>
    <!-- #primary --> 
  </div>
  <!-- #primary --> 

<?php get_footer(); ?>
