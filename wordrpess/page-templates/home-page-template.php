<?php
/* Template Name: Home page template */

get_header();

?>
<main>
  <?php 
  $hero_title = get_field('add_hero_heading');
  $hero_desc = get_field('add_hero_description');
  $hero_btn = get_field('add_hero_button');
  $hero_img = get_field('add_hero_image');
  if(!empty($hero_title) && !empty($hero_img)):
  ?>

    <section class="hero_section">
      <div class="hero_strip"><canvas id="gradient-canvas"></canvas></div>
      <div class="custom_container">
        <div class="hero_custom_row">
          <div class="left_text">
            <?php if(!empty($hero_title)): ?>
              <h1><?php echo $hero_title; ?></h1>
            <?php endif; ?>
            <?php if(!empty($hero_desc)): ?>
              <p><?php echo $hero_desc; ?></p>
            <?php endif; ?>
            <?php if(!empty($hero_btn)): ?>
              <div class="hero_btn">
                <a class="btn_main" href="<?php echo $hero_btn['url']; ?>"><?php echo $hero_btn['title']; ?></a>
              </div>
            <?php endif; ?>
          </div>
          <div class="right_img">
            <?php if(!empty($hero_img)): ?>
              <div class="hero_img">
                <img src="<?php echo $hero_img['url']; ?>" alt="<?php echo $hero_img['alt']; ?>" title="<?php echo $hero_img['title']; ?>">
              </div>
            <?php endif; ?>
          </div>
        </div>
        <div class="custom_row">
          <?php if(have_rows('add_featurs')): ?>
            <div class="true_line">
              <ul>
                <?php while(have_rows('add_featurs')): the_row(); 
                  $feature = get_sub_field('add_feature');
                  ?>
                <li><?php echo $feature; ?></li>
              <?php endwhile; ?>
              </ul>
            </div>
          <?php endif; ?>
        </div>
      </div>
    </section>
  <?php endif; ?>
<?php
$wc_title = get_field('add_wc_heading');
$wc_content = get_field('add_wc_content');
$wc_btn = get_field('add_wc_button');
$wc_include_title = get_field('add_include_title');
if(!empty($wc_title ) && !empty($wc_content)):
?>
    <section class="why_choose_wp">
      <div class="custom_container">
        <div class="why_choose_row">
          <div class="why_choose_left">
            <?php if(!empty($wc_title)): ?>
              <h2><?php echo $wc_title; ?></h2>
            <?php endif; ?>
            <?php if(!empty($wc_content)): ?>
              <?php echo $wc_content; ?>
            <?php endif; ?>
          </div>
          <div class="why_choose_right">
            <div class="why_choose_inside">
              <?php if(!empty($wc_include_title)): ?>  
                <h4><?php echo $wc_include_title; ?></h4>
              <?php endif; ?>
              <?php if(have_rows('add_include_items')): ?>
                <ul>
                  <?php while(have_rows('add_include_items')): the_row() ?>
                    <li><?php echo get_sub_field('add_item'); ?></li>
                  <?php endwhile; ?>
                </ul>
              <?php endif; ?>
            </div>
          </div>
        </div>
        <?php if(!empty($wc_btn)): ?>
          <div class="why_choose_row">
            <div class="why_choose_btn">
              <a class="btn_main" href="<?php echo $wc_btn['url']; ?>"><?php echo $wc_btn['title']; ?></a>
            </div>
          </div>
        <?php endif; ?>
      </div>
    </section>
<?php endif; ?>

