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
				<form method="GET" action="<?= base_url('admin/search') ?>">
					<div class="form-group mb-0">
						<i class="dw dw-search2 search-icon"></i>
						<input
							type="text"
							name="q"
							class="form-control search-input"
							placeholder="Cari pelanggan, pesanan, layanan..."
							autocomplete="off" />
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
									<label class="col-sm-12 col-md-4 col-form-label">Dari Tanggal</label>
									<div class="col-sm-12 col-md-8">
										<input
											name="tanggal_dari"
											class="form-control form-control-sm"
											type="date" />
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-12 col-md-4 col-form-label">Sampai</label>
									<div class="col-sm-12 col-md-8">
										<input
											name="tanggal_sampai"
											class="form-control form-control-sm"
											type="date" />
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-12 col-md-4 col-form-label">Status</label>
									<div class="col-sm-12 col-md-8">
										<select name="status" class="form-control form-control-sm">
											<option value="">Semua Status</option>
											<option value="menunggu">Menunggu</option>
											<option value="proses">Proses</option>
											<option value="selesai">Selesai</option>
											<option value="diambil">Diambil</option>
										</select>
									</div>
								</div>
								<div class="text-right">
									<button type="submit" class="btn btn-primary btn-sm">
										<i class="fa fa-search"></i> Cari
									</button>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
		<div class="header-right">
			<?php
			// AMBIL DATA NOTIFIKASI PESANAN BARU
			require_once __DIR__ . '/../../../core/Database.php';
			$dbNotif = new Database();
			$dbNotif->query("
				SELECT p.id_pesanan, u.nama_lengkap, u.foto, l.nama_layanan, p.tanggal_pesan 
				FROM pesanan p
				JOIN users u ON p.id_user = u.id_user
				JOIN layanan l ON p.id_layanan = l.id_layanan
				WHERE p.status_pesanan = 'menunggu' 
				ORDER BY p.tanggal_pesan DESC LIMIT 5
			");
			$notifPesananBaru = $dbNotif->resultSet();
			$jumlahNotif = count($notifPesananBaru);
			?>
			<div class="user-notification">
				<div class="dropdown">
						<a
						class="dropdown-toggle no-arrow"
						href="#"
						role="button"
						data-toggle="dropdown">
						<i class="icon-copy dw dw-notification"></i>
						<?php if ($jumlahNotif > 0): ?>
							<span class="badge notification-active"></span>
						<?php endif; ?>
					</a>
					<div class="dropdown-menu dropdown-menu-right">
						<div class="notification-list mx-h-350 customscroll">
							<ul>
								<?php if ($jumlahNotif > 0): ?>
									<?php foreach ($notifPesananBaru as $notif): ?>
										<li>
											<a href="<?= base_url('admin/data_pesanan/detail?id_pesanan=' . $notif->id_pesanan) ?>">
												<img src="<?= base_url('public/img/foto_pelanggan/' . (!empty($notif->foto) ? $notif->foto : 'default.jpg')) ?>" alt="" />
												<h3><?= htmlspecialchars($notif->nama_lengkap) ?></h3>
												<p>
													Memesan jasa <strong><?= htmlspecialchars($notif->nama_layanan) ?></strong> pada <?= date('d M Y', strtotime($notif->tanggal_pesan)) ?>.
												</p>
											</a>
										</li>
									<?php endforeach; ?>
								<?php else: ?>
									<li>
										<a href="#">
											<h3 class="text-center mt-3 text-muted">Belum ada pesanan baru</h3>
										</a>
									</li>
								<?php endif; ?>
							</ul>
						</div>
						<?php if ($jumlahNotif > 0): ?>
						<div style="padding: 10px 15px; border-top: 1px solid #eee;">
							<a href="<?= base_url('admin/data_pesanan/pesananmenunggu') ?>"
								class="btn btn-primary btn-block btn-sm">
								<i class="fa fa-list"></i> Lihat Semua Pesanan Menunggu
							</a>
						</div>
						<?php endif; ?>
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
						<a class="dropdown-item" href="<?= base_url('admin/profile') ?>"><i class="dw dw-user1"></i> Profile</a>
						<a class="dropdown-item" href="<?= base_url('auth/logout') ?>"><i class="dw dw-logout"></i> Log Out</a>
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
			<a href="<?= base_url('admin/dashboard/dashboard') ?>">
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
						<a href="<?= base_url('admin/dashboard/dashboard') ?>" class="dropdown-toggle no-arrow">
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
