# Shopify App Starter
Laravel starter for custom shopify apps

## Getting started
1. Create private app in shopify partner account
1. add local app url to whitelist
1. add staging app url to whitelist
1. Store API_KEY and API_SECRET in .env
1. go to /auth?store=<shopify_url>
    1. this will make an entry in the storefronts table with the access_token to the store


## Staging
1. Deploy new server with Forge
1. Create DNS A record in DNS Simple
1. Create stage site in forge 
1. Deploy to stage
1. Setup `master` to autodeploy   


