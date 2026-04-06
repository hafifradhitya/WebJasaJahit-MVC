<?php
global $judul;

?>

<!DOCTYPE html>
<html>

<head>
	<!-- Basic Page Info -->
	<meta charset="utf-8" />
	<title>JAHIT - Jadimulya Jasa Jahit</title>

	<!-- Site favicon -->
	<link
		rel="apple-touch-icon"
		sizes="180x180"
		href="<?= base_url('public/img/logo/logo-mesin-jahit.png') ?>" />
	<link
		rel="icon"
		type="image/png"
		sizes="32x32"
		href="<?= base_url('public/img/logo/logo-mesin-jahit.png') ?>" />
	<link
		rel="icon"
		type="image/png"
		sizes="16x16"
		href="<?= base_url('public/img/logo/logo-mesin-jahit.png') ?>" />

	<!-- Mobile Specific Metas -->
	<meta
		name="viewport"
		content="width=device-width, initial-scale=1, maximum-scale=1" />

	<!-- Google Font -->
	<link
		href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
		rel="stylesheet" />
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="<?= base_url('public/styles/core.css') ?>" />
	<link
		rel="stylesheet"
		type="text/css"
		href="<?= base_url('public/styles/icon-font.min.css') ?>" />
	<link
		rel="stylesheet"
		type="text/css"
		href="<?= base_url('public/styles/dataTables.bootstrap4.min.css') ?>" />
	<link
		rel="stylesheet"
		type="text/css"
		href="<?= base_url('public/styles/responsive.bootstrap4.min.css') ?>" />
	<link rel="stylesheet" type="text/css" href="<?= base_url('public/styles/style.css') ?>" />

	<link rel="stylesheet" type="text/css" href="<?= base_url('public/styles/jquery.steps.css') ?>">

	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script
		async
		src="https://www.googletagmanager.com/gtag/js?id=G-GBZ3SGGX85"></script>
	<script>
		window.dataLayer = window.dataLayer || [];

		function gtag() {
			dataLayer.push(arguments);
		}
		gtag("js", new Date());

		gtag("config", "G-GBZ3SGGX85");
	</script>
	<!-- Google Tag Manager -->
	<script>
		(function(w, d, s, l, i) {
			w[l] = w[l] || [];
			w[l].push({
				"gtm.start": new Date().getTime(),
				event: "gtm.js"
			});
			var f = d.getElementsByTagName(s)[0],
				j = d.createElement(s),
				dl = l != "dataLayer" ? "&l=" + l : "";
			j.async = true;
			j.src = "https://www.googletagmanager.com/gtm.js?id=" + i + dl;
			f.parentNode.insertBefore(j, f);
		})(window, document, "script", "dataLayer", "GTM-NXZMQSS");
	</script>
	<!-- End Google Tag Manager -->
</head>

