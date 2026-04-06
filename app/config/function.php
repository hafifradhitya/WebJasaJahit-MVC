<?php

function e($value) {
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

function base_url($path) {
    return BASE_URL . '/' . $path;
}

function site_url($url = '') {
    return '/' . $url;
}