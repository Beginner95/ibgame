<!DOCTYPE html>
<html lang='ru'>
<head>
    <title>Игра</title>
    <meta charset="utf-8">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&display=swap&subset=cyrillic" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset(env('THEME')) }}/css/normalize.css">
    <link rel="stylesheet" type="text/css" href="{{ asset(env('THEME')) }}/css/style.css">
    <link rel="stylesheet" type="text/css" href="{{ asset(env('THEME')) }}/css/media.css">
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>