# Neos CMS Bootstrap Plugin

A basic package to start building awesome Neos CMS websites based on Bootstrap v4.

## Installation

The NeosRulez.Bootstrap package is listed on packagist (https://packagist.org/packages/neosrulez/bootstrap) - therefore you don't have to include the package in your "repositories" entry any more.

Just add the following line to your require section:

```
"neosrulez/bootstrap": "*"
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
    magnificPopupWidth: '800'
    magnificPopupHeight: '600'
    thumbImageWidth: '255'
    thumbImageHeight: '255'
    colors:
      primary: '#007bff'
      secondary: '#6c757d'
      success: '#28a745'
      danger: '#dc3545'
      warning: '#d39e00'
      info: '#17a2b8'
      light: '#f8f9fa'
      dark: '#343a40'
      muted: '#6c757d'
      white: '#fff'
```

## Use Neos.Form or Neos.Form.Builder

You can easily use Neos.Form or Neos.Form.Builder. The package is prepared for use Neos.Form or Neos.Form.Builder. All required "Bootstrap CSS classes" are added to the form fields and error messages.


## Author

* E-Mail: mail@patriceckhart.com 
* URL: http://www.patriceckhart.com 


## Supported by browserStack

![alt text](https://ci3.googleusercontent.com/proxy/2ihnd69q-Cqz8gQawL4KvbKhKHw7nQ5sG1ZvYKZ0Ue56rcmiAWU7x1NLzKBHZ0fExrM4vPYe4hLWQtpzJxyfn1WirqvU3yow5SB9Z5A_RROJS-JvHavKLUzL-RB9oyuFZINll8-clE721aS3d3NcK3ogFBw3mY_uHAGPbpZdM5UP2wE39WItcpf7287HiyuwResyd8JykcnwZi2k44ngwdXaJ465pGnz4DquHma3F9bIN4-NLMxMMGXJmfiwcCbckJjmbrzF8J-GKrYhNSVrCAmW5C1wONQDDZnqgqQnAPVYwKoz8f9ePmTwUul7DD7aLlraht28oCuw_NflJ7_Xl3nYYERHlY5XI0Y=s0-d-e1-ft#https://attachment.freshdesk.com/inline/attachment?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpZCI6NDgwMTIyMjA3MTUsImRvbWFpbiI6ImJyb3dzZXJzdGFja2hlbHAuZnJlc2hkZXNrLmNvbSIsImFjY291bnRfaWQiOjExOTkzNjV9.J-hSBpU6BhLx_zIPtEOMjiLeLrPF5BcczAKWG-wyDfY)

I use BrowserStack because it's so easy to test for different platforms.
* URL: https://www.browserstack.com
