<?php echo view('App\Modules\Main\Views\partials\head-main'); ?>

<head>
	<meta charset="utf-8" />
	<title>Trans Semarang | Login Authentication | </title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta content=" Trans Semarang | Login Authentication" name="description" />
	<meta content=" PT. Nusantara Global Inovasi" name="author" />
	<link rel="shortcut icon" href="<?= base_url() ?>/assets/images/icon-smg.webp">
	<?php echo view('App\Modules\Main\Views\partials\head-css'); ?>
	<link href="assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />
	<script>
		document.addEventListener('DOMContentLoaded', (event) => {
			const titleText = "Trans Semarang | Login Authentication | ";
			let i = 0;

			function scrollTitle() {
				document.title = titleText.substring(i) + " " + titleText.substring(0, i);
				i = (i + 1) % titleText.length;
				setTimeout(scrollTitle, 300); // Adjust the delay (in milliseconds) for speed
			}
			scrollTitle();
		});
	</script>
</head>
<style>
	.bg-primary,
	.btn-primary {
		background-color: #224DDD !important;
	}

	.auth-bg {
		/* background-image: url('https://transsemarang.semarangkota.go.id/data_slider/1669966536_641(1).jpg') !important; */
		background-image: url('https://transsemarang.semarangkota.go.id/data_slider/1669974741_bandara.jpg') !important;
		background-size: cover !important;
	}
