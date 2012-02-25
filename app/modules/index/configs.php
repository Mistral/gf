<?php
/**
 * ## gfFilter Config
 * Configs of Load Filters
 * 
 */

########## LOAD FILTERS #################


## Load Filter In Selected Action #######

//$aArrayOfFiltersInSelectAction['index']['pre'][] = array(/*'filter' => 'exampleFilter', 'type' => gf_FILTER_PRE*/); // use only in action: index before load this action
//$aArrayOfFiltersInSelectAction['index']['post'][] = array(/*'filter' => 'exampleFilter', 'type' => gf_FILTER_POST*/); // use only in action: index after loaded this action
$aArrayOfFiltersInSelectAction['index']['pre'][] = array('filter' => 'geckoFilter', 'type' => gf_FILTER_PRE);


## Load Filter In All Actions ###########

//$aFiltersInAllAction['pre'][] = array('filter' => 'exampleFilter', 'type' => gf_FILTER_PRE); // use filter before execute action -- loaded with all actions
//$aFiltersInAllAction['post'][] = array('filter' => 'exampleFilter', 'type' => gf_FILTER_POST); // use filter after execute action -- loaded with all actions

########## BLOCK AUTO FILTERS ###########


## Block Auto Filter In Selected Action #

//$aBlockAutoArrayOfFilterInSelectAction['index']['pre'][] = array(/*'blockFilter', 'type' => gf_FILTER_PRE*/); // do not use this auto filter with action: index -- before execute action
//$aBlockAutoArrayOfFilterInSelectAction['index']['post'][] = array(/*'blockFilter', 'type' => gf_FILTER_POST*/); // do not use this auto filter with action: index -- after execute action

## Block Auto Filter In All Actions #####

//$aBlockAutoFiltersInAllAction['pre'][] = array(/*'filter' => 'blockFilter', 'type' => gf_FILTER_PRE*/); // do not use this auto filter with filters in array $aFilters -- ignored with all actions
//$aBlockAutoFiltersInAllAction['post'][] = array(/*'filter' => 'blockFilter', 'type' => gf_FILTER_POST*/); // do not use this auto filter with filters in array $aFilters -- ignored with all actions

?>