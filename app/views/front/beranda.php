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
  <title>JAHIT - Jadimulya Jasa Jahit</title>
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
        <a href="<?= base_url('#process-gallery') ?>">Galeri</a>
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
      <a href="<?= base_url('#process-gallery') ?>" class="mobile-menu-link">Galeri</a>

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


  <!-- Hero Slider -->
  <section class="hero-slider" id="beranda">
    <div class="slider-container">
      <div class="slide active">
        <img src="<?= base_url('public/img/hero/hero1.jpeg') ?>" alt="" />
      </div>
      <div class="slide">
        <img src="<?= base_url('public/img/hero/hero2.jpeg') ?>" alt="" />
      </div>
      <div class="slide">
        <img src="<?= base_url('public/img/hero/hero3.jpeg') ?>" alt="" />
      </div>

      <!-- Navigation Arrows -->
      <button class="slider-nav prev" onclick="previousSlide()">‹</button>
      <button class="slider-nav next" onclick="nextSlide()">›</button>

      <!-- Indicators -->
      <div class="slider-indicators">
        <div class="indicator active" onclick="currentSlide(1)"></div>
        <div class="indicator" onclick="currentSlide(2)"></div>
        <div class="indicator" onclick="currentSlide(3)"></div>
      </div>
    </div>
  </section>

  <!-- Kenapa Pilih Jasa Jahit Section -->
  <section class="sambutan" id="tentang-jasa">
    <div class="container">

      <!-- Feature Icons -->
      <div class="feature-grid">
        <div class="feature-item">
          <div class="feature-thumb count-thumb">
            <span>10+</span>
          </div>
          <p>Tahun<br />Pengalaman</p>
        </div>

        <div class="feature-item">
          <div class="feature-thumb count-thumb">
            <span>1500+</span>
          </div>
          <p>Pelanggan<br />Puas</p>
        </div>

        <div class="feature-item">
          <div class="feature-thumb count-thumb">
            <span>100%</span>
          </div>
          <p>Jahitan<br />Presisi</p>
        </div>

        <div class="feature-item">
          <div class="feature-thumb count-thumb">
            <span>Fast</span>
          </div>
          <p>Proses<br />Cepat</p>
        </div>
      </div>

      <!-- Heading & Description -->
      <div class="why">
        <h2>Mengapa Pilih <span class="highlight">Jasa Jahit Kami</span>?</h2>
        <h3>
          Kami menghadirkan layanan jahit dengan standar kualitas tinggi, detail presisi,
          serta sentuhan profesional. Setiap jahitan dikerjakan dengan ketelitian,
          menggunakan bahan terbaik dan disesuaikan dengan kebutuhan pelanggan.
          Kepuasan Anda adalah prioritas utama kami.
        </h3>
      </div>
    </div>

    <!-- Statistics Band -->
    <div class="stats-band">
      <div class="stats-wrapper">
        <div class="stat-card">
          <span class="stat-label">Kualitas Jahitan</span>
          <span class="stat-value accent">PREMIUM</span>
        </div>

        <div class="stat-card">
          <span class="stat-label">Ketepatan Ukuran</span>
          <span class="stat-value">AKURAT</span>
        </div>

        <div class="stat-card">
          <span class="stat-label">Kepercayaan Pelanggan</span>
          <span class="stat-value accent">TINGGI</span>
        </div>
      </div>
    </div>
  </section>

  <section class="temukan-layanan" id="jasa" style="margin-top: 100px;">
    <div class="container">
      <h2 class="tp-title">Temukan Layanan Jahit Terbaik untuk Anda</h2>

      <!-- Filter Tabs -->
      <div class="tp-filters" role="tablist" aria-label="Filter Layanan">
        <button class="tp-filter active" data-filter="all" role="tab" aria-selected="true">
          Semua Layanan
        </button>
        <?php foreach ($kategori_array as $kategori): ?>
          <button class="tp-filter" data-filter="kategori-<?= $kategori['id_kategori'] ?>" role="tab"
            aria-selected="false">
            <?= htmlspecialchars($kategori['nama_kategori']) ?>
          </button>
        <?php endforeach ?>
      </div>

      <!-- Intro Text - akan disembunyikan saat empty state muncul -->
      <h3 class="tp-intro" id="introText" style="font-weight: normal;">
        Kami menyediakan berbagai layanan jahit profesional mulai dari kebutuhan
        harian hingga busana formal dan custom eksklusif. Setiap jahitan dikerjakan
        dengan ketelitian, bahan berkualitas, dan sentuhan pengalaman untuk
        memastikan hasil yang rapi, nyaman, dan sesuai keinginan Anda.
      </h3>

      <!-- Programs Grid -->
      <div class="tp-grid" id="programGrid">
        <?php
        $total_layanan = 0;
        foreach ($layanan_by_kategori as $id_kat => $layanan_list) {
          foreach ($layanan_list as $layanan) {
            $total_layanan++;
            ?>
            <article class="tp-card" data-category="kategori-<?= $layanan['id_kategori'] ?>">
              <div class="tp-card-media">
                <img src="<?= base_url('public/img/layanan/' . $layanan['foto']) ?>"
                  alt="<?= htmlspecialchars($layanan['nama_layanan']) ?>" loading="lazy" />
              </div>
              <div class="tp-card-body">
                <h3><?= htmlspecialchars($layanan['nama_layanan']) ?></h3>
                <p><?= htmlspecialchars($layanan['deskripsi']) ?></p>
                <a href="<?= base_url('front/detail_layanan.php?id=' . $layanan['id_layanan']) ?>"
                  class="tp-card-btn">Detail Layanan</a>
              </div>
            </article>
            <?php
          }
        }

        // Jika tidak ada layanan sama sekali
        if ($total_layanan == 0):
          ?>
          <div class="col-12">
            <div class="alert alert-info text-center" role="alert">
              <i class="icon-copy dw dw-information" style="font-size: 48px;"></i>
              <h4 class="alert-heading mt-3">Layanan Belum Tersedia</h4>
              <p class="mb-0">Maaf, saat ini belum ada layanan yang tersedia. Silakan hubungi kami untuk informasi lebih
                lanjut.</p>
            </div>
          </div>
        <?php endif; ?>
      </div>

      <!-- Empty State Modern - untuk kategori kosong -->
      <div id="emptyState" style="display: none;">
        <div class="empty-state-wrapper">
          <div class="empty-state-card">

            <div class="icon-box">
              <i class="dw dw-broken-link"></i>
            </div>

            <h3>Layanan Belum Tersedia</h3>

            <p>
              Untuk kategori yang Anda pilih, layanan masih dalam tahap
              <strong>pengembangan</strong> dan belum dapat ditampilkan saat ini.
              <br>
              Silakan jelajahi kategori lain atau hubungi kami untuk informasi lebih lanjut.
            </p>

            <div class="action-group">
              <button class="btn" onclick="showAllServices()">
                <i class="dw dw-left-arrow-3"></i> Lihat Semua Layanan
              </button>
            </div>

          </div>
        </div>
      </div>

    </div>
  </section>

  <section class="section-timeline" id="process">
    <div class="page-wrapper">

      <!-- HEADING -->
      <div class="section-timeline-heading">
        <div class="container">
          <div class="padding-vertical-xlarge">
            <div class="timeline-main_heading-wrapper">
              <div class="margin-bottom-medium">
                <h2 class="title-timeline">From Fabric to Fit</h2>
              </div>
              <p class="paragraph-large">
                Setiap langkah kami kerjakan dengan presisi, detail, dan rasa —
                memastikan setiap jahitan mencerminkan kualitas dan karakter Anda.
              </p>
            </div>
          </div>
        </div>
      </div>

      <!-- TIMELINE -->
      <div class="container">
        <div class="timeline-component">

          <!-- PROGRESS LINE -->
          <div class="timeline_progress">
            <div class="timeline_progress-bar"></div>
          </div>

          <!-- STEP 1 -->
          <div class="timeline_item">
            <div class="timeline_left">
              <div class="timeline_date-text">01</div>
            </div>

            <div class="timeline_centre">
              <div class="timeline_circle"></div>
            </div>

            <div class="timeline-right">
              <div class="margin-bottom-medium">
                <div class="timeline_text">
                  Konsultasi & Pengukuran
                  <span class="text-colour-lightgrey">
                    — kami mendengarkan kebutuhan dan mengambil ukuran secara detail.
                  </span>
                </div>
              </div>

              <!-- IMAGE -->
              <div class="timeline-image-wrapper">
                <img src="<?= base_url('public/img/hero/hero1.jpeg') ?>" alt="Konsultasi dan pengukuran"
                  loading="lazy" />
              </div>
            </div>
          </div>

          <!-- STEP 2 -->
          <div class="timeline_item">
            <div class="timeline-right">
              <div class="margin-bottom-medium">
                <div class="timeline_text">
                  Pemilihan Kain
                  <span class="text-colour-lightgrey">
                    — bahan terbaik disesuaikan dengan fungsi dan karakter.
                  </span>
                </div>
              </div>
              <!-- IMAGE -->
              <div class="timeline-image-wrapper">
                <img src="<?= base_url('public/img/hero/hero2.jpeg') ?>" alt="Konsultasi dan pengukuran"
                  loading="lazy" />
              </div>
            </div>

            <div class="timeline_centre">
              <div class="timeline_circle"></div>
            </div>

            <div class="timeline_right">
              <div class="timeline_date-text">02</div>
            </div>


          </div>

          <!-- STEP 3 -->
          <div class="timeline_item">
            <div class="timeline_left">
              <div class="timeline_date-text">03</div>
            </div>

            <div class="timeline_centre">
              <div class="timeline_circle"></div>
            </div>

            <div class="timeline-right">
              <div class="margin-bottom-medium">
                <div class="timeline_text">
                  Pola & Potong
                  <span class="text-colour-lightgrey">
                    — presisi pola menentukan hasil akhir yang sempurna.
                  </span>
                </div>
              </div>
              <!-- IMAGE -->
              <div class="timeline-image-wrapper">
                <img src="<?= base_url('public/img/hero/hero3.jpeg') ?>" alt="Konsultasi dan pengukuran"
                  loading="lazy" />
              </div>
            </div>
          </div>

          <!-- STEP 4 -->
          <div class="timeline_item">
            <div class="timeline-right">
              <div class="margin-bottom-medium">
                <div class="timeline_text">
                  Jahit & Finishing
                  <span class="text-colour-lightgrey">
                    — detail halus pada setiap jahitan.
                  </span>
                </div>
              </div>
              <!-- IMAGE -->
              <div class="timeline-image-wrapper">
                <img src="<?= base_url('public/img/hero/hero1.jpeg') ?>" alt="Konsultasi dan pengukuran"
                  loading="lazy" />
              </div>
            </div>

            <div class="timeline_centre">
              <div class="timeline_circle"></div>
            </div>

            <div class="timeline_right">
              <div class="timeline_date-text">04</div>
            </div>
          </div>

          <!-- STEP 5 -->
          <div class="timeline_item">
            <div class="timeline_left">
              <div class="timeline_date-text">05</div>
            </div>

            <div class="timeline_centre">
              <div class="timeline_circle"></div>
            </div>

            <div class="timeline-right">
              <div class="margin-bottom-medium">
                <div class="timeline_text">
                  Fitting Akhir
                  <span class="text-colour-lightgrey">
                    — memastikan kenyamanan dan kesempurnaan.
                  </span>
                </div>
              </div>
              <!-- IMAGE -->
              <div class="timeline-image-wrapper">
                <img src="<?= base_url('public/img/hero/hero2.jpeg') ?>" alt="Konsultasi dan pengukuran"
                  loading="lazy" />
              </div>
            </div>
          </div>

          <!-- OVERLAY -->
          <div class="overlay-fade-top"></div>
          <div class="overlay-fade-bottom"></div>

        </div>
      </div>
    </div>
  </section>

  <section class="jahit-gallery" id="process-gallery">
    <div class="km-container">
      <h2>Workshop & Proses Jahit Kami</h2>
      <h3 class="km-intro">
        Setiap detail kami kerjakan langsung di workshop kami — mulai dari
        pengukuran, pemilihan kain, hingga finishing akhir dengan standar kualitas tinggi.
      </h3>

      <div class="km-grid">
        <figure class="km-item km-item--auditorium">
          <img src="<?= base_url('public/img/galeri/Mesin-Jahit-Benang.jpg') ?>" alt="Workshop Jahit" loading="lazy" />
          <figcaption>Workshop Jahit</figcaption>
        </figure>

        <figure class="km-item km-item--rapat">
          <img src="<?= base_url('public/img/galeri/ngukur-kain.jpg') ?>" alt="Konsultasi Pelanggan" loading="lazy" />
          <figcaption>Konsultasi & Ukur</figcaption>
        </figure>

        <figure class="km-item km-item--lab">
          <img src="<?= base_url('public/img/galeri/cutting-cloth.jpg') ?>" alt="Pembuatan Pola" loading="lazy" />
          <figcaption>Pola & Potong</figcaption>
        </figure>

        <figure class="km-item km-item--perpus">
          <img src="<?= base_url('public/img/galeri/jahit-kain.jpg') ?>" alt="Finishing Jahitan" loading="lazy" />
          <figcaption>Jahit & Finishing</figcaption>
        </figure>
      </div>
    </div>
  </section>

  <!-- Popup Chat Pelanggan -->
  <div id="chatOverlay" class="chat-overlay" onclick="closeChatPopup()"></div>
  <div id="chatPopup" class="chat-popup">
    <div class="chat-header">
      <div class="chat-title">
        <div class="chat-avatar">
          <i class="fas fa-headset"></i>
        </div>
        <div class="chat-title-text">
          <strong>Asisten AI Jadimulya</strong>
          <span class="chat-status">Online via Qwen Hugging Face</span>
        </div>
      </div>
      <button type="button" class="close-btn" onclick="closeChatPopup()" aria-label="Tutup chat">&times;</button>
    </div>
    <div id="chatMessages" class="chat-messages">
      <!-- Pesan dimuat via AJAX -->
    </div>
    <form id="chatForm" class="chat-form">
      <input type="text" id="chatInput" placeholder="Tulis pesan..." autocomplete="off" required />
      <button type="submit" aria-label="Kirim pesan">
        <i class="fas fa-paper-plane"></i>
      </button>
    </form>
    <button type="button" id="chatCloseBottom" class="chat-bottom-close" onclick="closeChatPopup()" aria-label="Tutup chat">
      <i class="fas fa-times"></i>
    </button>
  </div>

  <!-- WHATSAPP FLOAT GOLDEN -->
  <button type="button" id="aiFloatingButton" class="ai-golden" onclick="toggleChatPopup()" aria-label="Chat customer service">
    <i class="fas fa-headset"></i>
  </button>
  <a href="https://wa.me/6285720301295?text=Halo%20saya%20ingin%20konsultasi%20jasa%20jahit" class="wa-golden"
    target="_blank" aria-label="Chat WhatsApp Ja sa Jahit">
    <i class="fab fa-whatsapp"></i>
  </a>


  <!-- ================= FAQ ================= -->
  <section class="faq-section" id="faq">
    <div class="container">

      <div class="faq-heading">
        <h2>Pertanyaan yang <span class="highlight">Sering Diajukan</span></h2>
        <p>
          Temukan jawaban seputar layanan jasa jahit kami dengan mudah dan cepat.
        </p>
      </div>

      <div class="faq-wrapper">

        <div class="faq-item">
          <button class="faq-question">
            Apakah bisa jahit baju sesuai desain sendiri?
            <span class="faq-icon">+</span>
          </button>
          <div class="faq-answer">
            <p>
              Tentu bisa. Anda dapat membawa desain sendiri atau referensi gambar,
              dan kami akan membantu menyesuaikan model, ukuran, serta bahan agar
              hasilnya maksimal dan nyaman dipakai.
            </p>
          </div>
        </div>

        <div class="faq-item">
          <button class="faq-question">
            Berapa lama proses pengerjaan jahit?
            <span class="faq-icon">+</span>
          </button>
          <div class="faq-answer">
            <p>
              Waktu pengerjaan tergantung tingkat kesulitan dan jumlah pesanan.
              Rata-rata proses jahit membutuhkan waktu 3–7 hari kerja.
            </p>
          </div>
        </div>

        <div class="faq-item">
          <button class="faq-question">
            Apakah menerima permak atau revisi ukuran?
            <span class="faq-icon">+</span>
          </button>
          <div class="faq-answer">
            <p>
              Ya, kami menerima permak dan revisi ukuran seperti mengecilkan,
              membesarkan, atau memperbaiki jahitan agar pas di badan.
            </p>
          </div>
        </div>

        <div class="faq-item">
          <button class="faq-question">
            Apakah harus datang langsung ke toko?
            <span class="faq-icon">+</span>
          </button>
          <div class="faq-answer">
            <p>
              Untuk pengukuran disarankan datang langsung ke toko.
              Namun untuk konsultasi awal, Anda bisa menghubungi kami terlebih dahulu
              melalui WhatsApp atau form pesan.
            </p>
          </div>
        </div>

      </div>

    </div>
  </section>


  <!-- ================= CONTACT & LOCATION ================= -->
  <section class="contact-location" id="kontak">
    <div class="container">

      <div class="contact-wrapper">

        <!-- LEFT : FORM -->
        <div class="contact-card">
          <h2>Hubungi <span class="highlight">Kami</span></h2>
          <p class="contact-desc">
            Kirim pesan atau pertanyaan Anda terkait jasa jahit kami.
            Kami siap membantu dengan sepenuh hati.
          </p>

          <form class="contact-form" id="waForm">
            <div class="form-group">
              <label>Email</label>
              <input type="email" id="email" placeholder="email@example.com" required>
            </div>

            <div class="form-group">
              <label>Nama Lengkap</label>
              <input type="text" id="nama" placeholder="Nama Anda" required>
            </div>

            <div class="form-group">
              <label>Pesan</label>
              <textarea id="pesan" rows="4" placeholder="Tuliskan pesan Anda..." required></textarea>
            </div>

            <button type="submit" class="btn-submit">
              Kirim Pesan
            </button>
          </form>
        </div>

        <!-- RIGHT : MAP -->
        <div class="map-card">
          <iframe src="https://www.google.com/maps?q=-6.689232,108.550924&z=17&output=embed" allowfullscreen
            loading="lazy" referrerpolicy="no-referrer-when-downgrade">
          </iframe>
          <div class="map-info">
            <h4>📍 Lokasi Toko Jahit Jadimulya</h4>
            <p>Jadimulya, Kabupaten Bekasi<br>Jawa Barat, Indonesia</p>
          </div>
        </div>

      </div>

    </div>
  </section>

  <footer class="site-footer">
    <div class="footer-main">

      <!-- LEFT -->
      <div class="footer-left">
        <!-- LOGO -->
        <div class="footer-logo">
          <img src="<?= base_url('public/img/logo/logo-jasa-jahit.png') ?>" alt="Jasa Jahit Logo">
        </div>

        <!-- LINKS -->
        <div class="footer-links">
          <ul>
            <li><a href="#layanan">Layanan Jahit</a></li>
            <li><a href="#process">Proses Pengerjaan</a></li>
            <li><a href="#portfolio">Hasil Jahitan</a></li>
            <li><a href="#testimoni">Testimoni</a></li>
          </ul>

          <ul>
            <li><a href="#tentang">Tentang Kami</a></li>
            <li><a href="#faq">FAQ</a></li>
            <li><a href="#kontak">Kontak</a></li>
          </ul>
        </div>

        <!-- CONTACT -->
        <div class="footer-contact">
          <p>Jl. Gunung Jati Gg. Mushollah, Desa Jadimulya, RT 02/RW 01, Kecamatan Gunung Jati, Kabupaten Cirebon,
            Provinsi Jawa Barat</p>
          <p>WhatsApp: +62 896-8250-6082</p>
          <p>Email: aldivamuhammad@gmail.com</p>
          <p>Jam Operasional: Senin – Sabtu, 09.00 – 18.00</p>
        </div>
      </div>

      <!-- RIGHT -->
      <div class="footer-right">
        <!-- SOCIAL -->
        <div class="footer-social">
          <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
          <a href="#" aria-label="TikTok"><i class="fab fa-tiktok"></i></a>
          <a href="#" aria-label="WhatsApp"><i class="fab fa-whatsapp"></i></a>
          <a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
        </div>

        <!-- DECORATIVE IMAGE -->
        <div class="footer-rektorat">
          <img src="<?= base_url('public/img/footer/toko-jahit.png') ?>" alt="Mesin Jahit">
        </div>
      </div>

    </div>

    <!-- COPYRIGHT -->
    <div class="footer-copy">
      <p>© 2025 Jasa Jahit — Tailored with Precision & Care.</p>
    </div>
  </footer>


  <button id="backToTop" class="back-to-top" aria-label="Kembali ke atas" title="Kembali ke atas">
    ▲
  </button>

  <script>
    function appendMessage(text, sender) {
      const container = document.getElementById('chatMessages');
      if (!container) return;
      const div = document.createElement('div');
      div.className = 'chat-message ' + (sender === 'user' ? 'you' : 'admin');
      if (sender === 'user') {
        div.textContent = text;
      } else {
        div.innerHTML = text;
      }
      container.appendChild(div);
      container.scrollTop = container.scrollHeight;
    }

    // Flag for initial message
    let chatOpened = false;
    let chatHistory = [];
    let chatCloseTimer = null;

    function htmlToText(html) {
      const div = document.createElement('div');
      div.innerHTML = html;
      return div.textContent || div.innerText || '';
    }

    function pulseAiButton() {
      const aiButton = document.getElementById('aiFloatingButton');
      if (!aiButton) return;
      aiButton.classList.remove('vortex-pulse');
      void aiButton.offsetWidth;
      aiButton.classList.add('vortex-pulse');
      window.setTimeout(function () {
        aiButton.classList.remove('vortex-pulse');
      }, 700);
    }

    function setAiButtonOpen(isOpen) {
      const aiButton = document.getElementById('aiFloatingButton');
      if (!aiButton) return;
      const icon = aiButton.querySelector('i');
      aiButton.classList.toggle('chat-open', isOpen);
      aiButton.setAttribute('aria-label', isOpen ? 'Tutup chat customer service' : 'Chat customer service');
      if (icon) {
        icon.className = isOpen ? 'fas fa-times' : 'fas fa-headset';
      }
    }

    function toggleChatPopup() {
      const popup = document.getElementById('chatPopup');
      if (popup && popup.classList.contains('open')) {
        closeChatPopup();
      } else {
        openChatPopup();
      }
    }

    function openChatPopup() {
      const popup = document.getElementById('chatPopup');
      const overlay = document.getElementById('chatOverlay');
      if (!popup) return;
      if (chatCloseTimer) {
        window.clearTimeout(chatCloseTimer);
        chatCloseTimer = null;
      }
      pulseAiButton();
      popup.classList.remove('vortex-out');
      popup.classList.add('vortex-in');
      popup.classList.add('open');
      if (overlay) overlay.classList.add('open');
      setAiButtonOpen(true);
      
      if (!chatOpened) {
        const greeting = 'Halo! Saya Asisten AI Jadimulya Jasa Jahit.<br>Saya bisa bantu info harga, layanan, estimasi pengerjaan, alamat, jam buka, dan kontak pemesanan.';
        appendMessage(greeting, 'admin');
        chatHistory.push({ role: 'assistant', content: htmlToText(greeting) });
        chatOpened = true;
      }
    }

    function closeChatPopup() {
      const popup = document.getElementById('chatPopup');
      const overlay = document.getElementById('chatOverlay');
      if (!popup) return;
      pulseAiButton();
      popup.classList.remove('vortex-in');
      popup.classList.add('vortex-out');
      if (overlay) overlay.classList.remove('open');
      setAiButtonOpen(false);
      chatCloseTimer = window.setTimeout(function () {
        popup.classList.remove('open', 'vortex-out');
        chatCloseTimer = null;
      }, 420);
    }

    document.addEventListener('DOMContentLoaded', function () {
      const form = document.getElementById('chatForm');
      if (!form) return;
      const submitButton = form.querySelector('button[type="submit"]');

      form.addEventListener('submit', function (e) {
        e.preventDefault();
        const input = document.getElementById('chatInput');
        const text = input.value.trim();
        if (!text) return;

        // Tampilkan pesan user
        appendMessage(text, 'user');
        chatHistory.push({ role: 'user', content: text });
        input.value = '';
        input.disabled = true;
        if (submitButton) submitButton.disabled = true;

        // Tampilkan indikator mengetik
        const container = document.getElementById('chatMessages');
        const loadingDiv = document.createElement('div');
        loadingDiv.className = 'chat-message admin loading-indicator';
        loadingDiv.innerHTML = '<span class="typing-dot"></span><span class="typing-dot"></span><span class="typing-dot"></span>';
        container.appendChild(loadingDiv);
        container.scrollTop = container.scrollHeight;

        fetch('<?= base_url('chatbot/reply') ?>', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
          },
          body: 'message=' + encodeURIComponent(text) + '&history=' + encodeURIComponent(JSON.stringify(chatHistory.slice(-8)))
        })
          .then(function (r) {
            return r.json();
          })
          .then(function (data) {
            // Hapus indikator
            if (container.contains(loadingDiv)) {
              container.removeChild(loadingDiv);
            }
            input.disabled = false;
            if (submitButton) submitButton.disabled = false;
            input.focus();
            if (data.success) {
              appendMessage(data.reply, 'admin');
              chatHistory.push({ role: 'assistant', content: htmlToText(data.reply) });
            } else {
              const errorReply = data.reply || 'Maaf, pesan belum bisa diproses. Coba tanyakan harga, layanan, estimasi, alamat, atau kontak WhatsApp ya.';
              appendMessage(errorReply, 'admin');
              chatHistory.push({ role: 'assistant', content: htmlToText(errorReply) });
            }
          })
          .catch(function () { 
            if (container.contains(loadingDiv)) {
              container.removeChild(loadingDiv);
            }
            input.disabled = false;
            if (submitButton) submitButton.disabled = false;
            input.focus();
            const errorReply = 'Koneksi ke chatbot terputus. Coba kirim ulang pesan sebentar lagi ya.';
            appendMessage(errorReply, 'admin');
            chatHistory.push({ role: 'assistant', content: errorReply });
          });
      });
    });
  </script>

  <script>
    function userMenuToggle() {
      document.querySelector('.user-menu').classList.toggle('active');
    }

    // klik di luar → menu menutup
    document.addEventListener('click', function (e) {
      const action = document.querySelector('.user-action');
      if (!action.contains(e.target)) {
        document.querySelector('.user-menu')?.classList.remove('active');
      }
    });
  </script>

  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const filters = document.querySelectorAll('.tp-filter');
      const cards = document.querySelectorAll('.tp-card');
      const grid = document.getElementById('programGrid');
      const emptyState = document.getElementById('emptyState');

      filters.forEach(filter => {
        filter.addEventListener('click', function () {
          const filterValue = this.getAttribute('data-filter');

          // Update active state
          filters.forEach(f => {
            f.classList.remove('active');
            f.setAttribute('aria-selected', 'false');
          });
          this.classList.add('active');
          this.setAttribute('aria-selected', 'true');

          let visibleCount = 0;

          // Filter cards
          cards.forEach(card => {
            if (filterValue === 'all' || card.getAttribute('data-category') === filterValue) {
              card.style.display = 'block';
              visibleCount++;
            } else {
              card.style.display = 'none';
            }
          });

          // Show/hide empty state
          if (visibleCount === 0) {
            emptyState.style.display = 'block';
            cards.forEach(card => card.style.display = 'none');
          } else {
            emptyState.style.display = 'none';
          }
        });
      });
    });

    function showAllServices() {
      const allButton = document.querySelector('.tp-filter[data-filter="all"]');
      if (allButton) {
        allButton.click();
      }
    }
  </script>

  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const filters = document.querySelectorAll('.tp-filter');
      const cards = document.querySelectorAll('.tp-card');
      const grid = document.getElementById('programGrid');
      const emptyState = document.getElementById('emptyState');
      const introText = document.getElementById('introText');

      filters.forEach(filter => {
        filter.addEventListener('click', function () {
          const filterValue = this.getAttribute('data-filter');

          // Update active state
          filters.forEach(f => {
            f.classList.remove('active');
            f.setAttribute('aria-selected', 'false');
          });
          this.classList.add('active');
          this.setAttribute('aria-selected', 'true');

          let visibleCount = 0;

          // Filter cards
          cards.forEach(card => {
            if (filterValue === 'all' || card.getAttribute('data-category') === filterValue) {
              card.style.display = 'block';
              visibleCount++;
            } else {
              card.style.display = 'none';
            }
          });

          // Show/hide empty state dan intro text
          if (visibleCount === 0) {
            // Sembunyikan intro text
            introText.style.display = 'none';
            // Sembunyikan grid
            grid.style.display = 'none';
            // Tampilkan empty state
            emptyState.style.display = 'block';
          } else {
            // Tampilkan intro text
            introText.style.display = 'block';
            // Tampilkan grid
            grid.style.display = 'grid';
            // Sembunyikan empty state
            emptyState.style.display = 'none';
          }
        });
      });
    });

    function showAllServices() {
      const allButton = document.querySelector('.tp-filter[data-filter="all"]');
      if (allButton) {
        allButton.click();
      }
    }
  </script>
  <script src="<?= base_url('public/js/scroll.js') ?>"></script>
  <script src="<?= base_url('public/js/script.js') ?>"></script>
  <script src="<?= base_url('public/js/burgermenu.js') ?>"></script>
  <script src="<?= base_url('public/js/faq.js') ?>"></script>
  <script src="<?= base_url('public/js/whatsapp-form.js') ?>"></script>
  <script src="<?= base_url('public/js/backtotop.js') ?>"></script>

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <!-- Alert Berhasil -->
  <?php if (isset($_SESSION['berhasil'])): ?>
    <script>
      const Berhasil = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
          toast.onmouseenter = Swal.stopTimer;
          toast.onmouseleave = Swal.resumeTimer;
        }
      });
      Berhasil.fire({
        icon: "success",
        title: "<?= $_SESSION['berhasil'] ?>"
      });
    </script>
    <?php unset($_SESSION['berhasil']); ?>

  <?php endif; ?>
</body>

</html>
