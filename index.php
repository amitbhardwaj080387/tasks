<!DOCTYPE html>
<html lang="en" class="demo-loading no-js">
    <head>
        <?php //require_once(SITE_REL_URL.'common/inc/meta_description.php');
        ?>


        <link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri();?>/css/stylesheet.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri();?>/css/owl.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri();?>/css/jquery.fancybox.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri();?>/css/style.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri();?>/css/css3.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri();?>/css/stylish-select.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri();?>/css/layerslider.css"  />
    <link rel="stylesheet" type="text/less" href="<?php echo get_stylesheet_directory_uri();?>/less/bootstrap.less">
    <link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri();?>/css/uploadfile.css"/ >
    <link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri();?>/animation/animate.css">
    <link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri();?>/animation/component.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri();?>/css/bootstrap-switch.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri();?>/css/multiple-select.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri();?>/css/sumoselect.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri();?>/css/cmnCss.css"/>
    <link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri();?>/common/images/favicon.ico" type="image/x-icon">
<link rel="icon" href="<?php echo get_stylesheet_directory_uri();?>/common/images/favicon.ico" type="image/x-icon">
    <script type="text/javascript" src="<?php echo get_stylesheet_directory_uri();?>/js/optimized/jquery.min.js"></script>

 <script type="text/javascript" src="<?php echo get_stylesheet_directory_uri();?>/js/optimized/angular.min.js"></script>



        <link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri();?>/css/mytab.css" />
        <script>
    SITE_ROOT_URL='http://beta.vinove.com/pixel/';
      </script>
      <title><?php echo get_the_title();?></title>
        <?php wp_head();?>
    </head>
    <body class="casestudies-main">
<!--  include url.php code-->

      <?php require_once('URL.php'); ?>
        <div class="outer_layout">
            <div class="inner_layout">
                <?php require_once('header.inc.php'); ?>
                <section class="case-outer">
                    <section class="case-banner">
                        <div class="container">
                            <div class="breadcrumb-sec-main">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <ul class="breadcrumb-main">
                                            <li><a href="<?php echo $url['home']?>">Home</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="banner-cont">
                                <h1>case studies</h1>
                                <div class="tab-main" style="display:inline-block !important;">
                                  <!--  bootstrap content tab-->



                                    <!--tabbing with accordian-->
                                    <ul class="tabs">
                                      <!--  populate categories -->
                                      <?php
                                      $categories = new WP_Query(['cat'=>'8,12,16']);
                                      //print "<pre>";//print_r($categories);
                                      $arr = $categories->query;
                                      $sep_element = explode(',',$arr['cat']);
                                      for($i=0;$i<count($sep_element);$i++){
                                        $j = $i +1;
                                        if($j==1){
                                          echo "<li rel='tab$j' class='active'>".get_cat_name($sep_element[$i])."</li>";
                                        }else{
                                          echo "<li rel='tab$j'>".get_cat_name($sep_element[$i])."</li>";
                                        }
                                      }


                                    ?>

                                        <!-- <li class="active" rel="tab1">Services</li>
                                        <li rel="tab2">Solutions</li>
                                        <li rel="tab3">Technologies</li> -->
                                    </ul>
                                    <div class="tab_container">
                                        <h3 class="accord_active accordian" rel="tab1">Services</h3>
                                        <!-- fetch sub categories -->
                                        <?php
                                        $cat = new WP_Query(['cat'=>'8,12,16']);
                                        //print "<pre>";//print_r($categories);
                                        $ret_arr = $cat->query;
                                        $sep_cat_element = explode(',',$ret_arr['cat']);
                                      //  print "<pre>";?>





                                  <?php      for($i=0;$i<count($sep_cat_element);$i++){
                                          $j = $i +1;
                                        echo "<div id='tab$j' class='tab_content'>";
                                        echo " <div class='list-main'>";
                                        // get child category of each parent
                                          $ret = get_term_children( $sep_cat_element[$i],'category');
                                          ?>
                                        <div id="filters<?php echo $j; ?>" class="button-group">
                                        <?php
                                          foreach ( $ret as $ret_child ) {
                                          	$term = get_term_by( 'id', $ret_child, 'category' );
                                            ?>

                                            <button class="button" data-filter=".<?php  echo $term->slug; ?>"><?php  echo $term->name; ?></button>
                                      <?php    }
                                      echo '</div>';

                                        echo "</div>";
                                        echo "</div>";


                                        }


                                      ?>


                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <section class="project-list-M">
                        <div class="container">
                          <?php
                          query_posts(array(
                                    				'post_type' => 'post',
                                    				'post_status'=>'publish',
                                            'order'=>'ASC',
                                            'meta_key'=>'display_on_home_page',
                                            'meta_value'=>'yes',
                                    				) );

                          if(have_posts()):
                            $i=0;
                            while(have_posts()):
                              the_post();

                              $term_list = wp_get_post_terms(get_the_ID(), 'category', array("fields" => "all"));


                          $big_image = get_field('full_size_image');
                          $small_image = get_field('small_image');
                          ?>

                            <?php if($i==0 || $i==1):?>
                            <div class="row grid">
                          <?php endif; ?>
                              <!-- single element -->
                                <div class="col-sm-<?php if($i==0){ echo "12";}else if($i==1){ echo "6";}else if($i==2){
                                  echo "6";
                                }?> element-item <?php echo $term_list[0]->slug; ?>">

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
<?php if($i==1) echo "</div>";?>


                        <?php endif;?>

                            <!-- Start Load More Section -->
                            <div class="container">
                            <div class="row" id="load_posts">

                            </div></div>
                            <a href="javascript:void(0);" class="btn" id="load_more_post"><img src="<?php echo get_stylesheet_directory_uri() ?>/common/images/ajax-loader.gif" id="loaderImg" style="display: none;"> Load More</a>
                                <input type="hidden" id="pageNumber" value="1">
                                <input type="hidden" id="pageNumberMobile" value="1">

                            <!-- End Load More Section -->

                            <!--  Load more section js starts-->
                            <script type="text/javascript">
                                jQuery(function($){

                                    $("#load_more_post").click(function(){
                                        $("#loaderImg").show();
                                        var pageNumber = $("#pageNumberMobile").val();
                                        var pageNum = $("#pageNumber").val();

                                        $("#pageNumber").val(parseInt(pageNum)+1);
                                        $("#pageNumberMobile").val(parseInt(pageNumber)+1);

                                        var ajaxurl = "<?php echo admin_url( 'admin-ajax.php' ) ?>";
                                        $.ajax({
                                            type:"post",
                                            url:ajaxurl,
                                            data:{pageNumber: pageNumber, numPosts: 6, action: 'load_more_post_all' },
                                            success:function(data){
                                                $("#loaderImg").hide();
                                                $("#load_posts").append(data);
                                            }
                                        })
                                    })
                                });
                            </script>
                            <!--  Load more section js ends-->
                        </div>
                    </section>
                </section>
                <?php require_once('footer.inc.php'); ?>
            </div>
        </div>
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri();?>/js/jquery-3.3.1.min.js"></script>
        <script src="<?php echo get_stylesheet_directory_uri();?>/js/mytab.js"></script>
        <script type="text/javascript" src="<?php echo get_stylesheet_directory_uri();?>/js/isotope.pkgd.js"></script>
        <script type="text/javascript" src="<?php echo get_stylesheet_directory_uri();?>/js/index.js"></script>
        <?php wp_footer();?>
    </body>
</html>
