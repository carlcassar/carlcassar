---
uuid: c51a79ad-7fed-47a7-916e-5181f26fae76
title: Different ways to pass data to a Laravel View
slug: 
author: Carl Cassar
description: Laravel views allow you to pass data to a view in a number of different ways. Let's review four methods and describe the pros and cons for each one.
tags:
  - tips
  - laravel
  - php
image: 
link: https://www.carlcassar.com/articles/different-ways-to-pass-data-to-a-laravel-view
published_at: 2022-01-10 19:21:00
created_at: 2022-01-10 19:22:02
updated_at: 2022-01-10 19:23:37
deleted_at:
---
## 1. Using a magic method

First up, Laravel uses some PHP magic to make sense of fluent methods. If, for example, you have an array of people in a variable `$people`, then you can use a magic method `withPeople` on the `view()` helper function (or `View::` facade) to pass the array to your view. In your blade file, your people array will be available via a `$people` variable.

```
Route::get('/', function () {
    $people = ['Bob', 'John', 'Simon'];

    return view('welcome')->withPeople($people);
});
```

This method makes your code more readable to humans which will minimise the time it takes another developer (or your future self) to make sense of this code. Unfortunately, your IDE will most likely not be able to offer code completion or Intellisense for the `withPeople` method since it is using magic methods and has not been declared on the `Illuminate\View\Factory` class.

## 2. Using a string parameter

If you liked the readability of the first method, but don't want to deal with IDE warnings, you can pass your array through with a string key that Laravel will use as the name for the variable made available in your view.

For example, if you have a people array, you can pass it to the view by using the `with` method, passing the string key `people` as the first argument and the array `$people` as the second argument.

```
Route::get('/', function () {
    $people = ['Bob', 'John', 'Simon'];

	return view('welcome')->with('people', $people);
});
```

This method has a slight limitation in that you are left with a `magic string`, ie: `people` that must be kept up to date. Say, for example, that you rename `$people` to `$names` using your IDE. It might not be immediately obvious that you need to change the string `people` to `names`. For this reason, string values that are used to create variables are often a source of confusion and code drift over time.  

## 3. Using an array

If you have more than one variable that needs to be passed to the view, then you can pass an array as the second attribute to the view helper method (or View Facade).

```
Route::get('/', function () {
    $people = ['Bob', 'John', 'Simon'];
    $days = ['Monday' 'Tuesday'];

    return view('welcome', [
	      'people' => $people
	      'days' => $days
	  ];
});
```

This method can make your code look clean and concise, especially if you inline your variables.

```
Route::get('/', function () {
    return view('welcome', [
	      'people' => ['Bob', 'John', 'Simon'];
	      'days' => ['Monday' 'Tuesday'];
	  ];
});
```

As with previous methods, you still have to set a string key for the array. Once again, string keys are often problematic, because they have no inherent meaning in PHP. This means that your editor will not be able to assist you with renaming this key across many locations.

## 4. Using the compact method

Finally, we can make use of a function built in to PHP that can automatically create an array containing variables and their values.

If you are not familiar with the compact method, you can read about it in the [PHP documentation](https://www.php.net/manual/en/function.compact.php).

```
Route::get('/', function () {
    $people = ['Bob', 'John', 'Simon'];
    $days = ['Monday' 'Tuesday'];

    return view('welcome', compact('people', 'days'));
});
```

This method is useful if you want to pass an array through to the view, but don't want to have to make an array with a key that is the same as the value variable. 

```
// compact('people') === ['people' => $people]
```

Because compact is a well-defined PHP function, your editor may be able to deduce that the string key refers to a variable name in the same code block. `compact` can be extremely useful if you have many variables to pass through to a view and don't want to pass them inline.

```
compact('var1', 'var2', etc...)
```

## Conclusion 

There is no right or wrong way to pass data to a Laravel View. Some people detest magic methods, whilst others dislike string keys. The most important thing is that you choose a method that feels comfortable to you and try to be consistent across your code.

Let me know which method you prefer in the comments.
