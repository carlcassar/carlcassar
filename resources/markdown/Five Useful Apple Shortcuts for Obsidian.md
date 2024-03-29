---
uuid: 5a68ee02-2bd7-4454-a109-5bbfcd715faa
title: Five Useful Apple Shortcuts for Obsidian
slug: 
author: Carl Cassar
description: One thing missing from Obsidian for iOS is the ability to add widgets to the home screen. Let me show you how to add Obsidian Widgets with Apple Shortcuts.
tags:
  - apple
  - shortcuts
  - obsidian
  - automation
image: 
link: https://www.carlcassar.com/articles/five-useful-apple-shortcuts-for-obsidian
published_at: 2023-08-26 18:52:00
created_at: 2023-08-26 16:54:42
updated_at: 2023-08-26 18:52:00
deleted_at:
---
Obsidian is a note-taking powerhouse. Unfortunately, no app can offer every feature. One thing missing from Obsidian for iOS is the ability to add widgets to the home screen. In this article I'll show you how to get that functionality back with Apple Shortcuts.

## Prerequisites

Before I continue, there is some functionality that you may need or want to add to your Obsidian setup via community plugins in order to use these shortcuts.

### 1. Advanced URI

[Advanced URI](https://github.com/Vinzent03/obsidian-advanced-uri) by [Vinzent](https://github.com/Vinzent03) is required to add additional [URL Schemes](https://support.apple.com/en-gb/guide/shortcuts/apd621a1ad7a/ios) to Obsidian. These additional URL schemes will allow you to trigger functionality in Obsidian through links that can be called from outside the app. The documentation lists the following examples:

- [open files](https://vinzent03.github.io/obsidian-advanced-uri/actions/navigation)
- [edit files](https://vinzent03.github.io/obsidian-advanced-uri/actions/writing)
- [create files](https://vinzent03.github.io/obsidian-advanced-uri/actions/writing)
- [open workspaces](https://vinzent03.github.io/obsidian-advanced-uri/actions/navigation)
- [navigate to headings/blocks](https://vinzent03.github.io/obsidian-advanced-uri/actions/navigation)
- [automated search and replace in a file](https://vinzent03.github.io/obsidian-advanced-uri/actions/search)

Here is an example URL scheme:

```
obsidian://advanced-uri?vault=<your-vault>&workspace=main
```

### 2. Obsidian Homepage

[Obsidian Homepage](https://github.com/mirnovov/obsidian-homepage) by [mirnovov](https://github.com/mirnovov) allows you assign a note, canvas or workspace as a "home page". It allows you to configure when and how this homepage note is opened. This plugin isn't really necessary to use the Home shortcut, but it's a good plugin that deserves a mention in this context.

### 3. Quick Add

[Quick Add](https://github.com/chhoumann/quickadd) by [  Christian Bager Bach Houmann](https://github.com/chhoumann) adds functionality to Obsidian to enable you quickly create notes with a specified template. It is a very powerful plugin that enables you take additional actions  such as capturing information and running macros when adding notes. This plugin is required for the Quick Add shortcut.

### 4. Obsidian Hotkeys for Templates

[Obsidian Hotkeys for Templates](https://github.com/Vinzent03/obsidian-hotkeys-for-templates), also by [Vinzent](https://github.com/Vinzent03) adds a command to list all your templates. You can then assign a hotkey to bring up this list. This is useful when you want to call a command to insert a template from an Apple Shortcut using Advanced URI.

## Shortcuts

In this section I'll describe five shortcuts that will allow you to control Obsidian from Apple shortcuts on iPhone, iPad and Mac. Feel free to download and [[#Customisation|modify]] them to suit your needs.

### 1. Home

[Download Shortcut](https://www.icloud.com/shortcuts/8a12668dd5884655948b99c77e733769)

This shortcut will open your Obsidian home note. When you import it into the shortcuts app it will ask you two setup questions:

1. What is the name of your Vault?
2. What is the name of your home note?

In reality, you can simply duplicate and rename this shortcut to make it open any note in your Obsidian vault. Don't forget to modify or remove the import question that asks for the name of your home note.

### 2. Today (Daily Note)

[Download Shortcut](https://www.icloud.com/shortcuts/32142778ec8c472fb583225d85ce919c)

This shortcut will open today's daily note. Additionally, if you have [[#4. Obsidian Hotkeys for Templates|Obsidian Hotkeys for Templates]] installed, it will also insert the template for your daily note.

When you import this shortcut it will ask you two setup questions:
1. What is the name of your vault?
2. What is the path to your Daily Notes? (e.g. `Journal/`)

### 3. Quick Open

[Download Shortcut](https://www.icloud.com/shortcuts/6b3e41f0a46f4f56ba3eca204844257d)

This shortcut will open Obsidian and then call the command to open the Quick Open palette. You can start typing immediately to quickly open the note you are looking for.

When you import this shortcut it will ask you one setup question:
1. What is the name of your vault?

### 4. Open Note for Date

[Download Shortcut](https://www.icloud.com/shortcuts/5960bb74a66d4a80a39f634cb140f349)

This shortcut lets you open a daily note for any date by letting you choose from a date picker as well as offering shortcuts for Yesterday, Today and Tomorrow.

When you import this shortcut it will ask you two setup questions:
1. What is the name of your vault?
2. What is the format date you have chosen for your daily notes?

### 5. Quick Add

[Download Shortcut](https://www.icloud.com/shortcuts/ddbdccaee83943bd87c207ec1462c9df)

This shortcut will open Obsidian and call the Quick Add command. This will list all of the quick add commands you have configured in the plugin settings.

When you import this shortcut it will ask you one setup question:
1. What is the name of your vault?

## Customisation

Remember, you are free to copy and modify all of these shortcuts to fit into your Obsidian workflow. It's easy to [change the icon, colour and title](https://support.apple.com/en-gb/guide/shortcuts/apd5ad5a2128/ios) of each shortcut in the Shortcuts app.

You can also modify the shortcuts to use other urls exposed by the [[#1. Advanced URI|Advanced URI]] plugin. Get it touch with me on [Twitter/X](https://www.x.com/carlcassar) if you have any questions.

## Quick Tips

- All text entered during import will be URL Encoded so you can just enter the names as they appear in Obsidian.
- These shortcuts will work on both iOS and MacOS.
- You can search for these shortcuts in Spotlight or [Raycast](https://www.raycast.com).
- You can [pin shortcuts](https://support.apple.com/en-gb/guide/shortcuts/apdd7bf369da/ios) to the menu bar on Mac OS.
- You can modify the shortcuts to accept input and then [use them as Quick Actions on iOS](https://www.macrumors.com/how-to/use-finder-quick-actions/).
- You can add shortcut widgets that will trigger these shortcuts.
- You can ask Siri to trigger these shortcuts.
- You can even make new shortcuts to call existing shortcuts.

## Credit

Finally, I'd like to mention the Obsidian community forum, where you can find a thread called [iOS Shortcuts - Share your ideas!](https://forum.obsidian.md/t/ios-shortcuts-share-your-ideas/15149). My shortcuts are modified versions inspired by shortcuts I found on this forum. Unfortunately, its been some time since I made these shortcuts so I can't credit people individually as I normally do. 

Make sure to check the thread out if you are looking for inspiration or ready-made shortcuts that I don't cover in this article.
