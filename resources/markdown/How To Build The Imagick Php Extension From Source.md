---
title: How To Build The Imagick Php Extension From Source
description: This article describes the process you can follow to build the Imagick PHP extension from source, which can be handy if the version you are after has not been released via PECL.
published_at: 23-02-2021 6:00
---
**Update**: This instructions in this article should no longer be necessary as you can once again install imagick via pecl:

```
pecl install imagick
```

If you are still having issues, I would recommend [this excellent article by Andrea Olivato](https://coding.andreaolivato.com/fix-ld-library-not-found-for-lgomp-when-installing-imagick-35-via-php-pecl-on-mac).

---

At the time of writing, the PHP8 compatible version of the [Imagick](https://github.com/Imagick/imagick) extension has not yet been released, which means it is not available via [PECL](https://pecl.php.net/).

After a quick Google search, I found this [excellent article](https://freek.dev/1845-building-the-imagick-php-extension-from-master) by [Freek Van der Herten](https://twitter.com/freekmurze) explaining how to build the php extension from the master branch, which already seems to work with PHP 8.

After I followed Freek's instructions, I noticed that the extention was missing a package version number that is ordinarily populated automatically when the extension is built via the PECL installer. As it turns out, one of my sites also relies on [Laravel DOMPDF](https://github.com/barryvdh/laravel-dompdf) which requires the Imagick version number to be present for it to work correctly.

Let's go over the steps described by Freek with some additional context and code snippets.

1. Clone the repository to your local development directory:

```
git clone https://github.com/Imagick/imagick.git
```

2. Open the `php_imagick.h` located in the root of the `imagick` directory. Locate the following line:

```
#define PHP_IMAGICK_VERSION    "@PACKAGE_VERSION@"
```

and replace `"@PACKAGE_VERSION@"` with the latest released version. In my case this was `3.4.4`, so I modified the line to this:

```
#define PHP_IMAGICK_VERSION    "3.4.4"
```

3. Follow the [php.net guide](https://www.php.net/manual/en/install.pecl.phpize.php) to compile the extension.

```
# Navigate to the cloned directory
cd /path/to/imagick

# Prepare the build environment for a PHP extension.
phpize

# Run a script to make sure your system has the proper dependencies to compile from source.
./configure

# Compile the extension.
make
```

4. Locate and copy the newly created `imagick.so` extension which can be found in the `modules` directory inside the cloned `imagick` directory:

```
/path/to/imagick/modules/imagick.so
```

5. Use the following command to find the directory in which your PHP version expects to find extensions:

```
php -i | grep extension_dir
```

`php -i` prints all php information. This output is piped (sent) to the grep command which searches the output for the given keyword - `extension_dir` in this case.

This command should return something like this:

```
extension_dir => /usr/local/lib/php/pecl/20200930 => /usr/local/lib/php/pecl/20200930
```

Copy the `imagick.so` file to this directory.

6. Use the `php --ini` command to find the loaded configuration file for your php installation. In my case, this was:

```
/usr/local/etc/php/8.0/php.ini
```

Open this file in your preferred code editor and add the following line anywhere in the file:

```
extension="imagick.so"
```

This will instruct php to load the imagick extension. 

All being well, the Imagick extension should now be installed. You might need to restart the PHP service for this change to be registered. In my case, as a [Laravel Valet](https://laravel.com/docs/8.x/valet) user, I restarted Valet with the following command:

```
valet restart
```

Finally, you can use the following command to make sure the extension is loaded correctly:

```
php -i | grep imagick
```

This should result in the following output:

```
imagick module => enabled
```

I hope this works for you as it did for me. Once again, my thanks go to Freek for most of these instructions and to [Danack](https://twitter.com/MrDanack), the maintaner of the PHP Imagick extension. Please consider [sponsoring him](https://github.com/sponsors/Danack) if your work depends on the Imagick extension.