</style>
<?php echo view('App\Modules\Main\Views\partials\body'); ?>
<div class="auth-page">
	<div class="container-fluid p-0">
		<div class="row g-0">
			<div class="col-xxl-3 col-lg-4 col-md-5">
				<div class="auth-full-page-content d-flex p-sm-5 p-4">
					<div class="w-100">
						<div class="d-flex flex-column h-100 text-center">
							<div class="mb-4 mb-md-5 text-center">
								<a href="/" class="d-block auth-logo rounded">
									<img class="rounded" src="assets/images/icon-smg.webp" alt="" height="28"> <span class="logo-txt">Trans Semarang</span>
								</a>
							</div>
							<div class="auth-content my-auto">
								<div class="text-center">
									<h5 class="mb-0">Welcome Back !</h5>
									<p class="text-muted mt-2">Sign in to continue</p>
								</div>
								<form id="form-login" class="custom-form mt-4 pt-2" method="POST" enctype="multipart/form-data" action="<?= base_url() ?>/main">
									<?= csrf_field() ?>
									<div class="mb-3">
										<label class="form-label">Username</label>
										<input type="text" class="form-control" id="username" name="username" placeholder="Enter username">
									</div>
									<div class="mb-3">
										<div class="d-flex align-items-start">
											<div class="flex-grow-1">
												<label class="form-label">Password</label>
											</div>
										</div>
										<div class="input-group auth-pass-inputgroup">
											<input type="password" class="form-control" id="password" name="password" placeholder="Enter password" aria-label="Password" aria-describedby="password-addon">
											<button class="btn btn-light ms-0" type="button" id="password-addon"><i class="mdi mdi-eye-outline"></i></button>
										</div>
									</div>
									<!-- <div class="mb-3">
										<button type="submit" class="btn btn-primary w-100 waves-effect waves-light g-recaptcha" data-sitekey="<?= getenv('RECAPTCHA_SITE_KEY') ?>" data-callback='onSubmit' data-action='submit'>Masuk</button>
									</div> -->
									<div class="mb-3">
										<button type="submit" class="btn btn-primary w-100 waves-effect waves-light" onclick="onSubmit()">Masuk</button>
									</div>
								</form>
								<!-- <div class="d-flex flex-column position-relative text-center ">
									<div class="mb-3 align-self-center justify-content-center ">
										<p class="mb-0">Atau masuk dengan</p>
									</div>
									<div class="row">
										<div class="col-lg-12">
											<div class="w-100 text-center d-flex justify-content-center align-items-center" id="buttonDiv"></div>
										</div>
									</div>
								</div> -->
							</div>
							<div class="mt-4 mt-md-5 text-center">
								<p class="mb-0">© <script>
										document.write(new Date().getFullYear())
									</script> Trans Semarang. All rights reserved.</p>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xxl-9 col-lg-8 col-md-7">
				<div class="auth-bg pt-md-5 p-4 d-flex">
					<div class="bg-overlay" style="background: #DC143C;"></div>
					<ul class="bg-bubbles">
						<li></li>
						<li></li>
						<li></li>
						<li></li>
						<li></li>
						<li></li>
						<li></li>
						<li></li>
						<li></li>
						<li></li>
					</ul>
					<div class="row justify-content-center align-items-center">
						<div class="col-xl-12">
							<div class="p-0 p-sm-4 px-xl-0">
								<div id="reviewcarouselIndicators" class="carousel slide" data-bs-ride="carousel">
									<div class="carousel-indicators carousel-indicators-rounded justify-content-start ms-0 mb-0">
										<button type="button" data-bs-target="#reviewcarouselIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
										<button type="button" data-bs-target="#reviewcarouselIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
										<button type="button" data-bs-target="#reviewcarouselIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
										<button type="button" data-bs-target="#reviewcarouselIndicators" data-bs-slide-to="3" aria-label="Slide 4"></button>
										<button type="button" data-bs-target="#reviewcarouselIndicators" data-bs-slide-to="4" aria-label="Slide 5"></button>
									</div>
									<div class="carousel-inner">
										<div class="carousel-item active">
											<div class="testi-contain text-white">
												<i class="bx bxs-quote-alt-left text-success display-6"></i>
												<h4 class="mt-4 fw-medium lh-base text-white"></h4>
												<div class="mt-4 pt-3 pb-5">
													<div class="d-flex align-items-center">
														<div class="flex-shrink-0">
															<img src="assets/images/icon-smg.webp" class="avatar-md img-fluid W-25 rounded">
														</div>
														<div class="flex-grow-1 ms-3">
															<h5 class="font-size-18 text-white">Trans Semarang</h5>
															<p class="mb-0 text-white-50"></p>
														</div>
													</div>
												</div>
											</div>
										</div>
										<!-- <div class="carousel-item">
											<div class="testi-contain text-white">
												<i class="bx bxs-quote-alt-left text-success display-6"></i>

												<h4 class="mt-4 fw-medium lh-base text-white"></h4>
												<div class="mt-4 pt-3 pb-5">
													<div class="d-flex align-items-center">
														<img src="assets/images/NGI.PNG" class="avatar-md img-fluid rounded-circle" alt="...">
														<div class="flex-1 ms-3">
															<h5 class="font-size-18 text-white">Trans Semarang</h5>
															<p class="mb-0 text-white-50"></p>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="carousel-item">
											<div class="testi-contain text-white">
												<i class="bx bxs-quote-alt-left text-success display-6"></i>

												<h4 class="mt-4 fw-medium lh-base text-white"></h4>
												<div class="mt-4 pt-3 pb-5">
													<div class="d-flex align-items-center">
														<div class="flex-shrink-0">
															<img src="assets/img/DISHUB-Logo.png" class="avatar-md img-fluid rounded-circle" style="height: 55px !important;" alt="...">
														</div>
														<div class="flex-grow-1 ms-3">
															<h5 class="font-size-18 text-white">Trans Semarang</h5>
															<p class="mb-0 text-white-50"></p>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="carousel-item">
											<div class="testi-contain text-white">
												<i class="bx bxs-quote-alt-left text-success display-6"></i>

												<h4 class="mt-4 fw-medium lh-base text-white"></h4>
												<div class="mt-4 pt-3 pb-5">
													<div class="d-flex align-items-center">
														<div class="flex-shrink-0">
															<img src="assets/img/Logo_KSPN.png" class="avatar-md img-fluid rounded-circle w-100" alt="KSPN">
														</div>
														<div class="flex-grow-1 ms-3">
															<h5 class="font-size-18 text-white">Trans Semarang</h5>
															<p class="mb-0 text-white-50"></p>
														</div>
													</div>
												</div>
											</div>
										</div> -->
										<!-- <div class="carousel-item">
											<div class="testi-contain text-white">
												<i class="bx bxs-quote-alt-left text-success display-6"></i>

												<h4 class="mt-4 fw-medium lh-base text-white"></h4>
												<div class="mt-4 pt-3 pb-5">
													<div class="d-flex align-items-center">
														<div class="flex-shrink-0">
															<img src="assets/img/Logo_Teman_Bus.png" class="avatar-md img-fluid w-100" alt="TemanBus">
														</div>
														<div class="flex-grow-1 ms-3">
															<h5 class="font-size-18 text-white">Trans Semarang</h5>
															<p class="mb-0 text-white-50"></p>
														</div>
													</div>
												</div>
											</div>
										</div> -->
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- JAVASCRIPT -->
<?php echo view('App\Modules\Main\Views\partials\vendor-scripts'); ?>
<script src="<?= site_url() ?>assets/js/pages/pass-addon.init.js"></script>
<!-- <script src="https://accounts.google.com/gsi/client" async defer></script> -->
<!-- <script src="https://www.google.com/recaptcha/api.js?render=<?= getenv('RECAPTCHA_SITE_KEY') ?>"></script> -->
<script type="text/javascript">
	$(document).ready(function() {
		// window.onload = function() {
		// 	google.accounts.id.initialize({
		// 		client_id: "884122324633-u06ijjlch1912n0l09f7gnkkqlj289ci.apps.googleusercontent.com",
		// 		callback: handleCredentialResponse
		// 	});

		// 	google.accounts.id.renderButton(
		// 		document.getElementById("buttonDiv"), {
		// 			theme: "outline",
		// 			size: "large",
		// 			locale: "id",
		// 		}
		// 	);
		// 	$('#username').focus();
		// 	// google.accounts.id.prompt(); // also display the One Tap dialog
		// }
	});

	// function handleCredentialResponse(response) {
	// 	let jwt = parseJwt(response.credential)
	// 	let email = jwt.email;

	// 	loginWithGoogle(email);
	// }

	// function loginWithGoogle(email) {
	// 	Swal.fire({
	// 		title: "",
	// 		icon: "info",
	// 		text: "Mohon ditunggu...",
	// 		onOpen: function() {
	// 			Swal.showLoading()
	// 		}
	// 	})

	// 	var url = '<?= base_url() ?>/auth/action/loginGoogle';

	// 	$.post(url, {
	// 		email: email,
	// 		"<?= csrf_token() ?>": "<?= csrf_hash() ?>"
	// 	}, function(data) {
	// 		var ret = $.parseJSON(data);
	// 		swal.close();
	// 		if (ret.success) {
	// 			window.location = "<?= base_url() ?>/main";
	// 		} else {
	// 			Swal.fire({
	// 				title: ret.title,
	// 				text: ret.text,
	// 				icon: 'error',
	// 				showConfirmButton: false,
	// 				timer: 2500
	// 			})
	// 		}
	// 	}).fail(function(data) {
	// 		swal.close();
	// 		Swal.fire({
	// 			title: 'Error',
	// 			text: 'Sesi Anda telah berakhir, silahkan refresh halaman ini',
	// 			icon: 'error',
	// 			showConfirmButton: false,
	// 			timer: 2500
	// 		})
	// 	});
	// }

	function parseJwt(token) {
		var base64Url = token.split('.')[1];
		var base64 = base64Url.replace(/-/g, '+').replace(/_/g, '/');
		var jsonPayload = decodeURIComponent(window.atob(base64).split('').map(function(c) {
			return '%' + ('00' + c.charCodeAt(0).toString(16)).slice(-2);
		}).join(''));

		return JSON.parse(jsonPayload);
	};


	function onSubmit(token) {
		var $form = $("#form-login");

		Swal.fire({
			title: "",
			icon: "info",
			text: "Mohon ditunggu...",
			willOpen: function() {
				Swal.showLoading()
			}
		});

		var url = '<?= base_url() ?>/auth/action/login';

		// Include the reCAPTCHA v3 token in the form data
		$form.append('<input type="hidden" name="recaptcha_token" value="' + token + '">');

		// Submit the form
		$.post(url, $form.serialize(), function(data) {
			var ret = $.parseJSON(data);
			swal.close();
			if (ret.success) {
				window.location = "<?= base_url() ?>/main";
			} else {
				Swal.fire({
					title: ret.title,
					text: ret.text,
					icon: 'warning',
					showConfirmButton: false,
					timer: 1500
				});
			}
		}).fail(function(data) {
			swal.close();
			Swal.fire({
				title: 'Perhatian!',
				text: '404 Halaman Tidak Ditemukan',
				icon: 'warning',
				showConfirmButton: false,
				timer: 1500
			});
		});

		// grecaptcha.ready(function() {
		// 	grecaptcha.execute('<?= getenv('RECAPTCHA_SITE_KEY') ?>', {
		// 		action: 'login'
		// 	}).then(function(token) {

		// 		Swal.fire({
		// 			title: "",
		// 			icon: "info",
		// 			text: "Mohon ditunggu...",
		// 			willOpen: function() {
		// 				Swal.showLoading()
		// 			}
		// 		});

		// 		var url = '<?= base_url() ?>/auth/action/login';

		// 		// Include the reCAPTCHA v3 token in the form data
		// 		$form.append('<input type="hidden" name="recaptcha_token" value="' + token + '">');

		// 		// Submit the form
		// 		$.post(url, $form.serialize(), function(data) {
		// 			var ret = $.parseJSON(data);
		// 			swal.close();
		// 			if (ret.success) {
		// 				window.location = "<?= base_url() ?>/main";
		// 			} else {
		// 				Swal.fire({
		// 					title: ret.title,
		// 					text: ret.text,
		// 					icon: 'warning',
		// 					showConfirmButton: false,
		// 					timer: 1500
		// 				});
		// 			}
		// 		}).fail(function(data) {
		// 			swal.close();
		// 			Swal.fire({
		// 				title: 'Perhatian!',
		// 				text: '404 Halaman Tidak Ditemukan',
		// 				icon: 'warning',
		// 				showConfirmButton: false,
		// 				timer: 1500
		// 			});
		// 		});
		// 	});
		// });
	}
</script>
</body>

</html>