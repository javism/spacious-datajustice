# spacious-datajustice

Privacy-aware child theme of Spacious WordPress theme

# How to implement visitors privacy in WordPres websites

WordPres is by far the most widely used CMS for websites creation. It's a long term free-as-in-speech software project. However, the evolution of the project, plugins and templates has exposed users privacy. Initially, many people will host a blog in wordpress.com with a free or professional plan. If you do so, your visitors will be datafied by 15-17 trackers on average (even after disabling social network sharing buttons). There you can move to a self-managed hosting using wordpress.org implementation, but you still have to do several steps to get ride of trackers and cookies.

# Install some privacy analysis tools for your browser

To verify that you are properly removing trackers and cookies from your website you can use:

* [EFF's Privacy Badger](https://www.eff.org/privacybadger)

* [Mozilla's Lightbeam](https://addons.mozilla.org/firefox/addon/lightbeam/)

# Remove basic third party code

1. If installed, remove Jetpack plugin
2. Disable social network sharing buttons:  Configure → Sharing
2. Disable gravatar:  Settings → Discussion: uncheck the box ‘Show Avatars’

# Serve (Google) fonts through your own server

Many templates and plugins include Google fonts. However the default setup implies that your visitors will retrieve the fonts from Google servers, potentially allowing Google to track your users. Google font's EULA allows you to download and serve the fonts in your own server. All the code listed below is available at https://github.com/javism/spacious-datajustice.

These are the general steps. As an example we use a chiled theme  based on [Spacious theme](https://es.wordpress.org/themes/spacious/):

1. [Create a WP child theme](https://codex.wordpress.org/Child_Themes) of your template.

1. [Download corresponding Google fonts](https://developers.google.com/fonts/faq#can_i_download_the_fonts_on_google_fonts_to_my_own_computer) to a folder in your server, for instance 'fonts' in your Child Theme folder. If you don't need compatibility with old-browsers, you will only need the TTF archives. Spacious is using Lato font.

1. Use CSS to tell the browser that the fonts are available in your own server:
```CSS
/* fonts */

@font-face {
font-family: 'Lato';
src: local('Lato Bold'), local('Lato-Bold'), url('fonts/Lato-Semibold.eot?#iefix') format('embedded-opentype'),  url('fonts/Lato-Semibold.woff') format('woff'), url('fonts/Lato-Semibold.ttf')  format('truetype');
font-weight: bold;
font-style: normal;
}
@font-face {
font-family: 'Lato';
src: local('Lato Regular'), local('Lato-Regular'), url('fonts/Lato-Ligth.eot?#iefix') format('embedded-opentype'),  url('fonts/Lato-Ligth.woff') format('woff'), url('fonts/Lato-Ligth.ttf')  format('truetype');
font-weight: normal;
font-style: normal;
}
```

  4. Remove the Google fonts style from the WP actions queue. You can do it in `functions.php`:

```php
// Remove 'google_fonts' from the styles queue (id may vary for other themes)
function spacious_dj_dequeue_google_fonts() {
	wp_dequeue_style( 'google_fonts' );
}
// Use 100 for priority to process the remove action at the end of the queue
add_action( 'wp_enqueue_scripts', 'spacious_dj_dequeue_google_fonts', 100 );
```

# Cookies

A clean installation of WordPress does not use tracking cookies, however, some plugins and external media can insert cookies in your visitor browser. As a general tool, you can use [WP DoNotTrack plugin](https://es.wordpress.org/plugins/wp-donottrack/).

YouTube includes a sharing option that does not use cookies streaming the video from youtube-nocookie.com, however, this option still adding remote code that might allow users tracking. If you want a privacy aware streaming option you might need to server the media through your servers.

If you still need to use external content, a simple trick proposed [here](https://brianpagan.net/2017/privacy-for-wordpress-in-3-steps/) is to create a thumbnail of the video and link the image to the external content.

# Use HTTPS

Last but not least, connection encryption is a must also for security reasons. You can easily perform site encryption with [Let’s Encrypt](  https://letsencrypt.org/)
