magento_category_output
=======================

[Created by Boson](http://www.bosonhuang.com)

Count & Output all categories from your Magento store. Outputs includes Category ID, Category Name, Category URL path and Category Level.

Output is generated in table view, thus you can copy and past in Excel to convert into prettier sortable table.

Need help? Email [Boson](mailto:boson@bosonhuang.com)

USAGE
=====

1. Put this script to root of you Magento installation folder.
2. Run file in browser: http://www.yourStoreURL.com/categoryOutput.php
3. Put attribute name to (Array type) `$headArray` for output table head row elements. Search `$headArray` for 1st result.
4. Put associated product attribute values to (Array type) `$itemArray` for output content. Search `$itemArray` for 2nd result.

$headArray will be displayed:
-----------------------------

    '#',
    'Category ID',
    'Category Name',
    'Category URL',
    'Category Level'

Table to be displayed in similar format:
----------------------------------------

    # | Category ID | Category Name | Category URL | Category Level
    --- | --- | --- | --- | ---
