---
uuid: 77d8c622-037e-4804-9ecc-9c9837a1c404
title: Counting Related Models In Laravel
slug: 
author: Carl Cassar
description: This Laravel quick tip will allow you to count model relations whilst ensuring you don't encounter an N+1 problem.
tags:
  - tips
  - laravel
  - php
image: 
link: https://www.carlcassar.com/articles/counting-related-models-in-laravel
published_at: 2022-01-02 16:05:00
created_at: 2022-01-02 16:01:16
updated_at: 2022-01-02 16:19:47
deleted_at:
---
Very often when retrieving a model in Laravel, it is useful to load a count of related models at the same time. For example, when loading a blog post, you might want to display the number of comments left on that post.

Luckily, Laravel has a method to do just that:

```
$posts = Post::withCount('comments')->get();
```

What's more, as of Laravel 8, you can also make use of the `withMin`, `withMax`, `withAvg`, `withSum`, and `withExists` methods.

Read more in the [Laravel Documentation](https://laravel.com/docs/8.x/eloquent-relationships#counting-related-models).
