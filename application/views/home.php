<!DOCTYPE html>
<html lang="id" class="no-js">

<head>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<link rel="shortcut icon" href="<?= base_url('assets') ?>/img/fav.png" />
	<meta name="author" content="colorlib" />
	<meta name="description" content="" />
	<meta name="keywords" content="" />
	<meta charset="UTF-8" />
	<title><?= $title ?></title>

	<link href="https://fonts.googleapis.com/css?family=Playfair+Display:900|Roboto:400,400i,500,700" rel="stylesheet" />
	<link rel="stylesheet" href="<?= base_url('assets') ?>/css/linearicons.css" />
	<link rel="stylesheet" href="<?= base_url('assets') ?>/css/font-awesome.min.css" />
	<link rel="stylesheet" href="<?= base_url('assets') ?>/css/bootstrap.css" />
	<link rel="stylesheet" href="<?= base_url('assets') ?>/css/magnific-popup.css" />
	<link rel="stylesheet" href="<?= base_url('assets') ?>/css/owl.carousel.css" />
	<link rel="stylesheet" href="<?= base_url('assets') ?>/css/nice-select.css">
	<link rel="stylesheet" href="<?= base_url('assets') ?>/css/hexagons.min.css" />
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/themify-icons/0.1.2/css/themify-icons.css" />
	<link rel="stylesheet" href="<?= base_url('assets') ?>/css/main.css" />
	<script src="<?= base_url('assets') ?>/js/vendor/jquery-2.2.4.min.js"></script>

</head>

