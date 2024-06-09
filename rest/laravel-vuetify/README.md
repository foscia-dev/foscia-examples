<p align="center">
  <img width="250" src="https://foscia.dev/img/logo-examples.svg" alt="Foscia Examples">
</p>

<p align="center">
<a href="https://foscia.dev">
  Website
</a>
•
<a href="https://foscia.dev/docs/getting-started">
  Documentation
</a>
</p>

This repository holds a ready-to-run example of a [Vue](https://vuejs.org/)
and [Vuetify](https://vuetifyjs.com/en/) frontend application using Foscia to
consume a [Laravel](https://laravel.com/) REST API.

This application is using [Laravel Sail](https://laravel.com/docs/11.x/sail),
which requires [Docker](https://www.docker.com/) to be installed on your computer.

> ℹ️ In this application, Foscia weight **87KB** after treeshake and minification (non-gziped).

## Getting started

### 1. Clone the repository

```shell
git clone git@github.com:foscia-dev/foscia-examples.git
cd rest/laravel-vuetify
```

### 2. Start the Laravel application

```shell
./vendor/bin/sail up -d
./vendor/bin/sail artisan migrate
./vendor/bin/sail npm run dev
```

Open your browser at [http://localhost](http://localhost).

### 3. Create fake posts and comments

```shell
./vendor/bin/sail artisan db:seed PostsSeeder
```

## Relevant files

Here are the files using Foscia:

- [`resources/js/data`](resources/js/data) holds all Foscia files (action, models, composables,
  loaders, etc.)
- [`resources/js/Pages/Posts/Index.vue`](resources/js/Pages/Posts/Index.vue) list all posts
- [`resources/js/Components/Posts/PostsCreateDialog.vue`](resources/js/Components/Posts/PostsCreateDialog.vue) create a post
- [`resources/js/Pages/Posts/Index.vue`](resources/js/Pages/Posts/Index.vue) show one post and comments
