// Source: https://gist.github.com/luetkemj/2023628
// Xem hướng dẫn WP_Query toàn tập: http://goo.gl/kRpzTz
<?php
$args = array( 
  
//////Author Parameters - Tham số lấy bài viết theo tác giả
    //http://codex.wordpress.org/Class_Reference/WP_Query#Author_Parameters
    'author' => '1,2,3,',                     //(int) - Các ID tác giả cần lấy bài viết (thêm dấu - vào để loại trừ tác giả, ví dụ: -14, -20)
    'author_name' => 'luetkemj',              //(string) - Lấy bài viết dựa theo tên nick name của tác giả
    'author__in' => array( 2, 6 ),            //(array) - Lấy bài dựa theo ID của tác giả
    'author__not_in' => array( 2, 6 ),        //(array)' - Các ID của tác giả không muốn lấy bài
  
//////Category Parameters - Tham số lấy bài viết dựa theo category
    //http://codex.wordpress.org/Class_Reference/WP_Query#Category_Parameters
    'cat' => 5,//(int) - Lấy bài dựa theo ID của category
    'category_name' => 'staff, news',          //(string) - Lấy bài dựa theo category slug
    'category__and' => array( 2, 6 ),         //(array) - Lấy bài mà nó mang cả hai category 2 và 6 (ID)
    'category__in' => array( 2, 6 ),          //(array) - ID của các category không muốn lấy bài
    'category__not_in' => array( 2, 6 ),      //(array) - Các ID của category không muốn lấy bài
     
//////Tag Parameters - Tham số lấy bài viết dựa theo tag
    //http://codex.wordpress.org/Class_Reference/WP_Query#Tag_Parameters
    'tag' => 'cooking',                       //(string) - Lấy bài viết theo tag slug
    'tag_id' => 5,                            //(int) - Lấy bài viết theo tag ID
    'tag__and' => array( 2, 6),               //(array) - Lấy bài viết mà nó mang cả hai tag có ID 2 và 6
    'tag__in' => array( 2, 6),                //(array) - Lấy tất cả bài viết trong nhiều tag ID khác nhau
    'tag__not_in' => array( 2, 6),            //(array) - Các tag ID không muốn lấy bài
    'tag_slug__and' => array( 'red', 'blue'), //(array) - Lấy bài viết mà nó mang cả hai tag có slug red và blue
    'tag_slug__in' => array( 'red', 'blue'),  //(array) - Lấy bài viết trong nhiều tag slug khác nhau
  
//////Taxonomy Parameters - Lấy bài viết dựa theo taxonomy
    //http://codex.wordpress.org/Class_Reference/WP_Query#Taxonomy_Parameters
    //Quan trọng: tax_query là tham số có thể sẽ chứa nhiều mảng lồng vào bên trong
    'tax_query' => array(                     //(array) - Lấy bài viết dựa theo taxonomy
    'relation' => 'AND',                      //(string) - Mối quan hệ giữa các tham số bên trong, AND hoặc OR
      array(
        'taxonomy' => 'color',                //(string) - Tên của taxonomy
        'field' => 'slug',                    //(string) - Loại field cần xác định term của taxonomy, sử dụng 'id' hoặc 'slug'
        'terms' => array( 'red', 'blue' ),    //(int/string/array) - Slug của các terms bên trong taxonomy cần lấy bài
        'include_children' => true,           //(bool) - Lấy category con, true hoặc false
        'operator' => 'IN'                    //(string) - Toán tử áp dụng cho mảng tham số này. Sử dụng 'IN' hoặc 'NOT IN'
      ),
      array(
        'taxonomy' => 'actor',
        'field' => 'id',
        'terms' => array( 103, 115, 206 ),
        'include_children' => false,
        'operator' => 'NOT IN'
      )
    ),

//////Post & Page Parameters - Lấy bài viết dựa vào tham số của Post hoặc Page
    //http://codex.wordpress.org/Class_Reference/WP_Query#Post_.26_Page_Parameters
    'p' => 1,                               //(int) - ID của post cần hiển thị
    'name' => 'hello-world',                //(string) - Slug của post cần hiển thị
    'page_id' => 1,                         //(int) - ID của page cần hiển thị
    'pagename' => 'sample-page',            //(string) - Slug của page cần hiển thị
    'pagename' => 'contact_us/canada',      //(string) - Hiển thị page con bằng slug của page mẹ và page con, cách nhau bởi dấu gạch chéo
    'post_parent' => 1,                     //(int) - Lấy page con dựa vào ID của page mẹ
    'post_parent__in' => array(1,2,3)       //(array) - Lấy nhiều page con dựa vào nhiều page mẹ thông qua ID
    'post_parent__not_in' => array(1,2,3),  //(array) - Các ID của page mẹ không muốn hiển thị page con
    'post__in' => array(1,2,3),             //(array) - Danh sách các post cần lấy, dùng ID
    'post__not_in' => array(1,2,3),         //(array) - Danh sách các post không muốn lấy, dùng ID
    //NOTE: Bạn không thể sử dụng 'post__in' cùng với 'post__not_in' trong một query

//////Password Parameters - Lấy các bài viết dựa theo thiết lập mật khẩu của post
    //http://codex.wordpress.org/Class_Reference/WP_Query#Password_Parameters
    'has_password' => true,                 //(bool) - Lấy các bài viết có đặt password
                                              //true bài viết có pass 
                                              //false bài viết không có pass
                                              //null Mặc định nó sẽ lấy toàn bộ post có pass và không có pass
    'post_password' => 'multi-pass',          //(string) - show posts with a particular password (available with Version 3.9)

//////Type - Hiển thị post dựa vào loại post 
    //http://codex.wordpress.org/Class_Reference/WP_Query#Type_Parameters
    'post_type' => array(                   //(string / array) - tên post type cần lấy bài viết. Mặc định là 'post'
            'post',                         // -  post.
            'page',                         // - page.
            'revision',                     // - revision.
            'attachment',                   // - tập tin đính kèm. 
            'my-post-type',                 // - Tên custom post type
            ),
    'post_type' => 'any',                   // - Lấy bất kỳ post type đang có trên website

//////Status Parameters - Lấy các bài viết dựa theo trạng thái của nó
    //http://codex.wordpress.org/Class_Reference/WP_Query#Status_Parameters
    'post_status' => array(                 //(string / array)       
            'publish',                      // - Post hoặc Page đã được publish
            'pending',                      // - Post đang ở trạng thái Pending Review
            'draft',                        // - Post đang trong nháp
            'auto-draft',                   // - Các bài viết tự động lưu nháp
            'future',                       // - Bài viết đang được đặt thời gian đăng trong tương lai
            'private',                      // - Bài viết đang trong trạng thái riêng tư
            'inherit',                      // - Lấy một bản revision
            'trash'                         // - Lấy post từ thùng rác
            ),
    'post_status' => 'any',                 // - Sử dụng bất kỳ trạng thái nào


    
//////Pagination Parameters
    //http://codex.wordpress.org/Class_Reference/WP_Query#Pagination_Parameters
    'posts_per_page' => 10,                 //(int) - Số lượng bài viết cần lấy ra để hiển thị trên mỗi trang. Nếu muốn hiển thị toàn bộ thì đặt giá trị là -1
    'posts_per_archive_page' => 10,         //(int) - Số lượng bài viết cần lấy ra hiển thị trên mỗi trang. Nhưng chỉ sử dụng cho các trang lưu trữ.
    'nopaging' => false,                    //(bool) - Nếu muốn sử dụng phân trang thì đặt là false. True sẽ hiển thị tất cả post. Mặc định là false.
    'paged' => get_query_var('paged'),      //(int) - Số trang hiện tại.
                                            //NOTE: Sử dụng get_query_var('page') nếu bạn cần sử dụng nó ở một Custom Page Template
    										// http://codex.wordpress.org/Function_Reference/next_posts_link#Usage_when_querying_the_loop_with_WP_Query
                                            // http://codex.wordpress.org/Pagination#Troubleshooting_Broken_Pagination
    'offset' => 3,                          // (int) - Số bài viết trước đó mà bạn muốn bỏ qua.
                                            // Warning: Thiết lập này sẽ làm cho phần phân trang bị lỗi, xem thêm: http://codex.wordpress.org/Making_Custom_Queries_using_Offset_and_Pagination
    										// Nếu tham số 'posts_per_page' có giá trị là -1 thì offset sẽ bị bỏ qua.

                                            
    'page' => get_query_var('page'),        // (int) - Số trang hiện tại sử dụng cho Custom Page Template.
                                            
    'ignore_sticky_posts' => false,         // (boolean) - Tuỳ chọn có lấy bài viết được Sticky hay không. Nếu false thì sẽ hiển thị, true thì bỏ qua.

	//////Order & Orderby Parameters - Thiết lập kiểu sắp xếp các bài viết
    //http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters
    'order' => 'DESC',                      //(string) - Thiết lập hiển thị tăng dần hay giảm dần.
                                              //Possible Values:
                                              //'ASC' - Hiển thị kiểu tăng dần (1, 2, 3; a, b, c).
                                              //'DESC' - Hiển thị kiểu giảm dần (3, 2, 1; c, b, a).
    'orderby' => 'date',                    //(string) - Thiết lập loại dữ liệu sẽ được sắp xếp dựa vào. Mặc định nó sẽ là tham số 'date' để dựa vào ngày đăng bài.
                                              //Possible Values:
                                              //'none' - Không sắp xếp
                                              //'ID' - Sắp xếp bởi ID bài viết
                                              //'author' - Sắp xếp bởi tác giả
                                              //'title' - Sắp xếp bởi tiêu đề
                                              //'name' - Sắp xếp bởi slug
                                              //'date' - Sắp xếp bởi ngày tháng
                                              //'modified' - Sắp xếp bởi ngày cập nhật
                                              //'parent' - Sắp xếp bởi ID của page mẹ
                                              //'rand' - Sắp xếp ngaẫu nhiên
                                              //'comment_count' - Sắp xếp bởi số lượng bình luận
                                              //'menu_order' - Sắp xếp bởi thứ tự của trang
                                              //'meta_value' - Sắp xếp bởi giá trị meta data
                                              //'meta_value_num' - Sắp xếp bởi giá trị dạng số tự nhiên của meta data
																							 
//////Date Parameters - Lấy bài viết trong khoảng thời gian cố định
    //http://codex.wordpress.org/Class_Reference/WP_Query#Date_Parameters

    'date_query' => array(                  //(array) - Date parameters (available with Version 3.7).
                                              //these are super powerful. check out the codex for more comprehensive code examples http://codex.wordpress.org/Class_Reference/WP_Query#Date_Parameters
      array(
	    'year' => 2014,                         //(int) - năm cần lấy bài (e.g. 2011).
	    'monthnum' => 4,                        //(int) - Tháng cần lấy bài (from 1 to 12).
	    'w' =>  25,                             //(int) - Số tuần trong năm cần lấy bài (từ 0 đến 53).
	    'day' => 17,                            //(int) - Lấy bài dựa theo ngày trong tháng (từ 1 đến 31).
	    'hour' => 13,                           //(int) - Lấy bài dựa theo giờ trong ngày (từ 0 đến 23).
	    'minute' => 19,                         //(int) - Lấy bài dựa theo phút trong giờ (từ 0 đến 60).
	    'second' => 30,                         //(int) - Lấy bài dựa theo giây trong phút (0 đến 60).
	    'm' => 201404,                          //(int) - Tháng của năm cần lấy bài (Ví dụ: 201307).
        'after'     => 'January 1st, 2013', //(string/array) - Lấy bài viết sau ngày cố định. Có thể sử dụng strtotime()-compatible string, hoặc sử dụng array gồm 'year', 'month', 'day'
        'before'    => array(               //(string/array) - Lấy bài viết trước ngày cố định. Có thể sử dụng strtotime()-compatible string, hoặc sử dụng array gồm 'year', 'month', 'day'
          'year'  => 2013,                  
          'month' => 2,                     
          'day'   => 28,                    
        ),
        'inclusive' => true,                //(boolean) - Nếu sử dụng before và after, sử dụng 'true' nếu muốn bao gồm cả hai tham số.
        'compare' =>  '=',                  //(string) - So sánh giá trị với '=', '!=', '>', '>=', '<', '<=', 'LIKE', 'NOT LIKE', 'IN', 'NOT IN', 'BETWEEN', 'NOT BETWEEN', 'EXISTS' (only in WP >= 3.5), and 'NOT EXISTS' (also only in WP >= 3.5). Default value is '='
        'column' => 'post_date',            //(string) - Cột dữ liệu mà cần gửi query đến, mặc định là 'post_date'
        'relation' => 'AND',                //(string) - OR hoặc AND, sử dụng khi có nhiều array trong date_query để tạo mối quan hệ
      ),
    ),

//////Custom Field Parameters - Lấy bài viết dựa theo custom field
    //http://codex.wordpress.org/Class_Reference/WP_Query#Custom_Field_Parameters
    'meta_key' => 'key',                    //(string) - Lấy bài dựa theo meta key của custom field
    'meta_value' => 'value',                //(string) - Lấy bài dựa theo giá trị của custom field
    'meta_value_num' => 10,                 //(number) - Giá trị của custom field dạng số tự nhiên
    'meta_compare' => '=',                  //(string) - Toán tử để so sánh với 'meta_value'. Có thể sử dụng '!=', '>', '>=', '<', or ='. Mặc định là '='.
    'meta_query' => array(                  //(array)  - Sử dụng nhiều điều kiện lấy bài viết theo custom field 
       'relation' => 'AND',                 //(string) - Mối quan hệ của các array query bên trong, sử dụng 'OR' hoặc 'AND'
       array(
         'key' => 'color',                  //(string) - Tên meta key
         'value' => 'blue'                  //(string/array) - Giá trị meta value
         'type' => 'CHAR',                  //(string) - Loại giá trị. Có thể sử dụng 'NUMERIC', 'BINARY', 'CHAR', 'DATE', 'DATETIME', 'DECIMAL', 'SIGNED', 'TIME', 'UNSIGNED'. Mặc định là 'CHAR'. Tham số 'type' DATE chỉ có thể hoạt động với tham số 'compare' nếu định dạng ngày tháng được sử dụng là YYYYMMDD.
                                            
         'compare' => '='                   //(string) - Toán tử so sánh với giá trị value trong mảng này. Có thể sử dụng '=', '!=', '>', '>=', '<', '<=', 'LIKE', 'NOT LIKE', 'IN', 'NOT IN', 'BETWEEN', 'NOT BETWEEN', 'EXISTS' (only in WP >= 3.5), and 'NOT EXISTS' (also only in WP >= 3.5). Default value is '='.
       ),
       array(
         'key' => 'price',
         'value' => array( 1,200 ),
         'compare' => 'NOT LIKE'
       )
    ), 

//////Caching Parameters
    //http://codex.wordpress.org/Class_Reference/WP_Query#Caching_Parameters
    //NOTE Caching is a good thing. Setting these to false is generally not advised.
    'cache_results' => true,                //(bool) Mặc định là true - Lưu cache của thông tin kết quả query
    'update_post_term_cache' => true,       //(bool) Default is true - Post meta information cache.
    'update_post_meta_cache' => true,       //(bool) Default is true - Post term information cache.
    
    'no_found_rows' => false,               //(bool) Xem thêm: http://flavio.tordini.org/speed-up-wordpress-get_posts-and-query_posts-functions
    

//////Search Parameter - Lấy bài viết dựa theo truy vấn tìm kiếm
    //http://codex.wordpress.org/Class_Reference/WP_Query#Search_Parameter
    's' => $s,                              //(string) - Từ khoá tìm kiếm bài viết. $s chính là biến lưu từ khoá truy vấn tìm kiếm khi tìm thông qua form tìm kiếm.
    'exact' => true,                        //(bool) - Tìm nội dung khớp chính xác với từ khoá tìm kiếm
    'sentence' => true,                     //(bool) - Sử dụng tìm kiếm trong cụm từ
         


);

