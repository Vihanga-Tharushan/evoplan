<?php require APPROOT . '/views/inc/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/components/login.css">

<main class="login">
	<section class="login__container">
		<div class="login__panel" aria-label="Login form">
			<div class="login__logo">
				<img src="<?php echo URLROOT; ?>/public/img/LandingPage/Logo.svg" alt="EvoPlan" class="login__logo-img">
			</div>
			<h1 class="login__title">Service Provider Login</h1>

			<form class="login__form" action="<?php echo URLROOT; ?>/Service/login" method="post">
				<div class="form__group">
					<label class="form__label" for="email">Email Address</label>
					<input class="form__input" type="email" id="email" name="email" placeholder="you@example.com"  value="<?php echo $data['email']; ?>">
					<span class="error"><?php echo $data['email_err']; ?></span>
				</div>

				<div class="form__group">
					<label class="form__label" for="password">Password</label>
					<input class="form__input" type="password" id="password" name="password" placeholder="••••••••"  value="<?php echo $data['password']; ?>">
					<span class="error"><?php echo $data['password_err']; ?></span>
				</div>

				<div class="form__row">
					<label class="checkbox">
						<input type="checkbox" name="remember"> <span>Remember Password</span>
					</label>
				</div>

				<button type="submit" class="btn btn--primary">Login</button>
			</form>

			<div class="login__cta">
				<span>Don’t have an account?</span>
				<button class="btn btn--secondary" type="button" onclick="window.location.href='<?php echo URLROOT ?>/Service/create'">Create Account</button>
			</div>
		</div>
	</section>
	<?php flash('register_success'); ?>
</main>

<?php require APPROOT . '/views/inc/footer.php'; ?>