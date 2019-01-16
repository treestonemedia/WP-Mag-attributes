[![StyleCI](https://github.styleci.io/repos/119318250/shield?branch=master)](https://github.styleci.io/repos/119318250)
# WP-Mag-attributes
This a simple WordPress plugin that will allow you to connect to Magento API

I created this plugin because I needed to show possible attribute values for a Magento site in a knowledge base that we're writing up using WordPress.
Once we were at it, we also added pulling orders - very rudimentary, play around with the filters.

I only tested it with M1.9 and M1.72 - open an issue if you'd like an M2 version.

We are using the ```Resource: catalog_product_attribute ``` from [Magento Dev Docs](http://devdocs.magento.com/guides/m1x/api/soap/catalog/catalogProductAttribute/product_attribute.options.html).
We are also using the ```Resource: sales_order``` from [Magento Dev Docs](http://devdocs.magento.com/guides/m1x/api/soap/sales/salesOrder/sales_order.list.html)

You can easily extend this for other API calls - open an issue if you need help.

# Install

Download this repo as a zip and install like any other WP plugin

# Setup

Once the plugin is installed and activated, head over to settings=>magento

1. Fill in the magento URL, http://example.com
2. Set the Magento API user and secret 

# Usage

In any post or page, simply use ```[magento_attributes attribute_id="YOUR_ATTRIBUTE_ID_HERE"]``` to get attribute values

We also added a shortcode for orders ```[magento_sales]```

# INFO

The API queries are cached, we did it setting a [transient (https://codex.wordpress.org/Transients_API). 

**This was created on the fly for our own use, so please evaluate carefully before installing on your site**

