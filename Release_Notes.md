
Monday, 18 September 2017 by @lynngre

## New 
You can now choose to add your logo to either the left or the right side of your site.

We've also added a 'Help' button to every page in the backend Admin area too. This links to our Akvo Sites support pages and offers assistance to your web editors.


## New Features

### Logo location
Switch logo location from left to right via the 'logo' options under 'customise'.

Github issue: #308  

### Help
A link to the Akvo Sites Support Hero pages has been added to the admin area of Akvo Sites. This means that it is easier for web editors to find the help they need when creating or editing pages and posts.

Github issue: #332 

## Fixes

### Event website URL
Original event website URLs were not being displayed on the events pages, these now appear below the image.

Github issue: #319 

### Formatting issues
Changes made to allow for sticky header resulted in incorrect menu colour combinations being used by the theme. 

Github issue: #310 

### RSR API content problem
The RSR integration/widgets broke if the content contained '[' or ']'. There is no official escape syntax in the shortcodes API. Wordpress will not recognize ] as the end of the shortcode

Github issue: #321

### Event images
If no image is selected for Events, the homepage event widget allows the text to fill the space.

Github issue: #324 

### Event 'meet' text
Option has been added under 'customise/events' to update the 'Meet' text.

Github issue: #323 

------

Monday, 26 June 2017 by @lynngre

## New 

The option to hide the search bar, or to replace it with a different widget has been added. It can be accessed via 'Customize/Header' in the admin area.

You now have the option to keep the navigation menu area sticky, which means that when a visitor scrolls down your site, the menu will be kept at the top. This is available via the 'Customize/Header' area. 
 Select 'Header type' default or sticky. 


## New Features

### Sticky navigation
Navigation remains at the top of the screen when visitor scrolls down.

Github issue: #292  & #289 

### Search bar

Option to hide the search bar or add a different widget where the search bar is.

Github issue: #291 

## Fixes

### Arial added

Arial font has been added to the font options under 'Customize/font'.

Github issue: #302 


Thursday, 25 May 2017 by @lynngre

## New & noteworthy

Higher quality, sharper images are possible now when uploading JPEGs & any 404's will redirect to the homepage.

The ability to include a cookies consent popup has been added and each site will be updated with a cookies policy in the coming few days.

## New Features

### Sharpen Resized Images
Plugin added for automatic sharpening of images on upload.

Github issue: #296

### 404 redirects

404's/page not found redirect to site's homepage.

Github issue: #262 

### Cookies consent

Cookies consent popup has been added, each site requires a cookies policy page.

Github issue: #46 

## Bugs/fixes

### Styling fixes

Small fixes in styling or CSS of the sites.

Github issue: #284  

### Iframes

Permission for admins/editors to add iframes to posts or pages.

Github issue: #283 

### Customisation allowances for card widgets

Fixing options around image height etc for card widgets.

Github issue: #278 

### Summary pages

Number of card widgets to be evenly distributed.

Github issue: #279 

### Horizontal logo resizing

Options to customise logo sizes has been increased.

Github issue: #257 

### Navigation bar colouring

The navigation bar colouring does not continue past the last menu item.

Github issue: #293 
-----

Thursday 22 September 2016, @lynngre

## New & noteworthy

This release focused mainly on updating Akvo Sites to the latest WordPress security release, 4.6.1.  All plugins have also been updated as required.

## New Features

###  Facebook plugin
Facebook page plugin has been added to allow partners to easily integrate their Facebook page on their site.

Github issue: #197 

### Comments added to custom post types
Comments can be added/viewed on custom post types such as 'news', etc.

Github issue: #206 


## Bug fixes & changes

###  Events plugin
Updates to the Events template when displayed in a widget as well as individual events.

Github issue: #201  & #202 

### Media library
Now available to add as a single post via page builder.

Github issue:  #203 

### Node prebuilt 
Earlier Akvo Sites template requires Node packages to be rebuilt for every release. This has now been prepackaged & included in the Github repo to allow for easier deployment.

Github issue:  #216 

### Logframe for WashAlliance
Logframe folders (Results framework) have been added to the Github repo to ensure that it is always included in a deployment.  

Github issue:  #196 


Released on Monday, 7 December 2015, @lynngre

This is the first real release of the Akvo sites software. Up to this point major changes were not made in the code.

## New & noteworthy

### Akvopedia widget

A new user friendly Akvopedia widget was created to allow for users to add Akvopedia pages to the sites. 

Github issue: #36 

### Wordpress

Wordpress was updated from 4.2.5 to 4.3.1

Github issues: #47 


## Bug fixes

### Styling widgets

Text displayed in widgets overlapped the edge of the widget/or were cut off and did not fit the widget area correctly.

Github issue: #23 

### Carousel duplication

When adding a new 'post' the Carousel became duplicated on the homepage as the result of a loop.

Github issue: #27 


### Image issues

Various image issues in posts fixed.

Github issues: #28 #29 

### Data feed plugin

The plugin created for adding API data (such as data from RSR) to widgets has been updated to make it more user friendly but this has resulted in an issue with the 'widgets' not being available from the theme customisation area. Exception handling has been added.



