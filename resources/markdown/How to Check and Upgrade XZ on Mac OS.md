---
uuid: 018e951a-eb7b-78f4-a36c-6719877a700d
title: How to Check and Upgrade XZ on Mac OS
slug: 
author: Carl Cassar
description: Quickly check and upgrade (downgrade really) your xz version on Mac OS, to make sure you are not using the backdoored version.
tags:
  - terminal
  - security
image: 
link: https://www.carlcassar.com/articles/how-to-check-and-upgrade-xz-on-mac-os
published_at: 2024-03-31 17:00:00
created_at: 2024-03-31 16:27:32
updated_at: 2024-03-31 17:17:32
deleted_at:
---
As you probably already know, [a backdoor has been found in XZ Utils](https://arstechnica.com/security/2024/03/backdoor-found-in-widely-used-linux-utility-breaks-encrypted-ssh-connections/), a compression tool that is used for lossless compression in command line utilities. If you're looking to understand more about this vulnerability, you can find [an excellent explanation on Reddit](https://www.reddit.com/r/explainlikeimfive/comments/1brf749/eli5_the_recently_discovered_xz_backdoor/).

If you're a Mac OS and [Homebrew](https://brew.sh) user, there is a good chance that you have the version of XZ that everyone has been talking about installed on your machine. This article is about how to find out for sure and what to do about.

## Which versions are affected

Before we begin, its useful to know that versions `5.6.0` and `5.6.1` are known to contain the vulnerability. There is also a chance that previous versions might have similar issues. Homebrew maintainers [have said](https://github.com/orgs/Homebrew/discussions/5243#discussioncomment-8954951) that they

> don't believe Homebrew's builds were compromised (the backdoor only applied to deb and rpm builds) but 5.6.x is being treated as no longer trustworthy and as a precaution we are forcing downgrades to 5.4.6.

## How to check if XZ is installed

You can run `which` to see if you have XZ installed at all:

```bash
which xz
```

![Check whether you have XZ installed](https://media.carlcassar.com/how-to-check-and-upgrade-xz-on-mac-os/xz-V.png)

## How to see which version is installed

You can use this command to display the XZ version currently installed on your system.

```bash
xz -V
```

![Check which XZ version you have installed](https://media.carlcassar.com/how-to-check-and-upgrade-xz-on-mac-os/which-xz.png)

As you can see, the version `5.6.1` installed on my machine is in fact one of the versions no longer considered trustworthy.

## How to remove the affected XZ version using Homebrew

Run the following command to upgrade all your Homebrew packages and formulas:

```bash
brew upgrade
```

Since, [Homebrew is forcing downgrades to 5.4.6.](https://github.com/orgs/Homebrew/discussions/5243#discussioncomment-8954951), the affected versions will be removed and replaced with version `5.4.6`.

You can now run `xz -V` again to ensure that XZ has been downgraded.

![Checking that your XZ version has been downgraded](https://media.carlcassar.com/how-to-check-and-upgrade-xz-on-mac-os/xz-V-5.4.6.png)

## Keeping Homebrew Up To Date

In general, its always good to keep all your software up to date, so that you can benefit from security patches as they become available.

Remember to update Homebrew itself using:

```php
brew update
```

and run

```bash
brew upgrade
```

to to keep all your packages and formulas up to date.

From time to time you can also use 

```php
brew cleanup
```

to remove stale lock files, outdated downloads for all formulae and casks, and remove old versions of installed formulae.

## An alias command to run all your updates at once

Add the following alias to your shell rc to perform all your updates at once:

```bash
# Get OS X Software Updates, and update installed Ruby gems, Homebrew, npm, and their installed packages
alias update='sudo softwareupdate -i -a; brew update; brew upgrade --all; brew cleanup; npm install npm -g; npm update -g; sudo gem update'
```