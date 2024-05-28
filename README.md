# Autoslug 0.9.1

Creates a TitleSlug from the first characters of your blog post and the publication date

## How to install an extension

[Download ZIP file](https://github.com/pftnhr/yellow-autoslug/archive/refs/heads/main.zip) and copy it into your `system/extensions` folder. [Learn more about extensions](https://github.com/annaesvensson/yellow-update).

## How to create a custom TitleSlug

The generated TitleSlug consists of the first characters of your blog post in lowercase letters, separated by `-` with the date appended in the format `Ymd`. UTF-8 umlauts are converted to ASCII. It is only generated if there is no TitleSlug in the page settings. You can therefore change the title of your blog post without changing the URL.

## Settings

The following settings can be configured in file `system/extensions/yellow-system.ini`:

`autoslugLength` = maximum length of the TitleSlug, excluding the date (e.g. `-20240507`). Default is `25`.

If you don't display titles in your blog and don't really use them, you can uncomment line 20:

`$page->rawData = $this->yellow->toolbox->setMetaData($page->rawData, "title", $titleSlug);`

This replaces the title of the blog post with the created TitleSlug.

## Acknowledgements

Many thanks to Mark Seuffert from [Yellow](https://github.com/datenstrom/yellow/) for the original [code](https://github.com/datenstrom/yellow/discussions/372#discussioncomment-244418) and the customisation of the `edit.php` so that everything works as it should.

## Developer

Robert Pfotenhauer. [Get help](https://datenstrom.se/yellow/help/).
