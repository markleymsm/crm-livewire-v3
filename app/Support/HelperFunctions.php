<?php

function obfuscate_email(?string $email = null): string
{
    if (!$email) {
        return '';
    }

    $email = explode('@', $email);

    if (sizeof($email) !== 2) {
        return '';
    }

    $username = $email[0];
    $domain   = $email[1];

    $username = substr($username, 0, 3) . str_repeat('*', strlen($username) - 3);
    $domain   = str_repeat('*', strlen($domain) - 2) . substr($domain, -2);

    return $username . '@' . $domain;
}
