# Magento 2 - Request Price extension 
Customer can request product price from details page.  
![Sample](https://github.com/nans/devdocs/blob/master/RequestPrice/PDP.png "Product page")  
![Sample](https://github.com/nans/devdocs/blob/master/RequestPrice/popup.png "Popup")  
![Sample](https://github.com/nans/devdocs/blob/master/RequestPrice/requests.png "Admin panel")  

# Supported  
Magento 2.1.x - 2.3.x  
PHP 7.0 and higher  

# Installation Instruction  
* Copy the content of the repo to the Magento 2: app/code/Nans/RequestPrice
* Run command: php bin/magento setup:upgrade
* Run Command: php bin/magento setup:static-content:deploy
* Now Flush Cache: php bin/magento cache:flush
