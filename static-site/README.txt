Static site bundle
==================

Deploy the contents of this folder to a static web host. The entry page is index.html.
This bundle contains no PHP pages, server endpoints, API keys, or movie feed fetches.

Sign-in, newsletter signup, and booking completion are browser-only demos stored in
localStorage. They do not create real accounts, send subscriptions, issue tickets,
or process payments. Movie, OTT, and trailer cards are a saved snapshot and do not
refresh automatically.

The pages load Bootstrap, icons, Swiper, fonts, and trailer/media assets from their
existing public CDNs, so an internet connection is needed for those resources.