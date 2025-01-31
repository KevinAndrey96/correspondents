# Changelog

## [Hotfix 1.0.1]
fix: balance and profit fields on database (users table) are fixed to accept null values

## [Hotfix 1.0.2]
fix: Add commission to users table and validate user creation

## [Hotfix 1.0.3]
fix: implement security in users edit 

## [Hotfix 1.0.4]
fix: balance dynamic was fixed

## [Hotfix 1.0.5]
fix: supplier time

## [Hotfix 1.0.6]
fix: redirect to transaction's index since admin was fixed

## [Hotfix 1.0.7]
fix: place image for canceled and failed transactions

## [Hotfix 1.0.8]
fix: transaction detail pdf was fixed

## [Hotfix 1.0.9]
fix: mail section in the env file

## [Hotfix 1.1.0]
fix: style and images of inactive providers mail

## [Hotfix 1.1.1]
fix: font-size of inactive suppliers mail

## [Hotfix 1.1.2]
fix: for loop

## [Hotfix 1.1.3]
fix: cron hour

## [Hotfix 1.1.4]
fix: periodicity of reassign transaction's scheduling 

## [Hotfix 1.1.5]
fix: put 2fa middleware

## [Hotfix 1.1.6]
fix: solve error of logout middleware 

## [Hotfix 1.1.7]
fix: solve cron delay

## [Hotfix 1.1.8]
fix: show chart

## [Hotfix 1.1.9]
fix: put 2fa

## [Hotfix 1.2.0]
fix: home error

## [Hotfix 1.2.1]
fix: put 2fa in ecuador platform

## [Hotfix 1.2.2]
fix: icons of products

## [Hotfix 1.2.2]
fix: icons of products

## [Hotfix 1.2.3]
fix: put 2fa and env variables correctly

## [Hotfix 1.2.4]
fix: put 2fa and env variables correctly in Colombia platform

## [Hotfix 1.2.5]
fix: test cpanel modification

## [Hotfix 1.2.6]
fix: increase time in setTimeout on balance index

## [Hotfix 1.2.7]
fix: balance history in shopkeeper rol

## [Hotfix 1.2.8]
fix: allow decimals in transaction input

## [Hotfix 1.2.9]
fix: add user name to balance extract

## [Hotfix 1.3.0]
fix: add livewire.php to config folder

## [Hotfix 1.3.1]
fix: delete livewire.php

## [Hotfix 1.3.2]
fix: delete dd() in chat-list component

## [Hotfix 1.3.3]
fix: balance assignment

## [Hotfix 1.3.4]
fix: add urlServe variable to iframe in transaction detail

## [Hotfix 1.3.5]
fix: max in input and alert text 

## [Hotfix 1.3.6]
fix: remove palabras clave button

## [Hotfix 1.3.7]
fix: transaction fields

## [Hotfix 1.3.8]
fix: max balance assignment

## [Hotfix 1.3.9]
fix: add SupplierProduct validation to ReassignTransaction Trait

## [Hotfix 1.4.0]
fix: change csrf middleware to accept all routes

## [Hotfix 1.4.1]
fix: add product_name to balances table

## [Hotfix 1.4.2]
fix: change same_site and secure in session file in config folder

## [Hotfix 1.4.3]
fix: add new status to validator of ValidateBalanceController

## [Hotfix 1.4.4]
fix: save balanceOwner on StoreAssignmentBalanceController

## [Hotfix 1.4.5]
fix: add $shopkeeperSummary on StoreAssignmentBalanceController

## [Hotfix 1.4.6]
fix: add bank to summeries on StoreAssignmentBalanceController

## [Hotfix 1.4.7]
fix: balance increment to suppliers when transaction is withdrawal 

## [Hotfix 1.4.8]
fix: delete secondary_color in brands table

## [Hotfix 1.4.9]
fix: add brand style to receipt and password views

## [Hotfix 1.5.0]
fix: change logo and background images 

## [Hotfix 1.5.1]
fix: frames and icons

## [Hotfix 1.5.2]
fix: logout redirect