<?php 
$fav_logo_title = get_field('add_fl_heading');
$fav_logo_btn = get_field('add_fl_button');
$fav_logos = get_field('add_logos');
if(!empty($fav_logo_title) && !empty($fav_logo_btn)):
?>

    <section class="favourite_logos">
      <div class="custom_container">
        <div class="favourite_logos_row">
          <?php if(!empty($fav_logo_title)): ?>
          <div class="favourite_logos_title">            
              <h2><?php echo $fav_logo_title; ?></h2>            
          </div>
          <?php endif; ?>
          <?php if(!empty($fav_logos)): ?>
          <div class="logo_list">
            <ul class="logo_box">
              <?php foreach ($fav_logos as $logo) { ?>
                <li><img alt="<?php echo $logo['title']; ?>" title="<?php echo $logo['title']; ?>" src="<?php echo $logo['url']; ?>"></li>
              <?php }?>
              
            </ul>
          </div>
          <?php endif; ?>
        </div>
        <?php if(!empty($fav_logo_btn)): ?>
          <div class="favourite_logos_row">
            <div class="favourite_logos_btn">
              <a class="btn_main" href="<?php echo $fav_logo_btn['url']; ?>"><?php echo $fav_logo_btn['title']; ?></a>
            </div>
          </div>
        <?php endif; ?>
      </div>
    </section>
  <?php endif; ?>
  <?php
  $start_logo_title = get_field('add_sl_heading'); 
  $start_logo_img = get_field('add_sl_image'); 
  if(!empty($start_logo_title) && !empty($start_logo_img)):
  ?>
    <section class="starts_logo">
      <div class="custom_container">
        <div class="starts_logo_row">
          <?php if(!empty($start_logo_title)): ?>
            <div class="starts_logo_title">
              <h2><?php echo $start_logo_title; ?></h2>
            </div>
          <?php endif; ?>
          <?php if(!empty($start_logo_img)): ?>
            <div class="starts_logo_pc">
              <img src="<?php echo $start_logo_img['url']; ?>" title="<?php echo $start_logo_img['title']; ?>" alt="<?php echo $start_logo_img['alt']; ?>">
            </div>
          <?php endif; ?>
        </div>
      </div>
    </section>
    <?php endif; ?>

    <div class="shap_bg">
        <?php 
        $contact_info_content = get_field('add_ci_content_');
        $contact_info_title = get_field('add_ci_heading');
        $contact_info_btn = get_field('add_ci_button');
        if(!empty($contact_info_content) && !empty($contact_info_title)):
        ?>
        <section class="contact_info">
          <div class="custom_container">
            <div class="contact_info_row">
              <?php if(!empty($contact_info_content)): ?>
                <div class="contact_info_left">
                  <?php echo $contact_info_content; ?>
                </div>
              <?php endif; ?>
              <div class="contact_info_right">
                <div class="contact_box">
                  <?php if(!empty($contact_info_title)): ?>
                    <p><?php echo $contact_info_title; ?></p>
                  <?php endif; ?>
                  <?php if(have_rows('add_contact_details')): ?>
                    <ul>
                      <?php 
                      $contact_details_item = 1;
                      $cont_class = '';
                      while(have_rows('add_contact_details')): the_row();
                        if($contact_details_item == 1){
                          $cont_class = 'phone_con';
                        }elseif($contact_details_item == 2){
                          $cont_class = 'email_con';
                        }else{
                          $cont_class = 'contact_icon';
                        }
                        $icon_c = get_sub_field('add_icon');
                        $icon_link_title = get_sub_field('add_link_title');
                      ?>
                      <li class="<?php echo $cont_class; ?>">
                        <span class="icon_contact"><img alt="<?php echo $icon_c['alt']; ?>" title="<?php echo $icon_c['title']; ?>" src="<?php echo $icon_c['url']; ?>"></span>
                        <a href="<?php echo $icon_link_title['url']; ?>"><?php echo $icon_link_title['title']; ?></a>
                      </li>
                      <?php $contact_details_item++; 
                            endwhile; 
                          ?>
                    </ul>
                  <?php endif; ?>
                </div>
                <?php if(!empty($contact_info_btn)): ?>
                  <div class="contact_info_btn">
                    <a class="btn_main" href="<?php echo $contact_info_btn['url']; ?>"><?php echo $contact_info_btn['title']; ?></a>
                  </div>
                <?php endif; ?>
              </div>
            </div>
          </div>
        </section>
      <?php endif;?>
      <?php
      $contact_title = get_field('add_cf_heading');
      $contact_shortcode = get_field('add_form_shortcode');
      if(!empty($contact_title) && !empty( $contact_shortcode) ):
      ?>
      <section class="contact_form">
        <div class="custom_container">
          <div class="contact_form_row">
            <?php if(!empty($contact_title)): ?>
              <div class="contact_form_title">
                <h2><?php echo $contact_title; ?></h2>
              </div>
            <?php endif; ?>
            <?php if(!empty($contact_shortcode)): ?>
              <div class="contact_form_form">
                <?php echo do_shortcode($contact_shortcode); ?>
              </div>
            <?php endif; ?>
          </div>
        </div>
      </section>
    <?php endif; ?>
    </div>
</main>
<?php
get_footer();