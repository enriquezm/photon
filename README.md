#Photon
Photon is a starter theme taken from [underscores theme](http://underscores.me/) and equipped with [Bootstrap v.3.3.5](http://getbootstrap.com/).

Photon is simplified to use the following structure:

##Basic

`header.php` Contains everything before `<body>...`.
`footer.php` Contains everything preceding  `...</body`
`index.php` is our front-page.

##Page templates

Photon comes with 2 page templates by default. They are `Contact` and `About`.

To create a page template, we simply create a file with the following name:
`page-[slug_name].php` where `[slug_name]` is the slug name of your created page.

For the `Contact` and `About` page, their file names are `page-contact.php` and `page-about.php`, respectively.

You can read [this](https://developer.wordpress.org/themes/template-files-section/page-template-files/page-templates/) to get more details on page templates.

##Functions

All our functions are written inside of `functions.php`.

Here we can:
1. Define functions to use within our site.
2. Enqueue scripts
3. Enqueue styles

You can read [this](https://codex.wordpress.org/Functions_File_Explained) to get more details on what you can do with `functions.php`.

##Bower

Bower is used to manage our packages:

Photon comes with Bootstrap and jQuery installed.

You can go [here](http://bower.io/) for more details on bower.