//////// Vòng lặp 1 đoạn cho bài viết

$the_query = new WP_Query( $args );

// The Loop
if ( $the_query->have_posts() ) :
while ( $the_query->have_posts() ) : $the_query->the_post();
  // Do Stuff
endwhile;
endif;

// Reset Post Data
wp_reset_postdata();

/////////////////  Ví dụ khác 

$my_query = new WP_Query('tag_slug__in=....&offset=0&showposts=10');
while ($my_query->have_posts()): $my_query->the_post();
    global $post;
    $do_not_duplicate[$post->ID] = $post->ID;
    if (has_post_thumbnail()) {
        $large_image_url = wp_get_attachment_image_src(get_post_thumbnail_id(), 'thumbnail');
    }
    $img = ($large_image_url[0] != '') ? $large_image_url[0] : ''; ?>
    <div class="">
        <div class="">
            <img src="<?= $img ?>" width="100%" alt="<?= get_the_title($post->ID) ?> ">
            <a href="<?= get_the_permalink($post->ID) ?>"
               title="<?= get_the_title($post->ID) ?>"><?= get_the_title($post->ID) ?></a>
        </div>
    </div>

<?php endwhile;
wp_reset_query(); 

////////// Gọi menu đơn giản
                        wp_nav_menu(
                            array(
                                'theme_location' => 'main-menu',
                                'menu_id'        => 'main-menu',
                                'menu_class'=>'main-menu',
                            )
                        );
                      

