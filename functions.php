<?php
 add_action('wp_ajax_load_more_post_all','load_more_post_all');
 add_action('wp_ajax_load_more_post_all','load_more_post_all');
// add_action('init','load_jquery_lib');
// function load_jquery_lib(){
//
//     wp_enqueue_script('jquery2',get_stylesheet_directory_uri().'/js/jquery-3.3.1.min.js');
// }
// function custom_action(){
// echo "success";
// }
function load_more_post_all(){
    // Our variables
    $numPosts = (isset($_POST['numPosts'])) ? $_POST['numPosts'] : 8;
    $paged = (isset($_POST['pageNumber'])) ? $_POST['pageNumber'] : 1;
    $query_args = array(
        'post_type' => 'post',
        'posts_per_page' => $numPosts,
        'paged' => $paged,

    );
    // create a new instance of WP_Query

    $my_query = new WP_Query( $query_args );


    while ($my_query->have_posts()) : $my_query->the_post();?>

<!--        section to display posts-->
        <?php
        $big_image = get_field('full_size_image');
        $small_image = get_field('small_image');
        ?>
        <?php if($i==0 || $i==1):?>
            <?php endif;?>
    <div class="col-sm-<?php if($i==0){ echo "12";}else if($i==1){ echo "6";}else if($i==2){
        echo "6";
    }?>">

        <div class="projectBox" style='background:url("<?php if($i==0){echo $big_image['url'];}else if($i==1){echo $small_image['url'];}else if($i==2){echo $small_image['url'];}?>");'>
            <a href="<?php the_permalink();?>">
                <div class="taglist">
                    <?php $tags = get_the_tags(get_the_ID());?>
                    <?php
                    $count = 0;
                    foreach( $tags as $tag ) {
                        $count++;
                        if ($count<5) {
                            echo "<span>".$tag->name."</span>";
                        }

                    }?>
                </div>
                <div class="projectBox-content">


                    <h3><?php the_title();?></h3>
                    <p><?php echo get_field('short_description',get_the_ID(),true);?></p>

                </div>
            </a>

            <?php $frontend = get_field_object('frontend');
            $value = $frontend['value'];
            if($value['value']=='yes'){
                ?>
                <!-- fancy box  -->
                <div class="portfolio_overlay">
                    <div class="detail_box">
                        <ul class="detail_links">
                            <li><a class="html_icon fancybox htmlcontent" data-fancybox-group="gallery" onclick="getHtml('html1', 'http://www.projectshell.com/frontend/kopin/v0.1/')" href="#html1">View HTML</a></li>
                            <li><a class="css_icon fancybox csscontent" data-fancybox-group="gallery" onclick="getHtml('css1', 'http://www.projectshell.com/frontend/kopin/v0.1/common/css/layout.css')" href="#css1">View CSS</a></li>
                            <li><a class="view_more fancybox imgcontent imgcontent" data-fancybox-group="gallery" onclick="showPreview('https://www.projectshell.com/frontend/kopin/v0.1/')" href="#website1"><span class="">Preview</span></a></li>
                        </ul>
                    </div>
                </div>
                <!-- end of fancy box -->
            <?php }?>
        </div>


        <?php if($i==0 || $i==2):?>
            </div>

        <?php endif;
        if($i<2)
        {
            $i++;
        }
        else{
            $i=0;
        }
        ?>




        <!--  end of single element-->
        </div>


    <?php endwhile;?>
<?php if($i==1) echo "</div>";
    die(0);
}
?>
