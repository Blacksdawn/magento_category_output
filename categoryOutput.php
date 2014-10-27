<?php
/*
 *
 * NOTICE OF LICENSE
 *
 * Ther is no license at all. Free to use.
 * Credit to Boson @ bosonhuang.com
 *
 *
 * USAGE
 *
 * This script generates table-viewed all categories output on screen.
 * 
 * 1. Put this file to root of your Magento installation folder.
 * 2. Put attribute name to(Array type) $headArray for output table head row elements.
 *    Search '$headArray' for 1st result.
 * 3. Put associated product attribute values to(Array type) $itemArray for output content.
 *    Search '$itemArray' for 2nd result.
 * 4. DO NOT CHANGE OR MODIFY OTHER CODES.
 * 
 */

// define Magento root path & get Mage class
define('MAGENTO', realpath(dirname(__FILE__)));
require_once MAGENTO . '/app/Mage.php';
Mage::app();

umask(0);

// get category model
$category = Mage::getModel( 'catalog/category' );
// get category tree model
$tree = $category->getTreeModel();
// load treed category model
$tree->load();

// retrieve categories id collection
$ids = $tree->getCollection()->getAllIds();

if($ids) {
  /*
   * Define table output head row elements
   *
   * @var array
   */
  $headArray = array(
    '#',
    'Category ID',
    'Category Name',
    'Category URL',
    'Category Level'
  );
  
  $itemArray = array();
  $index     = 1;
  
  foreach( $ids as $id ) {
    /*
     * get single category model
     *
     * @var Model
     */
    $cat      = $category->load($id);
    
    /*
     * Define table output content row elements
     *
     * @var array
     */
    $catArray = array(
      $index,
      $id,
      $cat->getName(),
      $cat->getUrlPath(),
      $cat->getLevel()
    );
    
    // add each product output array to table content row array
    array_push($itemArray, $catArray);
    
    $index++;
  }
  
  // output configurable product table
  echo getTable($headArray, $itemArray);
}

/*
 * Generate table output
 *
 * @param array $headArray - table head elements
 * @param array $itemArray - table content elements
 * @return string
 */
function getTable($headArray, $itemArray) {
  $countHead   = itemCount($headArray);
  $countItem   = itemCount($itemArray);
  $tableString = '<table>';
  
  for($i = 0; $i < $countHead; $i++) {
    $tableString .= '<col width="auto">';
  }
  
  if($countHead > 0 && $countItem > 0) {
    $tableString .= getTableRow($headArray, 'th', $countHead);
    $tableString .= getTableRow($itemArray, 'td', $countHead);
  } else
    $tableString .= getTableRow(array());
  
  $tableString .= '</table>';
  
  return $tableString;
}

/*
 * Generate table rows output
 *
 * @param array $arrayList - table row elements
 * @param String $flag     - table row HTML tags
 * @param int $arrayCount  - table row elements size
 * @return string
 */
function getTableRow($arrayList, $flag = '', $arrayCount = 0) {
  if(empty($flag)) {
    $startTag = '<td align="right">';
    $endTag   = '</td>';
  } elseif($flag === 'th') {
    $startTag = '<th align="left">';
    $endTag   = '</th>';
  } elseif($flag === 'td') {
    $startTag = '<td align="right">';
    $endTag   = '</td>';
  }
  
  $tableHeadString = '';
  // output table head
  if(itemCount($arrayList) == $arrayCount) {
    $tableHeadString .= '<tr>';
    foreach($arrayList as $arrayItem) {
      $tableHeadString .= $startTag . $arrayItem . $endTag;
    }
    $tableHeadString .= '</tr>';
  }
  // output table content
  else {
    foreach($arrayList as $listItem) {
      $tableHeadString .= '<tr>';
      if(itemCount($listItem) == $arrayCount) {
        foreach($listItem as $item) {
          $tableHeadString .= $startTag . $item . $endTag;
        }
      }
      $tableHeadString .= '</tr>';
    }
  }
  
  return $tableHeadString;
}

/*
 * count row element size
 *
 * @param array $arrayList - table row elements
 * @return int
 */
function itemCount($arrayList) {
  if(is_array($arrayList) && !empty($arrayList))
    return count($arrayList);
  else
    return 0;
}
