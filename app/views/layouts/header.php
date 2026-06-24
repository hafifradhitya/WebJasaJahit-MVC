<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
// Data $kategori_array dan $layanan_by_kategori sekarang didapatkan dari BerandaController
?>
<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="shortcut icon" href="public/img/logo/logo-mesin-jahit.png" type="image/x-icon" />
  <title><?= $judul ?? 'JAHIT - Jadimulya Jasa Jahit' ?></title>
  <link rel="stylesheet" href="<?= base_url('public/css/style-jahit.css') ?>" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

  <style>
    /* Golden Brown Empty State - DeskApp Friendly */

    .tp-card {
      transition: all 0.3s ease;
    }

    #emptyState {
      animation: fadeInUp 0.6s ease;
    }

    @keyframes fadeInUp {
      from {
        opacity: 0;
        transform: translateY(30px);
      }

      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .empty-state-wrapper {
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 420px;
      padding: 50px 0;
    }

    .empty-state-card {
      text-align: center;
      max-width: 620px;
      padding: 65px 45px;
      background: linear-gradient(145deg, #fff8ee, #ffffff);
      border-radius: 16px;
      border: 1px solid rgba(182, 141, 64, 0.25);
      box-shadow:
        0 15px 40px rgba(182, 141, 64, 0.18),
        inset 0 1px 0 rgba(255, 255, 255, 0.6);
      position: relative;
      overflow: hidden;
    }

    .empty-state-card::before {
      content: "";
      position: absolute;
      inset: 0;
      background: radial-gradient(circle at top, rgba(224, 192, 122, 0.15), transparent 60%);
      pointer-events: none;
    }

    .icon-box {
      margin-bottom: 30px;
    }

    .icon-box i {
      font-size: 84px;
      color: #b68d40;
      background: linear-gradient(135deg, #e0c07a, #b68d40);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
    }

    .empty-state-card h3 {
      font-size: 30px;
      color: #5a3e1b;
      margin-bottom: 18px;
      font-weight: 700;
      letter-spacing: 0.5px;
    }

    .empty-state-card p {
      font-size: 16px;
      color: #7a5a2f;
      line-height: 1.9;
      margin-bottom: 35px;
    }

    .empty-state-card strong {
      color: #b68d40;
      font-weight: 600;
    }

    .action-group .btn {
      background: linear-gradient(135deg, #b68d40, #e0c07a);
      border: none;
      color: #fff;
      padding: 12px 26px;
      font-size: 15px;
      font-weight: 600;
      border-radius: 50px;
      box-shadow: 0 8px 25px rgba(182, 141, 64, 0.35);
      transition: all 0.3s ease;
    }

    .action-group .btn:hover {
      transform: translateY(-2px);
      box-shadow: 0 12px 30px rgba(182, 141, 64, 0.45);
      background: linear-gradient(135deg, #a47b33, #d6b46a);
    }

    .tp-card[style*="display: none"] {
      display: none !important;
    }

    .tp-card[style*="display: block"] {
      display: block !important;
    }
  </style>


  <style>
    /* ===== USER DROPDOWN (ISOLATED) ===== */
    .user-action {
      position: relative;
      margin-left: 20px;
    }

    .user-profile {
      width: 42px;
      height: 42px;
      border-radius: 50%;
      overflow: hidden;
      cursor: pointer;
    }

    .user-profile img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    /* Dropdown box */
    .user-menu {
      position: absolute;
      top: 60px;
      right: 0;
      width: 200px;
      background: #fff;
      border-radius: 12px;
      padding: 10px 15px;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
      opacity: 0;
      visibility: hidden;
      transition: 0.3s ease;
      z-index: 999;
    }

    .user-menu.active {
      opacity: 1;
      visibility: visible;
      top: 50px;
    }

    /* KHUSUS dropdown */
    .user-menu h3 {
      text-align: center;
      font-size: 16px;
      font-weight: 600;
      color: #333;
      margin-bottom: 10px;
    }

    .user-menu h3 span {
      font-size: 13px;
      color: #999;
      font-weight: 400;
    }

    .user-menu ul {
      list-style: none;
      padding: 0;
      margin: 0;
    }

    .user-menu ul li {
      display: flex;
      align-items: center;
      padding: 8px 0;
      border-top: 1px solid #eee;
    }

    .user-menu ul li i {
      width: 20px;
      color: #999;
      margin-right: 8px;
    }

    .user-menu ul li a {
      text-decoration: none;
      color: #444;
      font-size: 14px;
    }

    .user-menu ul li:hover a {
      color: #b68d40;
    }
  </style>

  <style>
    .mobile-user-info {
      display: flex;
      align-items: center;
      gap: 12px;
      padding: 12px 0;
    }

    .mobile-user-avatar {
      width: 42px;
      height: 42px;
      border-radius: 50%;
      object-fit: cover;
    }

    .mobile-user-text span {
      font-size: 12px;
      color: #aaa;
    }

    .mobile-menu-link.danger {
      color: #ff5c5c;
    }
  </style>

  <!-- Popup Chat Pelanggan -->
  <style>
    #aiFloatingButton {
      position: fixed !important;
      left: 26px !important;
      right: auto !important;
      bottom: 96px !important;
      min-width: 0 !important;
      width: 58px !important;
      height: 54px !important;
      padding: 0 !important;
      border: 0 !important;
      border-radius: 50% !important;
      background: linear-gradient(135deg, #1c120b, #8B5A2B 48%, #D4A373) !important;
      color: #fff7df !important;
      display: flex !important;
      align-items: center !important;
      justify-content: center !important;
      gap: 9px !important;
      font-size: 15px !important;
      font-weight: 700 !important;
      line-height: 1 !important;
      cursor: pointer !important;
      opacity: 1 !important;
      visibility: visible !important;
      pointer-events: auto !important;
      overflow: visible !important;
      z-index: 2147483000 !important;
      box-shadow: 0 12px 28px rgba(0,0,0,0.35) !important;
      transition: transform 0.24s ease, box-shadow 0.24s ease, background 0.24s ease !important;
    }

    #aiFloatingButton i {
      font-size: 22px !important;
      position: relative !important;
      z-index: 2 !important;
      transition: transform 0.28s ease, opacity 0.2s ease !important;
    }

    #aiFloatingButton:hover {
      transform: scale(1.06) !important;
      box-shadow: 0 14px 32px rgba(0,0,0,0.45) !important;
    }

    #aiFloatingButton.chat-open {
      opacity: 1 !important;
      visibility: visible !important;
      pointer-events: auto !important;
      transform: scale(1) !important;
      z-index: 2147483001 !important;
      background: linear-gradient(135deg, #4a3012, #b68d40 58%, #e0c07a) !important;
      box-shadow:
        0 0 0 8px rgba(224, 192, 122, 0.16),
        0 14px 32px rgba(0,0,0,0.45) !important;
    }

    #aiFloatingButton.chat-open i {
      transform: rotate(180deg) scale(1.05) !important;
    }

    #aiFloatingButton.vortex-pulse::before,
    #aiFloatingButton.vortex-pulse::after {
      content: "";
      position: absolute;
      inset: -10px;
      border-radius: 50%;
      border: 1px solid rgba(224, 192, 122, 0.72);
      pointer-events: none;
      animation: csVortexRing 0.62s cubic-bezier(.16, 1, .3, 1) both;
    }

    #aiFloatingButton.vortex-pulse::after {
      inset: -18px;
      border-color: rgba(182, 141, 64, 0.42);
      animation-delay: 0.08s;
    }

    @keyframes csVortexRing {
      0% {
        opacity: 0.95;
        transform: rotate(0deg) scale(0.62);
      }

      100% {
        opacity: 0;
        transform: rotate(260deg) scale(1.9);
      }
    }

    @media (max-width: 560px) {
      #aiFloatingButton {
        left: 18px !important;
        right: auto !important;
        bottom: 86px !important;
        min-width: 0 !important;
        width: 56px !important;
        height: 50px !important;
        padding: 0 !important;
        font-size: 14px !important;
      }
    }

    .wa-golden {
      bottom: 96px !important;
      right: 26px !important;
    }

    .back-to-top {
      bottom: 168px !important;
      right: 26px !important;
    }

    @media (max-width: 560px) {
      .wa-golden {
        bottom: 86px !important;
        right: 18px !important;
      }

      .back-to-top {
        bottom: 154px !important;
        right: 18px !important;
      }
    }

    .chat-popup {
      position: fixed;
      left: 26px;
      right: auto;
      bottom: 170px;
      width: min(430px, calc(100vw - 32px));
      height: min(540px, calc(100vh - 220px));
      background: rgba(255, 250, 240, 0.76);
      border: 1px solid rgba(224, 192, 122, 0.62);
      border-radius: 24px;
      box-shadow:
        0 24px 70px rgba(21, 13, 4, 0.34),
        0 0 0 1px rgba(255, 255, 255, 0.35) inset;
      backdrop-filter: blur(18px);
      -webkit-backdrop-filter: blur(18px);
      display: flex;
      flex-direction: column;
      overflow: hidden;
      z-index: 9999;
      opacity: 0;
      visibility: hidden;
      pointer-events: none;
      filter: blur(6px);
      transform: translate(-18px, 44px) scale(0.74);
      transform-origin: 30px calc(100% + 78px);
      transition:
        opacity 0.26s ease,
        filter 0.26s ease,
        transform 0.44s cubic-bezier(.16, 1, .3, 1),
        visibility 0.26s ease;
    }

    .chat-popup.open {
      opacity: 1;
      visibility: visible;
      pointer-events: auto;
      filter: blur(0);
      transform: translateY(0) scale(1);
    }

    .chat-popup.vortex-in {
      animation: chatVortexIn 0.52s cubic-bezier(.16, 1, .3, 1) both;
    }

    .chat-popup.vortex-out {
      animation: chatVortexOut 0.42s cubic-bezier(.7, 0, .84, 0) both;
    }

    @keyframes chatVortexIn {
      0% {
        opacity: 0;
        filter: blur(12px);
        clip-path: circle(0 at 30px calc(100% + 78px));
        transform: translate(-22px, 48px) rotate(-8deg) scale(0.12);
      }

      48% {
        opacity: 1;
        filter: blur(4px);
        clip-path: circle(72% at 30px calc(100% + 78px));
        transform: translate(-7px, 12px) rotate(2deg) scale(1.03);
      }

      100% {
        opacity: 1;
        filter: blur(0);
        clip-path: circle(150% at 30px calc(100% + 78px));
        transform: translateY(0) rotate(0deg) scale(1);
      }
    }

    @keyframes chatVortexOut {
      0% {
        opacity: 1;
        filter: blur(0);
        clip-path: circle(150% at 30px calc(100% + 78px));
        transform: translateY(0) rotate(0deg) scale(1);
      }

      55% {
        opacity: 0.85;
        filter: blur(5px);
        clip-path: circle(60% at 30px calc(100% + 78px));
        transform: translate(-10px, 24px) rotate(-4deg) scale(0.72);
      }

      100% {
        opacity: 0;
        filter: blur(12px);
        clip-path: circle(0 at 30px calc(100% + 78px));
        transform: translate(-24px, 52px) rotate(-12deg) scale(0.08);
      }
    }

    .chat-overlay {
      position: fixed;
      inset: 0;
      z-index: 9998;
      background:
        radial-gradient(circle at center, rgba(224, 192, 122, 0.13), transparent 42%),
        rgba(16, 10, 4, 0.42);
      backdrop-filter: blur(9px);
      -webkit-backdrop-filter: blur(9px);
      opacity: 0;
      visibility: hidden;
      pointer-events: none;
      transition: opacity 0.28s ease, visibility 0.28s ease;
    }

    .chat-overlay.open {
      opacity: 1;
      visibility: visible;
      pointer-events: auto;
    }

    .chat-header {
      background:
        radial-gradient(circle at top right, rgba(224, 192, 122, 0.32), transparent 40%),
        linear-gradient(135deg, rgba(25, 16, 6, 0.92) 0%, rgba(79, 52, 19, 0.88) 46%, rgba(182, 141, 64, 0.86) 100%);
      color: #fff;
      padding: 16px 18px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      gap: 14px;
      min-height: 78px;
      position: relative;
    }

    .chat-header::after {
      content: "";
      position: absolute;
      left: 0;
      right: 0;
      bottom: 0;
      height: 1px;
      background: linear-gradient(90deg, transparent, rgba(255, 235, 181, 0.8), transparent);
    }

    .chat-title {
      display: flex;
      align-items: center;
      gap: 12px;
      min-width: 0;
    }

    .chat-avatar {
      width: 44px;
      height: 44px;
      border-radius: 50%;
      background: linear-gradient(135deg, #e0c07a, #b68d40);
      color: #1b1207;
      display: grid;
      place-items: center;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.22);
      flex: 0 0 auto;
    }

    .chat-title-text strong {
      display: block;
      font-size: 15px;
      line-height: 1.2;
      letter-spacing: 0;
    }

    .chat-status {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      margin-top: 5px;
      font-size: 12px;
      color: #f8e7b6;
      white-space: nowrap;
    }

    .chat-status::before {
      content: "";
      width: 8px;
      height: 8px;
      border-radius: 50%;
      background: #35d174;
      box-shadow: 0 0 0 3px rgba(53, 209, 116, 0.18);
    }

    .close-btn {
      border: none;
      background: rgba(255, 255, 255, 0.14);
      color: #fff6dc;
      width: 34px;
      height: 34px;
      border-radius: 50%;
      cursor: pointer;
      display: grid;
      place-items: center;
      font-size: 22px;
      line-height: 1;
      transition: background 0.2s ease, transform 0.2s ease;
      flex: 0 0 auto;
    }

    .close-btn:hover {
      background: rgba(255, 255, 255, 0.24);
      transform: rotate(90deg);
    }

    .chat-bottom-close {
      position: absolute;
      right: 16px;
      top: 16px;
      width: 52px;
      height: 52px;
      border: 1px solid rgba(224, 192, 122, 0.62);
      border-radius: 50%;
      background: rgba(25, 16, 6, 0.72);
      color: #fff5d6;
      display: grid;
      place-items: center;
      font-size: 24px;
      cursor: pointer;
      box-shadow: 0 16px 38px rgba(0, 0, 0, 0.28);
      backdrop-filter: blur(14px);
      -webkit-backdrop-filter: blur(14px);
      opacity: 0;
      visibility: hidden;
      pointer-events: none;
      transition: transform 0.2s ease, background 0.2s ease, opacity 0.28s ease, visibility 0.28s ease;
      z-index: 2;
    }

    .chat-bottom-close.open {
      opacity: 1;
      visibility: visible;
      pointer-events: auto;
    }

    .chat-bottom-close:hover {
      transform: translateY(-2px) rotate(90deg);
      background: rgba(90, 62, 27, 0.86);
    }

    .chat-messages {
      padding: 18px 16px 16px;
      flex: 1;
      overflow-y: auto;
      background:
        linear-gradient(rgba(255, 250, 240, 0.58), rgba(255, 250, 240, 0.58)),
        repeating-linear-gradient(135deg, rgba(182, 141, 64, 0.06) 0, rgba(182, 141, 64, 0.06) 1px, transparent 1px, transparent 18px);
      scrollbar-width: thin;
      scrollbar-color: #b68d40 #f4ead6;
    }

    .chat-messages::-webkit-scrollbar {
      width: 8px;
    }

    .chat-messages::-webkit-scrollbar-track {
      background: #f4ead6;
    }

    .chat-messages::-webkit-scrollbar-thumb {
      background: #b68d40;
      border-radius: 999px;
    }

    .chat-message {
      position: relative;
      margin-bottom: 12px;
      font-size: 14px;
      line-height: 1.45;
      max-width: 84%;
      padding: 11px 13px;
      clear: both;
      word-wrap: break-word;
      overflow-wrap: anywhere;
      animation: chatBubbleIn 0.2s ease;
    }

    @keyframes chatBubbleIn {
      from {
        opacity: 0;
        transform: translateY(6px);
      }

      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .chat-message.you {
      margin-left: auto;
      background: linear-gradient(135deg, #b68d40, #c99c45);
      color: #fff;
      border-radius: 16px 16px 4px 16px;
      box-shadow: 0 8px 18px rgba(182, 141, 64, 0.22);
    }

    .chat-message.admin {
      margin-right: auto;
      background: rgba(255, 255, 255, 0.78);
      border: 1px solid rgba(224, 192, 122, 0.65);
      color: #5a3e1b;
      border-radius: 16px 16px 16px 4px;
      backdrop-filter: blur(8px);
      -webkit-backdrop-filter: blur(8px);
      box-shadow: 0 8px 24px rgba(90, 62, 27, 0.08);
    }

    .chat-message.loading-indicator {
      display: inline-flex;
      align-items: center;
      gap: 5px;
      color: #8b672e;
      min-width: 74px;
    }

    .typing-dot {
      width: 7px;
      height: 7px;
      border-radius: 50%;
      background: #b68d40;
      animation: typingPulse 1s infinite ease-in-out;
    }

    .typing-dot:nth-child(2) {
      animation-delay: 0.15s;
    }

    .typing-dot:nth-child(3) {
      animation-delay: 0.3s;
    }

    @keyframes typingPulse {
      0%, 80%, 100% {
        opacity: 0.35;
        transform: translateY(0);
      }

      40% {
        opacity: 1;
        transform: translateY(-3px);
      }
    }

    .chat-form {
      display: flex;
      align-items: center;
      gap: 10px;
      padding: 12px;
      border-top: 1px solid rgba(224, 192, 122, 0.45);
      background: rgba(255, 255, 255, 0.54);
      backdrop-filter: blur(12px);
      -webkit-backdrop-filter: blur(12px);
    }

    .chat-form input {
      flex: 1;
      min-width: 0;
      border: 1px solid rgba(182, 141, 64, 0.28);
      background: #fffaf2;
      color: #4a3012;
      border-radius: 999px;
      padding: 12px 15px;
      font-size: 14px;
      outline: none;
      transition: border-color 0.2s ease, box-shadow 0.2s ease, background 0.2s ease;
    }

    .chat-form input:focus {
      background: #fff;
      border-color: #b68d40;
      box-shadow: 0 0 0 4px rgba(182, 141, 64, 0.14);
    }

    .chat-form input:disabled {
      opacity: 0.72;
    }

    .chat-form button {
      border: none;
      background: linear-gradient(135deg, #b68d40, #e0c07a);
      color: #fff;
      width: 44px;
      height: 44px;
      border-radius: 50%;
      cursor: pointer;
      display: grid;
      place-items: center;
      box-shadow: 0 10px 22px rgba(182, 141, 64, 0.32);
      transition: transform 0.2s ease, box-shadow 0.2s ease, opacity 0.2s ease;
      flex: 0 0 auto;
    }

    .chat-form button:hover {
      transform: translateY(-1px);
      box-shadow: 0 14px 28px rgba(182, 141, 64, 0.4);
    }

    .chat-form button:disabled {
      cursor: not-allowed;
      opacity: 0.65;
      transform: none;
      box-shadow: none;
    }

    @media (max-width: 576px) {
      .chat-popup {
        left: 12px;
        right: auto;
        bottom: 154px;
        width: calc(100vw - 24px);
        height: min(58vh, 540px);
        border-radius: 22px;
        transform-origin: 28px calc(100% + 74px);
      }

      .chat-message {
        max-width: 88%;
      }

      .chat-bottom-close {
        right: 14px;
        top: 14px;
      }

    }
  </style>
  <?= $extra_css ?? '' ?>
</head>

<body>
  <div class="top-header">
    <div class="container">
      <nav class="top-nav">
        <span>📍 Gg. Mushollah, Desa Jadimulya</span>
        <span>|</span>
        <span>⏰ Senin–Sabtu 08.00–17.00</span>
        <span>|</span>
        <span>📞 089682506082</span>
      </nav>
    </div>
  </div>

  <!-- Main Header -->
  <header class="main-header">
    <div class="container">
      <div class="logo">
        <a href="<?= base_url('#beranda') ?>">
          <img src="<?= base_url('public/img/logo/logo-jasa-jahit.png') ?>" alt="Jasa Jahit Premium" />
        </a>
      </div>

      <nav class="main-nav">
        <a href="<?= base_url('#beranda') ?>">Beranda</a>
        <a href="<?= base_url('#tentang-jasa') ?>">Tentang Kami</a>
        <a href="<?= base_url('#jasa') ?>">Layanan</a>
        <a href="<?= base_url('#process') ?>">Proses</a>
        <a href="<?= base_url('lacak') ?>">Lacak Pesanan</a>
        <!-- LOGIN BUTTON -->

        <?php if (!empty($_SESSION['login'])): ?>
          <div class="user-action">
            <div class="user-profile" onclick="userMenuToggle()">
              <img src="<?= base_url('public/img/foto_pelanggan/' . ($_SESSION['foto'] ?? 'default.jpg')) ?>" alt="Foto">
            </div>

            <div class="user-menu">
              <h3>
                <?= htmlspecialchars($_SESSION['nama_lengkap'] ?? ''); ?><br>
                <span><?= htmlspecialchars($_SESSION['role'] ?? ''); ?></span>
              </h3>
              <ul>
                <li><i class="fas fa-user"></i><a href="<?= base_url('admin/profile') ?>">Profil</a></li>
                <li><i class="fas fa-comments"></i><a href="javascript:void(0)" onclick="openChatPopup()">Chat</a></li>
                <li><i class="fas fa-sign-out-alt"></i><a href="<?= base_url('auth/logout') ?>">Logout</a></li>
              </ul>
            </div>
          </div>
        <?php endif; ?>

      </nav>

      <!-- Burger Menu Button -->
      <button class="burger-menu" id="burgerMenu" aria-label="Toggle Menu">
        <span></span>
        <span></span>
        <span></span>
      </button>
    </div>
  </header>

  <!-- Mobile Menu Overlay -->
  <div class="mobile-menu-overlay" id="mobileMenuOverlay"></div>

  <!-- Mobile Menu Sidebar -->
  <nav class="mobile-menu" id="mobileMenu">
    <button class="mobile-menu-close" id="mobileMenuClose" aria-label="Close Menu">
      <i class="fas fa-times"></i>
    </button>

    <div class="mobile-menu-content">
      <a href="<?= base_url('#beranda') ?>" class="mobile-menu-link">Beranda</a>
      <a href="<?= base_url('#tentang-jasa') ?>" class="mobile-menu-link">Tentang Kami</a>
      <a href="<?= base_url('#jasa') ?>" class="mobile-menu-link">Layanan</a>
      <a href="<?= base_url('#process') ?>" class="mobile-menu-link">Proses</a>
      <a href="<?= base_url('lacak') ?>" class="mobile-menu-link">Lacak Pesanan</a>

      <div class="mobile-menu-divider"></div>

      <?php if (!empty($_SESSION['login'])): ?>
        <!-- USER LOGIN -->
        <div class="mobile-user-info">
          <img src="<?= base_url('public/img/foto_pelanggan/' . ($_SESSION['foto'] ?? 'default.jpg')) ?>" alt="Foto User"
            class="mobile-user-avatar">
          <div class="mobile-user-text">
            <strong><?= htmlspecialchars($_SESSION['nama_lengkap']); ?></strong>
            <span><?= htmlspecialchars($_SESSION['role']); ?></span>
          </div>
        </div>

        <a href="<?= base_url('pelanggan/fitur_lainnya/profile.php') ?>" class="mobile-menu-link secondary">
          <i class="fas fa-user"></i> Profil
        </a>
        <a href="javascript:void(0)" class="mobile-menu-link secondary" onclick="openChatPopup()">
          <i class="fas fa-comments"></i> Chat
        </a>
        <a href="<?= base_url('auth/logout.php') ?>" class="mobile-menu-link secondary danger">
          <i class="fas fa-sign-out-alt"></i> Logout
        </a>

      <?php endif; ?>
    </div>
  </nav>
