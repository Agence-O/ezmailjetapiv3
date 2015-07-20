# ezmailjetapiv3

## Installation
1. Copy the package into the `extension' directory in the root of your eZ Publish installation.

2. We must now enable the extension in eZ Publish. To do this edit
      site.ini.append(.php) in the folder root_of_ezpublish/settings/override. If this
      file does not exist; create it. Locate (or add) the block
      [ExtensionSettings] and add the line:
   
          ActiveExtensions[]=ezmailjetapiv3
   
      If you run several sites using only one distribution and only some of the
      sites should use the extension, make the changes in the override file of
      that siteaccess.
      E.g root_of_ezpublish/settings/siteaccess/news/site.ini.append(.php)
      But instead of using ActiveExtensions you must add these lines instead:
   
          [ExtensionSettings]
          ActiveAccessExtensions[]=ezmailjetapiv3
   
3. Run the php script from commandline:
   
        $ php bin/php/ezpgenerateautoloads.php --extension
   
   Which is need to build an array of classes that are used by the autoload system in PHP to load classes. You will need eZ Components availlable to run this script.

4. Configure the extension by modifying the file *settings/mailjet.ini.append.php*

5. Just insert the following line where you want to see the form in your template :

        {include uri="design:mailjet/inscription.tpl"}

4. Complete