////////////  Thêm class  thẻ li  của menu
/// page nó vào func
function add_classes_on_li($classes, $item, $args) {
  $classes[] = 'title-class-li';
  return $classes;
}
add_filter('nav_menu_css_class','add_classes_on_li',1,3);

//////////////////////   Xóa Tag với Cate
////////////////
///////////////
//// * Page vào function.php
/// * vào cài đặt đường dẫn tĩnh 
///* Save lại domain/tên bài viết
/// done 
// Remove Parent Category from Child Category URL
add_filter('term_link', 'devvn_no_category_parents', 1000, 3);
function devvn_no_category_parents($url, $term, $taxonomy) {
    if($taxonomy == 'category'){
        $term_nicename = $term->slug;
        $url = trailingslashit(get_option( 'home' )) . user_trailingslashit( $term_nicename, 'category' );
    }
    return $url;
}
// Rewrite url mới
function devvn_no_category_parents_rewrite_rules($flash = false) {
    $terms = get_terms( array(
        'taxonomy' => 'category',
        'post_type' => 'post',
        'hide_empty' => false,
    ));
    if($terms && !is_wp_error($terms)){
        foreach ($terms as $term){
            $term_slug = $term->slug;
            add_rewrite_rule($term_slug.'/?$', 'index.php?category_name='.$term_slug,'top');
            add_rewrite_rule($term_slug.'/page/([0-9]{1,})/?$', 'index.php?category_name='.$term_slug.'&paged=$matches[1]','top');
            add_rewrite_rule($term_slug.'/(?:feed/)?(feed|rdf|rss|rss2|atom)/?$', 'index.php?category_name='.$term_slug.'&feed=$matches[1]','top');
        }
    }
    if ($flash == true)
        flush_rewrite_rules(false);
}
add_action('init', 'devvn_no_category_parents_rewrite_rules');
 