<body>
	<header class="default-header">
		<nav class="navbar navbar-expand-lg  navbar-light">
			<div class="container">
				<a class="navbar-brand" href="<?= site_url('/') ?>">
					<h3 class="text-white">UKM STMIK Lombok</h3>
				</a>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
					<span class="lnr lnr-menu"></span>
				</button>

				<div class="collapse navbar-collapse justify-content-end align-items-center" id="navbarSupportedContent">
					<ul class="navbar-nav">
						<li><a href="<?= site_url('/') ?>">Beranda</a></li>
						<li><a href="<?= site_url('kursus') ?>">Kursus</a></li>
						<li><a href="<?= site_url('tutorial') ?>">Tutorial</a></li>
						<li class="dropdown">
							<a class="dropdown-toggle" href="#" data-toggle="dropdown">
								Kegiatan
							</a>
							<div class="dropdown-menu">
								<a class="dropdown-item" href="<?= site_url('kegiatan') ?>">UKM Techcode</a>
								<a class="dropdown-item" href="<?= site_url('kegiatan') ?>">UKM Gumpala</a>
								<a class="dropdown-item" href="<?= site_url('kegiatan') ?>">UKM Halu</a>
							</div>
						</li>
						<li class="dropdown">
							<a class="dropdown-toggle" href="#" data-toggle="dropdown">
								Berita
							</a>
							<div class="dropdown-menu">
								<a class="dropdown-item" href="<?= site_url('berita') ?>">UKM Techcode</a>
								<a class="dropdown-item" href="<?= site_url('berita') ?>">UKM Gumpala</a>
								<a class="dropdown-item" href="<?= site_url('berita') ?>">UKM Halu</a>
							</div>
						</li>
						<li class="dropdown">
							<a class="dropdown-toggle" href="#" data-toggle="dropdown">
								Artikel
							</a>
							<div class="dropdown-menu">
								<a class="dropdown-item" href="<?= site_url('artikel') ?>">Teknologi</a>
								<a class="dropdown-item" href="<?= site_url('artikel') ?>">Budaya</a>
							</div>
						</li>
						<li><a href="<?= site_url('auth') ?>">Masuk</a></li>

						<li>
							<button class="search">
								<span class="lnr lnr-magnifier" id="search"></span>
							</button>
						</li>
					</ul>
				</div>
			</div>
		</nav>
		<div class="search-input" id="search-input-box">
			<div class="container">
				<form class="d-flex justify-content-between">
					<input type="text" class="form-control" id="search-input" placeholder="Mau cari apa ?" />
					<button type="submit" class="btn"></button>
					<span class="lnr lnr-cross" id="close-search" title="Close Search"></span>
				</form>
			</div>
		</div>
	</header>
	<?= $view ?>
	<footer class="footer-area section-gap">
		<div class="container">
			<div class="row">
				<div class="col-lg-2 col-md-6 single-footer-widget">
					<h4>Top Products</h4>
					<ul>
						<li><a href="#">Managed Website</a></li>
						<li><a href="#">Manage Reputation</a></li>
						<li><a href="#">Power Tools</a></li>
						<li><a href="#">Marketing Service</a></li>
					</ul>
				</div>
				<div class="col-lg-2 col-md-6 single-footer-widget">
					<h4>Quick Links</h4>
					<ul>
						<li><a href="#">Jobs</a></li>
						<li><a href="#">Brand Assets</a></li>
						<li><a href="#">Investor Relations</a></li>
						<li><a href="#">Terms of Service</a></li>
					</ul>
				</div>
				<div class="col-lg-2 col-md-6 single-footer-widget">
					<h4>Features</h4>
					<ul>
						<li><a href="#">Jobs</a></li>
						<li><a href="#">Brand Assets</a></li>
						<li><a href="#">Investor Relations</a></li>
						<li><a href="#">Terms of Service</a></li>
					</ul>
				</div>
				<div class="col-lg-2 col-md-6 single-footer-widget">
					<h4>Resources</h4>
					<ul>
						<li><a href="#">Guides</a></li>
						<li><a href="#">Research</a></li>
						<li><a href="#">Experts</a></li>
						<li><a href="#">Agencies</a></li>
					</ul>
				</div>
				<div class="col-lg-4 col-md-6 single-footer-widget">
					<h4>Newsletter</h4>
					<p>You can trust us. we only send promo offers,</p>
					<div class="form-wrap" id="mc_embed_signup">
						<form target="_blank" action="https://spondonit.us12.list-manage.com/subscribe/post?u=1462626880ade1ac87bd9c93a&amp;id=92a4423d01" method="get" class="form-inline">
							<input class="form-control" name="EMAIL" placeholder="Your Email Address" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Your Email Address '" required="" type="email">
							<button class="click-btn btn btn-default text-uppercase">subscribe</button>
							<div style="position: absolute; left: -5000px;">
								<input name="b_36c4fd991d266f23781ded980_aefe40901a" tabindex="-1" value="" type="text">
							</div>

							<div class="info"></div>
						</form>
					</div>
				</div>
			</div>
			<div class="footer-bottom row align-items-center">
				<p class="footer-text m-0 col-lg-8 col-md-12">
					<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
					Copyright &copy;<script>
						document.write(new Date().getFullYear());
					</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
					<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
				</p>
				<div class="col-lg-4 col-md-12 footer-social">
					<a href="#"><i class="fa fa-facebook"></i></a>
					<a href="#"><i class="fa fa-twitter"></i></a>
					<a href="#"><i class="fa fa-dribbble"></i></a>
					<a href="#"><i class="fa fa-behance"></i></a>
				</div>
			</div>
		</div>
	</footer>
	<!-- ================ End footer Area ================= -->

	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
	<script src="<?= base_url('assets') ?>/js/vendor/bootstrap.min.js"></script>
	<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBhOdIF3Y9382fqJYt5I_sswSrEw5eihAA"></script>
	<script src="<?= base_url('assets') ?>/js/jquery.ajaxchimp.min.js"></script>
	<script src="<?= base_url('assets') ?>/js/jquery.magnific-popup.min.js"></script>
	<script src="<?= base_url('assets') ?>/js/parallax.min.js"></script>
	<script src="<?= base_url('assets') ?>/js/owl.carousel.min.js"></script>
	<script src="<?= base_url('assets') ?>/js/jquery.sticky.js"></script>
	<script src="<?= base_url('assets') ?>/js/hexagons.min.js"></script>
	<script src="<?= base_url('assets') ?>/js/jquery.counterup.min.js"></script>
	<script src="<?= base_url('assets') ?>/js/waypoints.min.js"></script>
	<script src="<?= base_url('assets') ?>/js/jquery.nice-select.min.js"></script>
	<script src="<?= base_url('assets') ?>/js/main.js"></script>
</body>

</html>
