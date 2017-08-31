# OurnameShop Roadmap

## Before You Begin
Before you begin we recommend you read about the basic building blocks that assemble a CodeIgniter application:
* CodeIgniter - Go through [CodeIgniter Official Website](https://www.codeigniter.com/) and proceed to their [Documentation](https://www.codeigniter.com/docs), which should help you understand Codeigniter better.
* Fabric.js - Go through [Fabric.js Official Website](http://fabricjs.com/) and proceed to [Tutorial](http://fabricjs.com/articles/), which should help you understand about Fabric.js.
* Canvas - Go through [W3Schools](http://www.w3schools.com/html/html5_canvas.asp) and need to understand about [Canvas and their properties and methods](http://www.w3schools.com/tags/ref_canvas.asp).


## Roadmap of the site structure

### application *

The `application` folder contains the application you're building. Basically, this folder contains models, views, controllers, and other code(like helpers and class extension). In other words, this folder is where you will work for the project development.

#### cache

The `cache` folder contains all cached pages for this application.

#### config *

The `config` folder is the area where you set the configuration for this application.

##### - amazon.php

You can set Amazon env variables such as Logo bucket, domain, cloudfrontdomain, cloudfront keypair_id, cloudfront keypair_file.

##### - amazon_config.php

This file contains Amazon config such as API key, API secret, bucket and etc.

##### - autoload.php

You can set autoload libraries, helper, config, model and etc

##### - config.php *

You can set base url, index page, social networks configs.

##### - contants.php

This file contains some Macro variables.

##### - database.php *

You can set database configs. specially, hostname, username, password, database, dbdriver and etc.

##### - email.php

You can set the configs related to email.

##### - ion_auth.php

This is [Redux Auth](https://github.com/benedmunds/CodeIgniter-Ion-Auth) config file for this site.

##### - print_designer.json and print_designer.php

You can set some configs for Print designer. Specially, font, size and etc.

##### - routes.php *

This file lets you re-map URI requests to specific controller Methods.

##### - states.php

This file contains USA States info.

##### - surfaces.php

You can set all surfaces configs used for this site.

##### - template.php

You can set all template configs used for this site.

##### - unique.php

You can set some configs used for this site. Specially, Facebook, LinkedIn, Google+, Paypal, Stripe, ThePrintful. 

##### - upload.php

You can set all image upload paths.

#### controllers *

In this folder you can find/place the class files developed for this application.

##### - Admin.php

This file manage Admin Panel.

###### `dashboard` Method

It is for Dashboard page on Admin Panel.

###### `customers` Method

This method is for Customers page on Admin Panel. If call this as POST method, it acts as Delete-Customer feature.

###### `orders` Method

It returns Orders lists to display on Orders page on Admin Panel.

###### `order` Method

It returns Order details to display on Order page on Admin Panel.

###### `lastnames` Method

It returns Lastnames lists to display on Lastnames page on Admin Panel.

###### `presets` Method

It returns Presets lists to display on Presets page on Admin Panel. If call this as POST method, it acts as Delete-Preset feature.

###### `categories` Method

It returns Categories lists to display on Categories page on Admin Panel. If call this as POST method, it acts as Delete-Category feature.

###### `category` Method

It returns Category details to display on Edit Category page on Admin Panel. If call this as POST method, it acts as Update-Category feature.

###### `add_category` Method

It is to add new category on Admin Panel.

###### `import_jobs` Method

It is for Import Jobs on Admin Panel.

###### `import_job_details` Method

It is for Import Job Details on Admin Panel.

###### `import_logo_types` Method

If call this as POST method, it acts as Import-LogoTypes.

###### `logo_types` Method

It returns Logo types lists for Logo Types page on Admin Panel.

###### `add_logo_types` Method

If it is called this as POST method, it acts as Create-LogoTypes Method.

###### `logo_type` Method

It returns Logo types details for Edit LogoType page on Admin Panel. If it is called this as POST method, it acts as Update-LogoType feature.

###### `surfaces` Method

It returns Surfaces lists to display on Surfaces page on Admin Panel.

###### `surface` Method

It returns Surface details to display on Edit Surface page on Admin Panel. If it is called this as POST method, it acts as Update-Surface feature.

###### `templates` Method

It returns Templates lists to display on Templates page on Admin Panel.

###### `template` Method

Coming soon.

###### `upload_template` Method

It is to Upload Template. It uploads template to the folder which is configed in `config/upload.php`.

###### `meta_tags` Method

It returns Meta tags data to display on Meta Tags page on Admin Panel. If it is called as POST method, it acts as Update-MetaTags feature.

###### `products` Method

It returns Products lists to display on Products page on Admin Panel.

###### `product` Method

It returns Product details to display on (Edit) Product page on Admin panel. If it is called as POST method, it acts as Update-Product feature.

###### `product_types` Method

It returns ProductTypes lists to display on ProductTypes page on Admin Panel.

###### `product_type` Method

It returns ProductType details to display on Edit Product page on Admin Panel. If it is called as POST method, it acts as Update-ProductType feature.

###### `upload_surface_img` Method

It is to upload Surface Image. It uploads Surface Image to the `img/surfaces` folder.

###### `upload_product_img` Method

It is to upload Product Image. It uploads Product Image to the `img/products` folder.

###### `lastname_requests` Method

It returns LastnameRequests lists to display on LastnameRequests page on Admin Panel. If it is called as POST method, it acts as Update-LastnameRequests feature.

###### `graph_data` Method

It returns Chart Data to display Charts on Dashboard page on Admin Panel.

###### `profile` Method

It is for Profile page on Admin Panel. If it is called as POST method, it acts as Update-Profile feature.

###### `export_customers` Method

It is to export Customers Data as CSV type.

###### `shops` Method

It returns Shops data to generate from main site. If it is called as POST method, it acts as Delete-Shop Method.

###### `profile` Method

It is for Profile page on Admin Panel. If it is called as POST method, it acts as Update-Profile feature.

###### `featured` Method

It returns Featured Products lists to display on Featured page on Admin Panel. If it is called as POST method, it acts as Delete-Featured feature.

###### `add_featured` Method

If it is called as POST method, it add one Featured Product.

###### `edit_featured` Method

It returns Fetured Product details to display on Edit Featured page on Admin Panel. If it is called as POST method, it uploads Featured Product Image to the folder which is configed in `config/upload.php`.

###### `sndfeatured` Method

It returns 2ndFeatured Products lists to display on 2ndFeatured page on Admin Panel. If it is called as POST method, it acts as Delete-2ndFeatured feature.

###### `add_sndfeatured` Method

If it is called as POST method, it add one Featured Product.

###### `edit_sndeatured` Method

It returns 2ndFetured Product details to display on Edit 2ndFeatured page on Admin Panel. If it is called as POST method, it uploads 2ndFeatured Product Image to the folder which is configed in `config/upload.php`.

###### `pricing_tool` Method

It returns Option Data to display on Pricing Tool page on Admin Panel. If it is called as POST method, it can update price/income.

###### `_update_options` Method

It updates Shop options. it is called on `pricing_tool` Method.

###### `shop_pay_popup` Method

It returns Option Data to display on ShopPayPopup page on Admin Panel. If it is called as POST method, it updates shop balance.

###### `bulk_import` Method

If it is called as POST method, it creates KeyLogin data and send Email to Administrator.

##### - Auth.php

###### `signin` Method

It is LogIn Method, which is using CodeIgnier [Ion Auth Library](https://github.com/benedmunds/CodeIgniter-Ion-Auth).

###### `login` Method

It is LogIn Method for Admin.

###### `signup` Method

It is SignUp Method.

###### `social_login` Method

It is LogIn with Social Networks method.

###### `forgot` Method

It is Forgot Password method.

###### `new_aff` Method

It is to Create one new afflicate.

###### `aff_login` Method

It is LogIn Page as Afflicate.

###### `reset_aff_pwd` Method

It is Reset Password method.

###### `key_login` Method

It is LogIn_by method.

##### - Campaign.php

###### `create` Method

It prepares Data to display Afflicate Form page. If it is called as POST method, it creates Campaign/Shop.

###### `_create_shop` Method

It is to create one shop and it is called in `create` Method.

###### `check_subdomain` Method

It is to check if it is sub domain in DB.

###### `check_subdomain` Method

It is real Method to check sub domain.

###### `render_tpl` Method

It is Method to render templates in `views/campaign` folder.

##### - Cart.php

###### `index` Method

It gets Order lists of current user and redirect to Order page.

###### `_calc_order_amount` Method

It return all ordered amount of current user.

###### `shipping_methods` Method

It returns available shipping options and rates for the given list of products (It is calling Printful API).

###### `shipping` Method

It gets Cart items for Checkout and redirect Shipping page or Shipping Confirm Page. If it is called as POST Method, it calc shipping with Printful and Print Aura APIs.

###### `confirm` Method

It gets Order lists for checkout confirmation and redirect to Confirm page.

###### `_place_orders` Method

It places one order by calling Printful and Print Aura APIs. This Method is called in `pay` Method.

###### `pay` Method

This Method process payment using Stripe or Paypal.

###### `paypal_complete` Method

It checkes if paypal payment is completed.

###### `_after_payment` Method

It updates shop data after payment. This Method is called in `pay` Method.

###### `_update_num_sales` Method

It updates the number of sales, This Method is called in `pay` Method.

###### `notify_order_placed` Method

It notify the user after placed an order.

###### `assign_user` Method

It assigns the current user to the Orders.

###### `add_item` Method

It adds an items to Cart of current user. It includes the feature to create one image from Canvas.

###### `remove_item` Method

It removes an item from Cart.

###### `update_q` Method

It updates whole amount if change the number of items.

##### - Catalog.php

It is Default Controller of this site.

###### `cats` Method

Comins soon

###### `index` Method

It is for Homepage. It redirects to Homepage with the Featured Products Data. 

###### `loadmoreSnd` Method

It returns 2nd Featured Products for endless style.

###### `_visit_log` Method

It inserts one visit log to `shop_visitors_log` table in Database.

###### `_add_trend` Method

It inserts one trendInfo to `lastname_trends` table in Database.

###### `dummy_visitors` Method

It increases visit logs by creating dummy visitors.

###### `_fetch_tpl` Method

It fetches template data.

###### `_assign_metas` Method

It assigns meta tags such as Title, Description, Keyword and etc.

###### `lastname` Method

It redirect Lastname page with the template and surfaces data. It runs `_assign_metas`, `_add_trend`.

###### `_templates_by_cats` Method

It returns Template data by categories. It is limited with 4 categories now.

###### `load_folder_cats` Method

It returns Surfaces and Templates data and loads `catalog/folder_cats_ajax` view.

###### `_get_surfc` Method

It returns all surfaces such as 'T-SHIRT', 'HOODIE', 'MUG', 'POSTER', 'PHONE-CASE', 'BIB', 'APRON', 'TOTE-BAG' to treat on this site.

###### `surfaces` Method

It returns templates by the given lastname, surfaces and redirects to `catalog/surfaces`.

###### `product_json` Method

It returns one Product Infomations including Colors and Sizes.

###### `product` Method

It returns one Product Data such as Templates, Sizes, Colors, Styles and etc for Builder page.

###### `_has_campaign` Method

It returns Campaign data by the given shop, lastname, template and product.

###### `_get_current_surface` Method

It gets current surface to treat.

###### `products` Method

It gets all product, surfaces, brands, templates Data and redirect to `catalog/products`.

###### `load_family_items` Method

It returns product and template data by given lastname.

###### `custom_logo` Method

(Test Method) It composites two images.

###### `_generate_image` Method

It resamples the image of the given cart item.

###### `download_product` Method

It returns product image by running `_generate_image` method.

###### `printfull_image` Method

It resamples the image of the given cart item by running `_generate_image` method..

###### `canvas_sizes` Method

It defines canvas sizes of all surfaces.

###### `test_call` Method

It is test method for calling Print Aura API.

###### `save_print_design` Method

It saves Logo to AWS S3 bucket and print designs to `img/products` folder.

###### `logo_proxy` Method

It returns the thumbnail content of Template by the given logo.

###### `variant_proxy` Method

It returns the variant image content by the given variant id.

###### `collection` Method

It returns user data and saved_logo data by the given User ID.

###### `remove_from_collection` Method

It removed saved_logo by the given User ID and returns counts of saved_logo by that user.

##### - Cron.php

It manages Cron Job.

##### - Lastnames.php

###### `lastnames` Method

It returns all Lastnames lists to be saved in Database.

###### `request_lastname` Method

It adds one lastnames(POST data) to Database and notifies that to Administator via Email.

###### `insert_logos` Method

Coming soon

##### - Order.php

###### `popup_form` Method

It redirects to `orders/popup_form` without any data.

###### `place` Method

This method let`s you add a (Print Aura) product to your account using PrintAura API.

###### `calc_price` Method

It calculates current shirt`s price using PrintAura API.

###### `refund` Method

It is for Shop owner and Admininstrator. It is possible to refund a completed payment using Paypal or Stripe API.

##### - Print_designer.php

###### `index` Method

It redirects `print_designer/index` with the Template/Category data that has given template ID and joined with category, logo_folders and folder_cats.

###### `save_print` Method

It saves the updated Template images to `media/print_preview` folder, which is configed in Config/upload.php.

###### `text_designer_popup` Method

It redirects `print_designer/text_designer_popup` without any data.

###### `text_preview` Method

It returns the image url to be able to preview which is resampled with Resizer Library.

##### - Webhooks.php

###### `import_pics` Method

It updates the images to exist on the given paths to the thumbnail images of product which has the given brands.

###### `printful` Method

Coming soon

#### core

In this folder you can find/place place the base class files of this application.

##### - MY_Controller.php

This is Base Controller to extend CI_Controller. All controllers are extended from this one.

It includes basic Methods such as SendEmail, RenderTemplate, SetConfig ane etc.

##### - MY_Model.php

This is Base Model to extend CI_Model. All models are extended from this one.

It includes basic Methods such as SendEmail, RenderTemplate, SetConfig ane etc.

#### helpers *

In this folder you can find/place the include files use full for this application.

##### - catalog_helper.php

It contains URL Helpers, Format Helpers and Check Helpers.

##### - debug_helper.php

It contains some Methods related to Debug.

##### - helper_helper.php

It contains some useful Methods such as parse_csv, json_reply, isPostMethod, Object/Array Transparent, get_payment_gateway, safe_unlink, is_mobile and etc.

##### - pagination_helper.php

It is to create Pagination.

##### - shop_helper.php

It contains some useful Methods related to shop.

##### - shop_helper.php

It contains one Method to send Invitaion Email to the users.

#### hooks

In this folder you can find/place the support files use full for this application.

#### language

In this folder you can find/place language macros/ define constants.

#### libaries *

In this folder you can find/place own developed libraries useful for this application.

##### - amazonsdk

This is [AWS SDK for PHP](https://aws.amazon.com/sdk-for-php/).

##### - Bcrypt.php

This is Bcrypt Library and it is for Ion Auth Library.

##### - Curl.php

This is [Curl Class](https://github.com/philsturgeon/codeigniter-curl/blob/master/libraries/Curl.php).

##### - Image_moo.php

This is [Image Moo library](http://www.matmoo.com/digital-dribble/codeigniter/image_moo/).

##### - Ion_auth.php

This is [Ion Auth Library](https://github.com/benedmunds/CodeIgniter-Ion-Auth).

##### - Mobile_Detect.php

This is [Mobile Detect Library](https://github.com/serbanghita/Mobile-Detect).

##### - Print_aura.php

This is [print aura](https://printaura.com) PHP Client Library.

##### - Printful.php and PrintfulClient.php

This is [Printful](https://www.theprintful.com/docs) PHP Client Library.

##### - Resizer.php

This is Image(Logo) Management Library.

##### - Rest.php

This is [REST Client](https://github.com/philsturgeon/codeigniter-restclient).

##### - Rest.php

This is AWS Client.

##### - Scalablepress.php

This is [Scalablepress](https://scalablepress.com/docs/) PHP Client Library.

##### - simple_html_dom.php

This is [PHP Simple HTML DOM Parser](http://simplehtmldom.sourceforge.net/).

##### - Template.php

This is [CodeIgniter Template Library](https://github.com/jrmadsen67/williamsconcepts-template).

#### logs

The `logs` folder is the folder CodeIgniter uses to write error and other logs to.

#### models *

In this folder you can find/place the data base fetching logic in.

All files is related to each tables on DB.

#### third_party

In this folder you can find/place any plugins used for this application.

#### views *

This folder contains HTML template files.

##### - admin

It contains HTML template files related to Admin Panel.

##### - auth

It contains HTML template files related to Auth(Login, SignUp, Password Management, Group Management, etc).

##### - campaign

It contains HTML template files related to Campaign.

##### - carts

It contains HTML template files related to Cart pages.

##### - catalog

It contains HTML template files related to Product pages (All product page, Product lists page, Product builder page, etc).

##### - customer

It contains HTML template files related to Customer relation pages (Order Listing page, Profile page).

##### - email

It contains all Email template files.

##### - errors

It contains HMTL template files related to all error pages.

##### - lastnames

It contains HMTL template file of Lastname list page.

##### - orders

It contains HMTL template file of Order result.

##### - pages

It contains HMTL template files of Terms and Privacy pages.

##### - print_designer

It contains HMTL template files related to builder block such as Hue, Position, Add to Cart, Add Text and etc.

##### - storeadmin

It contains HTML template files related to Store Admin Panel.

##### - index.php

It is HTML template file of Homepage.

##### - main_template.php

It is HTML Main template file of this site. It includes Footer section.

### system

The `system` folder is where all the action happens. This folder contains all the CodeIgniter code of consequence, organized into various folders.

### apidocs

The `apidocs` contains API document of [ournameshop.com](http://ournameshop.com/).

### css *

The `css` folder contains CSS files related to all page styles.

### font

The `font` folder contains Font files used for this site.

### js *

The `js` folder contains Javascript files, which contains some libaries and components such as caman, colorpicker, fancybox, jquery, bootstrap, spectrum, wowslider, some jquery components, and script files used for this site.

### img *

The `img` folder contains Image files, which used for this this site.

That is, the avatar for main user, logo on footer section, product images, some logos, social button images, top slider images on Homepage, category images on menu section and etc.

### media

The `media` folder contains Media files, which contails preview files for Print, Image temp, some avatars, Logo, saved logos and etc.


## License
OurnameShop