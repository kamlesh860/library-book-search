<?php 
get_header();

$post_id = get_the_ID();
$price = get_field('price' );
$rating = get_field('rating');
$publishers = get_the_terms( $post_id, 'publishers' )[0];
$authors = get_the_terms( $post_id, 'authors' )[0];
?>
    <h1><?php echo get_the_title(); ?></h1>
    <h4>Price: <?php echo $price; ?></h4>
    <h4>Rating: <?php echo $rating; ?></h4>
    <h4>Author: <?php echo $authors->name; ?></h4>
    <h4>Publisher: <?php echo $publishers->name; ?></h4>
<?
get_footer();

?>