## [Hotfix 1.5.3]
fix: change text in redirect in logout method in LoginController

## [Hotfix 1.5.4]
fix: change color of submit input in requireDailyPassword view.

## [Hotfix 1.5.5]
fix: add validation to advisers in UpdateTransactionsController and change img src in index view in Cards folder

## [Hotfix 1.5.6]
fix: add is_deleted to cards table and add some validations with this boolean field in blade views

## [Hotfix 1.5.7]
fix: change card validations in addBalanceShopkeeper view and index view of card

## [Hotfix 1.5.8]
fix: limit quantity of products that can be used to assign to shopkeeper according to products assigned to its distributor 

## [Hotfix 1.5.9]
fix: delete old assigned products to shopkeepers 

## [Hotfix 1.6.0]
fix: show the correct commissions on commission index

## [Hotfix 1.6.1]
fix: filter by is_enabled when get products on DeleteProductAssignments seeder

## [Hotfix 1.6.2]
fix: drop strict logical operator in update transaction

## [Hotfix 1.6.3]
fix: add validation in users index to show assign products icon

## [Hotfix 1.6.4]
fix: mail disclaimer text when disabling qr

## [Hotfix 1.6.5]
fix: cyclic front error due to onerror

## [Hotfix 1.6.6]
fix: drop date pickers to update statistics on distributors home 

## [Hotfix 1.6.7]
fix: add country code to whatsapp phone on shopkeeper sidebar

## [Hotfix 1.6.8]
fix: show all products when changing type of them on select of transactions create view and add qr image on addBalance
Shopkeeper view

## [Hotfix 1.6.9]
fix: assign product to shopkeeper when assigning product to distributor

## [Hotfix 1.7.0]
fix: negative balances by shopkeeper transactions

## [Hotfix 1.7.1]
fix: allow one digit in create transaction

## [Hotfix 1.7.2]
fix: validate if transaction status is cancelled and add return to function in UpdateTransactionController

## [Hotfix 1.7.3]
fix: show only Recharge balances on all balances

## [Hotfix 1.7.4]
fix: show print button to show balance voucher on balances index 

## [Hotfix 1.7.5]
fix: don't show transaction load when in phantom mode 

## [Hotfix 1.7.6]
fix: add redirect at the end of upload method on UpdateTransactionController to avoid white screen

## [Hotfix 1.7.7]
fix: delete return on CreateGroupCommissionsController 

## [Hotfix 1.7.8]
fix: store and update type of user on Users module

## [Hotfix 1.7.9]
fix: change url to swagger code on loginUsersController

## [Hotfix 1.7.9]
fix: change url to swagger code on loginUsersController

## [Hotfix 1.8.0]
fix: change strict equality

## [Hotfix 1.8.1]
fix: name of CommissionsGroup class

## [Hotfix 1.8.2]
fix: add isset methods to validate product attributes

## [Hotfix 1.8.3]
fix: add validation to create and edit of commissionsGroup controllers which reject commissions with product on null

## [Hotfix 1.8.4]
fix: add validation to edit of commissionsGroup controllers which reject commissions with product on null

## [Hotfix 1.8.5]
fix: change currency formatter 

## [Hotfix 1.8.6]
fix: add to products endpoint swagger a example 

## [Hotfix 1.8.7]
fix: remove fields on products json

## [Hotfix 1.8.8]
fix: remove fields of product swagger script on GetProductsController

## [Hotfix 1.8.9]
fix: add product_commission and product_type to products swagger example

## [Hotfix 1.9.0]
fix: change attribute on product resource 

## [Hotfix 1.9.1]
fix: transaction swagger

## [Hotfix 1.9.2]
fix: change to snake-case on swagger examples

## [Hotfix 1.9.3]
fix: change enums implementation.

## [Hotfix 1.9.4]
fix: delete parameter on invoke method from GetAllByUserTransactionsController and get it implicitly by jwt token.

## [Hotfix 1.9.5]
fix: change echo by error_log on guzzle exception

## [Release 1.0.0]
## Jun-09-2022 App is ready for tests
