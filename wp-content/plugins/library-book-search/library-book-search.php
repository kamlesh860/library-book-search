<?php
 
/*
 
Plugin Name: Library Book Search
 
Plugin URI: https://booksearch.com/
 
Description: Plugin is create post type of books and create shortcode of search book form
 
Version: 1.0
 
Author: Book Search
 
Author URI: https://booksearch.com/
 
License: GPLv2 or later
 
Text Domain: booksearch
 
*/

add_action( 'init', 'activate_myplugin' );
function activate_myplugin() {

    $labels = array( 
        'name' => __( 'Books' , 'twentytwentytwo' ), 
        'singular_name' => __( 'Book' , 'twentytwentytwo' ),
        'add_new' => __( 'New Book' , 'twentytwentytwo' ),
        'add_new_item' => __( 'Add New Book' , 'twentytwentytwo' ),
        'edit_item' => __( 'Edit Book' , 'twentytwentytwo' ),
        'new_item' => __( 'New Book' , 'twentytwentytwo' ),
        'view_item' => __( 'View Book' , 'twentytwentytwo' ),
        'search_items' => __( 'Search Books' , 'twentytwentytwo' ),
        'not_found' =>  __( 'No Books Found' , 'twentytwentytwo' ),
        'not_found_in_trash' => __( 'No Books found in Trash' , 'twentytwentytwo' ),
    );
 
    $args = array(
        'labels' => $labels, 
        'has_archive' => true,
        'public' => true,
        'hierarchical' => false,
        'supports' => array('title','editor','excerpt', 'custom-fields', 'thumbnail','page-attributes'
        ),
        'rewrite'   => array( 'slug' => 'books' ),
        'show_in_rest' => true
    );

    register_post_type( 'books', $args );

    // For Create Author Taxonomy
    $labels = array(
        'name' => __( 'Authors' , 'twentytwentytwo' ),
        'singular_name' => __( 'Author', 'twentytwentytwo' ),
        'search_items' => __( 'Search Authors' , 'twentytwentytwo' ),
        'all_items' => __( 'All Authors' , 'twentytwentytwo' ),
        'edit_item' => __( 'Edit Author' , 'twentytwentytwo' ),
        'update_item' => __( 'Update Authors' , 'twentytwentytwo' ),
        'add_new_item' => __( 'Add New Author' , 'twentytwentytwo' ),
        'new_item_name' => __( 'New Author Name' , 'twentytwentytwo' ),
        'menu_name' => __( 'Authors' , 'twentytwentytwo' ),
    );
      
    $args = array(
        'labels' => $labels,
        'hierarchical' => true,
        'sort' => true,
        'args' => array( 'orderby' => 'term_order' ),
        'rewrite' => array( 'slug' => 'authors' ),
        'show_admin_column' => true,
        'show_in_rest' => true
    );
      
    register_taxonomy( 'authors', array( 'books' ), $args);

    // For create publisher taxonomy
    $labels = array(
        'name' => __( 'Publishers' , 'twentytwentytwo' ),
        'singular_name' => __( 'Publisher', 'twentytwentytwo' ),
        'search_items' => __( 'Search Publishers' , 'twentytwentytwo' ),
        'all_items' => __( 'All Publishers' , 'twentytwentytwo' ),
        'edit_item' => __( 'Edit Publisher' , 'twentytwentytwo' ),
        'update_item' => __( 'Update Publishers' , 'twentytwentytwo' ),
        'add_new_item' => __( 'Add New Publisher' , 'twentytwentytwo' ),
        'new_item_name' => __( 'New Publisher Name' , 'twentytwentytwo' ),
        'menu_name' => __( 'Publishers' , 'twentytwentytwo' ),
    );
      
    $args = array(
        'labels' => $labels,
        'hierarchical' => true,
        'sort' => true,
        'args' => array( 'orderby' => 'term_order' ),
        'rewrite' => array( 'slug' => 'publishers' ),
        'show_admin_column' => true,
        'show_in_rest' => true
  
    );
      
    register_taxonomy( 'publishers', array( 'books' ), $args);

    

}

function myplugin_flush_rewrites() {
        activate_myplugin();
        flush_rewrite_rules();
}

register_activation_hook( __FILE__, 'myplugin_flush_rewrites' );

register_uninstall_hook( __FILE__, 'my_plugin_uninstall' );
function my_plugin_uninstall() {
    
    unregister_post_type( 'books' );
}

