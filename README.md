# Neos CMS Bootstrap Plugin

A basic package to start building awesome Neos CMS websites based on Bootstrap v4.

## Installation

The NeosRulez.Bootstrap package is listed on packagist (https://packagist.org/packages/neosrulez/bootstrap) - therefore you don't have to include the package in your "repositories" entry any more.

Just add the following line to your require section:

```
"neosrulez/bootstrap": "1.*"
```

And the run this command to fetch the plugin:

```
composer update
```

## Including Bootstrap

The package does **not** use the Neos.Twitter.Bootstrap package at the moment. 

All required files are included in the package and can be overwritten in the CSS of your own site package.

## Bootstrap Navbar: NeosRulez.Bootstrap:MainMenu

You can use the Bootstrap Navbar. Just use **NeosRulez.Bootstrap:MainMenu** in your .fusion

```
page.body {
    parts {
        menu = NeosRulez.Bootstrap:MainMenu
    }
```

## Settings.yaml

If you want to use the NeosRulez.Bootstrap:MainMenu, you can use the Settings.yaml in your Site Package to customize the path to your logo and alternate text.

```
NeosRulez:
  Bootstrap:
    headerLogoPath: 'Images/Logo.png'
    headerLogoPackage: 'Your.Site'
    headerLogoAltText: 'YourAwesomeSite'
```

## Use Neos.Form or Neos.Form.Builder

You can easily use Neos.Form or Neos.Form.Builder. The package is prepared for use Neos.Form or Neos.Form.Builder. All required "Bootstrap CSS classes" are added to the form fields and error messages.


## Author

* E-Mail: mail@patriceckhart.com 
* URL: http://www.patriceckhart.com 