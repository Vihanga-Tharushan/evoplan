<?php require APPROOT . '/views/inc/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/components/login.css">

<main class="login">
	<section class="login__container">
		<div class="login__panel" aria-label="Forgot password">
			<div class="login__logo">
				<img src="<?php echo URLROOT; ?>/public/img/LandingPage/Logo.svg" alt="EvoPlan" class="login__logo-img">
			</div>
			<h1 class="login__title">Forgot Password</h1>

			<?php flash('reset_link_sent'); ?>

			<form class="login__form" action="<?php echo URLROOT; ?>/Clients/forgotPassword" method="post">
				<div class="form__group">
					<label class="form__label" for="email">Email Address</label>
					<input class="form__input" type="email" id="email" name="email" placeholder="you@example.com" required value="<?php echo $data['email']; ?>">
					<span class="error"><?php echo $data['email_err']; ?></span>
				</div>

				<button type="submit" class="btn btn--primary">Send Reset Link</button>
			</form>

			<div class="login__cta">
				<button class="btn btn--secondary" type="button" onclick="window.location.href='<?php echo URLROOT ?>/Clients/login'">Back to Login</button>
			</div>
		</div>
	</section>
</main>

<?php require APPROOT . '/views/inc/footer.php'; ?>
