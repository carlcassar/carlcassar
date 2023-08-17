---
title: Counting Related Models In Laravel
description: This Laravel quick tip will allow you to count model relations whilst ensuring you don't encounter an N+1 problem.
published_at: 02-01-2022 4:05
---
Very often when retrieving a model in Laravel, it is useful to load a count of related models at the same time. For example, when loading a blog post, you might want to display the number of comments left on that post.

Luckily, Laravel has a method to do just that:

```
$posts = Post::withCount('comments')->get();
```

What's more, as of Laravel 8, you can also make use of the `withMin`, `withMax`, `withAvg`, `withSum`, and `withExists` methods.

Read more in the [Laravel Documentation](https://laravel.com/docs/8.x/eloquent-relationships#counting-related-models).
