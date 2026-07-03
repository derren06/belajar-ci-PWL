<?php

if (!function_exists('hitung_ppn')) {
    function hitung_ppn($subtotal)
    {
        return $subtotal * 0.12;
    }
}

if (!function_exists('hitung_biaya_admin')) {
    function hitung_biaya_admin($subtotal)
    {
        if ($subtotal <= 15000000) {
            return $subtotal * 0.005; // 0.5%
        } elseif ($subtotal <= 35000000) {
            return $subtotal * 0.007; // 0.7%
        } else {
            return $subtotal * 0.009; // 0.9%
        }
    }
}

if (!function_exists('hitung_diskon_kupon')) {
    function hitung_diskon_kupon($kode, $subtotal)
    {
        switch (strtoupper($kode)) {

            case 'HEMAT10':
                return $subtotal * 0.10;

            case 'HEMAT20':
                return $subtotal * 0.20;

            default:
                return 0;
        }
    }
}
