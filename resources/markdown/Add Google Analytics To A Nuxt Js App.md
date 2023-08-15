---
title: Add Google Analytics To A Nuxt Js App
description: Let me show you how to add Google Analytics to your Nuxt JS app, whilst ensuring that you comply with GDPR legislation with a cookie banner.
published_at: 02-10-2020 8:39
---
Over recent weeks, I've been working hard to make this blog look and work well. Now that I'm writing
more often, I wanted a way to see what's working and what's not. My first thought was to add Google Analytics as I 
remember it being a quick and easy process. 

That said, the days when you could just add analytics without thinking about the privacy of your users is thankfully
coming to an end. As it turns out, some more work is needed to comply with GDPR and other legislation. In this
article, I'll show you how I went about adding Google Analytics and a compliant Cookie Banner to this site.

If you've installed Google Analytics on a website in the past, you might be familiar with the `analytics.js` script.
Google has now moved away from this script in favour of its `gtag.js` or Global Site Tag solution. They 
[strongly recommend](https://developers.google.com/analytics/devguides/collection/upgrade) that we should upgrade to 
the new "modern measurement library" and so we'll do just that. 

## Install GTAG on a simple HTML website

If you're looking to install gtag on a simple HTML
website, you can simpy follow [Google's instructions]() to paste the following code immediately after the `<head>` tag
on every page of your site, making sure to replace `GA_MEASUREMENT_ID` with the Google Analytics property that you want
to send the data to.

```html
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=GA_MEASUREMENT_ID"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'GA_MEASUREMENT_ID');
</script>
``` 

If you're using a templating engine, you can paste the code in of your layout file, so that it is loaded
automatically on every page that uses that layout.

## Installing GTAG in a Nuxt JS app

Nuxt allows you to [customise the app html template](https://nuxtjs.org/guide/views/#app-template) by creating an
`app.html` file in the `src` directory of your project. We could easily place the `gtag.js` script there, but we 
can do better than that by pulling in a small npm package that wraps the gtag script. I've chosen to use 
[vue-gtag](https://github.com/MatteoGabriele/vue-gtag), but you could use the same technique with another package if you
prefer.

1. Install `vue-gtag` in your application:

```shell script
npm install vue-gtag
```

2. Create a new javascript file in the `plugins` directory and load the `vue-gtag` plugin, making sure to replace the 
following properties with your own:

- `GA_MEASUREMENT_ID` - the ID of the property to which you want to send data.
- `APP_NAME` - The name of your application.

```javascript
import Vue from 'vue';
import VueGtag from 'vue-gtag';

Vue.use(VueGtag, {
    config: { id: 'GA_MEASUREMENT_ID' },
    appName: 'APP_NAME',
});
```

3. Tell Nuxt to load your Google Analytics plugin.

```javascript
plugins: [
    {
        src: './plugins/GoogleAnalytics.js',
        mode: 'client'
    }
]
```

At this point, the `gtag.js` script should load on all pages and environments in your app, but you really shouldn't stop
here. Read on to find out how to make sure you only load the script once you have obtained the consent of your users.

## GDPR, PECR and EU cookie compliance

When you install `gtag.js`, Google will place cookies in the user's browser to track the user uniquely. There are
three things we need to do to make sure that we comply with 
[PECT](https://ico.org.uk/for-organisations/guide-to-pecr/what-are-pecr/),
[GDPR](https://ico.org.uk/for-organisations/guide-to-data-protection/guide-to-the-general-data-protection-regulation-gdpr/), 
and other similar regulations as well as Google's own 
[terms](https://marketingplatform.google.com/about/analytics/terms/us/). Let's discuss each of these in turn.

1. Tell visitors to our site that we are using cookies.

The convention is to add a banner to inform users that the site uses cookies. The banner should load immediately when 
the user first visits the site. 

![Cookie Banner](https://media.carlcassar.com/14/cookie-banner.png "Cookie
 Banner")
*Cookie Banner*

2. Explain what the cookies are doing and why.

The cookie banner should have a link to a clear explanation describing the cookies that will be used as well as their
purpose. This will help the user to make an informed decision.

![Privacy Policy](https://media.carlcassar.com/9/privacy-policy.png
"Privacy Policy")
*Privacy Policy*

3. Get the user's consent before placing cookies on their device.

The banner should be displayed until the user specifies whether they accept the use of cookies. If they click *yes*, 
we can go ahead and load the analytics plugin which will store cookies on their device. If they click *no*, we will 
prevent the analytics tracker from loading. In both cases, we will remove the banner once the user has made their 
choice.

Now we know what needs to be done, we can make a `CookieAlert` vue component to add the banner to our site. I'm
using [Tailwind CSS](https://tailwindcss.com/) for styling, but you can change the template to suit your needs.

First, we will define the way the banner should look in the template tag of our component:

```html
    <div v-if="isOpen"
         class="fixed bottom-0 left-0 lg:flex items-center p-4 bg-gray-100 shadow-sm justify-center w-full">
        <div class="text-5xl pb-2 leading-none">
            🍪
        </div>
        <div class="lg:mx-8">
            <p>
                Can I use cookies for analytics? Read
                <nuxt-link class="text-link" to="/privacy-policy">the privacy policy</nuxt-link>
                for more information.
            </p>
        </div>
        <div class="flex justify-center mt-4 lg:mt-0">
            <div class="button ml-2 md:ml-0" @click="accept">Yes, sure</div>
            <div class="button md:ml-2" @click="deny">&times;</div>
        </div>
    </div>
``` 

Next, we will add a data property to track whether the cookie banner should be shown:

```javascript
data() {
    return {
        isOpen: false
    };
}
```

We can now create a method to call when the user denies our request to use cookies. If the clicks `deny`, then we will
hide the banner and save their preference to local storage.

```javascript
deny() {
    if (process.browser) {
        this.isOpen = false;
        localStorage.setItem('GDPR:accepted', false);
    }
}
```

Similarly, we can create a method to call when the user accepts our request to use cookies. If the user clicks `accept`,
we will hide the banner, save their preference to local storage and bootstrap the `vue-gtag` plugin.  

```javascript
import {bootstrap} from 'vue-gtag';

export default {
    methods: {
        accept() {
            if (process.browser) {
                bootstrap().then(gtag => {
                    this.isOpen = false;
                    localStorage.setItem('GDPR:accepted', true);
                    location.reload();
                })
            }
        },
        ...
    },
}
```

We should also make sure the component knows whether the banner should be shown when it is first loaded.

```javascript
created() {
    if (!this.getGDPR() === true) {
        this.isOpen = true;
    }
},

methods() {
    getGDPR() {
        if (process.browser) {
            return localStorage.getItem('GDPR:accepted', true);
        }
    },
    ...
}
```

You may be wondering what the `bootstrap` method is doing here. Happily, `vue-gtags` allows us to load the plugin
conditionally. This means the script will only load when we want it to. Lets' head back to our own analytics plugin and
modify the code like this:

```javascript
import Vue from 'vue';
import VueGtag from 'vue-gtag';

const getGDPR = localStorage.getItem('GDPR:accepted');

Vue.use(VueGtag, {
    config: { id: 'GA_MEASUREMENT_ID' },
    bootstrap: getGDPR === 'true',
    appName: 'APP_NAME',
    enabled: getGDPR === 'true',
});
```

You can read more about this in the 
[vue-gtag documentation](https://matteo-gabriele.gitbook.io/vue-gtag/custom-installation#bootstrap-later).

## Tracking page views

Since we are using `vue-router` as part of Nuxt JS, we can pass the application router to `vue-gtag` so that it can 
associate tracking information with the specific page the user is viewing.

```javascript
import Vue from 'vue';
import VueGtag from 'vue-gtag';

export default ({ app }) => {
    const getGDPR = localStorage.getItem('GDPR:accepted');

    Vue.use(VueGtag, {
        config: { id: 'GA_MEASUREMENT_ID' },
        bootstrap: getGDPR === 'true',
        appName: 'APP_NAME',
        enabled: getGDPR === 'true',
        pageTrackerScreenviewEnabled: true
    }, app.router);
}
``` 

## Conclusion

Google Analytics is undoubtedly easy to install, but it takes a bit more work to inform your users that you are using
cookies to track their use of your website and give them the option to opt out entirely. This process has made me think
about whether this really is the right solution for me. I've been looking into cookie-free, privacy-focused tracking
solutions and hope to be able to remove Google Analytics soon. I'd love to hear about how you measure visits to your 
blog and whether you've used any cookie-free solutions. Let me know in the comments below.