/*Sửa lỗi khi tạo mới category bị 404*/
function devvn_new_category_edit_success() {
    devvn_no_category_parents_rewrite_rules(true);
}
add_action('created_category','devvn_new_category_edit_success');
add_action('edited_category','devvn_new_category_edit_success');
add_action('delete_category','devvn_new_category_edit_success');


//////////////////// Redirect 404 về trang chủ
/// vào file 404.php
/// page nó vào header 
/// done

header("HTTP/1.1 301 Moved Permanently");
header("Location: ".get_bloginfo('url'));
exit();



////////////////// Remove title chuyên mục  và tag

add_filter( 'get_the_archive_title', function ($title) {
  if ( is_category() ) {
      $title = single_cat_title( '', false );
  }
  return $title;
});
add_filter( 'get_the_archive_title', function ($title) {
  if ( is_tag() ) {
      $title = single_cat_title( '', false );
  }
  return $title;
});


///////////////////// Custome Post Type

/// ->>>>ra đây cho nó tiện https://generatewp.com/post-type/ sẽ kết hợp với afc là tuyệt nhất

// thường thì mỗi post type sẽ có 1 tên vd sanpham lên khi tạo thêm 1 trường mới thì có 1 tên mới nếu không nó sẽ không hiện thị  register_post_type('sanpham', $args);

