---
title: Privacy-Focused Alternatives To Google Analytics
slug: 
author: Carl Cassar
description: An in-depth review of five privacy-focused, cookie free alternatives to Google Analytics. Get rid of your cookie banner by using Matomo, Fathom, Simple Analytics, Plausible or Cloudflare.
tags:
  - tools
  - analytics
image: 
link: https://www.carlcassar.com/articles/privacy-focused-alternatives-to-google-analytics
published_at: 2020-10-06 19:23:00
created_at: 2020-10-06 19:23:00
updated_at: 2021-02-22 15:36:38
deleted_at:
---

I recently wrote an article on how to  [add google analytics to a Nuxt JS app](https://www.carlcassar.com/articles/add-google-analytics-to-a-nuxt-js-app). In that post, I described the process I followed to install Google Analytics on this blog. I chose Google Analytics out of habit, without stopping to think whether it was the right solution for me. 

I knew that I would have to add a cookie banner to get visitors' permission to use cookies on their device. This led me implement a solution that ensures Google's tracking script is not loaded until the user gives their **explicit consent**.

Later, I [tweeted](https://twitter.com/carlcassar/status/1312071706643779587) about how I felt sad to add yet another cookie banner to the internet. These banners have been around for a while, but recently it feels like the web is drowning in a sea of cookie widgets of ever-increasing complexity.

> It's time to do away with cookie banners and save the internet from this annoying mess.
 
To be clear, I think the original intention behind these banners was admirable - they've made us aware of the extent to which our data is collected and used to track us across the internet. The [Cookie Law](https://gdpr.eu/cookies/)
was designed to tackle the huge market in specific, personal data that can identify us uniquely and track us across  multiple web pages.
 
I think it's legitimate to collect some anonymous information on the way in which users interact with our websites, blogs and apps. A small amount of analytics is necessary to make our content valuable and useful to our users. Luckily, as more people have come to value their online privacy, we have seen a number of products emerge that cater to these needs.

Since this is a budding industry, I thought I would do some research before choosing a cookie-free privacy-focused analytics solution for this blog. Here are my findings.

## The Contenders

After scouring Google and Twitter for a few weeks, I found five different products that claim to be privacy-focused Google Analytics alternatives. These are:

- [Matomo](https://matomo.org/)
- [Fathom](https://usefathom.com/ref/QR9NX6)
- [Simple Analytics](https://simpleanalytics.com/)
- [Plausible](https://plausible.io/)
- [Cloudflare](https://blog.cloudflare.com/free-privacy-first-analytics-for-a-better-web/)

Let's investigate each of these offerings in turn.

### Matomo

![Matomo Analytics Dashboard](https://media.carlcassar.com/5/matomo-analytics-dashboard.png "Matomo Analytics Dashboard")
*Matomo Analytics Dashboard*

Matomo, is an old hand when it comes to web analytics. It started its life in 2007 as Piwik, a small open-source analytics project. Since then, it has grown into a full fledged competitor to Google Analytics and is used by
[ over 1 million websites in 190 countries](https://matomo.org/history/).

Matomo is available as a cloud hosted SaaS product, but it still offers an open-source self-hosted solution. You can check out the source code for the analytics platform [on GitHub](https://github.com/matomo-org/matomo).

Of all the analytics providers reviewed here, Matomo undoubtedly has the largest, and most mature feature set. In fact, if you are coming from Google Analytics, you will find the Matomo dashboard quite familiar with tools such as *Behavior*, *Goals* and *Funnels*. Furthermore, Matomo offers the ability to view heatmaps and generate an almost infinite array of custom reports.

While you might be tempted by Matomo's long list of features, I would argue that this is also what makes it feel bloated. Depending on your use case, it is likely you don't need all or even many of these features.

Worse than this, though Matomo [bills itself as GDPR compliant](https://matomo.org/gdpr-analytics/), it requires [additional steps](https://matomo.org/blog/2018/04/how-to-make-matomo-gdpr-compliant-in-12-steps/) to ensure the level of compliance required to remove that dreaded cookie banner.

**Summary**
- An established competitor to Google Analytics.
- Saas or self-hosted
- Rich in features.
- Steeper learning curve.
- Additional work required to ensure GDPR compliance.

### Fathom

Fathom was [one of the first](https://usefathom.com/blog/v2) of the new small contenders focused solely on  privacy-focused analytics. They bill themselves as a simple, light-weight, privacy-first alternative to  Google Analytics.

Fathom is extremely simple to set up and use. The app looks great and feels extremely minimalistic, but this belies a very powerful set of features that gives you just the right amount of information to track the success of your site.

Amongst other things, Fathom offers unlimited sites, notifications and reports. It allows you to add an unlimited number of subdomains, which can be used to host the tracking script and ensure that it won't be blocked by  over-eager ad-blockers.  

Fathom's unique site views are arguably a lot more accurate than any of its competitors. One side-affect of removing cookies from an analytics solution is that it becomes a lot harder to tell the difference between a unique visit and ordinary page views. The easiest way to tell whether a visit is unique is to look at the referrer (the URI of the page that linked to the current page). This can be extremely inaccurate for several reasons:

1. The referrer can add a `rel=”noreferrer”` attribute to the link. This will prevent the referrer information from being passed to the target website by removing the referral data from the HTTP header. It's possible to mitigate this effect, by counting all visits where the referrer is your own site as non-unique and vice-versa, but once again, accuracy will decrease if you use `rel="noreferrer"` on your own site. 

2. Starting in version 85, Chrome has a new default referrer policy, `strict-origin-when-cross-origin`, which may  [impact use cases relying on the referrer value from another origin](https://developers.google.com/web/updates/2020/07/referrer-policy-new-chrome-default). Websites can override this policy, but I imagine most will not bother to do so.

3. Even worse, this method would count a user who navigated to your site, then moved to another site and back to your site as a unique visit, which is highly undesirable and would render this statistic close to meaningless.

Unique visitors are a very important measure of a website's success. I would miss this metric more than any other. Happily, Fathom have pioneered a much more accurate method that uses a clever hashing mechanism to track unique visits without using cookies or tracking any personal information. By using  [multiple, un-related complex hashes](https://usefathom.com/blog/anonymization), they are able to distinguish new and repeat visits whilst ensuring that the user remains entirely anonymous.

This additional functionality comes at an increased cost. The entry level plan is capped at 100,000 page-views which is probably too many for a small side-project. It would be great to see them offer a reduced price for startups who will undoubtedly be happy to pay more once their site starts to take off. That said, you can add an unlimited number of sites making the cost more palatable when spread over a number of projects.

Fathom is built using [Laravel](/tags/laravel) and hosted on [Laravel Vapor](https://usefathom.com/blog/moved-to-vapor) backed by [AWS](/tags/aws). In fact, they were one of the first to launch a production application on Laravel Vapor when it was still in beta. Their app is hosted on secure [enterprise grade infrastructure](https://usefathom.com/blog/vapor-one-year), that auto-scales to meet spikes in
traffic.

Fathom is [very popular](https://twitter.com/JackEllis/status/1312079142699982849) in the Laravel community, but it can be used on any website. It is entirely GDPR, CCPA and PECR compliant, meaning there's no need to add a cookie banner to your site.

**Full Disclosure:** After careful review, this is the solution I chose for my own sites. If you consider signing up for Fathom, I'd appreciate it if you used my [affiliate link](https://usefathom.com/ref/QR9NX6) which will give you a $10  discount on your first invoice.

![Fathom Analytics Dashboard](https://media.carlcassar.com/4/fathom-analytics-dashboard.png "Fathom Analytics Dashboard")
*Fathom Analytics Dashboard*

**Summary**
- Well established and loved by the Laravel community.
- Simple, beautiful design with powerful functionality when you need it.
- An accurate solution to track unique visitors to your site.
- Built using secure and scalable enterprise-level infrastructure.

> See a working [demo of Fathom](https://app.usefathom.com/share/sqqvo/chimp+essentials)

### Simple Analytics

Simple Analytics was the first EU based privacy-focused analytics solution, created at roughly the same time as Fathom. Again, Simple Analytics doesn't use cookies or collect any personal data, so there's no need to worry about a cookie banner.

One solution that is unique to Simple Analytics is the Tweet Viewer. Simple Analytics will automatically convert `t.co` referrers to show you the actual tweet that is the source of the referral. This is a really cool and innovative feature, especially useful if Twitter is the primary source of traffic to your site. This is the type of feature, that comes from  the attention to detail only small startups are able to offer their customers, based upon their own needs and experiences. Other referral links are displayed as [mini websites](https://docs.simpleanalytics.com/mini-websites)  or small screenshots of the referral website.

Another feature, currently unique to Simple Analytics is a fully fledged API that you can use to integrate your data with other tools. Simple Analytics is also the only product other than Matomo to offer a dark mode, if that's your thing.

Unlike Fathom, Simple Analytics uses the referrer to distinguish unique visitors. It doesn't offer the ability to share your metrics dashboard but offers a comprehensive email reporting alternative. You can also override the domain name for the script to stop it from being recognised and blocked.

Simple Analytics' pricing is quite strange in that it is more expensive than Fathom if billed monthly, but considerably cheaper if billed yearly, with a whopping 53% discount (from $19 down to $9) if you pay for a year in advance.

I can't put my finger on it, but Simple Analytics doesn't feel as polished as Fathom or Plausible, even though some features are more advanced, and the documentation is very detailed.

![Simple Analytics Dashboard](https://media.carlcassar.com/1/simple-analytics-analytics-dashboard.png "Simple Analytics Dashboard")
*Simple Analytics Dashboard*

**Summary**
- Based and hosted in the EU
- Unique tweet viewer and mini website feature shows richer referral data.
- Offers a dark mode
- Uses potentially inaccurate referrer method for unique visitors. 
- Well priced if you are willing to pay for a year in advance.

> See a working [demo of Simple Analytics](https://simpleanalytics.com/simpleanalytics.com)

### Plausible

Plausible was born in December 2018 and came out of beta in late April 2019. The main Saas offering was released shortly afterwards. There is no difference between the paid SaaS product and the self-hosted version except that you have to host the latter yourself. Like Simple Analytics it is based and hosted in the EU. Plausible are extremely open about  everything they do. You can see all their stats, from the number of customers to their MMR on their [about page](https://plausible.io/about).

Plausible has feature parity with its competitors and has [recently announced](https://twitter.com/plausiblehq/status/1313418052915126272?s=21) that their self-hosted server  is out of beta. This comes with [excellent documentation](https://docs.plausible.io/self-hosting/) and uses docker to create the necessary databases and start a webserver. 

One key selling point for Plausible is that it has a smaller basic tier than Fathom or Simple Analytics. In fact,  you can get started from just $6 dollars a month with a cap of 10,000 monthly page-views. They also offer one of the most generous annual billing options with a 33% discount if you pay for a year upfront.

Like Fathom, Plausible **does not** use the referrer to determine unique visitors. Instead, they generate a daily identifier along with the visitor's IP address and user agent. These data-points are run through a hash function  with a rotating salt to ensure that they are anonymised.

```
hash(daily_salt + website_domain + ip_address + user_agent)
```

You can read more about this process on their [data policy](https://plausible.io/data-policy), where you will find the following explanation:

> This generates a random string of letters and numbers that is used to calculate unique visitor numbers for the day. Old salts are deleted to avoid the possibility of linking visitor information from one day to the next. Forgetting used salts also removes the possibility of the original IP addresses being revealed in a brute-force attack.

Plausible can track the time visitors spend on your site, calculating the visitor duration for users who  visit more than one page. They also offer more detailed information on referrers and devices than Simple Analytics or Fathom by including the operating system and browser for devices, and UTM medium and UTM campaigns for referrers. Another nice feature is the ability to view visits by country on a map as well as a list.

One final feature that users seem to love is the combination of referral and page drill-downs. This means that you can filter all stats by any referral, any page or any referral and page in combination. Pretty powerful stuff. 

Plausible is definitely one to keep an eye on. They have an [open roadmap](https://github.com/plausible/analytics/projects/1) and have come very far in a short time. Now they're out of beta and have the basics out of they way, I can't wait to  see how they grow and innovate over the next few months.

![Plausible Analytics Dashboard](https://media.carlcassar.com/2/plausible-analytics-dashboard.png "Plausible Analytics Dashboard")
*Simple Analytics Dashboard*

**Summary**
- Open-source with an active community.
- Well-documented self-hosted solution.
- Cheaper than its competitors with roughly the same features.
- Uses hashing method to calculate accurate unique visitor metrics.
- Offers more detail on referrers and devices. 

> See a working [demo of Plausible](https://plausible.io/plausible.io)

### Cloudflare

Cloudflare caused quite a stir recently when it [announced](https://blog.cloudflare.com/free-privacy-first-analytics-for-a-better-web/) its entry into what has until recently been a market dominated by small, self-funded startups. 

This is a big announcement, making Cloudflare the first large corporate to join the fray. No doubt, the internet  juggernauts are starting to pay attention. We'll almost certainly see other large companies enter this space with  similar offerings soon.

In keeping with the products we've already discussed, Cloudflare will count visits without tracking users. They don't use cookies or local storage and don't fingerprint individuals via their IP address or other attributes. Unique visits are identified using the referrer method described above.

One unique feature coming to Cloudflare analytics soon, is the ability to see which bots are reaching the website and block them using firewall rules. This seems like quite an innovative idea but presumably requires the use of other Clourflare products. Since Cloudflare is already an established infrastructure provider, it can augment client-based analytics with data from their edge locations. This brings a higher degree of accuracy as it allows you to track visits  from clients with third-party blockers enabled.

Cloudflare Analytics is going to be available for free when the javascript analytics script is ready, but it's only currently available at no additional cost for existing Cloudflare users.

One thing to keep in mind is that this is not Cloudflare's main business. This doesn't mean they won't continue to improve this service, but they might not be able to move as quickly as smaller, more nimble competitors focusing entirely on the privacy-focused analytics market. 

![Cloudflare Analytics Dashboard](https://media.carlcassar.com/3/cloudflare-analytics-dashboard.png "Cloudflare Analytics Dashboard")
*Cloudflare Analytics Dashboard*

**Summary**
- Large, established organisation with experience in the field.
- Edge and client analytics
- Uses referrer data to identify unique visitors.
- Will be free, but requires a paid plan for now.

## Comparison

Now you've got a basic overview of each of these offerings, we'll dive into a side by side comparison across a number of categories.

### Cost

|                  | Free Option   | Basic Pricing | Annual Discount         |                                                |
|----------------|:-------------:|:-----------:|:---------------------:| --------------------------------------------:| 
| Matomo           | yes*          | $19/m         | 17%                     | [pricing](https://matomo.org/pricing/)         | 
| Fathom           | yes**         | $14/m         | 17%                     | [pricing](https://usefathom.com/pricing)       |
| Simple Analytics | trial only    | $19/m         | ~17% to ~53%            | [pricing](https://simpleanalytics.com/#signup) |
| Plausible        | yes**         | $6            | 33%                     | [pricing](https://plausible.io/#pricing)       |
| Cloudflare       | coming soon** | $20           | No                      | [pricing](https://www.cloudflare.com/plans/)   |

- *This is a wordpress or self-hosted option and therefore not really free.
- **There is a [lite version](https://github.com/usefathom/fathom) you can self-host, but it uses cookies and hasn't been updated recently.
- ***Self-hosted or trial version
- ****Currently only available with an existing subscription.

### Compliance 

|                  | Compliant           | Cookies | IP Address |               |
|----------------|:------------------:|:-----:|:--------:|:-----------:| 
| Matomo           | yes*                | No*     | anonymous  | [data collected](https://matomo.org/faq/general/faq_18254/) |  
| Fathom           | yes                 | No      | no         | [data collected](https://usefathom.com/gdpr-ccpa-pecr-compliant) |
| Simple Analytics | yes                 | No      | no         | [data collected](https://docs.simpleanalytics.com/what-we-collect?ref=blog.simpleanalytics.com) |
| Plausible        | yes                 | No      | no         | [data collected](https://plausible.io/data-policy) | 
| Cloudflare       | probably**          | No      | no***      | N/A           | 

- *Considerable configuration required by the user.
- **This isn't stated on their website, and they don't implicitly list the data they collect.
- ***Not sure if the IP address is anonymised or discarded.

### Features

|                  | Screen Sizes | Browser | OS  | Referrers |
|----------------|:-----------:|:-----:|:--:|:-------:|
| Matomo           | yes          | yes     | yes | yes       |
| Fathom           | yes*         | yes     | no  | yes       |
| Simple Analytics | yes          | yes     | no  | yes       |
| Plausible        | yes          | yes     | yes | yes       |
| Cloudflare       | yes          | yes     | no  | yes       |

- *Screen size can be inferred from device type.

|                  | Page Views | Unique Visitors | Goals / Conversions | Sharing |
|----------------|:--------:|:-------------:|:-----------------:|:-----:|
| Matomo           | yes        | no*             | yes                 | yes     |
| Fathom           | yes        | yes**           | yes                 | yes     |
| Simple Analytics | yes        | graph only***   | no                  | no      |
| Plausible        | yes        | yes**           | yes                 | yes     |
| Cloudflare       | yes        | yes***          | no                  | no      |

- *[As far as I can tell](https://matomo.org/faq/general/faq_156/), this is not possible when cookies are disabled.
- **[Fathom](https://usefathom.com/blog/anonymization) and [Plausible](https://plausible.io/data-policy) use custom 
hashing mechanisms to generate accurate unique visitor metrics.
- ***Simple Analytics and Cloudflare use the referrer to check if the viewer is unique.

|                  | Reports | Custom Domain | API   | Uptime Monitor |
|----------------|:-----:|:-----------:|:---:|-------------|
| Matomo           | yes     | yes*          | yes   | plugin         |
| Fathom           | yes     | yes           | no    | yes            |
| Simple Analytics | yes     | yes           | yes   | no             |
| Plausible        | yes     | yes           | no    | no             |
| Cloudflare       | no      | no            | yes   | yes*           |

- *If the tracker is self-hosted.
- **As part of a paid plan.

### Misc

|                  | Tracker Size | Basic Plan Data Retention | Dark Mode | Paid Referrals | Demo |
|----------------|:----------:|:-----------------------:|:-------:|:--------------------------------------------------:|:----|
| Matomo           | 22.8 KB      | 6 months                  | yes       | no                                                                    | no       |
| Fathom           | 1.5KB        | Unlimited                 | no        | [yes](https://usefathom.com/support/affiliates)                       | [yes](https://app.usefathom.com/share/sqqvo/chimp+essentials) |
| Simple Analytics | 15KB         | N/A                       | yes       | [yes](https://docs.simpleanalytics.com/referral-program/how-it-works) | [yes](https://simpleanalytics.com/simpleanalytics.com) |
| Plausible        | 0.7KB        | Unlimited                 | no        | no                                                                    | [yes](https://plausible.io/plausible.io) |   
| Cloudflare       | N/A          | N/A*                      | no        | no                                                                    | no       |

- *I presume this is unlimited.

## Conclusion

I've been very pleasantly surprised to see the growing number of privacy-first, cookie-free analytics solutions that have given us a way to keep track of essential metrics without compromising user privacy. Though there are some obvious differences, they all offer roughly the same features given the right configuration.

Even though Cloudflare is free and Matomo is the most established, the three solutions that tempted me the most were Plausible, Simple Analytics and Fathom. I love the fact that they are all run by small teams dedicated to the privacy cause. I'd happily sign up for any of them, especially when you consider the traditional alternatives. 

In the end, I went with [Fathom](https://usefathom.com/ref/QR9NX6), mostly because they appear to have the most accurate way of tracking data. The sign up and set up process was incredibly smooth. They are also unwaveringly dedicated to their users and answer any queries within seconds.

Over recent years, we've been spoiled by free analytics solutions that track far more information than we will ever require. We didn't realise that this data wasn't collected for our benefit. We unknowingly became complicit in turning our users into commodities. 

Now we know better. It's time to put our user's privacy first. Though it will take some time to adjust to the idea of paying for things again, we can look forward to the day when we don't have to click our way through a maze of cookie alerts to get to the information we are looking for.