<body class="sidebar-light header-light">
	<?php if (!isset($no_preloader)) : ?>
		<div class="pre-loader">
			<div class="pre-loader-box">
				<div class="loader-logo">
					<img width="350" height="350"
						src="<?= base_url('public/img/logo/logo-preload.png') ?>" alt="" />
				</div>
				<div class="loader-progress" id="progress_div">
					<div class="bar" id="bar1"></div>
				</div>
				<div class="percent" id="percent1">0%</div>
				<div class="loading-text">Loading...</div>
			</div>
		</div>
	<?php endif; ?>

	<div class="header">
		<div class="header-left">
			<div class="menu-icon bi bi-list"></div>
			<div
				class="search-toggle-icon bi bi-search"
				data-toggle="header_search"></div>
			<div class="header-search">
				<form>
					<div class="form-group mb-0">
						<i class="dw dw-search2 search-icon"></i>
						<input
							type="text"
							class="form-control search-input"
							placeholder="Search Here" />
						<div class="dropdown">
							<a
								class="dropdown-toggle no-arrow"
								href="#"
								role="button"
								data-toggle="dropdown">
								<i class="ion-arrow-down-c"></i>
							</a>
							<div class="dropdown-menu dropdown-menu-right">
								<div class="form-group row">
									<label class="col-sm-12 col-md-2 col-form-label">From</label>
									<div class="col-sm-12 col-md-10">
										<input
											class="form-control form-control-sm form-control-line"
											type="text" />
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-12 col-md-2 col-form-label">To</label>
									<div class="col-sm-12 col-md-10">
										<input
											class="form-control form-control-sm form-control-line"
											type="text" />
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-12 col-md-2 col-form-label">Subject</label>
									<div class="col-sm-12 col-md-10">
										<input
											class="form-control form-control-sm form-control-line"
											type="text" />
									</div>
								</div>
								<div class="text-right">
									<button class="btn btn-primary">Search</button>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
		<div class="header-right">
			<div class="user-notification">
				<div class="dropdown">
					<a
						class="dropdown-toggle no-arrow"
						href="#"
						role="button"
						data-toggle="dropdown">
						<i class="icon-copy dw dw-notification"></i>
						<span class="badge notification-active"></span>
					</a>
					<div class="dropdown-menu dropdown-menu-right">
						<div class="notification-list mx-h-350 customscroll">
							<ul>
								<li>
									<a href="#">
										<img src="<?= base_url('public/images/img.jpg') ?>" alt="" />
										<h3>John Doe</h3>
										<p>
											Lorem ipsum dolor sit amet, consectetur adipisicing
											elit, sed...
										</p>
									</a>
								</li>
								<li>
									<a href="#">
										<img src="<?= base_url('public/images/photo1.jpg') ?>" alt="" />
										<h3>Lea R. Frith</h3>
										<p>
											Lorem ipsum dolor sit amet, consectetur adipisicing
											elit, sed...
										</p>
									</a>
								</li>
								<li>
									<a href="#">
										<img src="<?= base_url('public/images/photo2.jpg') ?>" alt="" />
										<h3>Erik L. Richards</h3>
										<p>
											Lorem ipsum dolor sit amet, consectetur adipisicing
											elit, sed...
										</p>
									</a>
								</li>
								<li>
									<a href="#">
										<img src="<?= base_url('public/images/photo3.jpg') ?>" alt="" />
										<h3>John Doe</h3>
										<p>
											Lorem ipsum dolor sit amet, consectetur adipisicing
											elit, sed...
										</p>
									</a>
								</li>
								<li>
									<a href="#">
										<img src="<?= base_url('public//images/photo4.jpg') ?>" alt="" />
										<h3>Renee I. Hansen</h3>
										<p>
											Lorem ipsum dolor sit amet, consectetur adipisicing
											elit, sed...
										</p>
									</a>
								</li>
								<li>
									<a href="#">
										<img src="<?= base_url('public/images/img.jpg') ?>" alt="" />
										<h3>Vicki M. Coleman</h3>
										<p>
											Lorem ipsum dolor sit amet, consectetur adipisicing
											elit, sed...
										</p>
									</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<div class="user-info-dropdown">
				<div class="dropdown">
					<a
						class="dropdown-toggle"
						href="#"
						role="button"
						data-toggle="dropdown"> 
						<img
							src="<?= base_url('public/img/foto_pelanggan/' . (!empty($_SESSION['foto']) ? $_SESSION['foto'] : 'default.jpg')) ?>"
							alt="User"
							class="user-icon rounded-circle" />
						<span class="user-name"><?= $_SESSION['nama_lengkap'] ?></span>
					</a>
					<div
						class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
						<a class="dropdown-item" href="<?= base_url('admin/fitur_lainnya/profile.php') ?>"><i class="dw dw-user1"></i> Profile</a>
						<a class="dropdown-item" href="<?= base_url('admin/fitur_lainnya/ubah_password.php') ?>"><i class="dw dw-settings2"></i> Ubah Password</a>
						<a class="dropdown-item" href="<?= base_url('auth/logout.php') ?>"><i class="dw dw-logout"></i> Log Out</a>
					</div>
				</div>
			</div>
			<div class="github-link">
				<a href="https://github.com/dropways/deskapp" target="_blank"><img src="vendors/images/github.svg" alt="" /></a>
			</div>
		</div>
	</div>

	<div class="left-side-bar">
		<div class="brand-logo">
			<a href="index.html">
				<img src="<?= base_url('public/img/logo/logo-jasa-jahit-dark.png') ?>" alt="" class="dark-logo" />
				<img
					src="<?= base_url('public/img/logo/logo-jasa-jahit.png') ?>"
					alt=""
					class="light-logo" />
			</a>
			<div class="close-sidebar" data-toggle="left-sidebar-close">
				<i class="ion-close-round"></i>
			</div>
		</div>
		<div class="menu-block customscroll">
			<div class="sidebar-menu">
				<ul id="accordion-menu">
					<li>
						<a href="<?= base_url('admin/dashboard/dashboard.php') ?>" class="dropdown-toggle no-arrow">
							<span class="micon fa fa-line-chart"></span><span class="mtext">Dashboard</span>
						</a>
					</li>
					<li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle">
							<span class="micon fa fa-archive"></span><span class="mtext">Pesanan</span>
						</a>
						<ul class="submenu">
							<li>
								<a href="<?= base_url('admin/data_pesanan/semuapesanan') ?>">
									<i class="fa fa-list"></i>
									Semua Pesanan
								</a>
							</li>

							<li>
								<a href="<?= base_url('admin/data_pesanan/pesananmenunggu') ?>">
									<i class="fa fa-clock-o"></i>
									Menunggu
								</a>
							</li>

							<li>
								<a href="<?= base_url('admin/data_pesanan/pesanandiproses') ?>">
									<i class="fa fa-refresh"></i>
									Proses
								</a>
							</li>

							<li>
								<a href="<?= base_url('admin/data_pesanan/pesananselesaidiambil') ?>">
									<i class="fa fa-check-circle"></i>
									Selesai / Diambil
								</a>
							</li>
						</ul>

					</li>
					<li>
						<a href="<?= base_url('admin/data_pelanggan/pelanggan') ?>" class="dropdown-toggle no-arrow">
							<span class="micon fa fa-users"></span><span class="mtext">Pelanggan</span>
						</a>
					</li>
					<li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle">
							<span class="micon fa fa-briefcase"></span><span class="mtext">Layanan Jahit</span>
						</a>
						<ul class="submenu">
							<li>
								<a href="<?= base_url('admin/data_layanan/layanan') ?>">
									<i class="fa fa-scissors"></i>
									Layanan
								</a>
							</li>

							<li>
								<a href="<?= base_url('admin/data_kategori/kategori') ?>">
									<i class="fa fa-tags"></i>
									Kategori
								</a>
							</li>
						</ul>
					</li>
					<li>
						<a href="<?= base_url("admin/data_laporan/laporan") ?>" class="dropdown-toggle no-arrow">
							<span class="micon fa fa-file-text-o"></span><span class="mtext">Laporan</span>
						</a>
					</li>
					<!-- <li>
						<div class="dropdown-divider"></div>
					</li>
					<li>
						<div class="sidebar-small-cap">Management Jahit</div>
					</li>
					<li>
						<a href="javascript:;" class="dropdown-toggle">
							<span class="micon bi bi-file-pdf"></span><span class="mtext">Documentation</span>
						</a>
						<ul class="submenu">
							<li><a href="introduction.html">Introduction</a></li>
							<li><a href="getting-started.html">Getting Started</a></li>
							<li><a href="color-settings.html">Color Settings</a></li>
							<li>
								<a href="third-party-plugins.html">Third Party Plugins</a>
							</li>
						</ul>
					</li>
					<li>
						<a
							href="https://dropways.github.io/deskapp-free-single-page-website-template/"
							target="_blank"
							class="dropdown-toggle no-arrow">
							<span class="micon bi bi-layout-text-window-reverse"></span>
							<span class="mtext">Pelanggan
								<img src="<?= base_url('public/images/coming-soon.png') ?>" alt="" width="25" /></span>
						</a>
					</li> -->
				</ul>  
			</div>
		</div>
	</div>
	<div class="mobile-menu-overlay"></div>  
	<div class="main-container">
		<div class="xs-pd-20-10 pd-ltr-20">
			<div class="title pb-20">
				<h2 class="h3 mb-0"><?= $judul ?></h2>
			</div>
