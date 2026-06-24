<?php

function hitung_diskon($totalUnit, $totalHarga)
{
    if ($totalUnit >= 5) {
        return $totalHarga * 0.15;
    }

    if ($totalUnit >= 3) {
        return $totalHarga * 0.10;
    }

    if ($totalUnit == 2) {
        return $totalHarga * 0.05;
    }

    return 0;
}