// For create sortcode for showing form and all books
function library_book_search($atts, $content=null){

    $args = array(
        'taxonomy' => 'publishers',
        'orderby' => 'name',
        'order'   => 'ASC'
    );

    $cats = get_categories($args);
   $output  = '' ; 

   $output .= '<form class="search-books" action="" method="post">
        <div class="form">
            <div class="book-name">
                <label for="">Book Name</label>
                <input type="text" class="books" name="book-name" placeholder="Book Name" />
            </div>
            <div class="book-author">
                <label for="">Author Name</label>
                <input type="text" class="authors" name="author-name" placeholder="Author" />
            </div>
            <div class="publisher-name">
                <label for="">Publisher Name</label>
                <select name="publisher-name" id="publisher" class="publisher">';
                        foreach($cats as $cat) {
                            $output .= '<option value="'.$cat->name.'">'. $cat->name.'</option>';
                        }
        
    $output .= '</select>
            </div>
            <div class="ratings">
                <label for="">Rating</label>
                <select name="rating" class="rating" id="rating">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
            </div>
            <div class="rangeslider" data-role="rangeslider">
                <label for="price-min">Min:</label>
                <input type="range" name="price-min" class="price-min" id="price-min" value="200" min="0" max="500">
                <label for="price-max">Max:</label>
                <input type="range" name="price-max" class="price-max" id="price-max" value="800" min="501" max="1000">
            </div>
        </div>
        <input type="submit" class="search-book" name="submit" value="submit">
   </form>
    
   <table class="book-listing">
        <thead>
            <tr>
                <th>No</th>
                <th>Book Name</th>
                <th>Price</th>
                <th>Author</th>
                <th>Publisher</th>
                <th>Rating</th>
            </tr>
        </thead>
        <tbody>';

        $query = new WP_Query(array(
            'post_type' => 'books',
            'post_status' => 'publish',
            'numberposts' => -1
        ));
        
        $i = 1;
        while ($query->have_posts()) {
            $query->the_post();
            $post_id = get_the_ID();
            $permalink = get_permalink();
            $price = get_field('price',$post_id);
            $rating = get_field('rating',$post_id);
            $publishers = get_the_terms( $post_id, 'publishers' )[0];
            $authors = get_the_terms( $post_id, 'authors' )[0];
    $output .= '<tr>
                    <td>'.$i.'</td>
                    <td><a href="'.$permalink.'">'.get_the_title().'</a></td>
                    <td>'.$price.'</td>
                    <td>'.$authors->name.'</td>
                    <td>'.$publishers->name.'</td>
                    <td>'.$rating.'</td>
                </tr>';
                $i++;
        }
        wp_reset_query();
        $output .= '</tbody></table>';
        
    return $output;
}
add_shortcode('librarybook', 'library_book_search');

// For create function for ajac action handle
function booksearch_ajax_handler(){    
    $books = array();
    // Get all Value
    $bookName = $_POST['bookName'];
    $autorName = $_POST['autorName'];
    $publisherName = $_POST['publisherName'];
    $rating = $_POST['rating'];
    $minPrice = $_POST['minPrice'];
    $maxPrice = $_POST['maxPrice'];
    
    // For all value store in array
    $books['bookName'] = $bookName;
    $books['autorName'] = $autorName;
    $books['publisherName'] = $publisherName;
    $books['rating'] = $rating;
    $books['minPrice'] = $minPrice;
    $books['maxPrice'] = $maxPrice;

    // Get Books by value
    $query = new WP_Query([
        "post_type" => 'books',
        "name" => $books['bookName'],
        'meta_query' => array(
            'relation' => 'OR',
            array(
                'key'     => 'price',
                'value'   =>  array( $books['minPrice'], $books['maxPrice'] ),
                'type'    => 'numeric',
                'compare' => 'BETWEEN',
            ),
            array(
                'key'     => 'rating',
                'value'   =>  $books['rating'],
            ),
        ),
        'tax_query' => array(
            'relation' => 'OR',
            array(
                'taxonomy' => 'publishers',
                'field' => 'name',
                'terms' => $books['publisherName']
            ),
            array(
                'taxonomy' => 'authors',
                'field' => 'name',
                'terms' => $books['autorName']
            )
        )
    ]);
    $search = '';
    $i = 1;
    while ($query->have_posts()) {
        $query->the_post();
        $post_id = get_the_ID();
        $permalink = get_permalink();
        $price = get_field('price',$post_id);
        $rating = get_field('rating',$post_id);
        $publishers = get_the_terms( $post_id, 'publishers' )[0];
        $authors = get_the_terms( $post_id, 'authors' )[0];

        $search .='<tr>
            <td>'.$i.'</td>
            <td><a href="'.$permalink.'">'.get_the_title().'</a></td>
            <td>'.$price.'</td>
            <td>'.$authors->name.'</td>
            <td>'.$publishers->name.'</td>
            <td>'.$rating.'</td>
        </tr>';
        $i++;
    }
    echo $search;
	die; // here we exit the script and even no wp_reset_query() required!
}
 
add_action('wp_ajax_booksearch', 'booksearch_ajax_handler'); // wp_ajax_{action}
add_action('wp_ajax_nopriv_booksearch', 'booksearch_ajax_handler'); // wp_ajax_nopriv_{action}
