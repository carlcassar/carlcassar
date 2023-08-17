---
title: Better Http Status Codes In Laravel
description: This Laravel quick tip will show you how to make your code more readable and expressive by replacing http status code magic numbers with calls to static constants.
published_at: 02-01-2022 4:10
---
'Magic numbers' like `200` or `401` can cause a lot of confusion for colleagues or your future self. It's not always immediately obvious what these numbers represent. 

> A magic number is a number in the code that has no context or meaning.

Luckily, when it comes to HTTP Status Codes, we can make use of a complete set of constants that will make the meaning of your code self evident.

```php
return Response::HTTP_OK;
```

For example, `Response::HTTP_OK` will return `200`, `Response::HTTP_UNAUTHORIZED` will return `401` and my personal favourite `Response::HTTP_I_AM_A_TEAPOT` will return `418`.

This is possible because the `Illuminate\Http\Response` class extends the `Symfony\Component\HttpFoundation\Response` class.

Finally, we also have access to an array of all status codes via `Response::$statusTexts`. This is handy if you want to list, validate or otherwise iterate over all status codes.
