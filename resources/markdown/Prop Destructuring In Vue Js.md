---
uuid: 5accd75b-146d-4d61-89f1-aa37232f9765
title: Prop Destructuring In Vue Js
slug: 
author: Carl Cassar
description: Caleb Porzio demonstrates an easy way to pass JavaScript object properties to a child component without declaring a separate prop for each property.
tags:
  - vue
  - javascript
image: 
link: https://www.carlcassar.com/articles/prop-destructuring-in-vue-js
published_at: 2018-08-21 15:48:00
created_at: 2018-08-21 15:48:00
updated_at: 2021-02-08 19:09:14
deleted_at:
---
In a couple of recent tweets, [Caleb Porzio](https://twitter.com/calebporzio) demonstrated an easy way to pass Javascript object properties to a child component without declaring a separate prop for each property.

Here's how it works. Let's say that we have a Javascript object with several properties in the data object of a Vue JS component:

```js
data() {
    return {
        post: {
            id: 1,
            name: 'Prop destructuring in Vue Js',
            author: 'Carl Cassar'
        }
    };
}
```

Imagine that you want to pass this data to a child component. One way of doing it, is to declare a prop for each of the object's properties and pass each one through individually.

```html
<post :id="post.id" :name="post.name" :author="post.author"> </post>
```

Whilst there is nothing wrong with this approach, it is also possible to pass through the whole object at once by using the `v-bind` directive.

```html
<post v-bind="post"></post>
```

Behind the scenes, Vue will 'destructure' the `post` object and pass through each property to the 'post` component as a prop.

```javascript
props: {
    id: Number,
    name: String,
    author: Object
}
```

As you can see, this still allows us to validate the prop and set a sensible default as we would normally.

In the interest of giving credit where credit is due, here's the original tweet with Caleb's great tip:

<blockquote class="twitter-tweet"><p lang="en" dir="ltr">📒📚 In <a href="https://twitter.com/vuejs?ref_src=twsrc%5Etfw">@vuejs</a>, instead of passing a bunch of object properties into a component as props, you can use v-bind as kind of a &quot;prop destructuring&quot; <a href="https://t.co/swZrNrmMou">pic.twitter.com/swZrNrmMou</a></p>&mdash; Caleb Porzio (@calebporzio) <a href="https://twitter.com/calebporzio/status/1034846966730158080?ref_src=twsrc%5Etfw">August 29, 2018</a></blockquote>

<br/>

You can see all of the uses for the `v-bind` directive in the [docs](https://vuejs.org/v2/api/#v-bind) and follow [@calebporzio](https://twitter.com/calebporzio) on Twitter. He's been posting some great tips recently and is well worth following.
