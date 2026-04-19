<?php require APPROOT . '/views/inc/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/components/login.css">

<main class="login">
	<section class="login__container">
		<div class="login__panel" aria-label="Reset password">
			<div class="login__logo">
				<img src="<?php echo URLROOT; ?>/public/img/LandingPage/Logo.svg" alt="EvoPlan" class="login__logo-img">
			</div>
			<h1 class="login__title">Reset Password</h1>

			<form class="login__form" action="<?php echo URLROOT; ?>/Clients/resetPassword/<?php echo $data['token']; ?>" method="post">
				<div class="form__group">
					<label class="form__label" for="password">New Password</label>
					<input class="form__input" type="password" id="password" name="password" placeholder="••••••••" required>
					<span class="error"><?php echo $data['password_err']; ?></span>
				</div>

				<div class="form__group">
					<label class="form__label" for="confirm_password">Confirm Password</label>
					<input class="form__input" type="password" id="confirm_password" name="confirm_password" placeholder="••••••••" required>
					<span class="error"><?php echo $data['confirm_password_err']; ?></span>
				</div>

				<button type="submit" class="btn btn--primary">Update Password</button>
			</form>

			<div class="login__cta">
				<button class="btn btn--secondary" type="button" onclick="window.location.href='<?php echo URLROOT ?>/Clients/login'">Back to Login</button>
			</div>
		</div>
	</section>
</main>

<?php require APPROOT . '/views/inc/footer.php'; ?>
