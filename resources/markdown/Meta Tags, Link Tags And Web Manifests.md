---
title: Meta Tags, Link Tags And Web Manifests
slug: 
author: Carl Cassar
description: A comprehensive guide to meta, link and other `<head>` tags I use to improve SEO and ensure my sites look great on all platforms.
tags:
  - html
image: 
link: https://www.carlcassar.com/articles/meta-tags-link-tags-and-web-manifests
published_at: 2021-02-24 12:00:00
created_at: 2021-02-23 18:51:50
updated_at: 2021-02-24 14:02:50
deleted_at:
---
Every time I make a new site, I spend a significant amount of time adding meta and link tags to the layout. I do this to improve SEO but also to control the way the site is rendered in different browsers, share sheets and operating systems. I often find myself looking up details which I have researched in the past. This article will list all the tags I use on this and other sites. I hope it will save you (and future me) a lot of time.

## The Basics

- **Meta** tags represent metadata that cannot be represented by other HTML meta-related elements such as `<title>`, `<script>`, or `<link>`.
- **Link** tags define relationships between the current document and external resources.

All the tags described in this article should go in the `<head>` tag of your site. Depending on your setup, it is probably best to have a sensible default in your layout file, that can be overwriten with more specific content on dedicated pages of your site. In this way, static pages like your home page will have content related to your site as a whole, whereas specific pages for articles, recipes etc will have more relevant content.

## Title

