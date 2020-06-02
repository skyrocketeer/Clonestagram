<p align="center"><img src="https://res.cloudinary.com/dtfbvvkyp/image/upload/v1566331377/laravel-logolockup-cmyk-red.svg" width="400"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

This repo is powered by Laravel and Vuejs

## Install package

<p>Install bcmath to use laravel telescope (you can skip telescope by delete the package in composer.json)</p>
<i>apt install php7.2-bcmath</i>
<p>composer install </p>

## Symlink environment
<i>ln -sF $(pwd)/env/.env.local $(pwd)/.env</i>

## Generate app key
<i>php artisan key:generate</i>

## Database migration
<p><i>php artisan migrate</i></p>
<p><i>php artisan db:seed</i></p>

## Build frontend
<p><i>npm install</i></p>
<p><i>npm run dev</i></p>
