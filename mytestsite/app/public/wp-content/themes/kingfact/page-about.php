<?php
/*
Template Name: About — Profile / Vision / Mission / Why Us
Description: Custom About page template with Profile, Vision, Mission and Why Us sections.
*/
get_header();
?>

<main id="about-page" class="site-main">

  <!-- Hero / Header -->
  <section class="about-hero">
    <div class="container">
      <h1 class="about-title"><?php the_title(); ?></h1>
      <p class="about-sub">Learn who we are and why we do what we do.</p>
    </div>
  </section>

  <!-- Profile -->
  <section id="about-profile" class="about-section container">
    <div class="row">
      <div class="col-6">
        <div class="profile-image">
          <!-- Replace src with theme image or use featured image -->
          <img src="<?php echo get_template_directory_uri(); ?>/assets/img/about/profile.jpg" alt="Profile">
        </div>
      </div>
      <div class="col-6">
        <h2>Profile</h2>
        <p>Short summary about the company / person. Use this area to introduce your history, core capabilities and what makes you unique.</p>
        <ul class="profile-list">
          <li><strong>Founded:</strong> 2010</li>
          <li><strong>Industry:</strong> Construction & Manufacturing</li>
          <li><strong>Location:</strong> New York</li>
        </ul>
      </div>
    </div>
  </section>

  <!-- Vision -->
  <section id="about-vision" class="about-section bg-light">
    <div class="container">
      <div class="row align-center">
        <div class="col-12 text-center">
          <h2>Vision</h2>
          <p class="lead">To be the world’s most trusted industrial partner — delivering safe, efficient and sustainable solutions.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Mission -->
  <section id="about-mission" class="about-section container">
    <div class="row">
      <div class="col-6">
        <h2>Mission</h2>
        <p>We deliver tailored engineering, construction and maintenance solutions that empower our clients to grow with confidence.</p>
        <ol class="mission-list">
          <li>Deliver projects on time and on budget</li>
          <li>Maintain highest safety & compliance standards</li>
          <li>Continuously innovate and reduce environmental impact</li>
        </ol>
      </div>
      <div class="col-6">
        <div class="mission-image">
          <img src="<?php echo get_template_directory_uri(); ?>/assets/img/about/mission.jpg" alt="Mission">
        </div>
      </div>
    </div>
  </section>

  <!-- Why Us / Our Goals -->
  <section id="about-why-us" class="about-section bg-accent">
    <div class="container">
      <h2 class="text-center">Why Us / Our Goals</h2>

      <div class="row goals-row">
        <div class="col-3 goal">
          <h3>Expertise</h3>
          <p>Decades of field experience across major industries.</p>
        </div>
        <div class="col-3 goal">
          <h3>Quality</h3>
          <p>Certified processes, QA and strict inspection.</p>
        </div>
        <div class="col-3 goal">
          <h3>Safety</h3>
          <p>Safety-first culture, zero-tolerance approach to risk.</p>
        </div>
        <div class="col-3 goal">
          <h3>Sustainability</h3>
          <p>Eco-conscious engineering and resource optimization.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- CTA / Contact -->
  <section id="about-cta" class="about-section container">
    <div class="row">
      <div class="col-12 text-center">
        <a class="b-btn btn-black" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">Contact Us</a>
      </div>
    </div>
  </section>

</main>

<?php get_footer(); ?>
