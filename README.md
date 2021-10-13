# 503

## About

This application is to create a temporary
503 page when the website is not available for any
reason.


It follows the [google advice](https://developers.google.com/search/docs/advanced/crawling/pause-online-business)


## Steps

### Start it locally


```bash
php -S localhost:8000 api/index.php
```

### Changes

Change the [service-unavailable](html/service-unavailable.html) with your own message.

### Deploy

  * Install the vercel client
```bash
yarn global add vercel
```
  * Login and deploy
```
vercel login
vercel 
```

### Add custom domain

Add [custom domain to your app](https://vercel.com/docs/concepts/projects/custom-domains)


### Cname

Delete the A and create a CNAME
for (@) the apex domain
to cname.vercel-dns.com

Make the SSL connexion, flexible has the ssl certificate may be not generated

## Technology

We use the [vercel php runtime](https://github.com/juicyfx/vercel-php)