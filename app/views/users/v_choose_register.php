<?php require APPROOT . '/views/inc/header.php'; ?>
<link rel="stylesheet" href="../public/css/components/choose_register.css">

	<main class="choose">
		<header class="choose__header">
			<a href="#" class="choose__brand" aria-label="EvoPlan Home">
				<img src="../public/img/choose_register/EvoPlan_Logo_new-removebg-preview 2.svg" alt="EvoPlan" class="choose__logo">
			</a>
		</header>

		<section class="hero" aria-label="Intro">
			<div class="hero__overlay"></div>
			<div class="hero__content">
				<h1 class="hero__title">From Idea to Action Plan Your Event Seamlessly</h1>
				<p class="hero__subtitle">A space where anyone can plan unforgettable events and professionals showcase their best work</p>
				<div class="hero__actions">

					<form method="post" action="<?php echo URLROOT; ?>/Users/choose_register">
						<button class="btn btn--light">I’m a Client</button>
					</form>

                <form action="<?php echo URLROOT; ?>/Service/create">
					<button class="btn btn--accent">I’m a Service Provider</button>
				</form>
				</div>
			</div>
		</section>

		<section class="how" aria-label="How it works">
			<h2 class="how__title">How It Works</h2>
			<p class="how__desc">Evoplan bridges the gap between your services and those looking to create unforgettable events</p>
		</section>

		<section class="cards" aria-label="Audiences">
			<article class="card card--providers">
				<header class="card__header">
					<div class="card__icon" aria-hidden="true"></div>
					<h3 class="card__title">For Service Providers</h3>
				</header>
				<ul class="card__list">
					<li>Create your webpage and professional portfolio</li>
					<li>Manage bookings, sessions and client communications</li>
					<li>Generate and send professional invoices</li>
					<li>Receive payments according to event type</li>
				</ul>
                <form method="post" action="<?php echo URLROOT; ?>/Service/create">
                    <button class="btn btn--pill">Get Started</button>
                </form>
			</article>

			<article class="card card--clients">
				<header class="card__header">
					<div class="card__icon" aria-hidden="true"></div>
					<h3 class="card__title">For Clients</h3>
				</header>
				<ul class="card__list">
					<li>Browse professional service Providers in your area</li>
					<li>Calculate the budget according to selected services</li>
					<li>Book sessions directly through the platform</li>
					<li>Explore best service packages</li>
				</ul>
                <form method="post" action="<?php echo URLROOT; ?>/Users/choose_register">
					<button class="btn btn--pill">Find a Service Providers</button>
				</form>
			</article>
		</section>
	</main>

<?php require APPROOT . '/views/inc/footer.php'; ?>