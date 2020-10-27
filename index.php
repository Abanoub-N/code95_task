<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package blog
 */
get_header(); 
?>

<section class="main-posts py-3">
    <?php 
        $args = array(
            'post_type' => 'post',
            'post_status' => 'publish',
            'posts_per_page' => 3
        );
        
        $arr_posts = new WP_Query( $args );
    ?>
    <div class="container-fluid px-5">
        <div class="row px-1">
            <div class="col-md-8 px-0">
                <div class="grid">
                        <?php if ( $arr_posts->have_posts() ) :
                        $posts_count = 0;
                        while ( $arr_posts->have_posts()) : $arr_posts->the_post(); 
                        $main_post = get_field('main_posts');
                        $posts_count++;
                        if ($main_post) :?>
                        <div class="main-post-item">
                            <div class="post-img">
                                <?php the_post_thumbnail()  ?>
                            </div>
                            <header class="post-title">
                                <p><?php the_category(', ') ?></p>
                                <a href="<?php the_permalink(); ?>"><h4 class="entry-title"><?php the_title(); ?></h4></a>
                            </header>
                        </div>
                        <?php endif; endwhile; endif;?>
                </div>
            </div>
            <div class="col-md-4 px-0 d-flex justify-content-center align-items-center">
                <div class="ads mt-2" style="background: #aaa"></div>
            </div>
        </div>
    </div>
</section>

<section class="egypt-news">
    <div class="container-fluid">
        <h2 class="head">Egypt News</h2>
        <div class="slider">
            <?php 

            $args = array(
                'post_type' => 'post',
                'post_status' => 'publish',
                'category_name' => 'egypt-news',
            );
            $arr_posts = new WP_Query( $args );
            
            if ( $arr_posts->have_posts() ) :
            
                while ( $arr_posts->have_posts() ) :
                    $arr_posts->the_post();
                    ?>
                    <div class="position-relative" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                        <div class="post-img">
                            <?php the_post_thumbnail(); ?>
                        </div>
                        <header class="post-title">
                            <a href="<?php the_permalink(); ?>"><h4 class="entry-title"><?php the_title(); ?></h4></a>
                        </header>
                    </div>
                    <?php
                endwhile;
            endif;
            ?>
        </div>
    </div>
</section>

<section class="features py-3">
    <div class="container-fluid">
    <?php 
        $args = array(
            'post_type' => 'post',
            'post_status' => 'publish',
            'category_name' => 'feature',
        );
        $arr_posts = new WP_Query( $args );
    ?>
        <div class="row">
            <div class="col-md-8">
            <h2 class="head">Features</h2>
                <div class="row">
                    <?php
                    if ( $arr_posts->have_posts() ) : while ( $arr_posts->have_posts() ) : $arr_posts->the_post();
                    ?>
                        <div class="col-md-6">
                        <div class="post-img mb-2">
                        <a href="<?php the_permalink();?>" title='<?php the_title(); ?>'><?php the_post_thumbnail(); ?></a>
                        </div>
                        </div>
                    <?php
                    endwhile;
                    endif;
                    ?>
                </div>
            </div>
            <div class="col-md-4">
                <div class="top-stories">
                    <h2 class="head">Top 5 Stories</h2>
                    <ul class='list-unstyled'>
                    <?php
                    $count=1;
                        query_posts('meta_key=post_views_count&posts_per_page=5&orderby=meta_value_num&
                        order=DESC');
                        if (have_posts()) : while (have_posts()) : the_post();
                    ?>
                    <li><span><?php echo $count++ ?></span><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
                    <?php
                    endwhile; endif;
                    wp_reset_query();
                    ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
