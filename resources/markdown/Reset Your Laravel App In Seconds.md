---
title: Reset Your Laravel App In Seconds
slug: 
author: Carl Cassar
description: In his recent talk about Laravel Nova at Laracon US, Taylor Otwell used a nice little shortcut to reset his demo app during the presentation.
tags:
  - terminal
  - laravel
  - php
image: 
link: https://www.carlcassar.com/articles/reset-your-laravel-app-in-seconds
published_at: 2018-08-06 18:35:00
created_at: 2018-08-06 18:35:00
updated_at: 2018-08-06 18:35:00
deleted_at:
---
In his recent talk about Laravel Nova at Laracon US, Taylor Otwell used a nice little shortcut to reset his demo app during the presentation. To reset an app in our local environment, we need to do three things:

1. Drop the database.
2. Migrate the database.
3. Seed the database.

As of Laravel 5.5, we've been able to to use the following command to perform all three actions at once:

```shell script
php artisan migrate:fresh --seed
```

That's still quite a lot to type if you are using this command over and over, so let's add a quick alias to our `bashrc` or `zshrc`:

```shell script
alias mfs="php artisan migrate:fresh --seed"
```

Now you can simply type `mfs` to quickly refresh your application and reseed it with fresh data.

While I've got your attention, [Taylor's talk](https://www.youtube.com/watch?v=pLcM3mpZSV0) is well worth watching. I always learn something new from his presentations. I love the way that he can abstract a concept to the point where thousands of developers can use it in their own projects.
