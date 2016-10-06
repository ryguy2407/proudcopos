<?php
use \TestGuy;

class StockItemsCest
{

    public function _before()
    {
    }

    public function _after()
    {
    }

    // tests
    public function canCreateStockItems(TestGuy $I) 
    {
    	$I->wantTo('Create new stock items');
    	$I->amOnPage('/stock_items/create');
    	$I->see('Add New Stock Item', 'h1');
    	
    	$I->fillField('Barcode', '123456789');
    	$I->fillField('Stock Number', '22');
        $I->fillField('Stock Description', 'Apple Iphone');
    	$I->selectOption('Listed', 'No');
    	$I->selectOption('Sold', 'No');
    	$I->attachFile('input[type="file"]', 'img.jpg');
    	$I->fillField('Sale Price', '100.00');
    	$I->fillField('Postage Price', '10.00');
    	$I->click('Submit');

    	$I->seeCurrentUrlEquals('/stock_items');
    	$I->see('Stock item successfully added', '.flash');
    	$I->seeInDatabase('stock_items', ['stock_number' => '22']);
    }

    public function canSeeStockItemsInIndexView(TestGuy $I)
    {
        $I->wantTo('see a list of stock items');
        $I->haveInDatabase('stock_items', 
            array(
                'barcode' => '6543231',
                'stock_number' => '654321',
                'stock_description' => 'Breville juicer',
                'listed' => '0',
                'sold' => '0',
                'image' => 'public/uploads/stock_images/img.jpg',
                'sale_price' => '20.00',
                'postage_price' => '10.00'
        ));
        $I->amOnPage('/stock_items');
        $I->see('Stock Number: 654321', 'h1');
        $I->see('Breville juicer', 'td');
    }

}