The [title tag](https://developer.mozilla.org/en-US/docs/Web/HTML/Element/title) defines the title for the page. This will be shown in the browser's title bar, address bar or tab. It will also be used for the default name of a bookmark, title in search engine results, share sheets and rich links.

```
<title>Carl Cassar</title>
```

## Charset

This meta tag declares the document's `charset` or character encoding. As it happens, `UTF-8` is the only valid encoding for HTML5 documents. Make sure to place this at the start of the head tag as character encoding elements [must be present within the first 1024 bytes of the document](https://developer.mozilla.org/en-US/docs/Web/HTML/Element/meta).

UTF-8 is a character set defined by the [Unicode Consortium](https://www.unicode.org/consortium/consort.html) that develops the [Unicode Standard](https://home.unicode.org/). A character from UTF-8 [can be 1-4 bytes long](https://www.w3schools.com/charsets/ref_html_utf8.asp) and can represent any character in the Unicode Standard.

```
<meta charset="utf-8">
```

## Viewport

The [viewport meta tag](https://developer.apple.com/library/archive/documentation/AppleApplications/Reference/SafariWebContent/UsingtheViewport/UsingtheViewport.html#//apple_ref/doc/uid/TP40006509-SW28) was introduced by Apple to let web developers [control the viewport's size and scale](https://developer.mozilla.org/en-US/docs/Web/HTML/Viewport_meta_tag), but is now supported by many other browsers. This tag can be used to set the width of the viewport and the initial scale of the viewport in relation to the device.

```
<meta name="viewport" content="width=device-width, initial-scale=1">
```

It is also possible to prevent the user from scaling the viewport by using the property `content="user-scalable=no"`, however this will probably lead to a worse user experience as most people have come to expect that they can scale a website to "zoom in", especially on mobile devices.

## Description

As its name implies, the Description Meta tag is used to add a short textual description for the current page. This tag used to be a lot more important for SEO before search engines took the actual content of the page into consideration, but it is still useful for Bookmarks, Rich Links and SERPs (Search Engine Result Pages).

Try to keep the description for a page to [between 50–160 characters](https://moz.com/learn/seo/meta-description), since Google and others often truncate longer descriptions. This is your opportunity to advertise and summarise the content of your page, so make sure the description is concise and tells your audience what to expect. Don't try to be clever and stuff your description with search keywords as search engines have become wise to this trick and may actually [harm your SEO rankings](https://blog.alexa.com/keyword-stuffing/).

```
<meta name="description" content="Carl Cassar's Blog">
```

## Keywords

The keywords meta tag allows you add a comma-separated list of keywords that encapsulate the content on your page.

```
<meta name="keywords" content="PHP, Laravel, JavaScript, Vue">
```

Just like with the description tag, search engines can detect "keyword stuffing", but this doesn't mean that tag should be ommitted. Your best bet is to be honest and truthful, adding a few choice keywords (3-5) that accurately reflect the content of your page.

## Author

This meta tag quite simply specifies the author for the content on that page.

```
<meta name="author" content="Carl Cassar">
```

## Open Graph

The stated purpose of Open Graph tags is to [enable any web page to become a rich object in a social graph](https://ogp.me/). In reality, this means that a web page can specify a title, description, url, keywords, images and more that will declare how the website should be displayed in rich links on other sites and applications.

There are [many open graph structured properites](https://ogp.me/) that you can add to your site. These are the ones that I find most useful and would reccomend as a minimum. The more you add, the more control you are likely to have over how your site is presented to users in other contexts.

There are [many online tools](https://www.google.com/search?client=firefox-b-d&q=open+graph+generator) that can help you generate open graph tags for your own site, by guiding you to fill in various fields and upload the relevant images. I find [metatags.io](https://metatags.io/) particularly useful.

```
<meta property="og:title" content="Carl Cassar" />
<meta property="og:description" content="Carl Cassar's Blog" />
<meta property="og:url" content="https://www.carlcassar.com" />
<meta property="og:type" content="website" />
<meta property="og:updated_time" content="2021-02-24T12:52:54+00:00" />

<meta property="og:image" content="path/to/image" />
<meta property="og:image:width" content="1200" />
<meta property="og:image:height" content="1200" />

<meta property="og:image" content="path/to/image" />
<meta property="og:image:width" content="1200" />
<meta property="og:image:height" content="600" />
```

## Twitter

While many sites such as Facebook, Pinterest, LinkedIn and Google use Open Graph tags to extract rich content from your site, Twitter has opted to extend this standard with its own system and therefore requires [addition meta tags](https://developer.twitter.com/en/docs/twitter-for-websites/cards/guides/getting-started).

These are the ones that I use on my own sites:

```
<meta name="twitter:site" content="@carlcassar" />
<meta name="twitter:card" content="summary_large_image" />
<meta name="twitter:creator" content="@carlcassar" />
```

## Theme Color

This tag can specify the overall theme colour for your site. It is used by browsers for various UI elements and can be a great way to [show your users that you care about the details](https://medium.com/@micsumner/why-use-a-custom-meta-theme-color-for-theme-development-ea38abe12770).

```
<meta property="theme-color" content="#ffffff" />
```

## Windows Tiles

A [windows tile](https://docs.microsoft.com/en-us/previous-versions/windows/apps/hh202948(v=vs.105)?redirectedfrom=MSDN) is an image that represents your app on the Windows start screen. 

If a tile is not specified in the meta tags for your site, [Windows will use the image from the favicon](https://webdesign.tutsplus.com/tutorials/how-to-add-windows-tiles-to-your-website--cms-23099), but this could lead to low resolution or blurry images.

These are the meta tags I use to add tiles to my sites:

```
<meta property="msapplication-TileColor" content="#ed8936" />
<meta property="msapplication-TileImage" content="path/to/image" />
```

If you prefer not to add many meta tags for different properties, you can use one meta tag that links to a browser config xml file:

```
<meta name="msapplication-config" content="browserconfig.xml" />
```

```
<?xml version="1.0" encoding="utf-8"?>
 
<browserconfig>
    <msapplication>
        <tile>
            <square70x70logo src="path/to/image"/>
            <square150x150logo src="path/to/image"/>
            <wide310x150logo src="path/to/image"/>
            <square310x310logo src="path/to/image"/>
            <TileColor>#da532c</TileColor>
        </tile>
    </msapplication>
</browserconfig>
```

## iOS

As with Windows, there are a number of meta tags [specific to iOS](https://developer.apple.com/library/archive/documentation/AppleApplications/Reference/SafariHTMLRef/Articles/MetaTags.html).

These are the two tags I am currently using on my sites:

```
<meta name="apple-mobile-web-app-capable" content="yes">
<meta property="apple-mobile-web-app-status-bar-style" content="default" />
```

The first tag indicates that the site can be used as a mobile web app, while the second specifies the style to be used for the status bar in an iOS web app.

## Favicons

Favicons are small icons that are used by the browser for tabs, bookmark bars, window bars, address bars and other UI elements as a placeholder for your site. It's good to have a number of different favicon sizes and formats to suit the needs of different browsers.

These are the ones I'm currently using:

```
<link href="path/to/image.ico" rel="icon" type="image/x-icon">
<link href="path/to/image.png" rel="icon" type="image/png">
<link href="path/to/image.png" rel="icon" type="image/png">
<link href="path/to/image.svg" rel="mask-icon" type="image/svg" sizes="693x693">
<link href="path/to/image.svg" rel="apple-touch-icon" type="image/svg" sizes="180x180">
```

As with meta tags, there are many [online favicon generators](https://www.google.com/search?client=firefox-b-d&q=online+favicon+generator).

## Web Manifest

A [web app manifest](https://developer.mozilla.org/en-US/docs/Web/Manifest) is a JSON text file that gives information about a web application. This file can be downloaded and used to present the site as a native app.

I use a web manifest for my sites, including this blog so users can add a bookmark to their home screen with a nice logo and description. They can then quickly open this 'app' to see the site without browser bars and other distractions.

To add a web manifest, first create a web manifest file, `site.webmanifest`, in the root of your public directory:

```
{
    "name": "Carl Cassar",
    "short_name": "Carl Cassar",
    "start_url": "/",
    "icons": [
        {
            "src": "/favicons/android-chrome-192x192.png",
            "sizes": "192x192",
            "type": "image/png"
        },
        {
            "src": "/favicons/android-chrome-512x512.png",
            "sizes": "512x512",
            "type": "image/png"
        },
        {
          "src": "/favicons/apple-touch-icon.png",
          "sizes": "180x180",
          "type": "image/png"
        }
    ],
    "theme_color": "#ffffff",
    "background_color": "#ffffff",
    "display": "standalone"
}

```

and then add a link to this file in the head of your site:

```
<link href="path/to/site.webmanifest" rel="manifest">
```

## Conclusion

I hope you found this article useful. I intend for it to be a work in progress and will update it whenever I learn something new or a adopt a new practice. If you spot anything wrong or missing, I'd love it if you could leave a comment below.
