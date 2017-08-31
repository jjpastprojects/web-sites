# OurnameShop Intall Guide

## Before You Begin

Before you begin we recommend you read about the basic building blocks that assemble a CodeIgniter application:
* CodeIgniter - Go through [CodeIgniter Official Website](https://www.codeigniter.com/) and proceed to their [Documentation](https://www.codeigniter.com/docs), which should help you understand Codeigniter better.
* Fabric.js - Go through [Fabric.js Official Website](http://fabricjs.com/) and proceed to [Tutorial](http://fabricjs.com/articles/), which should help you understand about Fabric.js.
* Canvas - Go through [W3Schools](http://www.w3schools.com/html/html5_canvas.asp) and need to understand about [Canvas and their properties and methods](http://www.w3schools.com/tags/ref_canvas.asp).

## Quick Intall on your Local

Once you've cloned from git repository, you need to copy all files to `xampp/htdocs` folder in Windows, or `var/www/html` folder on Ubuntu.

And create MySQL blank database named "lastname_main" and import DB file(`lastname_main.sql.zip`) on PHPMyadmin.

Copy .passwd file to `xampp/htdocs` on Windows, `var/www` on Ubuntu.

The next thing you should do is to setup [Virtualhost](https://delanomaloney.com/2013/07/10/how-to-set-up-virtual-hosts-using-xampp/) using Apache.

And then, you need to change some env variables.

Go to `application\config\config.php`
```
20    $config['base_url'] = '[Virtualhost Name]';
```

Go to `application\config\database.php`
```
20    'username' => '[MySQL Username]',
21    'password' => '[MySQL Password]',
```

You need to change .htacess file.
```
15    AuthUserFile /home/lastnamecompany/.passwd
```
`/home/lastnamecompany/.passwd` is the path of `.passwd` file.

For instance,
```
15    AuthUserFile C:/xampp/htdocs/.passwd
```
or
```
15    AuthUserFile var/www/.passwd
```

And then, you need to change one column in Database.

Go to Table "shops" on Database.

You can see row which ID is 1.
Change "domain" column using your Virtualhost Name.

Now you can visit dev site on your local.

Once you can see `Authentication Requried` modal, Username is `andre`, Password is `12345678`.

If you make some mistakes in Install, you will see `404 Page Not Found` Page.


## License

OurnameShop