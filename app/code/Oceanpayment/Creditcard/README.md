#Oceanpayment Creditcard
Installation
1 - unzip de module in app/code/Oceanpayment/Creditcard
2 - enable module: bin/magento module:enable --clear-static-content Oceanpayment_Creditcard
3 - upgrade database: bin/magento setup:upgrade
4 - re-run compile command: bin/magento setup:di:compile

In order to deactivate the module bin/magento module:disable --clear-static-content Oceanpayment_Creditcard
In order to update static files: bin/magento setup:static-content:deploy

Important: make sure that php path is correct in bin/magento file
