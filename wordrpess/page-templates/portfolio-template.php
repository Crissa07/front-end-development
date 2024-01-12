<?php
/* Template Name: Portfolio template */

get_header();

?>
<?php
	$site_url = get_site_url(); 
  $hero_img = get_field('add_hero_bg_img');
	?>

<main>
    <section class="sub_bredcome">
     <?php if(!empty($hero_img)): ?>   
      <div class="subpage_hero">
        <img alt="<?php echo $hero_img['alt']; ?>" src="<?php echo $hero_img['url']; ?>" title="<?php echo $hero_img['title']; ?>">
      </div>
    <?php endif; ?>
    <div class="custom_container">
        <div class="sub_bredcome_row">
            <?php
            // Get the ACF field values
            $hero_title = get_field('add_hero_title');
            $hero_description = get_field('add_hero_description');
            $nh_heading = get_field('add_nh_heading','option');
            $contact_details = get_field('add_contact_details','option');
            
            // Check if hero_title is not empty, and display sub_bredcome_text
            if (!empty($hero_title) && !empty($hero_description) ) :
            ?>
            <div class="sub_bredcome_text">
                <h1><?php echo $hero_title; ?></h1>
                
                <p><?php echo $hero_description; ?></p>
            </div>
            <?php endif; ?>

            <div class="sub_bredcome_info">
                <p><?php echo $nh_heading; ?></p>
                <?php if ($contact_details): ?>
                <ul>
                  <?php
                  // Loop through the contact_details repeater field                    
                    $cont_items = 1;
                      foreach ($contact_details as $contact_detail) :
                          $add_icon = $contact_detail['add_icon'];
                          $add_title_and_url = $contact_detail['add_title_and_url'];
                          if($cont_items == 1){
                            $cust_class = 'phone_con';
                          }elseif($cont_items == 2){
                            $cust_class = 'email_con';
                          }else{
                            $cust_class = 'cont_details';
                          }
                          ?>
                          <li class="<?php echo $cust_class; ?>">
                              <span class="icon_contact"><img alt="<?php echo $add_icon['alt']; ?>" title="<?php echo $add_icon['title']; ?>" src="<?php echo $add_icon['url']; ?>"></span>
                              <a href="<?php echo $add_title_and_url['url']; ?>"><?php echo $add_title_and_url['title']; ?></a>
                          </li>
                      <?php $cont_items++;  endforeach; ?>                    
                </ul>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<?php 
$portfolio_logos = get_field('add_portfolio_logos');
$protfolio_btn = get_field('add_button');
?>
    <section class="portfolio favourite_logos">
      <div class="custom_container">
        <?php if(!empty($portfolio_logos)): ?>
        <div class="favourite_logos_row">
          <div class="logo_list">
            <ul class="logo_box">
              <?php foreach ($portfolio_logos as $logo) { ?>
                <li><img alt="<?php echo $logo['title']; ?>" title="<?php echo $logo['title']; ?>" src="<?php echo $logo['url']; ?>"></li>
              <?php }?>
              
            </ul>
          </div>
        </div>
         <?php endif; ?>
         <?php if(!empty($protfolio_btn)): ?>
            <div class="favourite_logos_row">
              <div class="favourite_logos_btn">
                <a class="btn_main" href="<?php echo $protfolio_btn['url']; ?>"><?php echo $protfolio_btn['title']; ?></a>
              </div>
            </div>
          <?php endif; ?>
      </div>
    </section>
  </main>

<?php
get_footer();