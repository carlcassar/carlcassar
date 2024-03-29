---
uuid: 77d8c622-037e-4804-9ecc-9c9837a1c404
title: Testing Values
slug: 
author: Carl Cassar
description: Explore efficient methods for value testing in PHP & Laravel, doing away with confusion. Unravel best practices for clear, precise results.
tags:
  - php
image: 
link: https://www.carlcassar.com/articles/testing-values
published_at: 2018-08-03 17:32:00
created_at: 2018-08-03 17:32:00
updated_at: 2021-02-08 19:08:47
deleted_at:
---
There are many ways to test a value in php, some of which can produce confusing results. What’s more, Laravel also offers a couple of helpers which can help us test php values. We’ll go over each method in turn and find out how to avoid some common pitfalls along the way.

## Is Null
From the [php documentation](http://www.php.net/manual/en/function.is-null.php):

> `is_null()` finds whether a variable is NULL.

In other words, `is_null()` returns:

- `true` if the value is null and
- `false` if the value is not null

```php
is_null(null) // true
is_null(0) // false
is_null('')	// false
is_null([]) // false
is_null(true)	// false
is_null(false) // false
is_null(collect()) // false
```

## Is Set

From the [php documentation](http://www.php.net/manual/en/function.isset.php):

> `isset()` determines if a value is set and is not NULL.

Unlike other methods described in this post, `isset()` can take multiple values and returns true only if all the parameters are set. Also unlike other methods, `isset()` requires a variable to be passed and will throw an error if you try to pass a value directly.

```php
isset('value') // error

isset($unset)	// false

$value = null
isset($value)	// false

$value = 0
isset($value)	// true

$value = ''
isset($value)	// true

$value = []
isset($value)	// true

$value = true
isset($value)	// true

$value = false
isset($value)	// true

$value = collect()
isset($value)	// true
```

Notice that `isset()` returns false if null is passed, which can lead to some confusing results if you wanted to check whether a variable was initialised.

## Empty
 
From the [php documentation](http://www.php.net/manual/en/function.empty.php):

> `empty()`  determines whether a variable is empty.

`empty()` is a helper that is logically equivalent to `!isset($var) || $var == false`

```php
empty(null) // true
empty(0) // true
empty('') // true
empty([]) // true
empty(true) // false
empty(false) // true	
empty(collect()) // false 
```

The `empty()` function returns a couple of counterintuitive results, notably for `0`, `true` and `false`.  Because `empty()` performs a `==` check, values that are logically equivalent to `false` are treated as ‘empty’.  This can be confusing since you might think that `empty` implies that the method will return true if a variable contains a value, whereas this is only the case if that value is also falsey.

Another potential pitfall is the way that empty deals with arrays and collections (or other iterable objects). Whereas an array with no items is  treated as ‘empty’ (true), a collection with no items in it is considered ‘not empty’ (false).

## Blank

Laravel includes a helper method called [blank](https://laravel.com/docs/5.6/helpers#method-blank).

```php
blank(null) // true
blank(0) // false
blank('') // true
blank([]) // true
blank(true) // false
blank(false) // false
blank(collect()) // true
blank($unset) // error
```

This method tries to check if the value is `truthy` in a more intuitive way. One thing to note is that  unlike `empty()` it will not check if the value is set and will throw an error if you try to pass an unset variable. On a positive note, it treats arrays and collections in the same way.

Blank makes the following checks before falling back to the `empty()` method:

- Check if the value is null
- Check if the value is an empty string
- Check if the value is numeric or boolean
- Check if the value is an countable instance

It might be helpful to see the [method signature](https://github.com/laravel/framework/blob/c8682e11b9f0e153654ff5c2a3ad9f8b2dca56d1/src/Illuminate/Support/helpers.php#L334) for the `blank()` helper.

## Filled
Laravel also comes with a helper method called [filled](https://laravel.com/docs/5.6/helpers#method-filled), which is the logical opposite of `blank()`.

```php
filled(null) // false
filled(0) // true
filled('') // false
filled([]) // false
filled(true) // true
filled(false) // true
filled(collect())	// false
filled($unset) // error
```

Looking into the [code](https://github.com/laravel/framework/blob/c8682e11b9f0e153654ff5c2a3ad9f8b2dca56d1/src/Illuminate/Support/helpers.php#L635) for `filled()` shows us that it is literally equivalent to `!blank()`.

As you can see, it can be hard to know which tool to use. None of the methods described above are better that the other. It’s simply a case of using the right method for the right use case.  

Here’s a handy table you can use to compare the results from each method.

|           | is_null() | isset() | empty() | blank() | filled() |
|-----------|-----------|---------|---------|---------|----------|
| null      | true      | false   | true    | true    | false    |
| 0         | false     | true    | true    | false   | true     |
| ''        | false     | true    | true    | true    | false    |
| []        | false     | true    | true    | true    | false    |
| true      | false     | true    | false   | false   | true     |
| false     | false     | true    | true    | false   | true     |
| collect() | false     | true    | false   | true    | false    |
