<?php require APPROOT . '/views/inc/header.php'; ?>
<link rel="stylesheet" href="../public/css/components/login.css">

<main class="login">
		<section class="login__panel" aria-label="Login form">
			<div class="login__logo">
				<img src="../public/img/login/EvoPlan_Logo_new-removebg-preview 2.svg" alt="EvoPlan" class="login__logo-img">
			</div>
			<h1 class="login__title">Client Login</h1>

			<form class="login__form" action="<?php echo URLROOT; ?>/Clients/login" method="post">
				<label class="form__label" for="email">Email Address</label>
				<input class="form__input" type="email" id="email" name="email" placeholder="you@example.com" required value="<?php echo $data['email']; ?>">
				<span class="form__error"><?php echo $data['email_err']; ?></span>

				<label class="form__label" for="password">Password</label>
				<input class="form__input" type="password" id="password" name="password" placeholder="••••••••" required value="<?php echo $data['password']; ?>">

				<div class="form__row">
					<label class="checkbox">
						<input type="checkbox" name="remember"> <span>Remember Password</span>
					</label>
				</div>

				<button type="submit" class="btn btn--primary">Login</button>
			</form>

			<div class="login__cta">
				<span>Don’t have an account?</span>
				<button class="btn btn--secondary" type="button" onclick="window.location.href='<?php echo URLROOT ?>/Clients/register'">Create</button>
			</div>
		</section>

		<aside class="login__hero" aria-hidden="true"></aside>
	</main>

<?php require APPROOT . '/views/inc/footer.php'; ?>