// ví dụ cơ bản 

function tao_custom_post_type()
{
 
    /*
     * Biến $label để chứa các text liên quan đến tên hiển thị của Post Type trong Admin
     */
    $label = array(
        'name' => 'Các sản phẩm', //Tên post type dạng số nhiều
        'singular_name' => 'Sản phẩm' //Tên post type dạng số ít
    );
 
    /*
     * Biến $args là những tham số quan trọng trong Post Type
     */
    $args = array(
        'labels' => $label, //Gọi các label trong biến $label ở trên
        'description' => 'Post type đăng sản phẩm', //Mô tả của post type
        'supports' => array(
            'title',
            'editor',
            'excerpt',
            'author',
            'thumbnail',
            'comments',
            'trackbacks',
            'revisions',
            'custom-fields'
        ), //Các tính năng được hỗ trợ trong post type
        'taxonomies' => array( 'category', 'post_tag' ), //Các taxonomy được phép sử dụng để phân loại nội dung
        'hierarchical' => false, //Cho phép phân cấp, nếu là false thì post type này giống như Post, true thì giống như Page
        'public' => true, //Kích hoạt post type
        'show_ui' => true, //Hiển thị khung quản trị như Post/Page
        'show_in_menu' => true, //Hiển thị trên Admin Menu (tay trái)
        'show_in_nav_menus' => true, //Hiển thị trong Appearance -> Menus
        'show_in_admin_bar' => true, //Hiển thị trên thanh Admin bar màu đen.
        'menu_position' => 5, //Thứ tự vị trí hiển thị trong menu (tay trái)
        'menu_icon' => '', //Đường dẫn tới icon sẽ hiển thị
        'can_export' => true, //Có thể export nội dung bằng Tools -> Export
        'has_archive' => true, //Cho phép lưu trữ (month, date, year)
        'exclude_from_search' => false, //Loại bỏ khỏi kết quả tìm kiếm
        'publicly_queryable' => true, //Hiển thị các tham số trong query, phải đặt true
        'capability_type' => 'post' //
    );
 
    register_post_type('sanpham', $args); //Tạo post type với slug tên là sanpham và các tham số trong biến $args ở trên
 
}
/* Kích hoạt hàm tạo custom post type */
add_action('init', 'tao_custom_post_type');

