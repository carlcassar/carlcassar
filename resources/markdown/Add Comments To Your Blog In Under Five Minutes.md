---
title: Add Comments To Your Blog In Under Five Minutes
description: Utterances is a free and open source comment system that uses GitHub issues to track comments on a web page. In this article I'll show you how to get Utterances up and running and share some tips on how to configure it for Nuxt JS.
published_at: 08-02-2020 7:45
---
While reading a [blog post on web mentions](https://freek.dev/1406-how-to-add-webmentions-to-a-laravel-powered-blog) I
noticed that the author, [Freek Van der Herten](https://freek.dev/about) was using a comment system that I had never
seen before. It looked very similar to a GitHub issue, which piqued my interest. After some digging, I found that it was 
powered by a free and open source tool called [Utterances](https://utteranc.es/).

Utterances provides a GitHub app and a lightwight script to enbed a comment widget on your website. When Utterances
loads, it will use the GitHub API to find a matching issue based on one of the following criteria:
- the article pathname
- the site url
- the page title
- the page open graph title
- a specific issue number
- an issue title containing a specific term 

The comments from that issue are displayed inline on your site as you can see in the comment section at the bottom
of this article. 

## Who is this for?

Before we jump into installation instructions, I thought it best to mention that this tool is **not for everyone**.
Utterances will require users to be signed in with a valid GitHub account to post a comment. This means that it is
better suited to technical and software development blogs or sites whose users are familiar with GitHub. If you are 
catering to a wider audience, it is probably better to use a more generic solution such as 
[Disqus](https://disqus.com/) or [Commento](https://commento.io/). 

## Installation

Follow these steps to install the Utterances comment widget on your site:

1. Create a new public GitHub repository. Be sure to make it **public**, or your readers will not be able to see the 
comments. 

![Create a new public GitHub repository](https://media.carlcassar.com/12/create-a-new-github-repository.png "Create a new public GitHub repository")
*Create a new public GitHub repository*

2. Head over to [https://github.com/apps/utterances](https://github.com/apps/utterances) to install the GitHub app and
give Utterances permission to access your public repository.

![Utterances permissions](https://media.carlcassar.com/11/utterances-permissions.png "Utterances Permissions")
*Utterances Permissions*

3. Use the tool at [https://utteranc.es/](https://utteranc.es/) to configure the comment section to match the style of 
your site. Once you have configured your options, you will see and be able to copy a script that looks something like
this:

```html
<script src="https://utteranc.es/client.js"
            repo="carlcassar/blog-comments"
            issue-term="pathname"
            theme="github-light"
            crossorigin="anonymous"
            async>
```

4. Paste the script into your code. The widget will be loaded at the location at which you paste the code snippet.

You should now be able to see the comment section and sign in to post a comment. After this, you can go
to the issues tab of your public repository where you will see that Utterances has created a new issue.

From now on, Utterances will synchronise issues between GitHub and your site. 

## Nuxt / Vue sites

This blog, *carlcassar.com*, is built using the [Vue.js](https://vuejs.org/) base framework, 
[Nuxt JS](https://nuxtjs.org/). There are several ways to add external scripts to a Nuxt project. 

First, Nuxt allows you to add a file called `app.html` in the root directory of your project. In this file, you can 
modify the template into which Nuxt will inject your code. In my case, this option was not a viable solution as I only
want the comment section to load on blog articles and not on every page of the site.

Ordinarily, Nuxt also lets you inject external scripts in the `scripts` property of the `head()` method. In this case,
however, Utterances does not let you specify which div to attach the comment section to, which means that this method
will load the Utterances widget in the head tag of the page, rendering it invisible.

The solution I ended up using was to simply copy and paste the auto-generated script tag into the view component for
this page adding the attribute `type="application/javascript"`.

```html
<script type="application/javascript"
        src="https://utteranc.es/client.js"
        repo="carlcassar/blog-comments"
        issue-term="pathname"
        theme="github-light"
        crossorigin="anonymous"
        async>
</script>
```