///////////////// Tạo plugin cơ bản 
/////// cấu trúc plugin
/// *css
//* image
//* js
//* lib
//main.php
//readme.txt
//// đoạn này mở đầu file main
/**
 * Plugin Name: My First Plugin Demo // Tên của plugin
 * Plugin URI: http://hocwp.net // Địa chỉ trang chủ của plugin
 * Description: Đây là plugin đầu tiên mà tôi viết dành riêng cho WordPress, chỉ để học tập mà thôi. // Phần mô tả cho plugin
 * Version: 1.0 // Đây là phiên bản đầu tiên của plugin
 * Author: Sau Hi // Tên tác giả, người thực hiện plugin này
 * Author URI: http://sauhi.com // Địa chỉ trang chủ của tác giả
 * License: GPLv2 or later // Thông tin license của plugin, nếu không quan tâm thì bạn cứ để GPLv2 vào đây
 */

/// đoạn này là gọi file nội bộ plugin
function enqueue_scripts_and_styles()
{
  
        wp_register_style( 'hocwp-foundation', get_theme_uri() . '/lib/foundation.css', array(), get_theme_version() );
        wp_register_style( 'hocwp', get_style_uri(), array(), get_theme_version() );
        wp_register_script('my-plugin-script', plugins_url( '/js/script.js', __FILE__ ));
        wp_enqueue_script('mainplugin', plugins_url('/js/main.js', __FILE__), array(), '20151215', true);
 
}
add_action( 'wp_enqueue_scripts', 'enqueue_scripts_and_styles' );

///// 1 ví dụ tạo 1 trang nhập đơn giản


function register_mysettings() {
        register_setting( 'mfpd-settings-group', 'mfpd_option_name' );
}
 
function mfpd_create_menu() {
        add_menu_page('My First Plugin Settings', 'MFPD Settings', 'administrator', __FILE__, 'mfpd_settings_page',plugins_url('/images/icon.png', __FILE__), 1);
        add_action( 'admin_init', 'register_mysettings' );
}
add_action('admin_menu', 'mfpd_create_menu'); 
 
function mfpd_settings_page() {
?>
<div class="wrap">
<h2>Tạo trang cài đặt cho plugin</h2>
<?php if( isset($_GET['settings-updated']) ) { ?>
    <div id="message" class="updated">
        <p><strong><?php _e('Settings saved.') ?></strong></p>
    </div>
<?php } ?>
<form method="post" action="options.php">
    <?php settings_fields( 'mfpd-settings-group' ); ?>
    <table class="form-table">
        <tr valign="top">
        <th scope="row">Tùy chọn cài đặt</th>
        <td><input type="text" name="mfpd_option_name" value="<?php echo get_option('mfpd_option_name'); ?>" /></td>
        </tr>
    </table>
    <?php submit_button(); ?>
</form>
</div>
<?php } 

///////////// List code thường dùng 
the_content(); // lấy bài viết ở single.php là chủ yếu nếu không hiển thị thì ta dùng vòng lặp while
the_title(); // lấy title của bài viết rất hay dùng
get_the_permalink(); // lấy link của bài viết 
get_site_url(); // lấy đường dẫn của site 
wp_trim_words(get_the_excerpt($post->ID),15, '...'); // compo mình rất hay dùng khi mô tả hoặc title quá dài 
get_the_date(); // lấy time của bài viết nhớ chuyển định dạng ở quản trị để được kết quả tương ứng
get_queried_object(); // cũng khá mạnh để lấy bài viết setup từ chỗ khác
get_the_archive_description(); //lấy mô tả cả tag hoặc cate 
get_the_tags(); // lấy thông tin tag từ bài viết thường nó là mảng
wp_get_attachment_image_src(); /// lấy đường dẫn thôi chứ lấy ảnh là nó đưa cả thẻ img thường mình dùng cái này còn custoem được


//////////// cập nhật thời gian mới nhất bài viết 
 $u_time = get_the_time('U'); 
$u_modified_time = get_the_modified_time('U'); 
if ($u_modified_time >= $u_time + 86400) { 
echo "Cập nhật ngày "; 
the_modified_time('d/m/Y'); 
echo " lúc "; 
the_modified_time(); 
echo ""; } s









////////////////////////// continue


